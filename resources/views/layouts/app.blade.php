<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="csrf-token" content="{{ csrf_token() }}"><title>@yield('title','داشبورد') | HSE</title>@vite(['resources/css/app.css','resources/js/app.js'])<link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css"><script src="https://unpkg.com/jquery@3.7.1/dist/jquery.min.js"></script><script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script><script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script><style>.datepicker-plot-area{font-family:-apple-system,"Segoe UI",system-ui,sans-serif!important;border-radius:1rem!important;border:1px solid #e5e7eb!important;box-shadow:0 10px 40px #0001!important;} .datepicker-plot-area *{direction:rtl!important;} .selected-day{background:#10b981!important;} .hover{background:#d1fae5!important;color:#065f46!important;}</style></head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
<div class="min-h-screen lg:grid lg:grid-cols-[270px_1fr]">
 <aside class="hidden lg:flex sticky top-0 h-screen flex-col bg-slate-950 text-white">
  <div class="flex h-20 items-center gap-3 border-b border-white/10 px-6"><div class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-600 shadow-lg shadow-emerald-950/40"><svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4zM9 12l2 2 4-5"/></svg></div><div><div class="font-black">سامانه مدیریت HSE</div><div class="mt-0.5 text-[11px] text-slate-400">سلامت، ایمنی و محیط‌زیست</div></div></div>
  <nav class="scrollbar-thin flex-1 overflow-y-auto p-3 text-sm">
   @php
    $isActive = fn ($route) => request()->routeIs(str($route)->before('.').'.*') || request()->routeIs($route);
    $navLink = 'flex items-center gap-3 rounded-xl px-3 py-2.5 font-medium transition';
   @endphp
  <a href="{{ route('dashboard') }}" class="{{ $navLink }} py-3.5 text-lg leading-7 font-extrabold mb-1 {{ $isActive('dashboard') ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-950/30' : 'text-slate-100 hover:bg-white/10 hover:text-white' }}"><span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/10">@include('components.icon',['name'=>'home'])</span>داشبورد</a>

  @php
   $coreNav=[['inspections.index','بازرسی‌ها','clipboard'],['risks.index','خطرات و ریسک‌ها','warning'],['incidents.index','حوادث و شبه‌حوادث','incident'],['actions.index','اقدامات اصلاحی','check']];
   $isCoreActive = request()->routeIs('inspections.*') || request()->routeIs('risks.*') || request()->routeIs('incidents.*') || request()->routeIs('actions.*');
  @endphp
  <details data-sidebar-category class="group mt-6" {{ $isCoreActive ? 'open' : '' }}><summary class="flex cursor-pointer list-none items-center justify-between px-2.5 pb-1 pt-5 text-lg font-extrabold tracking-wide text-emerald-200"><span>پایش و اقدام</span><span class="text-lg text-emerald-300 transition group-open:rotate-180">⌄</span></summary><div class="space-y-0.5">
  @foreach($coreNav as [$route,$label,$icon]) <a href="{{ route($route) }}" class="{{ $navLink }} {{ $isActive($route) ? 'bg-emerald-500 font-bold text-white shadow-lg shadow-emerald-950/30' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"><span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-white/10">@include('components.icon',['name'=>$icon])</span>{{ $label }}</a>@endforeach
  </div></details>

  <details data-sidebar-category class="group mt-6" {{ request()->routeIs('ppe.*') || request()->routeIs('equipment.*') || request()->routeIs('permits.*') ? 'open' : '' }}><summary class="flex cursor-pointer list-none items-center justify-between px-2.5 pb-1 pt-5 text-lg font-extrabold tracking-wide text-emerald-200"><span>ایمنی عملیاتی</span><span class="text-lg text-emerald-300 transition group-open:rotate-180">⌄</span></summary><div class="space-y-0.5">
  <a href="{{ route('ppe.index') }}" class="{{ $navLink }} {{ $isActive('ppe.index') ? 'bg-emerald-500 font-bold text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">@include('components.icon',['name'=>'check']) تجهیزات حفاظت فردی</a><a href="{{ route('equipment.index') }}" class="{{ $navLink }} {{ $isActive('equipment.index') ? 'bg-emerald-500 font-bold text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">@include('components.icon',['name'=>'warning']) تجهیزات ایمنی و حریق</a><a href="{{ route('permits.index') }}" class="{{ $navLink }} {{ $isActive('permits.index') ? 'bg-emerald-500 font-bold text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">@include('components.icon',['name'=>'clipboard']) مجوز کار PTW</a>
   </div></details>
  @if(auth()->user()->hasRole(['admin','hse_manager']))<details data-sidebar-category class="group mt-6" {{ request()->routeIs('checklists.*') || request()->routeIs('reports.*') ? 'open' : '' }}><summary class="flex cursor-pointer list-none items-center justify-between px-2.5 pb-1 pt-5 text-lg font-extrabold tracking-wide text-emerald-200"><span>مدیریت و تحلیل</span><span class="text-lg text-emerald-300 transition group-open:rotate-180">⌄</span></summary><div class="space-y-0.5"><a href="{{ route('checklists.index') }}" class="{{ $navLink }} {{ $isActive('checklists.index') ? 'bg-emerald-500 font-bold text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">@include('components.icon',['name'=>'list']) چک‌لیست‌ها</a><a href="{{ route('reports.index') }}" class="{{ $navLink }} {{ $isActive('reports.index') ? 'bg-emerald-500 font-bold text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">@include('components.icon',['name'=>'chart']) گزارش‌های مدیریتی</a></div></details>@endif
  @if(auth()->user()->hasRole('admin'))<details data-sidebar-category class="group mt-6" {{ request()->routeIs('users.*') || request()->routeIs('departments.*') || request()->routeIs('settings.*') ? 'open' : '' }}><summary class="flex cursor-pointer list-none items-center justify-between px-2.5 pb-1 pt-5 text-lg font-extrabold tracking-wide text-emerald-200"><span>مدیریت سامانه</span><span class="text-lg text-emerald-300 transition group-open:rotate-180">⌄</span></summary><div class="space-y-0.5"><a href="{{ route('users.index') }}" class="{{ $navLink }} {{ $isActive('users.index') ? 'bg-emerald-500 font-bold text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">@include('components.icon',['name'=>'users']) کاربران و دسترسی‌ها</a><a href="{{ route('departments.index') }}" class="{{ $navLink }} {{ $isActive('departments.index') ? 'bg-emerald-500 font-bold text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">@include('components.icon',['name'=>'building']) واحدهای سازمانی</a><a href="{{ route('settings.edit') }}" class="{{ $navLink }} {{ $isActive('settings.edit') ? 'bg-emerald-500 font-bold text-white' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">@include('components.icon',['name'=>'settings']) تنظیمات سامانه</a></div></details>@endif
  </nav>
  <div class="m-4 rounded-2xl border border-white/10 bg-white/5 p-3"><div class="flex items-center gap-3"><div class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-500 font-black">{{ mb_substr(auth()->user()->name,0,1) }}</div><div class="min-w-0 flex-1"><div class="truncate text-sm font-bold">{{ auth()->user()->name }}</div><div class="truncate text-[11px] text-slate-400">{{ auth()->user()->role->label() }}</div></div><form method="post" action="{{ route('logout') }}">@csrf<button class="rounded-lg p-2 text-slate-400 hover:bg-white/10 hover:text-white" title="خروج">@include('components.icon',['name'=>'logout'])</button></form></div></div>
 </aside>
 <main class="min-w-0">
  <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200/80 bg-white/90 px-4 backdrop-blur lg:px-8"><div><div class="text-xs text-slate-400">امروز، {{ \Morilog\Jalali\Jalalian::now()->format('l d F Y') }}</div><h1 class="font-black text-slate-900">@yield('page-title','داشبورد')</h1></div><div class="flex items-center gap-2"><a href="{{ route('notifications.index') }}" title="اعلان‌ها" class="relative grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-500 hover:border-emerald-300 hover:text-emerald-600">@include('components.icon',['name'=>'bell'])@if(isset($unreadNotifications)&&$unreadNotifications)<span class="absolute -left-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white">{{ $unreadNotifications }}</span>@endif</a><details class="relative lg:hidden"><summary class="list-none rounded-xl bg-slate-900 px-3 py-2 text-xs font-bold text-white">منو</summary><div class="absolute left-0 top-12 w-56 rounded-2xl border bg-white p-2 shadow-2xl">@foreach([['ppe.index','PPE'],['equipment.index','تجهیزات ایمنی'],['permits.index','مجوز کار'],['notifications.index','اعلان‌ها']] as [$r,$l])<a href="{{ route($r) }}" class="block rounded-xl px-4 py-3 text-sm font-bold hover:bg-slate-50">{{ $l }}</a>@endforeach @if(auth()->user()->hasRole(['admin','hse_manager']))<a href="{{ route('reports.index') }}" class="block rounded-xl px-4 py-3 text-sm font-bold">گزارش‌ها</a>@endif</div></details></div></header>
  <div class="p-4 pb-24 lg:p-8">
   @if(session('success'))<div data-auto-dismiss class="mb-5 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-800">@include('components.icon',['name'=>'check']) {{ session('success') }}</div>@endif
   @if($errors->any())<div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800"><div class="mb-2 font-black">لطفاً موارد زیر را اصلاح کنید:</div><ul class="list-inside list-disc space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
   @yield('content')
  </div>
 </main>
 <nav class="fixed inset-x-3 bottom-3 z-40 flex items-center justify-around rounded-2xl border border-slate-200 bg-white/95 p-2 shadow-2xl backdrop-blur lg:hidden">@foreach([['dashboard','home','خانه'],['inspections.index','clipboard','بازرسی'],['risks.index','warning','ریسک'],['incidents.index','incident','رویداد'],['actions.index','check','اقدامات']] as [$route,$icon,$label])<a href="{{ route($route) }}" class="flex min-w-14 flex-col items-center gap-1 rounded-xl px-2 py-1.5 text-[10px] font-bold {{ request()->routeIs(str($route)->before('.').'.*')||request()->routeIs($route)?'bg-emerald-50 text-emerald-700':'text-slate-400' }}">@include('components.icon',['name'=>$icon]){{ $label }}</a>@endforeach</nav>
