<?php

namespace App\Http\Controllers;
use App\Http\Requests\ReplyRequest;
use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function show($id){
        $replies = Reply::where('thread_id', $id)->with('user')->get();

        return response()->json($replies);
    }

    public function store(ReplyRequest $request){
       $reply = new Reply();
       $reply->body = $request->input('body');
       $reply->thread_id = $request->input('thread_id');
       $reply->user_id = \Auth::user()->id;

        $reply->save();

        return response()->json($reply);
    }
}
