@extends('layouts.app') @section('title','PPE') @section('page-title','تجهیزات حفاظت فردی') @section('content')
@if(auth()->user()->hasRole(['admin','hse_manager']))
<details class="mb-5 rounded-2xl border bg-white p-5" open>
	<summary class="cursor-pointer font-black">ثبت اطلاعات PPE</summary>
	<div class="mt-5 grid gap-4 xl:grid-cols-3">
		<form method="post" action="{{ route('ppe.types.store') }}" class="space-y-3 rounded-xl bg-slate-50 p-4">
			@csrf
			<h3 class="font-bold">نوع PPE</h3>
			<input name="name" required placeholder="نام تجهیز" class="w-full rounded-xl border p-3">
			<input name="category" required placeholder="دسته‌بندی" class="w-full rounded-xl border p-3">
			<input name="standard" placeholder="استاندارد" class="w-full rounded-xl border p-3">
			<label for="replacement_days" class="block text-sm font-bold text-slate-700">دوره تعویض (به روز)</label>
			<input id="replacement_days" name="replacement_days" type="number" min="1" value="365" required placeholder="تعداد روز تا تعویض" class="w-full rounded-xl border p-3">
			<button class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-bold text-white">ثبت نوع</button>
		</form>
		<form method="post" action="{{ route('ppe.requirements.store') }}" class="space-y-3 rounded-xl bg-slate-50 p-4">
			@csrf
			<h3 class="font-bold">نیاز شغلی</h3>
			<select name="department_id" class="w-full rounded-xl border p-3">@foreach($departments as $d)<option value="{{ $d->id }}">{{ $d->name }}</option>@endforeach</select>
			<input name="job_title" required placeholder="عنوان شغل" class="w-full rounded-xl border p-3">
			<select name="ppe_type_id" class="w-full rounded-xl border p-3">@foreach($types as $t)<option value="{{ $t->id }}">{{ $t->name }}</option>@endforeach</select>
			<label for="requirement_quantity" class="block text-sm font-bold text-slate-700">تعداد مورد نیاز برای هر شغل</label>
			<input id="requirement_quantity" name="quantity" type="number" value="1" min="1" class="w-full rounded-xl border p-3">
			<button class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-bold text-white">ثبت نیاز</button>
		</form>
		<form method="post" action="{{ route('ppe.issues.store') }}" class="space-y-3 rounded-xl bg-emerald-50 p-4">
			@csrf
			<h3 class="font-bold">تحویل به کاربر</h3>
			<select name="user_id" class="w-full rounded-xl border p-3">@foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach</select>
			<label class="block text-sm font-bold text-slate-700">نوع تجهیز PPE <span class="font-normal text-slate-500">(تجهیزی که به کاربر تحویل می‌شود)</span></label>
			<select name="ppe_type_id" required aria-label="نوع تجهیز PPE برای تحویل" class="w-full rounded-xl border p-3">@foreach($types as $t)<option value="{{ $t->id }}">{{ $t->name }}</option>@endforeach</select>
			<div class="flex gap-2">
				<div class="w-1/3">
					<label for="issue_quantity" class="mb-2 block text-sm font-bold text-slate-700">تعداد تحویل</label>
					<input id="issue_quantity" name="quantity" type="number" value="1" min="1" class="w-full rounded-xl border p-3">
				</div>
				<div class="w-2/3">
					<label for="issued_at" class="mb-2 block text-sm font-bold text-slate-700">تاریخ تحویل</label>
					<div class="relative">
						<input id="issued_at" name="issued_at" type="text" value="{{ old('issued_at', \Morilog\Jalali\Jalalian::now()->format('Y/m/d')) }}" data-jdatepicker="date" autocomplete="off" placeholder="۱۴۰۵/۰۶/۱۴" class="w-full rounded-xl border p-3 pr-11" dir="ltr">
						<span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
						</span>
					</div>
				</div>
			</div>
			<select name="condition" class="w-full rounded-xl border p-3"><option value="new">نو</option><option value="good">سالم</option><option value="used">کارکرده</option></select>
			<button class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-bold text-white">ثبت تحویل</button>
		</form>
	</div>
</details>
@endif
<div class="mb-4 grid gap-3 md:grid-cols-2"><form class="flex gap-2"><input name="q" value="{{ request('q') }}" placeholder="جست‌وجوی کاربر..." class="min-w-0 flex-1 rounded-xl border bg-white px-4 py-3"><button class="rounded-xl bg-slate-900 px-5 text-white">جست‌وجو</button></form><div class="rounded-xl border bg-white px-4 py-3 text-sm"><b>{{ $requirements->count() }}</b> نیاز شغلی تعریف شده</div></div><div class="overflow-hidden rounded-2xl border bg-white"><div class="overflow-x-auto"><table class="w-full min-w-[760px] text-right text-sm"><thead class="bg-slate-50"><tr><th class="p-4">کاربر</th><th>تجهیز</th><th>تعداد</th><th>تحویل</th><th>تعویض</th><th>وضعیت</th></tr></thead><tbody class="divide-y">@forelse($issues as $i)<tr><td class="p-4 font-bold">{{ $i->user->name }}<small class="block text-slate-400">{{ $i->user->department?->name }}</small></td><td>{{ $i->type->name }}</td><td>{{ $i->quantity }}</td><td>@jdate($i->issued_at)</td><td class="{{ $i->expires_at?->isPast()?'font-bold text-rose-600':'' }}">@jdate($i->expires_at)</td><td><x-status :status="$i->status" /></td></tr>@empty<tr><td colspan="6" class="p-10 text-center text-slate-400">سابقه تحویلی ثبت نشده است.</td></tr>@endforelse</tbody></table></div><div class="border-t p-4">{{ $issues->links() }}</div></div>@endsection
