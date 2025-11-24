<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_article()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $token = auth()->login($admin);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->json('POST', '/api/admin/articles', [
                'title' => 'Test Article',
                'content' => 'Test content',
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', ['title' => 'Test Article']);
    }

    public function test_admin_can_publish_article()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $article = Article::factory()->create(['is_published' => false]);
        $token = auth()->login($admin);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->json('POST', "/api/admin/articles/{$article->id}/toggle-publish");

        $response->assertStatus(200);
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'is_published' => true
        ]);
    }

    public function test_regular_user_cannot_access_admin_routes()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $token = auth()->login($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->json('GET', '/api/admin/articles');

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_access_admin_routes()
    {
        $response = $this->json('GET', '/api/admin/articles');
        $response->assertStatus(401);
    }

    public function test_admin_can_update_article()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $article = Article::factory()->create();
        $token = auth()->login($admin);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->json('PUT', "/api/admin/articles/{$article->id}", [
                'title' => 'Updated Article Title',
                'content' => 'Updated content'
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Updated Article Title'
        ]);
    }

    public function test_admin_can_delete_article()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $article = Article::factory()->create();
        $token = auth()->login($admin);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->json('DELETE', "/api/admin/articles/{$article->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
}