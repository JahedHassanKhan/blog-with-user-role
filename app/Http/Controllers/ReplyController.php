<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request, $post){
        $reply = new Reply();
        $reply->user_id             =   Auth::user()->id;
        $reply->post_id             =   $post;
        $reply->body                =   $request->body;
        $reply->save();

        return redirect()->back();
    }
    public function replyReply(Request $request, $reply1){
        $reply = new Reply();
        $reply->user_id     =   Auth::user()->id;
        $reply->post_id     =   null;
        $reply->reply_id    =   $reply1;
        $reply->body        =   $request->body;
        $reply->save();

        return redirect()->back();

    }
}
