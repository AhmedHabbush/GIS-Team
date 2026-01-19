<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDocumentFileController extends Controller
{
    /**
     * Display a listing of document files.
     */
    public function index()
    {
        $files = DocumentFile::with(['document.user'])
            ->latest()
            ->paginate(30);

        return view('admin.document-files.index', compact('files'));
    }

    /**
     * Store new files for a document.
     */
    public function store(Request $request, Document $document)
    {
        $request->validate([
            'files' => ['required', 'array'],
            'files.*' => [
                'required',
                'file',
            ],
        ]);


        foreach ($request->file('files') as $file) {
            $path = $file->store('documents', 'public');

            $document->files()->create([
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
            ]);
        }

        return back()->with('success', 'تم رفع الملفات بنجاح');
    }

    /**
     * Download a single file.
     */
    public function download(DocumentFile $documentFile)
    {
        if (! Storage::disk('public')->exists($documentFile->file_path)) {
            abort(404, 'الملف غير موجود');
        }

        return Storage::disk('public')->download(
            $documentFile->file_path,
            $documentFile->original_name
        );
    }

    /**
     * Remove a file from storage.
     */
    public function destroy(DocumentFile $documentFile)
    {
        if (Storage::disk('public')->exists($documentFile->file_path)) {
            Storage::disk('public')->delete($documentFile->file_path);
        }

        $documentFile->delete();

        return back()->with('success', 'تم حذف الملف بنجاح');
    }
}
