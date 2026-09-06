@php($loginNotifications = session('login_notifications', []))
@if(count($loginNotifications))
<div id="login-notifications-modal" class="fixed inset-0 z-70 hidden bg-slate-950/50 p-4" style="align-items: center; justify-content: center;" role="dialog" aria-modal="true" aria-labelledby="login-notifications-title">
 <div class="flex max-h-[70vh] flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-2xl" style="width: clamp(280px, 33.333vw, 520px);">
  <div class="flex items-start justify-between border-b border-slate-200 px-4 py-3">
  <div><div class="text-[11px] font-bold text-emerald-600">اعلان‌های جدید</div><h2 id="login-notifications-title" class="mt-1 text-base font-black text-slate-900">مواردی برای بررسی دارید</h2></div>
   <button type="button" data-close-login-notifications class="grid h-9 w-9 place-items-center rounded-lg text-xl text-slate-400 hover:bg-slate-100 hover:text-slate-700" aria-label="بستن اعلان‌ها" title="بستن">&times;</button>
  </div>
  <div class="min-h-0 divide-y divide-slate-100 overflow-y-auto">
   @foreach($loginNotifications as $notification)
   <div class="flex gap-3 px-4 py-3">
    <span class="mt-1 h-3 w-3 shrink-0 rounded-full {{ $notification['type'] === 'overdue' ? 'bg-rose-500' : ($notification['type'] === 'due_today' ? 'bg-amber-500' : 'bg-sky-500') }}"></span>
    <div class="min-w-0"><div class="font-bold text-slate-800">{{ $notification['title'] }}</div><div class="mt-1 text-sm text-slate-500">{{ $notification['message'] }}</div></div>
   </div>
   @endforeach
  </div>
  <div class="flex shrink-0 items-center justify-end gap-2 border-t border-slate-200 bg-slate-50 px-4 py-3">
  <button type="button" data-close-login-notifications class="rounded-md border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-600 hover:bg-slate-100">بعداً بررسی می‌کنم</button>
  <a href="{{ route('notifications.index') }}" class="rounded-md px-3 py-1.5 text-xs font-bold text-white" style="background-color: #059669; color: #fff; transition: background-color .2s ease, box-shadow .2s ease;" onmouseover="this.style.backgroundColor='#047857'; this.style.boxShadow='0 4px 12px rgba(5, 150, 105, .25)'" onmouseout="this.style.backgroundColor='#059669'; this.style.boxShadow='none'">مشاهده همه اعلان‌ها</a>
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
