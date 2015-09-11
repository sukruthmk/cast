<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
use App\Comment;
use App\Location;
use DB;

class PostController extends Controller {

    public function index(){
        $posts  = Post::where('user_id', '=', Auth::id())->get();

        return response()->json($posts);
    }

    public function getPost($id){
        $post  = Post::find($id);

        return response()->json($post);
    }

    public function savePost(Request $request){
        $post = new Post;
        $post->message = $request->input('message');
        $post->user_id = Auth::id();
        $post->save();

        return response()->json($post);

    }

    public function deletePost($id){
        $post  = Post::find($id);
        if ($this->checkUser($post)) {
            return $post->delete();
        }

        return false;
    }

    public function updatePost(Request $request,$id){
        $post  = Post::find($id);
        if ($this->checkUser($post)) {
            $post->message = $request->input('message');
            $post->save();

            return response()->json($post);
        }
        return false;
    }

    public function getComments(Request $request, $id){
        $comments  = Comment::where('post_id', '=', $id)->get();

        return response()->json($comments);
    }

    public function getLocations(Request $request, $id) {
        $locations = Location::where('post_id', '=', $id)->get();

        return response()->json($locations);
    }

    public function newPosts(Request $request) {
        $lattitude = $request->input('lattitude');
        $longitude = $request->input('longitude');
        $radius = 10;
        $posts = Location::select(
                 DB::raw("locations.post_id,
                               ( 6371 * acos( cos( radians(?) ) *
                                 cos( radians( lattitude ) )
                                 * cos( radians( longitude ) - radians(?)
                                 ) + sin( radians(?) ) *
                                 sin( radians( lattitude ) ) )
                               ) AS distance, posts.message, posts.user_id, users.id, users.name, users.user_name"))
                 ->join('posts', 'posts.id', '=', 'locations.post_id')
                 ->join('users', 'users.id', '=', 'posts.user_id')
                 ->having("distance", "<", $radius)
                 ->orderBy("posts.created_at", 'desc')
                 ->setBindings([$lattitude, $longitude, $lattitude])
                 ->distinct()
                 ->get();

       return response()->json($posts);
    }

    /**
     * Check valid user.
     *
     * @param  App\Dream $dream
     * @return boolean
     */
    private function checkUser(Post $post)
    {
        return $post->user_id == Auth::id();
    }

}
