<?php

namespace Tests\Unit;

use App\Http\Controllers\PostController;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    private PostController $postController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postController = $this->app->make(PostController::class);
    }

    public function testIndex()
    {
        $user = User::factory()->create();
        $this->be($user);  // Authenticate the user

        $posts = Post::factory()->count(5)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->postController->index();

        $this->assertEquals('post.index', $response->getName());
        $this->assertArrayHasKey('posts', $response->getData());
        $this->assertArrayHasKey('user', $response->getData());
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $this->be($user);  // Authenticate the user

        $postData = [
            'title' => 'Test Title',
            'content' => 'Test content'
        ];

        $request = new PostRequest();
        $request->merge($postData);
        $request->setContainer($this->app)->validateResolved();

        $response = $this->postController->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('posts', $postData);
    }

    public function testEdit()
    {
        $post = Post::factory()->create();
        $this->be($post->user);  // Authenticate the user

        $response = $this->postController->edit($post);

        $this->assertEquals('post.edit', $response->getName());
        $this->assertArrayHasKey('post', $response->getData());
    }

    public function testUpdate()
    {
        $post = Post::factory()->create();
        $this->be($post->user);  // Authenticate the user

        $postData = [
            'title' => 'Updated Title',
            'content' => 'Updated content'
        ];

        $request = new PostRequest();
        $request->merge($postData);
        $request->setContainer($this->app)->validateResolved();

        $response = $this->postController->update($request, $post);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('posts', $postData);
    }

    public function testDestroy()
    {
        $post = Post::factory()->create();
        $this->be($post->user);  // Authenticate the user

        $response = $this->postController->destroy($post);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
