@extends('layouts.app') @section('title','گزارش‌ها') @section('page-title','گزارش‌های مدیریتی HSE') @section('content')
@php
    $jFrom  = \Morilog\Jalali\Jalalian::fromCarbon($from);
    $jTo    = \Morilog\Jalali\Jalalian::fromCarbon($to);
    $fromVal = $jFrom->getYear() . '/' . sprintf('%02d', $jFrom->getMonth()) . '/' . sprintf('%02d', $jFrom->getDay());
    $toVal   = $jTo->getYear()   . '/' . sprintf('%02d', $jTo->getMonth())   . '/' . sprintf('%02d', $jTo->getDay());
    $riskChart = ['type' => 'doughnut', 'data' => ['labels' => ['بحرانی', 'زیاد', 'متوسط', 'کم'], 'datasets' => [['data' => [$riskByLevel['بحرانی'] ?? 0, $riskByLevel['زیاد'] ?? 0, $riskByLevel['متوسط'] ?? 0, $riskByLevel['کم'] ?? 0], 'backgroundColor' => ['#e11d48', '#f97316', '#f59e0b', '#10b981'], 'borderWidth' => 0]]], 'options' => ['responsive' => true, 'maintainAspectRatio' => false, 'plugins' => ['legend' => ['position' => 'bottom', 'rtl' => true, 'labels' => ['usePointStyle' => true, 'padding' => 18]]]]];
    $incidentChart = ['type' => 'bar', 'data' => ['labels' => ['حادثه', 'شبه‌حادثه', 'بیماری شغلی', 'محیط‌زیستی'], 'datasets' => [['label' => 'تعداد رویداد', 'data' => [$incidentByType['incident'] ?? 0, $incidentByType['near_miss'] ?? 0, $incidentByType['occupational_disease'] ?? 0, $incidentByType['environmental'] ?? 0], 'backgroundColor' => ['#f43f5e', '#f59e0b', '#8b5cf6', '#0ea5e9'], 'borderRadius' => 8, 'borderSkipped' => false]]], 'options' => ['responsive' => true, 'maintainAspectRatio' => false, 'plugins' => ['legend' => ['display' => false]], 'scales' => ['y' => ['beginAtZero' => true, 'ticks' => ['precision' => 0]], 'x' => ['grid' => ['display' => false]]]]];
    $departmentLabels = $departmentStats->pluck('name')->values()->all();
    $departmentRisks = $departmentStats->pluck('risks_count')->map(fn($value) => (int) $value)->values()->all();
    $departmentActions = $departmentStats->pluck('actions_open')->map(fn($value) => (int) $value)->values()->all();
    $departmentInspections = $departmentStats->pluck('inspection_avg')->map(fn($value) => (float) $value)->values()->all();
    $departmentChart = ['type' => 'bar', 'data' => ['labels' => $departmentLabels, 'datasets' => [['label' => 'ریسک ثبت‌شده', 'data' => $departmentRisks, 'backgroundColor' => '#f97316', 'borderRadius' => 6, 'borderSkipped' => false, 'barThickness' => 10, 'maxBarThickness' => 12], ['label' => 'اقدام باز', 'data' => $departmentActions, 'backgroundColor' => '#0ea5e9', 'borderRadius' => 6, 'borderSkipped' => false, 'barThickness' => 10, 'maxBarThickness' => 12], ['label' => 'میانگین بازرسی', 'data' => $departmentInspections, 'backgroundColor' => '#10b981', 'borderRadius' => 6, 'borderSkipped' => false, 'barThickness' => 10, 'maxBarThickness' => 12]]], 'options' => ['responsive' => true, 'maintainAspectRatio' => false, 'plugins' => ['legend' => ['position' => 'bottom', 'rtl' => true, 'labels' => ['usePointStyle' => true, 'padding' => 18]]], 'scales' => ['y' => ['beginAtZero' => true, 'ticks' => ['precision' => 0]], 'x' => ['grid' => ['display' => false], 'categoryPercentage' => .65, 'barPercentage' => .7]]]];
