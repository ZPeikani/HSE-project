<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\AiConversation;
use App\Models\AiMessage;
use App\Models\Checklist;
use App\Models\CorrectiveAction;
use App\Models\Department;
use App\Models\Incident;
use App\Models\Inspection;
use App\Models\Risk;
use App\Models\SafetyEquipment;
use App\Models\User;
use App\Models\WorkPermit;
use App\Models\PpeIssue;
use App\Services\AiActionService;
use App\Services\AiKnowledgeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AiChatController extends Controller
{
    private const MAX_CONVERSATIONS = 50;
    private const MAX_MESSAGES      = 100;  // پیام در هر مکالمه
    private const HISTORY_WINDOW    = 20;   // پیام ارسالی به AI

    // ─────────────────────────────────────────────────────────────
    // Context builder (بدون تغییر از نسخه قبل)
    // ─────────────────────────────────────────────────────────────
    private function buildDatabaseContext(User $authUser): string
    {
        $isAdmin      = $authUser->role === UserRole::Admin;
        $isHseManager = $authUser->role === UserRole::HseManager;
        $isInspector  = $authUser->role === UserRole::Inspector;

        $incidentQuery = Incident::with('department');
        if (!$isAdmin && !$isHseManager && !$isInspector) {
            $incidentQuery->where('department_id', $authUser->department_id);
        }
        $incidents       = (clone $incidentQuery)->selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt', 'status');
        $recentIncidents = (clone $incidentQuery)->latest()->take(5)->get()
            ->map(fn($i) => "- [{$i->code}] {$i->title} | نوع: {$i->type} | وضعیت: {$i->status} | واحد: " . ($i->department?->name ?? '-'))
            ->implode("\n");

        $riskQuery = Risk::with('department');
        if (!$isAdmin && !$isHseManager && !$isInspector) {
            $riskQuery->where('department_id', $authUser->department_id);
        }
        $risks        = (clone $riskQuery)->selectRaw('risk_level, COUNT(*) as cnt')->groupBy('risk_level')->pluck('cnt', 'risk_level');
        $criticalRisks = (clone $riskQuery)->where('risk_level', 'بحرانی')->take(5)->get()
            ->map(fn($r) => "- [{$r->code}] {$r->title} | امتیاز: {$r->risk_score} | واحد: " . ($r->department?->name ?? '-'))
            ->implode("\n");

        $inspectionQuery = Inspection::with('department');
        if (!$isAdmin && !$isHseManager && !$isInspector) {
            $inspectionQuery->where('department_id', $authUser->department_id);
        }
        $inspections       = (clone $inspectionQuery)->selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt', 'status');
        $recentInspections = (clone $inspectionQuery)->latest()->take(5)->get()
            ->map(fn($i) => "- [{$i->code}] {$i->title} | وضعیت: {$i->status} | واحد: " . ($i->department?->name ?? '-') . " | امتیاز: " . ($i->score ?? '-'))
            ->implode("\n");

        $actionQuery = CorrectiveAction::with('department', 'assignee');
        if (!$isAdmin && !$isHseManager) {
            $actionQuery->where(function ($q) use ($authUser) {
                $q->where('assignee_id', $authUser->id)
                  ->orWhere('department_id', $authUser->department_id);
            });
        }
        $actions        = (clone $actionQuery)->selectRaw('status, COUNT(*) as cnt')->groupBy('status')->pluck('cnt', 'status');
        $overdueActions = (clone $actionQuery)->whereNotIn('status', ['verified', 'closed'])
            ->whereDate('due_date', '<', now())->take(5)->get()
            ->map(fn($a) => "- [{$a->code}] {$a->title} | مسئول: " . ($a->assignee?->name ?? '-') . " | سررسید: {$a->due_date}")
            ->implode("\n");

        $departments = Department::withCount(['incidents', 'risks'])
            ->when($isAdmin, fn($q) => $q->withCount('users'))
            ->get()
            ->map(function ($d) use ($isAdmin) {
                $line = "- {$d->name} (کد: {$d->code}, ID: {$d->id}) | حوادث: {$d->incidents_count} | ریسک‌ها: {$d->risks_count}";
                if ($isAdmin) $line .= " | کاربران: {$d->users_count}";
                return $line;
            })->implode("\n");

        $ctx  = "=== داده‌های زنده سامانه HSE ===\n";
        $ctx .= "کاربر جاری: {$authUser->name} | نقش: " . $authUser->role->label() . " | ID: {$authUser->id}\n\n";

        $ctx .= "** حوادث **\n";
        $ctx .= "مجموع: " . array_sum($incidents->toArray()) . " مورد\n";
        foreach ($incidents as $status => $cnt) $ctx .= "  - {$status}: {$cnt}\n";
        if ($recentIncidents) $ctx .= "آخرین حوادث:\n{$recentIncidents}\n";

        $ctx .= "\n** ریسک‌ها **\n";
        $ctx .= "مجموع: " . array_sum($risks->toArray()) . " مورد\n";
        foreach ($risks as $level => $cnt) $ctx .= "  - {$level}: {$cnt}\n";
        if ($criticalRisks) $ctx .= "ریسک‌های بحرانی:\n{$criticalRisks}\n";

        $ctx .= "\n** بازرسی‌ها **\n";
        $ctx .= "مجموع: " . array_sum($inspections->toArray()) . " مورد\n";
        foreach ($inspections as $status => $cnt) $ctx .= "  - {$status}: {$cnt}\n";
        if ($recentInspections) $ctx .= "آخرین بازرسی‌ها:\n{$recentInspections}\n";

        $ctx .= "\n** اقدامات اصلاحی **\n";
        $ctx .= "مجموع: " . array_sum($actions->toArray()) . " مورد\n";
        foreach ($actions as $status => $cnt) $ctx .= "  - {$status}: {$cnt}\n";
        if ($overdueActions) $ctx .= "اقدامات معوق:\n{$overdueActions}\n";

        $ctx .= "\n** واحدهای سازمانی **\n";
        $ctx .= "مجموع: " . Department::count() . " واحد\n" . $departments . "\n";

        $ctx .= "\n** کاربران **\n";
        if ($isAdmin) {
            $users = User::with('department')->where('is_active', true)->get()
                ->map(fn($u) => "- {$u->name} | نقش: " . $u->role->label() . " | واحد: " . ($u->department?->name ?? '-'))
                ->implode("\n");
            $ctx .= "مجموع: " . User::count() . " نفر | فعال: " . User::where('is_active', true)->count() . " نفر\n";
            $ctx .= $users . "\n";
        } elseif ($isHseManager) {
            $usersByRole = User::selectRaw('role, COUNT(*) as cnt')->groupBy('role')->pluck('cnt', 'role');
            $ctx .= "مجموع: " . User::count() . " نفر | فعال: " . User::where('is_active', true)->count() . " نفر\n";
            foreach ($usersByRole as $role => $cnt) $ctx .= "  - {$role}: {$cnt}\n";
            $ctx .= "(دسترسی به اسامی کاربران فقط برای مدیر سامانه است)\n";
        } else {
            $ctx .= "(اطلاعات کاربران در سطح دسترسی شما نمایش داده نمی‌شود)\n";
        }

        if ($isAdmin || $isHseManager || $isInspector) {
            $checklists = Checklist::selectRaw('is_active, COUNT(*) as cnt')->groupBy('is_active')->pluck('cnt', 'is_active');
            $ctx .= "\n** چک‌لیست‌ها **\n";
            $ctx .= "مجموع: " . array_sum($checklists->toArray()) . " عدد";
            $ctx .= " | فعال: " . ($checklists[1] ?? $checklists['1'] ?? 0);
            $ctx .= " | غیرفعال: " . ($checklists[0] ?? $checklists['0'] ?? 0) . "\n";
        }

        $equipmentQuery = SafetyEquipment::query()->when(!$isAdmin && !$isHseManager && $authUser->department_id, fn($q) => $q->where('department_id', $authUser->department_id));
        $permitQuery    = WorkPermit::query()->when(!$isAdmin && !$isHseManager && $authUser->department_id, fn($q) => $q->where('department_id', $authUser->department_id));
        $ppeQuery       = PpeIssue::query()->when(!$isAdmin && !$isHseManager && $authUser->department_id, fn($q) => $q->whereHas('user', fn($u) => $u->where('department_id', $authUser->department_id)));
        $ctx .= "\n** تجهیزات، PPE و مجوز کار **\n";
        $ctx .= "تجهیزات ایمنی: " . (clone $equipmentQuery)->count() . " | سررسید: " . (clone $equipmentQuery)->where(fn($q) => $q->whereDate('next_inspection_at', '<=', today())->orWhereDate('next_service_at', '<=', today()))->count() . "\n";
        $ctx .= "مجوزهای فعال: " . (clone $permitQuery)->whereIn('status', ['approved', 'active'])->count() . " | PPE نزدیک تعویض: " . (clone $ppeQuery)->where('status', 'issued')->whereDate('expires_at', '<=', today()->addDays(30))->count() . "\n";

        return $ctx;
    }

    // ─────────────────────────────────────────────────────────────
    // System Prompt با قابلیت عملیات
    // ─────────────────────────────────────────────────────────────
    private function buildSystemPrompt(User $authUser, string $knowledgeContext = ""): string
    {
        $dbContext = $this->buildDatabaseContext($authUser);
        $isAdmin   = $authUser->role === UserRole::Admin;

        $operationalSection = '';
        if ($isAdmin) {
            $depts = Department::where('is_active', true)->get()->map(fn($d) => "  ID={$d->id}: {$d->name}")->implode("\n");
            $roles = implode(', ', array_map(fn($r) => $r->value . '=' . $r->label(), UserRole::cases()));

            $operationalSection = "\n\n=== قابلیت‌های عملیاتی ===\n"
                . "شما می‌توانید کاربر جدید ایجاد کنید. فرآیند:\n"
                . "1. اطلاعات را از مکالمه استخراج کن (نام، ایمیل الزامی؛ کد پرسنلی، تلفن، نقش، واحد اختیاری)\n"
                . "2. وقتی اطلاعات کافی جمع شد، یک JSON با کلید ACTION_REQUIRED ارسال کن:\n"
                . '   {"ACTION_REQUIRED":"create_user","params":{"name":"...","email":"...","personnel_code":"...","phone":"...","role":"...","department_id":...},"preview":"خلاصه برای نمایش به کاربر"}' . "\n"
                . "3. منتظر تأیید کاربر بمان. بعد از تأیید، سیستم عملیات را انجام می‌دهد.\n"
                . "4. اگر اطلاعات ناقص است، فقط اطلاعات مفقود را بپرس.\n"
                . "نقش‌های مجاز: {$roles}\n"
                . "واحدهای سازمانی:\n{$depts}\n"
                . "نکته مهم: JSON با ACTION_REQUIRED را فقط وقتی همه اطلاعات لازم جمع شد ارسال کن.";
        }

        return 'شما یک دستیار هوش مصنوعی تخصصی در حوزه HSE (بهداشت، ایمنی و محیط‌زیست) هستید. '
            . 'در یک سامانه مدیریت HSE فعالیت می‌کنید و به کارکنان، بازرسان و مدیران کمک می‌کنید. '
            . 'پاسخ‌های خود را به فارسی، کوتاه، دقیق و عملی ارائه دهید. '
            . 'در صورت لزوم از اعداد، لیست‌بندی یا راهنمای گام‌به‌گام استفاده کنید. '
            . 'وقتی سوال درباره داده‌های سامانه است، از اطلاعات زیر استفاده کن:'
            . "\n\n" . $dbContext
            . $operationalSection
            . "\n\n" . $knowledgeContext
            . "\n\nقواعد استفاده از منابع: اگر منبع ایرانی بازیابی شده، در پرسش‌های حقوقی/الزام‌آور آن را بر اطلاعات عمومی ترجیح بده. عنوان منبع و ماده/بند را فقط وقتی ذکر کن که در منبع بازیابی‌شده وجود دارد. اگر کاربر سؤال پیگیری مانند «کدام ماده؟»، «براساس کدام ماده؟»، «کدام بند؟» یا مشابه آن پرسید، موضوع را از تاریخچه مکالمه تشخیص بده و فقط از همان موضوع/آیین‌نامه برای تعیین مستند استفاده کن؛ به یک ماده از آیین‌نامه‌ای دیگر صرفاً به دلیل وجود واژه «ماده» استناد نکن. برای عدد، آستانه، الزام قانونی و شماره ماده، فقط وقتی پاسخ قطعی بده که در منابع بازیابی‌شده صریحاً پشتیبانی شده باشد. اگر منابع با هم تعارض دارند یا منبع کافی نیست، تعارض/نبود منبع را صریح اعلام کن و چیزی را حدس نزن. منبع ایرانی و استاندارد/راهنمای بین‌المللی را با هم مخلوط نکن؛ در صورت نیاز آن‌ها را جداگانه با برچسب «الزامات قانونی ایران» و «راهنمای بین‌المللی» توضیح بده.";
    }

    // ─────────────────────────────────────────────────────────────
    // GET /ai/conversations
    // ─────────────────────────────────────────────────────────────
    public function conversations()
    {
        $conversations = AiConversation::where('user_id', Auth::id())
            ->withCount(['messages as messages_count' => fn ($query) => $query->where('role', 'user')])
            ->orderByDesc('updated_at')
            ->get(['id', 'title', 'updated_at']);

        return response()->json([
            'conversations'   => $conversations,
            'max_convs'       => self::MAX_CONVERSATIONS,
            'max_msgs'        => self::MAX_MESSAGES,
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // GET /ai/conversations/{id}
    // ─────────────────────────────────────────────────────────────
    public function showConversation(int $id)
    {
        $conversation = AiConversation::where('user_id', Auth::id())
            ->with('messages')
            ->findOrFail($id);

        return response()->json([
            'id'            => $conversation->id,
            'title'         => $conversation->title,
            'message_count' => $conversation->messages->where('role', 'user')->count(),
            'messages'      => $conversation->messages->map(fn($m) => [
                'role'    => $m->role,
                'content' => $m->content,
            ]),
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // POST /ai/conversations
    // ─────────────────────────────────────────────────────────────
    public function newConversation()
    {
        $user  = Auth::user();
        $count = AiConversation::where('user_id', $user->id)->count();

        // اگر به ظرفیت رسیده، اطلاعات قدیمی‌ترین مکالمه را برگردان
        if ($count >= self::MAX_CONVERSATIONS) {
            $oldest = AiConversation::where('user_id', $user->id)
                ->orderBy('updated_at')
                ->first();

            return response()->json([
                'needs_confirm' => true,
                'oldest_title'  => $oldest?->title ?? 'مکالمه قدیمی',
                'oldest_id'     => $oldest?->id,
                'count'         => $count,
                'max'           => self::MAX_CONVERSATIONS,
            ]);
        }

        $conversation = AiConversation::create([
            'user_id' => $user->id,
            'title'   => 'مکالمه جدید',
        ]);

        return response()->json(['id' => $conversation->id, 'title' => $conversation->title]);
    }

    // ─────────────────────────────────────────────────────────────
    // POST /ai/conversations/force-new  (بعد از تأیید کاربر)
    // ─────────────────────────────────────────────────────────────
    public function forceNewConversation()
    {
        $user = Auth::user();
        AiConversation::where('user_id', $user->id)
            ->orderBy('updated_at')
            ->first()
            ?->delete();

        $conversation = AiConversation::create([
            'user_id' => $user->id,
            'title'   => 'مکالمه جدید',
        ]);

        return response()->json(['id' => $conversation->id, 'title' => $conversation->title]);
    }

    // ─────────────────────────────────────────────────────────────
    // DELETE /ai/conversations/{id}
    // ─────────────────────────────────────────────────────────────
    public function deleteConversation(int $id)
    {
        AiConversation::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail()
            ->delete();

        return response()->json(['ok' => true]);
    }

    // ─────────────────────────────────────────────────────────────
    // DELETE /ai/conversations
    // ─────────────────────────────────────────────────────────────
    public function deleteAllConversations()
    {
        AiConversation::where('user_id', Auth::id())->delete();
        return response()->json(['ok' => true]);
    }

    // ─────────────────────────────────────────────────────────────
    // POST /ai/chat
    // ─────────────────────────────────────────────────────────────
    public function chat(Request $request)
    {
        $request->validate([
            'message'         => 'required|string|max:2000',
            'conversation_id' => 'nullable|integer',
        ]);

        $user = Auth::user();

        // ── پیدا یا ایجاد مکالمه ──
        if ($request->conversation_id) {
            $conversation = AiConversation::where('user_id', $user->id)
                ->findOrFail($request->conversation_id);
        } else {
            $count = AiConversation::where('user_id', $user->id)->count();
            if ($count >= self::MAX_CONVERSATIONS) {
                // در این حالت frontend قبلاً باید تأیید گرفته باشد؛
                // اگر به اینجا رسید بدون تأیید، خطا برگردانید
                return response()->json([
                    'error'         => 'ظرفیت مکالمات تکمیل شده است.',
                    'needs_confirm' => true,
                ], 422);
            }
            $conversation = AiConversation::create([
                'user_id' => $user->id,
                'title'   => mb_substr($request->message, 0, 50),
            ]);
        }

        // ── بررسی محدودیت پیام‌های مکالمه ──
        $msgCount = $conversation->messages()->where('role', 'user')->count();
        if ($msgCount >= self::MAX_MESSAGES) {
            return response()->json([
                'error'       => "ظرفیت پیام‌های کاربر در این مکالمه تکمیل شده است (حداکثر " . self::MAX_MESSAGES . " پیام). لطفاً مکالمه جدیدی شروع کنید.",
                'conv_full'   => true,
                'msg_count'   => $msgCount,
                'max_msgs'    => self::MAX_MESSAGES,
            ], 422);
        }

        // ── تاریخچه از DB (آخرین HISTORY_WINDOW پیام) ──
        $dbHistory = $conversation->messages()
            ->latest('created_at')
            ->take(self::HISTORY_WINDOW)
            ->get()
            ->reverse()
            ->values();

        // ── بازیابی منابع HSE مرتبط با سؤال ──
        // برای سؤال‌های پیگیری مثل «براساس کدوم ماده؟»، سؤال قبلی هم وارد
        // عبارت جست‌وجو می‌شود تا موضوع آیین‌نامه از دست نرود.
        $knowledgeService = app(AiKnowledgeService::class);

        $retrievalQuestion = $request->message;
        $recentUserQuestions = $dbHistory
            ->where('role', 'user')
            ->pluck('content')
            ->take(-3)
            ->all();

        if ($recentUserQuestions !== []) {
            $retrievalQuestion = implode("\n", array_merge($recentUserQuestions, [$request->message]));
        }

        $knowledgeResults = $knowledgeService->search($retrievalQuestion);

        // برای سؤال‌های حقوقی، اگر منبع بازیابی نشد، اصلاً به مدل اجازه تولید
        // پاسخ حدسی نمی‌دهیم؛ پاسخ کنترل‌شده برمی‌گردد.
        $normalizedRetrievalQuestion = mb_strtolower($retrievalQuestion);
        $isLegalQuestion = false;
        foreach ([
            'قانون', 'آیین نامه', 'آیین‌نامه', 'ماده', 'تبصره', 'بند',
            'الزام قانونی', 'الزامات ایمنی', 'مقررات', 'وزارت کار', 'شورای عالی حفاظت فنی',
            'مشمول الزامات', 'کار در ارتفاع', 'ارتفاع مشمول',
            'براساس کدام ماده', 'بر اساس کدام ماده',
        ] as $legalTerm) {
            if (mb_stripos($normalizedRetrievalQuestion, $legalTerm) !== false) {
                $isLegalQuestion = true;
                break;
            }
        }

        if ($isLegalQuestion && $knowledgeResults === []) {
            $content = 'برای این پرسش حقوقی/مقرراتی، منبع فعال و مشخصی در پایگاه دانش پیدا نشد؛ بنابراین از بیان عدد، ماده یا الزام قانونی بدون مستند خودداری می‌کنم.';

            AiMessage::insert([
                ['ai_conversation_id' => $conversation->id, 'role' => 'user', 'content' => $request->message, 'created_at' => now()],
                ['ai_conversation_id' => $conversation->id, 'role' => 'assistant', 'content' => $content, 'created_at' => now()],
            ]);

            $conversation->touch();
            $conversation->save();

            return response()->json([
                'reply' => $content,
                'conversation_id' => $conversation->id,
                'msg_count' => $msgCount + 1,
                'max_msgs' => self::MAX_MESSAGES,
            ]);
        }

        $knowledgeContext = $knowledgeService->formatForPrompt($knowledgeResults);

        // ── ساخت payload برای AI ──
        $systemPrompt = $this->buildSystemPrompt($user, $knowledgeContext);
        $messages     = [['role' => 'system', 'content' => $systemPrompt]];
        foreach ($dbHistory as $h) {
            $messages[] = ['role' => $h->role, 'content' => $h->content];
        }
        $messages[] = ['role' => 'user', 'content' => $request->message];

        // ── فراخوانی AI ──
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.key'),
                'HTTP-Referer'  => config('app.url'),
                'X-Title'       => config('app.name'),
                'Content-Type'  => 'application/json',
            ])
            ->timeout(30)
            ->post('https://openrouter.ai/api/v1/chat/completions', [
                'model'       => 'openai/gpt-4o-mini',
                'messages'    => $messages,
                'max_tokens'  => 1000,
                'temperature' => 0.2,
            ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'خطا در اتصال به سرویس هوش مصنوعی.',
                'debug' => ['http_status' => $response->status(), 'body' => $response->json() ?? $response->body()],
            ], 502);
        }

        $content = $response->json('choices.0.message.content', '');
        if (empty($content)) {
            return response()->json([
                'error' => 'پاسخی از سرویس هوش مصنوعی دریافت نشد.',
                'debug' => ['http_status' => $response->status(), 'body' => $response->json() ?? $response->body()],
            ], 502);
        }

        // ── تشخیص ACTION_REQUIRED در پاسخ AI ──
        $actionPayload = $this->extractActionPayload($content);

        // ── ذخیره پیام‌ها ──
        AiMessage::insert([
            ['ai_conversation_id' => $conversation->id, 'role' => 'user',      'content' => $request->message,  'created_at' => now()],
            ['ai_conversation_id' => $conversation->id, 'role' => 'assistant', 'content' => trim($content),     'created_at' => now()],
        ]);

        // ── به‌روزرسانی عنوان ──
        if ($conversation->title === 'مکالمه جدید') {
            $conversation->title = mb_substr($request->message, 0, 50);
        }
        $conversation->touch();
        $conversation->save();

        $result = [
            'reply'           => trim($content),
            'conversation_id' => $conversation->id,
            'msg_count'       => $msgCount + 1,
            'max_msgs'        => self::MAX_MESSAGES,
        ];

        if ($actionPayload) {
            // پاسخ نمایشی را از JSON پاک کن
            $displayReply = $this->stripActionJson($content);
            $result['reply']          = $displayReply ?: 'اطلاعات کاربر جدید آماده است. لطفاً تأیید کنید.';
            $result['action_pending'] = $actionPayload;
        }

        return response()->json($result);
    }

    // ─────────────────────────────────────────────────────────────
    // POST /ai/action  — اجرای عملیات بعد از تأیید کاربر
    // ─────────────────────────────────────────────────────────────
    public function executeAction(Request $request)
    {
        $request->validate([
            'action'          => 'required|string',
            'params'          => 'required|array',
            'conversation_id' => 'nullable|integer',
        ]);

        $user    = Auth::user();
        $service = new AiActionService();
        $result  = $service->dispatch($request->action, $request->params, $user);

        // ذخیره نتیجه در مکالمه (اگر conversation_id داده شده)
        if ($request->conversation_id && $result['ok']) {
            $conversation = AiConversation::where('user_id', $user->id)
                ->find($request->conversation_id);

            if ($conversation) {
                $userMessageCount = $conversation->messages()
                    ->where('role', 'user')
                    ->count();

                if ($userMessageCount >= self::MAX_MESSAGES) {
                    return response()->json([
                        'error'     => "ظرفیت پیام‌های کاربر در این مکالمه تکمیل شده است (حداکثر " . self::MAX_MESSAGES . " پیام).",
                        'conv_full' => true,
                        'msg_count' => $userMessageCount,
                        'max_msgs'  => self::MAX_MESSAGES,
                    ], 422);
                }

                AiMessage::insert([
                    ['ai_conversation_id' => $conversation->id, 'role' => 'user',      'content' => '[عملیات: ' . $request->action . ']', 'created_at' => now()],
                    ['ai_conversation_id' => $conversation->id, 'role' => 'assistant', 'content' => $result['message'],                   'created_at' => now()],
                ]);
                $conversation->touch();
            }
        }

        return response()->json($result);
    }

    // ─────────────────────────────────────────────────────────────
    // Helpers
    // ─────────────────────────────────────────────────────────────

    /** استخراج JSON عملیات از پاسخ AI */
    private function extractActionPayload(string $content): ?array
    {
        if (!str_contains($content, 'ACTION_REQUIRED')) return null;

        // تلاش برای پیدا کردن JSON در متن
        if (preg_match('/\{[^{}]*"ACTION_REQUIRED"[^{}]*\}/s', $content, $m)) {
            $decoded = json_decode($m[0], true);
            if (is_array($decoded) && isset($decoded['ACTION_REQUIRED'], $decoded['params'])) {
                return $decoded;
            }
        }

        return null;
    }

    /** حذف JSON عملیات از متن پاسخ برای نمایش تمیز */
    private function stripActionJson(string $content): string
    {
        $cleaned = preg_replace('/\{[^{}]*"ACTION_REQUIRED"[^{}]*\}/s', '', $content);
        return trim($cleaned ?? $content);
    }
}
