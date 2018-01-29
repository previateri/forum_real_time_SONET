<?php

namespace Tests\Feature;


use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function testActionIndexOnController()
    {
        $user = factory(\App\User::class)->create();
        $this->seed('ThreadsTableSeeder');

        $threads = Thread::orderBy('updated_at', 'desc')->paginate();

        $response = $this
            ->actingAs($user)
            ->json('GET', '/threads');
        $response
            ->assertStatus(200)
            ->assertJsonFragment([$threads->toArray()['data']]);
    }

    public function testActionStoreController()
    {
        $user = factory(\App\User::class)->create();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/threads', [
                                'title' => 'My First Thread.',
                                'body' => 'Content of my first thread in the forum.',
                                ]
            );

        $thread = \App\Thread::find(1);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['created' => 'success'])
            ->assertJsonFragment([$thread->toArray()]);

    }

    public function testActionUpdateController(){
        $user = factory(\App\User::class)->create();
        $thread = factory(\App\Thread::class)->create(['user_id' => $user->id]);

        $thread->title = "My First Thread Updated";
        $thread->body = "My First Thread Updated";

        $response = $this
                    ->actingAs($user)
                    ->json('PUT', "/threads/{$thread->id}", [ 'title' => $thread->title, 'body' => $thread->body ]);
        
        $response->assertStatus(302);
        $this->assertEquals(Thread::find(1)->toArray(), $thread->toArray());
    }
}
