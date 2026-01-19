<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentFile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;


class DocumentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display documents list
     */
    public function index()
    {
        $this->authorize('viewAny', Document::class);

        $documents = Document::where('user_id', auth()->id())
            ->with('files')
            ->latest()
            ->paginate(10);

        return view('documents.index', compact('documents'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a new document
     */
    public function store(Request $request)
    {
        $this->authorize('create', Document::class);
        $data = $request->validate([
            'company'          => ['required', 'string', 'max:255'],
            'types'            => ['nullable', 'array'],
            'projects'         => ['nullable', 'array'],
            'nationality'      => ['required', 'string', 'max:255'],
            'square'           => ['required', 'string', 'max:255'],
            'camp'             => ['required', 'string', 'max:255'],
            'pilgrims_count'   => ['required', 'integer', 'min:1'],
            'notes'            => ['nullable', 'string'],
            'files.*'          => ['nullable', 'file', 'max:10240'],
        ]);

        DB::transaction(function () use ($request, $data) {

            $document = Document::create([
                'user_id'         => $request->user()->id,
                'company'         => $data['company'],
                'types'           => $data['types'] ?? [],
                'projects'        => $data['projects'] ?? [],
                'nationality'     => $data['nationality'],
                'square'          => $data['square'],
                'camp'            => $data['camp'],
                'pilgrims_count'  => $data['pilgrims_count'],
                'notes'           => $data['notes'] ?? null,
                'status'          => 'pending',
            ]);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store("documents/{$document->id}", 'public');

                    $document->files()->create([
                        'file_path'     => $path,
                        'original_name' => $file->getClientOriginalName(),
                    ]);
                }
            }
        });

        return back()->with('success', 'تم إضافة المستند بنجاح');
    }

    /**
     * Download a specific document file
     */
    public function download(DocumentFile $documentFile)
    {
        $this->authorize('download', $documentFile);

        if (! Storage::disk('public')->exists($documentFile->file_path)) {
            abort(404, 'الملف غير موجود');
        }

        return Storage::disk('public')->download(
            $documentFile->file_path,
            $documentFile->original_name
        );
    }

    public function print(Document $document)
    {
        $this->authorize('print', $document);

        $document->load('files');

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',

            'directionality' => 'rtl',

            'fontDir' => array_merge(
                (new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir'],
                [ storage_path('fonts') ]
            ),

            'fontdata' => array_merge(
                (new \Mpdf\Config\FontVariables())->getDefaults()['fontdata'],
                [
                    'cairo' => [
                        'R' => 'Cairo-Regular.ttf',
                        'B' => 'Cairo-Bold.ttf',
                        'useOTL' => 0xFF,
                    ],
                ]
            ),

            'default_font' => 'cairo',


            'autoLangToFont' => true,
            'autoScriptToLang' => true,
        ]);

        $html = view('documents.print', compact('document'))->render();
        $mpdf->SetHTMLHeader('
                <div style="text-align:right; font-size:12px; border-bottom:1px solid #ddd; padding-bottom:8px;">
                    <strong>نظام إدارة المستندات</strong>
                    <span style="float:left;">GIS Team</span>
                </div>
                ');

                        $mpdf->SetHTMLFooter('
                <div style="text-align:center; font-size:10px; color:#777;">
                    صفحة {PAGENO} من {nbpg} | تم الإنشاء بتاريخ '.now()->format('Y-m-d').'
                </div>
                ');

        $mpdf->SetHTMLFooter('
                <div style="text-align:center; font-size:10px; color:#777;">
                    صفحة {PAGENO} من {nbpg} | تم الإنشاء بتاريخ '.now()->format('Y-m-d').'
                </div>
                ');
        $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output('document-'.$document->id.'.pdf', 'S'),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="document.pdf"',
            ]
        );
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        DB::transaction(function () use ($document) {
            foreach ($document->files as $file) {
                Storage::delete($file->file_path);
                $file->delete();
            }

            $document->delete();
        });

        return back()->with('success', 'تم حذف المستند');
    }
}
