<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;
use App\Article;

class ArticleTest extends TestCase
{
    public function testsArticlesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Numquam consectetur explicabo repudiandae fugit impedit debitis.',
            'body' => 'Eveniet ad omnis consectetur nisi vero. Expedita non iusto cumque. Ea magni voluptas aut et itaque repudiandae dignissimos odit. Fugit vitae ullam aut nemo consequuntur est voluptas.',
        ];

        $this->json('POST', '/api/articles', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'title' => 'Numquam consectetur explicabo repudiandae fugit impedit debitis.',
                                     'body' => 'Eveniet ad omnis consectetur nisi vero. Expedita non iusto cumque. Ea magni voluptas aut et itaque repudiandae dignissimos odit. Fugit vitae ullam aut nemo consequuntur est voluptas.']);
    }

    public function testsArticlesAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $payload = [
            'title' => 'Numquam consectetur explicabo repudiandae fugit impedit debitis.',
            'body' => 'Eveniet ad omnis consectetur nisi vero. Expedita non iusto cumque. Ea magni voluptas aut et itaque repudiandae dignissimos odit. Fugit vitae ullam aut nemo consequuntur est voluptas.',
        ];

        $response = $this->json('PUT', '/api/articles/' . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'title' => 'Numquam consectetur explicabo repudiandae fugit impedit debitis.',
                'body' => 'Eveniet ad omnis consectetur nisi vero. Expedita non iusto cumque. Ea magni voluptas aut et itaque repudiandae dignissimos odit. Fugit vitae ullam aut nemo consequuntur est voluptas.'
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $this->json('DELETE', '/api/articles/' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    public function testArticlesAreListedCorrectly()
    {
        factory(Article::class)->create([
            'title' => 'First Article',
            'body' => 'First Body'
        ]);

        factory(Article::class)->create([
            'title' => 'Second Article',
            'body' => 'Second Body'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/articles', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'title' => 'First Article', 'body' => 'First Body' ],
                [ 'title' => 'Second Article', 'body' => 'Second Body' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'title', 'created_at', 'updated_at'],
            ]);
    }

}
