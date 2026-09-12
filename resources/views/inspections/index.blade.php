@extends('layouts.app') @section('title','بازرسی‌ها') @section('page-title','مدیریت بازرسی‌ها') @section('content')
<form class="mb-4 flex gap-2"><input name="q" value="{{ request('q') }}" placeholder="جست‌وجوی کد یا عنوان بازرسی" class="min-w-0 flex-1 rounded-xl border bg-white px-4 py-3"><select name="status" class="rounded-xl border bg-white px-3"><option value="">همه وضعیت‌ها</option><option value="planned">برنامه‌ریزی</option><option value="in_progress">در حال انجام</option><option value="completed">تکمیل</option></select><button class="rounded-xl bg-slate-900 px-5 text-white">فیلتر</button></form>
<div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-center"><div><h2 class="text-xl font-black">برنامه و سوابق بازرسی</h2><p class="mt-1 text-sm text-slate-500">برنامه‌ریزی، اجرا و پایش نتایج بازرسی‌های HSE</p></div><div class="flex flex-wrap gap-2"><button type="button" id="toggle-inspection-calendar" aria-expanded="false" aria-label="نمایش تقویم" title="نمایش تقویم" class="grid h-12 w-12 place-items-center rounded-xl border border-none bg-slate-900 text-white shadow-sm">@include('components.icon',['name'=>'calendar'])</button><a href="{{ route('inspections.create') }}" class="rounded-xl bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">+ برنامه‌ریزی بازرسی</a></div></div>
<div id="inspection-calendar" class="fixed inset-0 z-50 hidden bg-slate-950/70 p-3 backdrop-blur-sm sm:p-6" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="inspection-calendar-title"><div class="mx-auto flex h-full max-w-7xl flex-col overflow-hidden rounded-3xl border border-white/20 bg-slate-100 shadow-2xl"><div class="flex shrink-0 items-center justify-between bg-slate-900 px-5 py-4 text-white sm:px-7"><div><div class="mb-1 flex items-center gap-2 text-xs font-bold text-emerald-300"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>برنامه‌ریزی و پایش</div><h3 id="inspection-calendar-title" class="text-lg font-black sm:text-2xl">تقویم برنامه بازرسی</h3><p class="mt-1 text-xs text-slate-400">{{ $calendarTitle }} · عنوان بازرسی را برای مشاهده جزئیات انتخاب کنید</p></div><button type="button" id="close-inspection-calendar" class="grid h-10 w-10 shrink-0 place-items-center rounded-xl border border-white/10 text-2xl text-slate-300 hover:bg-white/10 hover:text-white" aria-label="بستن تقویم" title="بستن تقویم">&times;</button></div><div class="flex shrink-0 flex-wrap items-center gap-2 border-b border-slate-200 bg-white px-5 py-3 text-[11px] font-bold text-slate-500 sm:px-7"><span class="rounded-full bg-sky-100 px-3 py-1.5 text-sky-700">● برنامه‌ریزی‌شده</span><span class="rounded-full bg-amber-100 px-3 py-1.5 text-amber-700">● در حال انجام</span><span class="rounded-full bg-emerald-100 px-3 py-1.5 text-emerald-700">● تکمیل‌شده</span></div><div class="min-h-0 flex-1 overflow-auto p-3 sm:p-6"><div class="min-w-[760px]"><div class="mb-2 grid grid-cols-7 gap-2 text-center text-xs font-black text-slate-500"><div class="rounded-lg bg-slate-200/70 p-2.5">شنبه</div><div class="rounded-lg bg-slate-200/70 p-2.5">یکشنبه</div><div class="rounded-lg bg-slate-200/70 p-2.5">دوشنبه</div><div class="rounded-lg bg-slate-200/70 p-2.5">سه‌شنبه</div><div class="rounded-lg bg-slate-200/70 p-2.5">چهارشنبه</div><div class="rounded-lg bg-rose-50 p-2.5 text-rose-600">پنجشنبه</div><div class="rounded-lg bg-rose-50 p-2.5 text-rose-600">جمعه</div></div><div class="grid grid-cols-7 gap-2">@foreach($calendar as $cellIndex => $cell)<div class="min-h-[128px] rounded-2xl border p-2 transition {{ !$cell['day'] ? 'border-transparent bg-slate-200/40' : (($cellIndex % 7 >= 5) ? 'border-rose-100 bg-rose-50/50' : 'border-slate-200 bg-white shadow-sm hover:border-emerald-300 hover:shadow-md') }}">@if($cell['day'])<div class="mb-2 flex items-center justify-between"><span class="grid h-8 w-8 place-items-center rounded-full text-sm font-black {{ $cell['inspections']->count() ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-700' }}">{{ $cell['day'] }}</span>@if($cell['inspections']->count())<span class="text-[10px] font-black text-emerald-700">{{ $cell['inspections']->count() }} برنامه</span>@endif</div><div class="space-y-1.5">@foreach($cell['inspections'] as $inspection)@php $inspectionColor=$inspection->status==='completed'?'border-emerald-500 bg-emerald-50 hover:bg-emerald-100':($inspection->status==='in_progress'?'border-amber-500 bg-amber-50 hover:bg-amber-100':'border-sky-500 bg-sky-50 hover:bg-sky-100'); @endphp<a href="{{ route('inspections.show',$inspection) }}" class="block rounded-lg border-r-4 px-2 py-1.5 text-right text-[11px] font-bold leading-5 text-slate-700 transition {{ $inspectionColor }}" title="{{ $inspection->title }}"><span class="block truncate">{{ $inspection->title }}</span><span class="block text-[10px] font-normal text-slate-500">{{ $inspection->scheduled_at->format('H:i') }} · {{ $inspection->code }}</span></a>@endforeach</div>@endif</div>@endforeach</div></div></div></div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
	const calendarToggle = document.getElementById('toggle-inspection-calendar');
	const inspectionCalendar = document.getElementById('inspection-calendar');
	const closeCalendar = document.getElementById('close-inspection-calendar');
	calendarToggle?.addEventListener('click', () => {
		inspectionCalendar?.classList.remove('hidden');
		inspectionCalendar?.setAttribute('aria-hidden', 'false');
		document.body.classList.add('overflow-hidden');
	});
	closeCalendar?.addEventListener('click', () => {
		inspectionCalendar?.classList.add('hidden');
		inspectionCalendar?.setAttribute('aria-hidden', 'true');
		document.body.classList.remove('overflow-hidden');
	});
	const calendarPanel = inspectionCalendar?.firstElementChild;
	const calendarHeader = calendarPanel?.firstElementChild;
	let monthNavigation;

	inspectionCalendar?.classList.add('flex', 'items-center', 'justify-center');
	calendarPanel?.classList.remove('h-full');
	calendarPanel?.classList.add('h-[92vh]', 'w-full');

	if (calendarHeader) {
		monthNavigation = document.createElement('div');
		monthNavigation.className = 'absolute inset-x-0 bottom-5 flex translate-y-0 items-center justify-center gap-2 md:inset-x-32 md:bottom-auto md:top-1/2 md:-translate-y-1/2';
		monthNavigation.innerHTML = `<button type="button" data-month-step="-1" class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-900 shadow-sm transition hover:border-slate-300 hover:bg-slate-100" title="ماه قبل" aria-label="ماه قبل"><svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/></svg></button><button type="button" data-month-step="1" class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-900 shadow-sm transition hover:border-slate-300 hover:bg-slate-100" title="ماه بعد" aria-label="ماه بعد"><svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/></svg></button>`;
		calendarHeader.classList.add('relative', 'flex-wrap', 'gap-3', 'pb-20', 'md:flex-nowrap', 'md:gap-0', 'md:pb-4');
		calendarHeader.insertBefore(monthNavigation, calendarHeader.lastElementChild);
	}

	const monthData = @json($calendarNavigation);
	let activeMonthIndex = 12;
	const calendarTitleElement = calendarHeader?.querySelector('p');
	const calendarGrid = inspectionCalendar?.querySelectorAll('.grid.grid-cols-7.gap-2')[1];
	const escapeHtml = (value) => String(value).replace(/[&<>'"]/g, (character) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;' }[character]));
	const statusClass = (status) => status === 'completed' ? 'border-emerald-500 bg-emerald-50 hover:bg-emerald-100' : (status === 'in_progress' ? 'border-amber-500 bg-amber-50 hover:bg-amber-100' : 'border-sky-500 bg-sky-50 hover:bg-sky-100');
	const renderMonth = (monthIndex) => {
		const month = monthData[monthIndex];
		if (!month || !calendarGrid) return;
		activeMonthIndex = monthIndex;
		if (calendarTitleElement) calendarTitleElement.textContent = `${month.title} · عنوان بازرسی را برای مشاهده جزئیات انتخاب کنید`;
		calendarGrid.innerHTML = month.cells.map((cell, index) => {
			if (!cell.day) return '<div class="min-h-[128px] rounded-2xl p-2"></div>';
			const dayClass = index % 7 === 6 ? 'border border-rose-100 bg-rose-50/50' : 'border border-slate-200 bg-white shadow-sm hover:border-emerald-300 hover:shadow-md';
			const inspections = cell.inspections.map((inspection) => `<a href="${escapeHtml(inspection.url)}" class="block rounded-lg border-r-4 px-2 py-1.5 text-right text-[11px] font-bold leading-5 text-slate-700 transition ${statusClass(inspection.status)}"><span class="block truncate">${escapeHtml(inspection.title)}</span><span class="block text-[10px] font-normal text-slate-500">${escapeHtml(inspection.time)} · ${escapeHtml(inspection.code)}</span></a>`).join('');
			return `<div class="min-h-[128px] rounded-2xl p-2 transition ${dayClass}"><div class="mb-2 flex items-center justify-between"><span class="grid h-8 w-8 place-items-center rounded-full text-sm font-black ${cell.inspections.length ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-700'}">${cell.day}</span>${cell.inspections.length ? `<span class="text-[10px] font-black text-emerald-700">${cell.inspections.length} برنامه</span>` : ''}</div><div class="space-y-1.5">${inspections}</div></div>`;
		}).join('');
	};
	monthNavigation?.querySelectorAll('[data-month-step]').forEach((button) => {
		button.addEventListener('click', () => renderMonth(activeMonthIndex + Number(button.dataset.monthStep)));
	});

	const weekdayHeaders = inspectionCalendar?.querySelectorAll('.grid.grid-cols-7.gap-2')[0]?.children;
	const calendarCells = inspectionCalendar?.querySelectorAll('.grid.grid-cols-7.gap-2')[1]?.children;
	if (weekdayHeaders?.[5]) weekdayHeaders[5].className = 'rounded-lg bg-slate-200/70 p-2.5';
	for (let index = 6; index < (calendarCells?.length || 0); index += 7) {
		calendarCells[index].classList.add('border', 'border-rose-100', 'bg-rose-50/50');
	}
	for (let index = 5; index < (calendarCells?.length || 0); index += 7) {
		calendarCells[index].classList.remove('border-rose-100', 'bg-rose-50/50');
		calendarCells[index].classList.add('border-slate-200', 'bg-white');
	}
	calendarCells?.forEach((cell) => {
		if (!cell.querySelector('.mb-2')) cell.classList.remove('border', 'border-transparent', 'border-slate-200', 'bg-slate-200/40', 'bg-white');
	});

	const setCalendarOpen = (isOpen) => {
		inspectionCalendar.classList.toggle('hidden', !isOpen);
		inspectionCalendar.setAttribute('aria-hidden', String(!isOpen));
		calendarToggle.setAttribute('aria-expanded', String(isOpen));
		document.body.classList.toggle('overflow-hidden', isOpen);
	};

	inspectionCalendar?.addEventListener('click', (event) => {
		if (event.target === inspectionCalendar) setCalendarOpen(false);
	});
	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && !inspectionCalendar.classList.contains('hidden')) setCalendarOpen(false);
	});
	if (new URLSearchParams(window.location.search).get('calendar') === '1') setCalendarOpen(true);
});
</script>
<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white"><div class="overflow-x-auto"><table class="w-full min-w-[850px] text-right text-sm"><thead class="bg-slate-50 text-xs text-slate-500"><tr><th class="p-4">کد / عنوان</th><th>نوع چک‌لیست</th><th>واحد</th><th>بازرس</th><th>زمان برنامه</th><th>امتیاز</th><th>وضعیت</th></tr></thead><tbody class="divide-y divide-slate-100">@forelse($inspections as $i)<tr class="hover:bg-slate-50"><td class="p-4"><a href="{{ route('inspections.show',$i) }}" class="font-bold hover:text-emerald-600">{{ $i->title }}</a><div class="text-[11px] text-slate-400">{{ $i->code }}</div></td><td>{{ $i->checklist->category }}</td><td>{{ $i->department->name }}</td><td>{{ $i->inspector->name }}</td><td>@jdatetime($i->scheduled_at)</td><td>@if($i->score!==null)<b class="{{ $i->score<70?'text-rose-600':'text-emerald-600' }}">{{ $i->score }}٪</b>@else—@endif</td><td><x-status :status="$i->status" /></td></tr>@empty<tr><td colspan="7" class="p-12 text-center text-slate-400">هنوز بازرسی ثبت نشده است.</td></tr>@endforelse</tbody></table></div><div class="border-t border-slate-100 p-4">{{ $inspections->links() }}</div></div>@endsection
