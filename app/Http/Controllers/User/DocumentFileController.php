<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DocumentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentFileController extends Controller
{

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentFile $documentFile)
    {
        $this->authorize('delete', $documentFile);

        if (Storage::exists($documentFile->file_path)) {
            Storage::delete($documentFile->file_path);
        }

        $documentFile->delete();

        return back()->with('success', 'تم حذف الملف بنجاح');
    }
}
