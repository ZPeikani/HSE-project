<div class="relative" data-notification-menu>
 <button type="button" data-notification-toggle title="اعلان‌ها" aria-label="اعلان‌ها" aria-expanded="false" class="relative grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-emerald-300 hover:text-emerald-600">
  @include('components.icon',['name'=>'bell'])
  @if($unreadNotifications)<span class="absolute -left-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white">{{ $unreadNotifications }}</span>@endif
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
<script>
(function () {
 const menu = document.querySelector('[data-notification-menu]');
 if (!menu) return;
 const toggle = menu.querySelector('[data-notification-toggle]');
 const panel = menu.querySelector('[data-notification-panel]');
 const close = function () { panel.classList.add('hidden'); toggle.setAttribute('aria-expanded', 'false'); };
 toggle.addEventListener('click', function (event) { event.stopPropagation(); const isOpen = !panel.classList.contains('hidden'); panel.classList.toggle('hidden', isOpen); toggle.setAttribute('aria-expanded', String(!isOpen)); });
 document.addEventListener('click', function (event) { if (!menu.contains(event.target)) close(); });
 document.addEventListener('keydown', function (event) { if (event.key === 'Escape') close(); });
}());
</script>
