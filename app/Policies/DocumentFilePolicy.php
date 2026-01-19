<?php

namespace App\Policies;

use App\Models\DocumentFile;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DocumentFilePolicy
{
    /**
     * Admin override
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isRole('admin')) {
            return true;
        }

        return null;
    }

    /**
     * Download document file
     */
    public function download(User $user, DocumentFile $file): bool
    {
        $document = $file->document;

        if ($user->isRole('editor')) {
            return true;
        }

        if ($user->isRole('user')) {
            return $document->user_id === $user->id;
        }


        return false;
    }
    public function delete(User $user, DocumentFile $file): bool
    {
        return $user->hasPermission('documents.files.delete');
    }
}
