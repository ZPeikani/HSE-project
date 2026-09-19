<?php

namespace App\Http\Controllers;

use App\Services\AiKnowledgeImportService;
use Illuminate\Http\Request;
use Throwable;

class AiKnowledgeImportController extends Controller
{
    public function __construct(
        private readonly AiKnowledgeImportService $importService
    ) {
    }

    public function create()
    {
        return view('ai-knowledge.import');;
    }

    public function store(Request $request)
    {
        $request->validate([
            'pdf' => [
                'required',
                'file',
                'mimes:pdf',
                'max:20480',
            ],
        ]);

        try {
            $document = $this->importService->import(
                $request->file('pdf')
            );

            return redirect()
                ->route('ai.knowledge.import')
                ->with(
                    'success',
                    "منبع «{$document->title}» با موفقیت به Knowledge Base اضافه شد."
                );
        } catch (Throwable $e) {
            $message = $e->getMessage();

            return back()
                ->withInput()
                ->withErrors([
                    'pdf' => $message,
                ]);
        }
    }
}