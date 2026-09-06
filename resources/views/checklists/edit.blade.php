@extends('layouts.app')
@section('title', 'ویرایش چک‌لیست')
@section('page-title', 'ویرایش مشخصات چک‌لیست')
@section('content')
<form method="post" action="{{ route('checklists.update', $checklist) }}" class="mx-auto max-w-5xl">@csrf @method('PUT')<div class="rounded-2xl border border-slate-200 bg-white p-6"><div class="grid gap-5 md:grid-cols-3">@include('components.field',['label'=>'عنوان','name'=>'title','value'=>$checklist->title]) @include('components.field',['label'=>'دسته‌بندی','name'=>'category','value'=>$checklist->category]) @include('components.field',['label'=>'نسخه','name'=>'version','value'=>$checklist->version])</div></div><div class="mt-5 flex justify-end gap-3"><a href="{{ route('checklists.show',$checklist) }}" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold">انصراف</a><button class="rounded-xl bg-emerald-600 px-6 py-3 text-sm font-black text-white">ذخیره تغییرات</button></div></form>
@endsection
