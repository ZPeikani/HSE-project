@extends('layouts.app')

@section('title', 'Import PDF پایگاه دانش')
@section('page-title', 'افزودن منبع PDF به پایگاه دانش AI')

@section('content')
<div class="mx-auto max-w-4xl">
    @if(session('success'))
        <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-bold text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <div class="mb-2 font-black">Import انجام نشد</div>
            <ul class="list-disc space-y-1 pr-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-lg font-black text-slate-800">افزودن آیین‌نامه / استاندارد</h2>
            <p class="mt-2 text-sm leading-7 text-slate-500">
                PDF متنی را انتخاب کنید. سیستم متن را استخراج کرده، فصل‌ها و ماده‌ها را تشخیص می‌دهد
                و هر ماده را به‌عنوان یک chunk در پایگاه دانش ذخیره می‌کند.
            </p>
        </div>

        <form method="POST" action="{{ route('ai.knowledge.import.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-5">
                <label class="mb-2 block text-sm font-bold text-slate-700">فایل PDF *</label>
                <input
                    type="file"
                    name="pdf"
                    accept="application/pdf"
                    required
                    class="block w-full rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm"
                >
                <p class="mt-2 text-xs text-slate-400">حداکثر حجم: ۲۰ مگابایت</p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-bold">عنوان سند *</label>
                    <input name="title" value="{{ old('title') }}" required class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-bold">نام منبع *</label>
                    <input name="source_name" value="{{ old('source_name', 'وزارت تعاون، کار و رفاه اجتماعی') }}" required class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-bold">نوع سند</label>
                    <input name="document_type" value="{{ old('document_type', 'آیین نامه') }}" class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-bold">مرجع صادرکننده</label>
                    <input name="issuing_authority" value="{{ old('issuing_authority', 'وزارت تعاون، کار و رفاه اجتماعی') }}" class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-bold">دسته‌بندی</label>
                    <input name="category" value="{{ old('category', 'ایمنی') }}" class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-bold">نسخه</label>
                    <input name="version" value="{{ old('version') }}" class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-bold">تاریخ تصویب</label>
                    <input type="date" name="approval_date" value="{{ old('approval_date') }}" class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
                </div>

                <div>
                    <label class="mb-1 block text-sm font-bold">لینک منبع</label>
                    <input type="url" name="source_url" value="{{ old('source_url') }}" dir="ltr" class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
                </div>
            </div>

            <div>
                <label class="mb-1 block text-sm font-bold">توضیحات</label>
                <textarea name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-3 py-2.5">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-3">
                <button class="rounded-xl bg-emerald-600 px-5 py-3 text-sm font-black text-white shadow-sm transition hover:bg-emerald-700">
                    شروع Import
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
