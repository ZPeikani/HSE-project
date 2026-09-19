<?php

namespace Tests\Feature;

use App\Services\AiKnowledgeImportService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AiKnowledgeImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_a_pdf_even_when_no_selectable_text_is_found(): void
    {
        $pdfPath = tempnam(sys_get_temp_dir(), 'hse-pdf-') . '.pdf';
        file_put_contents($pdfPath, <<<'PDF'
%PDF-1.4
1 0 obj
<< /Type /Catalog /Pages 2 0 R >>
endobj
2 0 obj
<< /Type /Pages /Kids [3 0 R] /Count 1 >>
endobj
3 0 obj
<< /Type /Page /Parent 2 0 R /MediaBox [0 0 300 144] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>
endobj
4 0 obj
<< /Length 0 >>
stream

endstream
endobj
5 0 obj
<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>
endobj
xref
0 6
0000000000 65535 f 
0000000010 00000 n 
0000000062 00000 n 
0000000123 00000 n 
0000000245 00000 n 
0000000546 00000 n 
trailer
<< /Root 1 0 R /Size 6 >>
startxref
634
%%EOF
PDF);

        $file = new UploadedFile($pdfPath, 'blank-import.pdf', 'application/pdf', null, true);

        $document = app(AiKnowledgeImportService::class)->import($file, [
            'title' => 'Blank PDF Test',
            'source_name' => 'Test Source',
        ]);

        $this->assertNotNull($document);
        $this->assertSame('Blank PDF Test', $document->title);
        $this->assertNotEmpty($document->chunks);
    }

    public function test_it_imports_pdf_when_uploaded_file_real_path_is_unavailable(): void
    {
        $pdfPath = tempnam(sys_get_temp_dir(), 'hse-pdf-') . '.pdf';
        file_put_contents($pdfPath, <<<'PDF'
%PDF-1.4
1 0 obj
<< /Type /Catalog /Pages 2 0 R >>
endobj
2 0 obj
<< /Type /Pages /Kids [3 0 R] /Count 1 >>
endobj
3 0 obj
<< /Type /Page /Parent 2 0 R /MediaBox [0 0 300 144] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>
endobj
4 0 obj
<< /Length 0 >>
stream

endstream
endobj
5 0 obj
<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>
endobj
xref
0 6
0000000000 65535 f 
0000000010 00000 n 
0000000062 00000 n 
0000000123 00000 n 
0000000245 00000 n 
0000000546 00000 n 
trailer
<< /Root 1 0 R /Size 6 >>
startxref
634
%%EOF
PDF);

        $file = new class($pdfPath, 'realpath-fallback.pdf', 'application/pdf', null, true) extends UploadedFile
        {
            public function getRealPath(): string|false
            {
                return false;
            }
        };

        $document = app(AiKnowledgeImportService::class)->import($file, [
            'title' => 'Fallback PDF Test',
            'source_name' => 'Test Source',
        ]);

        $this->assertNotNull($document);
        $this->assertSame('Fallback PDF Test', $document->title);
        $this->assertNotEmpty($document->chunks);
    }

    public function test_it_ignores_appendix_numbering_when_explicit_article_markers_exist(): void
    {
        $service = app(AiKnowledgeImportService::class);
        $method = new \ReflectionMethod($service, 'extractChunks');
        $method->setAccessible(true);

        $pages = [[
            'page' => 1,
            'text' => implode("\n", [
                'ماده 1. تعریف و هدف',
                'ماده 2. وظایف کارفرما',
                'ماده 3. شناسایی و مستند نمودن خطرات',
                'ماده 4. ارزیابی ریسک',
                'ماده 5. آموزش کارکنان',
                'ماده 6. نظارت بر اجرای ایمنی',
                'ماده 7. گزارش‌گیری',
                'ماده 8. کنترل و پایش',
                'ماده 9. پایان کار',
                'پیوست شماره 1',
                '1. همکاری و تشریک مساعی با بازرسان کار',
                '2. شناسایی و مستند نمودن خطرات',
                '18. انجام سایر وظایف محوله',
            ]),
        ]];

        $chunks = $method->invoke($service, $pages, ['category' => 'ایمنی']);

        $articleNumbers = array_map(
            static fn (array $chunk): string => (string) ($chunk['article_number'] ?? ''),
            $chunks
        );

        $this->assertSame([
            'ماده 1',
            'ماده 2',
            'ماده 3',
            'ماده 4',
            'ماده 5',
            'ماده 6',
            'ماده 7',
            'ماده 8',
            'ماده 9',
        ], $articleNumbers);
    }

    public function test_it_finds_the_hse_regulation_question_in_knowledge_search(): void
    {
        $document = \App\Models\AiKnowledgeDocument::create([
            'title' => 'آیین نامه بکارگیری مسئول ایمنی در کارگاه ها',
            'source_name' => 'وزارت تعاون، کار و رفاه اجتماعی',
            'source_type' => 'iranian_regulation',
            'document_type' => 'آیین نامه',
            'category' => 'ایمنی',
            'language' => 'fa',
            'status' => 'active',
        ]);

        \App\Models\AiKnowledgeChunk::create([
            'ai_knowledge_document_id' => $document->id,
            'chunk_index' => 0,
            'chapter' => 'فصل اول',
            'article_number' => 'ماده 1',
            'page_number' => 1,
            'content' => 'کارفرما مکلف است مسئول ایمنی را برای کارگاه خود به‌صورت رسمی تعیین کند و امکانات لازم برای اجرای برنامه ایمنی را فراهم نماید.',
        ]);

        $service = app(\App\Services\AiKnowledgeService::class);
        $results = $service->search('طبق آیین نامه بکارگیری مسئول ایمنی در کارگاه ها، کارفرما چه تکلیفی دارد؟', 6);

        $this->assertNotEmpty($results);
        $this->assertSame('آیین نامه بکارگیری مسئول ایمنی در کارگاه ها', $results[0]['title']);
    }
}