@endphp
<div class="mb-4 flex flex-wrap gap-2"><span class="py-2 text-sm font-bold">خروجی Excel/CSV:</span>@foreach(['risks'=>'ریسک‌ها','incidents'=>'حوادث','actions'=>'CAPA','inspections'=>'بازرسی‌ها'] as $k=>$v)<a href="{{ route('reports.export',['type'=>$k]) }}" class="rounded-xl bg-emerald-50 px-4 py-2 text-xs font-bold text-emerald-700">{{ $v }}</a>@endforeach</div>
<form class="mb-5 flex flex-wrap items-end gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm"><div><span class="mb-1 block text-xs font-bold">از تاریخ</span><div class="relative"><input type="text" name="from" value="{{ $fromVal }}" data-jdatepicker="date" autocomplete="off" dir="ltr" class="rounded-xl border border-slate-200 bg-slate-50 py-2 pl-3 pr-9" style="background-image:none;"><span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span></div></div><div><span class="mb-1 block text-xs font-bold">تا تاریخ</span><div class="relative"><input type="text" name="to" value="{{ $toVal }}" data-jdatepicker="date" autocomplete="off" dir="ltr" class="rounded-xl border border-slate-200 bg-slate-50 py-2 pl-3 pr-9" style="background-image:none;"><span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span></div></div><button class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-bold text-white shadow-sm">به‌روزرسانی گزارش</button><button type="button" onclick="print()" class="rounded-xl border border-slate-200 bg-slate-50 px-5 py-2.5 text-sm font-bold">چاپ / PDF</button></form>
<div class="grid gap-5 lg:grid-cols-2"><section class="rounded-2xl border border-emerald-200 bg-[linear-gradient(135deg,#ffffff_0%,#f0fdf4_38%,#dcfce7_100%)] p-6 shadow-[0_16px_28px_rgba(22,163,74,0.08)]"><div class="flex items-center justify-between"><h3 class="font-black">توزیع سطح ریسک‌ها</h3><span class="text-xs text-slate-400">{{ $riskByLevel->sum() }} مورد</span></div><div class="mx-auto mt-5 h-64 max-w-sm"><canvas data-chart='@json($riskChart)'></canvas></div></section><section class="rounded-2xl border border-sky-200 bg-[linear-gradient(135deg,#ffffff_0%,#f0f9ff_35%,#e0f2fe_100%)] p-6 shadow-[0_16px_28px_rgba(14,165,233,0.08)]"><h3 class="font-black">ترکیب رویدادها</h3><div class="mt-5 h-64"><canvas data-chart='@json($incidentChart)'></canvas></div></section></div>
<div class="mt-5 w-full lg:w-1/2"><section class="w-full rounded-2xl border border-slate-200 bg-[linear-gradient(135deg,#ffffff_0%,#f8fafc_35%,#f3f4f6_100%)] p-6 shadow-[0_16px_28px_rgba(15,23,42,0.05)]"><div class="mb-4 flex items-center justify-between"><div><h3 class="font-black">مقایسه عملکرد واحدها</h3><p class="text-xs text-slate-400">ریسک ثبت‌شده، اقدام باز و میانگین امتیاز بازرسی</p></div><span class="text-xs text-slate-400">در بازه انتخاب‌شده</span></div><div class="h-64 w-full"><canvas class="!h-full !w-full" data-chart='@json($departmentChart)'></canvas></div></section></div>
<section class="mt-5 overflow-hidden rounded-[28px] border border-emerald-200 bg-[linear-gradient(135deg,#ffffff_0%,#f8fafc_28%,#ecfdf5_100%)] shadow-[0_18px_32px_rgba(15,23,42,0.06)]">
    <div class="flex flex-col gap-3 border-b border-emerald-200 bg-[linear-gradient(135deg,#eff6ff_0%,#ecfdf5_40%,#f0fdf4_100%)] p-5 md:flex-row md:items-center md:justify-between">
        <div>
            <h3 class="text-lg font-black text-slate-800">عملکرد واحدهای سازمانی</h3>
            <p class="mt-1 text-xs text-slate-500">مقایسه ریسک، اقدام باز و میانگین امتیاز بازرسی</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 text-xs">
            <span class="rounded-full border border-slate-200 bg-white px-2.5 py-1.5 font-bold text-slate-600">{{ $departmentStats->count() }} واحد</span>
            <span class="rounded-full bg-emerald-100 px-2.5 py-1.5 font-bold text-emerald-800">میانگین {{ round($departmentStats->avg('inspection_avg') ?? 0, 1) }}٪</span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[760px] border-separate border-spacing-0 text-right text-sm">
            <thead>
                <tr class="bg-slate-100 text-[11px] text-slate-600">
                    <th class="p-4 font-black">واحد</th>
                    <th class="p-4 font-black">کاربران</th>
                    <th class="p-4 font-black">ریسک‌های ثبت‌شده</th>
                    <th class="p-4 font-black">اقدامات باز</th>
                    <th class="p-4 font-black">میانگین بازرسی</th>
                    <th class="p-4 font-black">ارزیابی</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departmentStats as $d)
                    @php
                        $statusClass = $d->inspection_avg >= 85 ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : ($d->inspection_avg >= 70 ? 'bg-amber-100 text-amber-700 border-amber-200' : 'bg-rose-100 text-rose-700 border-rose-200');
                        $statusText = $d->inspection_avg >= 85 ? 'مطلوب' : ($d->inspection_avg >= 70 ? 'نیازمند بهبود' : 'نامطلوب');
                        $openActionClass = $d->actions_open > 3 ? 'text-rose-600 font-black' : 'text-slate-700';
                    @endphp
                    <tr class="border-b border-slate-200 bg-white transition-colors duration-200 hover:bg-slate-50">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-black text-slate-800">{{ $d->name }}</div>
                                    <div class="mt-0.5 text-[11px] text-slate-500">واحد عملکردی</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex min-w-[52px] items-center justify-center rounded-lg bg-slate-200 px-2.5 py-1.5 font-bold text-slate-700">{{ $d->users_count }}</span>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex min-w-[52px] items-center justify-center rounded-lg bg-orange-100 px-2.5 py-1.5 font-bold text-orange-700">{{ $d->risks_count }}</span>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex min-w-[52px] items-center justify-center rounded-lg {{ $d->actions_open > 3 ? 'bg-rose-100' : 'bg-sky-100' }} px-2.5 py-1.5 font-bold {{ $openActionClass }}">{{ $d->actions_open }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-end gap-2">
                                <span class="font-black text-slate-800">{{ $d->inspection_avg }}٪</span>
                                <div class="h-2.5 w-20 overflow-hidden rounded-full bg-slate-100">
                                    <div class="h-full rounded-full {{ $d->inspection_avg >= 85 ? 'bg-emerald-500' : ($d->inspection_avg >= 70 ? 'bg-amber-500' : 'bg-rose-500') }}" style="width: {{ min(max($d->inspection_avg, 0), 100) }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex rounded-full border px-2.5 py-1.5 text-xs font-black {{ $statusClass }}">{{ $statusText }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>@endsection
