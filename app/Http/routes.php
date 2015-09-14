<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->welcome();
});

// For Authentication and login
$app->post('auth/token', 'AuthTokenController@postLogin');
$app->post('user/add', 'UserController@createUser');

$app->group(['middleware' => 'jwt.auth'], function ($app) {
    // For Posts
    $app->get('api/post', 'App\Http\Controllers\PostController@index');
    $app->get('api/post/{id}','App\Http\Controllers\PostController@getPost');
    $app->post('api/post','App\Http\Controllers\PostController@savePost');
    $app->put('api/post/{id}','App\Http\Controllers\PostController@updatePost');
    $app->delete('api/post/{id}','App\Http\Controllers\PostController@deletePost');
    $app->get('api/posts/new', 'App\Http\Controllers\PostController@newPosts');
    $app->get('api/posts/hot', 'App\Http\Controllers\PostController@hotPosts');

    // For Comments
    $app->get('api/post/comment/{id}', 'App\Http\Controllers\PostController@getComments');
    $app->post('api/comment/add', 'App\Http\Controllers\CommentController@saveComment');

    // For Locations
    $app->get('api/post/location/{id}', 'App\Http\Controllers\PostController@getLocations');
    $app->post('api/location/add', 'App\Http\Controllers\LocationController@saveLocation');
});
