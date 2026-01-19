<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserCanAccessPage
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('slug');

        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $user = $request->user();

        $allowed = $user->pages()->where('pages.id', $page->id)->exists();

        if (!$allowed && !$user->isRole('admin')) {
            abort(403, 'Unauthorized');
        }

        $request->attributes->set('page', $page);

        return $next($request);
    }
}
