<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::with('user')
            ->orderByDesc('id')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title'   => 'required|string',
            'content' => 'required|string',
        ]);

        Post::create([
            'title'   => $fields['title'],
            'content' => $fields['content'],
            'user_id' => $request->user()->id,
        ]);

        return response([
            'message' => 'success'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::with('user')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($request->user()->cannot('update', $post)) {
            return response([
                'message' => 'Forbidden'
            ], 403);
        }

        $fields = $request->validate([
            'title'   => 'required|string',
            'content' => 'required|string',
        ]);

        $post->title   = $fields['title'];
        $post->content = $fields['content'];
        $post->save();

        return response([
            'message' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response([
            'message' => 'success'
        ], 200);
    }
}
