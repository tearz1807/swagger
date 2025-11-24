<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleStoreRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Http\Requests\Admin\ArticleDestroyRequest;
use App\Http\Requests\Admin\ArticleShowRequest;
use App\Http\Requests\Admin\ArticleIndexRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Get list of articles
     * 
     * Retrieve paginated list of articles for admin with optional published status filter
     *
     * @param ArticleIndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ArticleIndexRequest $request)
    {
        $articles = Article::with('user')
            ->when($request->has('is_published'), function($query) use ($request) {
                return $query->where('is_published', $request->boolean('is_published'));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $this->response(
            ArticleResource::collection($articles)
        );
    }

    /**
     * Get article by ID
     *
     * Retrieve specific article details
     * 
     * @param ArticleShowRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ArticleShowRequest $request, string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->responseError('Article not found', 404);
        }

        return $this->response(
            new ArticleResource($article)
        );
    }

    /**
     * Create new article
     *
     * Create a new article (admin only)
     * 
     * @param ArticleStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleStoreRequest $request)
    {
        $article = Article::factory()->create([
            'title' => $request->title,
            'image' => $request->image,
            'user_id' => Auth::id(),
        ]);

        if ($article) {
            return $this->response(
                new ArticleResource($article),
                201
            );
        }

        return $this->responseError('Not create article');
    }

    /**
     * Update article
     *
     * Update existing article (admin only)
     * 
     * @param ArticleUpdateRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->responseError('Article not found', 404);
        }

        $updateData = $request->only([
            'title',
            'content', 
            'image',
            'is_published',
        ]);

        // Если обновляется title, обновляем и slug
        if ($request->has('title')) {
            $updateData['slug'] = Str::slug($request->title);
        }

        $article->forceFill($updateData);

        if ($article->save()) {
            return $this->response(
                new ArticleResource($article)
            );
        }

        return $this->responseError('Not update article');
    }

    /**
     * Delete article
     *
     * Delete article (admin only)
     * 
     * @param ArticleDestroyRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ArticleDestroyRequest $request, string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->responseError('Article not found', 404);
        }

        if($article->delete()){
            return $this->response(['message' => 'Article deleted successfully']);
        }

        return $this->responseError('Not deleted');
    }

    /**
     * Toggle article publish status
     *
     * Publish or unpublish article (admin only)
     * 
     * @param ArticleUpdateRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function togglePublish(ArticleUpdateRequest $request, string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->responseError('Article not found', 404);
        }

        $article->is_published = !$article->is_published;
        
        if ($article->save()) {
            return $this->response(
                new ArticleResource($article)
            );
        }

        return $this->responseError('Not update article');
    }
}