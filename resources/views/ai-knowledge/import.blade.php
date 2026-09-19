@extends('layouts.app')

@section('title', 'Import PDF پایگاه دانش')
@section('page-title', 'افزودن منبع PDF به پایگاه دانش AI')

@section('content')
<div class="mx-auto max-w-4xl">
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h2 class="text-lg font-black text-slate-800">افزودن آیین‌نامه / استاندارد</h2>
        </div>

        <form method="POST" action="{{ route('ai.knowledge.import.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const input = document.getElementById('pdf-upload-input');
                    const fileName = document.getElementById('pdf-file-name');
                    const removeButton = document.getElementById('pdf-remove-button');

                    if (!input || !fileName || !removeButton) {
                        return;
                    }

                    const updateState = () => {
                        const selected = input.files && input.files[0];

                        if (selected) {
                            fileName.textContent = selected.name;
                            removeButton.classList.remove('hidden');
                        } else {
                            fileName.textContent = 'Choose File';
                            removeButton.classList.add('hidden');
                        }
                    };

                    input.addEventListener('change', updateState);
                    removeButton.addEventListener('click', function () {
                        input.value = '';
                        updateState();
                    });
                });
            </script>

            <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-5">
                <label class="mb-2 block text-sm font-bold text-slate-700">فایل PDF *</label>

                <div class="relative">
                    <input
                        id="pdf-upload-input"
                        type="file"
                        name="pdf"
                        accept="application/pdf"
                        required
                        class="sr-only"
                    >

                    <label for="pdf-upload-input" class="relative flex cursor-pointer items-center justify-between gap-3 overflow-hidden rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm">
                        <span id="pdf-file-name" class="flex-1 truncate text-right text-slate-500">Choose File</span>

                    </label>
                    <button type="button" id="pdf-remove-button" class="absolute left-0 top-0 hidden h-full w-11 cursor-pointer items-center justify-end text-red-500 transition hover:text-red-700" aria-label="حذف فایل انتخابی" title="حذف فایل">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

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
                    <input type="text" name="approval_date" value="{{ old('approval_date') }}" data-jdatepicker="date" autocomplete="off" placeholder="۱۴۰۳/۰۱/۰۱" dir="ltr" class="w-full rounded-xl border border-slate-200 px-3 py-2.5">
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
