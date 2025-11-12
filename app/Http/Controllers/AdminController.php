<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getArticles(Request $request)
    {
        $articles = Article::with('user')
            ->when($request->has('is_published'), function($query) use ($request) {
                return $query->where('is_published', $request->boolean('is_published'));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($articles);
    }

    public function createArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $article = Article::create([
            ...$validated,
            'slug' => Str::slug($validated['title']),
            'user_id' => Auth::id(),
        ]);

        return response()->json($article, 201);
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'image' => 'nullable|string',
            'is_published' => 'sometimes|boolean',
        ]);

        $article->update($validated);

        return response()->json($article);
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }

    public function togglePublish($id)
    {
        $article = Article::findOrFail($id);
        $article->update(['is_published' => !$article->is_published]);

        return response()->json([
            'message' => $article->is_published ? 'Article published' : 'Article unpublished',
            'article' => $article
        ]);
    }
}