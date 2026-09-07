<div id="action-confirmation-modal" class="fixed inset-0 z-80 hidden items-center justify-center bg-slate-950/50 p-4" role="dialog" aria-modal="true" aria-labelledby="action-confirmation-title" aria-describedby="action-confirmation-message" aria-hidden="true">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">
        <div class="flex items-start gap-3">
            <div class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-rose-100 text-rose-600">
                @include('components.icon', ['name' => 'warning'])
            </div>
            <div class="min-w-0 flex-1">
                <h2 id="action-confirmation-title" class="text-lg font-black text-slate-900">تأیید عملیات</h2>
                <p id="action-confirmation-message" class="mt-2 text-sm leading-6 text-slate-500"></p>
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-2">
            <button id="action-confirmation-cancel" type="button" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">انصراف</button>
            <button id="action-confirmation-submit" type="button" class="rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-rose-700">تأیید</button>
        </div>
    </div>
</div>
