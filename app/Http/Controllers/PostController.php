<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {

    }

    public function all_view()
    {
        $posts = Post::all();

    	return view('backend.pages.post.all', [
            'active_link' => 'posts',
            'posts'       => $posts
        ]);
    }

    public function all()
    {
        try
        {
            $posts = Post::all();

            return response()->json([
                'posts' => $posts
            ], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function add_view()
    {
    	return view('backend.pages.post.add', [
            'active_link' => 'posts'
        ]);
    }

    public function add(Request $request)
    {
        try 
        {
            $post = new Post;

            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = Auth::user()->id;
            $post->type = $request->input('type');

            if ($post->save())
            {
                return response()->json(['status' => 'ok'], 200);
            }

            return response()->json(['status' => 'fail'], 200);
        } 
        catch (\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function show($post_id)
    {
        try
        {
            $post = Post::findOrFail($post_id);

            return response()->json([
                'post'          => $post
            ], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function show_view($post_id)
    {
        $post = Post::findOrFail($post_id);

        return view('backend.pages.post.show', [
            'active_link'   => 'posts',
            'post'          => $post
        ]);
    }

    public function update(Request $request)
    {
        try
        {
            $post = Post::findOrFail($request->input('post_id'));

            $post->title = $request->input('title');
            $post->content = $request->input('content');

            if ($post->save())
            {
                return response()->json(['status' => 'ok']);
            }

            return response()->json(['status' => 'fail']);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try
        {
            $post = Post::findOrFail($request->input('post_id'));

            if ($post->delete())
            {
                return response()->json(['status' => 'ok']);
            }

            return response()->json(['status' => 'fail']);
        }
        catch(\Exception $e)
        {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
}
