@php
    $toPersian = static fn ($value): string => strtr((string) $value, [
        '0' => '۰',
        '1' => '۱',
        '2' => '۲',
        '3' => '۳',
        '4' => '۴',
        '5' => '۵',
        '6' => '۶',
        '7' => '۷',
        '8' => '۸',
        '9' => '۹',
    ]);
@endphp

@if ($paginator->hasPages())
    <nav class="flex flex-col items-center gap-3" role="navigation" aria-label="صفحه‌بندی">
        <p class="text-sm text-slate-500">
            @if ($paginator->firstItem())
                نمایش {{ $toPersian($paginator->firstItem()) }} تا {{ $toPersian($paginator->lastItem()) }} از {{ $toPersian($paginator->total()) }} مورد
            @else
                {{ $toPersian($paginator->count()) }} مورد
            @endif
        </p>

        <div class="flex items-center gap-1" dir="rtl">
            @if ($paginator->onFirstPage())
                <span class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 px-2 text-sm text-slate-300" aria-disabled="true">قبلی</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="صفحه قبل" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-slate-200 bg-white px-2 text-sm text-slate-600 transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700">قبلی</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="inline-flex h-9 min-w-9 items-center justify-center px-1 text-sm text-slate-400" aria-hidden="true">{{ $element }}</span>
                @elseif (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg bg-emerald-600 px-2 text-sm font-bold text-white" aria-current="page" aria-label="صفحه {{ $toPersian($page) }}">{{ $toPersian($page) }}</span>
                        @else
                            <a href="{{ $url }}" aria-label="رفتن به صفحه {{ $toPersian($page) }}" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-slate-200 bg-white px-2 text-sm text-slate-600 transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700">{{ $toPersian($page) }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="صفحه بعد" class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-slate-200 bg-white px-2 text-sm text-slate-600 transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700">بعدی</a>
            @else
                <span class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 px-2 text-sm text-slate-300" aria-disabled="true">بعدی</span>
            @endif
        </div>
    </nav>
@endif
