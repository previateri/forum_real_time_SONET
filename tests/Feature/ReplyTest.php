<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;


    public function testListagemRespostasPorTopico()
    {
        $user = factory(\App\User::class)->create();
        $this->seed('RepliesTableSeeder');

        $replies = \App\Reply::where('thread_id', 2)->get();

        $response = $this->actingAs($user)->json('GET', '/replies/2');
        $response
                ->assertStatus(200)
                ->assertJson($replies->toArray());
    }

    public function testEnviarRespostaParaTopico(){
        $user = factory(\App\User::class)->create();
        $thread = factory(\App\Thread::class)->create();

        $dt = ['body' => "Resposta Qualquer", 'thread_id' => $thread->id];

        $response = $this->actingAs($user)->json('POST', '/replies', $dt);

        $replie = \App\Reply::find(1);

        $response
                ->assertStatus(200)
                ->assertJson($replie->toArray());
    }
}
