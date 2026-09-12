@php($loginNotifications = session('login_notifications', []))
@if(count($loginNotifications))
<div id="login-notifications-modal" class="fixed inset-0 z-70 hidden bg-slate-950/35 p-4 backdrop-blur-sm" style="align-items: center; justify-content: center;" role="dialog" aria-modal="true" aria-labelledby="login-notifications-title">
 <div class="flex max-h-[82vh] flex-col overflow-hidden rounded-3xl border-2 border-slate-700 bg-white shadow-[0_20px_55px_rgba(15,23,42,.18)]" style="width: min(100%, 760px);">
  <div class="relative border-b border-emerald-200 bg-linear-to-br from-emerald-50 via-white to-sky-50 px-5 py-6 sm:px-8 sm:py-7" dir="rtl">
  <button type="button" data-close-login-notifications class="absolute left-5 top-5 z-10 grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white/90 text-2xl leading-none text-slate-400 shadow-sm transition hover:border-slate-300 hover:bg-white hover:text-slate-600 sm:left-7 sm:top-7" aria-label="بستن اعلان‌ها" title="بستن">&times;</button>
  <div class="relative min-w-0 pr-16 text-right sm:pr-20">
   <div class="absolute right-0 top-0 grid h-12 w-12 place-items-center rounded-2xl bg-emerald-600 text-white shadow-lg shadow-emerald-600/25 sm:right-1">@include('components.icon',['name'=>'bell'])</div>
   <div class="text-sm font-bold text-emerald-700">مرکز اعلان HSE</div>
   <h2 id="login-notifications-title" class="mt-2 text-xl font-black leading-8 text-slate-900 sm:text-2xl">مواردی برای بررسی دارید</h2>
   <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base">اعلان‌های مهم اخیر شما</p>
  </div>
  <div class="mt-5 flex justify-end" dir="rtl">
   <div class="inline-flex shrink-0 items-center gap-2 rounded-full border border-emerald-200 bg-white/90 px-5 py-2 text-xs font-bold text-slate-700 shadow-sm"><span class="h-2.5 w-2.5 rounded-full bg-rose-500"></span>{{ count($loginNotifications) }} اعلان خوانده‌نشده</div>
   </div>
  </div>
  <div class="mt-4 min-h-0 space-y-2 overflow-y-auto bg-slate-50/40 px-6 py-5 sm:px-7 sm:py-6">
   @foreach($loginNotifications as $notification)
   <div class="flex items-start gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3.5 shadow-sm transition hover:border-emerald-200 hover:shadow-md">
    <span class="mt-2 h-3 w-3 shrink-0 rounded-full {{ $notification['type'] === 'overdue' ? 'bg-rose-500' : ($notification['type'] === 'due_today' ? 'bg-amber-500' : 'bg-sky-500') }}"></span>
    <div class="min-w-0 flex-1 text-right"><div class="text-base font-black leading-6 text-slate-800">{{ $notification['title'] }}</div><div class="mt-1 text-sm leading-6 text-slate-500">{{ $notification['message'] }}</div></div>
   </div>
   @endforeach
  </div>
  <div class="flex shrink-0 flex-col gap-2 border-t border-slate-200 bg-white px-6 py-4 sm:flex-row sm:items-center sm:justify-start sm:px-7" style="direction: ltr;">
  <a href="{{ route('notifications.index') }}" class="rounded-xl bg-emerald-600 px-4 py-2.5 text-center text-sm font-bold text-white shadow-md shadow-emerald-600/20 transition hover:bg-emerald-700" style="direction: rtl;">مشاهده همه اعلان‌ها</a>
  <button type="button" data-close-login-notifications class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 hover:text-slate-800" style="direction: rtl;">بعداً بررسی می‌کنم</button>
  </div>
 </div>
</div>
<script>
(function () {
  const modal = document.getElementById('login-notifications-modal');
  if (!modal) return;
  const close = function () {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true');
  };
  modal.querySelectorAll('[data-close-login-notifications]').forEach(button => button.addEventListener('click', close));
  modal.addEventListener('click', event => { if (event.target === modal) close(); });
  document.addEventListener('keydown', event => { if (event.key === 'Escape') close(); });
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  modal.setAttribute('aria-hidden', 'false');
}());
</script>
@endif
