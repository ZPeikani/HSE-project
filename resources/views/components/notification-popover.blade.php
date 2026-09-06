<div class="relative" data-notification-menu>
 <button type="button" data-notification-toggle title="اعلان‌ها" aria-label="اعلان‌ها" aria-expanded="false" class="relative grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-emerald-300 hover:text-emerald-600">
  @include('components.icon',['name'=>'bell'])
  @if($unreadNotifications)<span data-notification-badge class="absolute -left-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white">{{ $unreadNotifications }}</span>@endif
 </button>
 <div data-notification-panel class="absolute top-12 z-50 hidden w-[min(360px,calc(100vw-2rem))] overflow-hidden rounded-xl border border-emerald-200 bg-white text-right shadow-2xl ring-1 ring-slate-900/5" style="left: 0; right: auto;" dir="rtl">
  <div class="flex items-center justify-between border-b border-slate-100 bg-emerald-50 px-4 py-3"><div class="font-black text-slate-800">اعلان ها</div><span class="text-xs font-bold text-emerald-700">{{ $unreadNotifications }} خوانده‌نشده</span></div>
  <div class="max-h-80 divide-y divide-slate-100 overflow-y-auto">
   @forelse($unreadNotificationItems as $notification)
   <a href="{{ route('notifications.index') }}" class="block px-4 py-3 transition hover:bg-emerald-50"><div class="flex items-start gap-2"><span class="mt-1.5 h-2.5 w-2.5 shrink-0 rounded-full {{ $notification->type === 'overdue' ? 'bg-rose-500' : ($notification->type === 'due_today' ? 'bg-amber-500' : 'bg-sky-500') }}"></span><div class="min-w-0"><div class="text-sm font-bold text-slate-800">{{ $notification->title }}</div><div class="mt-1 truncate text-xs text-slate-500">{{ $notification->message }}</div></div></div></a>
   @empty
   <div class="px-4 py-8 text-center text-sm text-slate-400">اعلان خوانده‌نشده‌ای ندارید.</div>
   @endforelse
  </div>
    <a href="{{ route('notifications.index') }}" class="block border-t border-slate-100 bg-slate-50 px-4 py-3 text-center text-sm font-bold text-emerald-700 transition hover:bg-emerald-100">مشاهده همه اعلان‌ها</a>
 </div>
</div>
<div data-notification-toast-container class="fixed z-60 flex w-[min(420px,calc(100vw-2rem))] flex-col gap-2" style="top: 20px; left: 50%; right: auto; transform: translateX(-50%);" dir="rtl"></div>
<script>
(function () {
 const menu = document.querySelector('[data-notification-menu]');
 if (!menu) return;
 const toggle = menu.querySelector('[data-notification-toggle]');
 const panel = menu.querySelector('[data-notification-panel]');
 let latestNotificationId = {{ $unreadNotificationItems->merge(collect([\App\Models\HseNotification::where('user_id', auth()->id())->latest('id')->first()]))->max('id') ?? 0 }};
 const initialNotifications = @json($unreadNotificationItems->map(fn ($notification) => ['id' => $notification->id, 'title' => $notification->title, 'message' => $notification->message])->values());
 const toastContainer = document.querySelector('[data-notification-toast-container]');
 const pollUrl = @json(route('notifications.poll'));
 const close = function () { panel.classList.add('hidden'); toggle.setAttribute('aria-expanded', 'false'); };
 toggle.addEventListener('click', function (event) { event.stopPropagation(); const isOpen = !panel.classList.contains('hidden'); panel.classList.toggle('hidden', isOpen); toggle.setAttribute('aria-expanded', String(!isOpen)); });
 document.addEventListener('click', function (event) { if (!menu.contains(event.target)) close(); });
 document.addEventListener('keydown', function (event) { if (event.key === 'Escape') close(); });
 const showToast = function (notification) {
  const toast = document.createElement('a');
  toast.href = @json(route('notifications.index'));
  toast.className = 'relative block overflow-hidden rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-right text-emerald-900 shadow-2xl ring-1 ring-emerald-950/10';
  toast.innerHTML = '<div class="mb-1 text-xs font-bold text-emerald-700">اعلان جدید</div><div class="text-sm font-black text-emerald-950"></div><div class="mt-1 text-xs text-emerald-800"></div><div style="position:absolute;right:0;bottom:0;height:4px;width:100%;background:#ffffff;"><div data-toast-progress style="height:100%;width:100%;background:#047857;transition:width 8s linear;"></div></div>';
  toast.querySelector('div:nth-child(2)').textContent = notification.title;
  toast.querySelector('div:nth-child(3)').textContent = notification.message || '';
  toastContainer.appendChild(toast);
  const progress = toast.querySelector('[data-toast-progress]');
  setTimeout(function () { progress.style.width = '0%'; }, 20);
  setTimeout(function () { toast.remove(); }, 8000);
 };
 const updateBadge = function (count) {
  let badge = menu.querySelector('[data-notification-badge]');
  if (!count) { if (badge) badge.remove(); return; }
  if (!badge) { badge = document.createElement('span'); badge.dataset.notificationBadge = ''; badge.className = 'absolute -left-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white'; toggle.appendChild(badge); }
  badge.textContent = count;
 };
 const shownKey = 'hse-shown-notification-toasts-v8';
 const shown = new Set(JSON.parse(sessionStorage.getItem(shownKey) || '[]'));
 const poll = function () { fetch(pollUrl, { headers: { 'Accept': 'application/json' } }).then(response => response.json()).then(data => { updateBadge(data.unread_count); data.notifications.forEach(function (notification) { if (notification.id > latestNotificationId) { latestNotificationId = notification.id; shown.add(notification.id); showToast(notification); } }); sessionStorage.setItem(shownKey, JSON.stringify(Array.from(shown).slice(-50))); }).catch(function () {}); };
 initialNotifications.forEach(function (notification) { if (!shown.has(notification.id)) { shown.add(notification.id); showToast(notification); } });
 sessionStorage.setItem(shownKey, JSON.stringify(Array.from(shown).slice(-50)));
 setInterval(poll, 20000);
}());
</script>
