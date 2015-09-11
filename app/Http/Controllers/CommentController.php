<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Comment;

class CommentController extends Controller {

    public function saveComment(Request $request){
        $comment = new Comment;
        $comment->message = $request->input('message');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = Auth::id();
        $comment->save();

        return response()->json($comment);
    }

}
