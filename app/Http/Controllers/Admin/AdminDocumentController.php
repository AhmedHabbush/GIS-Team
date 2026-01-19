<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class AdminDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Document::class);

        $documents = Document::with(['user', 'files'])
            ->latest()
            ->paginate(10);

        return view('admin.documents.index', compact('documents'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'company' => 'required|string|max:255',

            'types' => 'required|array',
            'types.*' => 'string',

            'projects' => 'required|array',
            'projects.*' => 'string',

            'nationality' => 'required|string|max:100',
            'square' => 'required|string|max:50',
            'camp' => 'required|string|max:100',

            'pilgrims_count' => 'required|integer|min:1',
            'notes' => 'nullable|string',

            'files.*' => 'file|max:10240',
        ]);


        $document = Document::create([
            'user_id' => auth()->id(),

            'company' => $attributes['company'],
            'types' => $attributes['types'],
            'projects' => $attributes['projects'],

            'nationality' => $attributes['nationality'],
            'square' => $attributes['square'],
            'camp' => $attributes['camp'],
            'pilgrims_count' => $attributes['pilgrims_count'],
            'notes' => $attributes['notes'] ?? null,

            'status' => 'pending',
        ]);



        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('documents', 'public');

                $document->files()->create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'تم إنشاء المستند بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        foreach ($document->files as $file) {
            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }
        }

        $document->delete();

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'تم حذف المستند بنجاح');
    }

    public function download(Document $document)
    {
        $file = $document->files()->first();

        if (! $file) {
            abort(404, 'الملف غير موجود');
        }

        if (! Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'الملف غير موجود');
        }

        return Storage::disk('public')->download(
            $file->file_path,
            $file->original_name
        );
    }

    /**
     * @throws MpdfException
     * @throws AuthorizationException
     */
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

        $html = view('admin.documents.print', compact('document'))->render();

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

}
