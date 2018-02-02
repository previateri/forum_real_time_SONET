<?php

namespace App\Http\Controllers;
use App\Events\NewReply;
use App\Http\Requests\ReplyRequest;
use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function show($id){
        $replies = Reply::where('thread_id', $id)
            ->with('user')
            ->orderBy('highlighted', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($replies);
    }

    public function highlite($id){
        $reply = Reply::findOrFail($id);

        $this->authorize('update', $reply);

        Reply::where([
            ['id', '!=', $id],
            ['thread_id', '=', $reply->thread_id],
            ])
            ->update([
                'highlighted' => false
            ]);

        $reply->highlighted = ($reply->highlighted ? false : true);
        $reply->save();

        return redirect()->to("/threads/{$reply->thread_id}");
    }

    public function store(ReplyRequest $request){
       $reply = new Reply();
       $reply->body = $request->input('body');
       $reply->thread_id = $request->input('thread_id');
       $reply->user_id = \Auth::user()->id;

        $this->authorize('sendReply', $reply);

        $reply->save();

        broadcast(new NewReply($reply));

        return response()->json($reply);
    }
}