</div>
<script>
document.querySelectorAll('[data-sidebar-category]').forEach(function(category){
  category.addEventListener('toggle', function(){
    if (!category.open) return;

    document.querySelectorAll('[data-sidebar-category][open]').forEach(function(otherCategory){
      if (otherCategory !== category && !otherCategory.querySelector('.bg-emerald-500')) {
        otherCategory.removeAttribute('open');
      }
    });
  });
});

$(function(){
  $('[data-jdatepicker]').each(function(){
    var isDatetime = $(this).data('jdatepicker') === 'datetime';
    var hasPersianValue = !!$(this).val().match(/^[1-4]\d{3}\//);
    $(this).persianDatepicker({
      format: isDatetime ? 'YYYY/MM/DD HH:mm' : 'YYYY/MM/DD',
      altFormat: isDatetime ? 'YYYY-MM-DD HH:mm:ss' : 'YYYY-MM-DD',
      timePicker: { enabled: isDatetime, meridian: { enabled: false } },
      calendarType: 'persian',
      calendar: { persian: { locale: 'fa', leapYearMode: 'algorithmic' } },
      initialValue: true,
      initialValueType: hasPersianValue ? 'persian' : 'gregorian',
      observer: true,
      position: 'auto'
    });
  });
});
</script>
@include('components.ai-chat')
</body></html>
