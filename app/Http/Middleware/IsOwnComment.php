<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsOwnComment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $commentId = $request->route()->parameters('id');
        $comment = Comment::where('id', $commentId)->first();
        if (auth()->user()->id == $comment->user_id) {
            return $next($request);
        }
        return abort(403, 'UnAuthorize');
    }
}
