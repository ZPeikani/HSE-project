<?php

namespace App\Http\Controllers;

use App\Services\AiKnowledgeImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AiKnowledgeImportController extends Controller
{
    public function create()
    {
        return view('ai-knowledge.import');
    }

    public function store(Request $request, AiKnowledgeImportService $importService)
    {
        if ($request->filled('approval_date')) {
            $request->merge(['approval_date' => optional(jalaliToCarbon($request->input('approval_date')))?->toDateString() ?? $request->input('approval_date')]);
        }

        $data = $request->validate([
            'pdf' => ['required', 'file', 'mimes:pdf', 'max:20480'],
            'title' => ['required', 'string', 'max:255'],
            'source_name' => ['required', 'string', 'max:255'],
            'document_type' => ['nullable', 'string', 'max:100'],
            'issuing_authority' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'version' => ['nullable', 'string', 'max:100'],
            'approval_date' => ['nullable', 'date'],
            'source_url' => ['nullable', 'url', 'max:1000'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        try {
            $document = $importService->import(
                $request->file('pdf'),
                $data
            );

            return redirect()
                ->route('ai.knowledge.import')
                ->with(
                    'success',
                    "«{$document->title}» با موفقیت وارد شد. {$document->chunks->count()} ماده/بخش در پایگاه دانش ذخیره شد."
                );
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput($request->except('pdf'))
                ->withErrors([
                    'pdf' => 'Import انجام نشد: ' . $e->getMessage(),
                ]);
        }
    }
}
