<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // User::all();
        //CONFIRMAMOS QUE EXISTA
        $posts = auth()->user()->posts;

        return response()->json(['success' => true, 'data' => $posts], 200);

        // return users
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->image;

        if(auth()->user()->posts()->save($post))
            return response()->json([
                'success' => true,
                'data' => $post->toArray()
            ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Post not added'
                ], 500);
        // data = Request->all();

        // user = User::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //CONFIRMAMOS LA AUTHENTICATION
        $post = auth()->user()->posts()->find($id);

        if(!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => $post->toArray()
        ], 200);
        // User::findOrFail($id);

        // return user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$user = User::findOrFail($id);
        $post = auth()->user()->posts()->find($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }
        // $updated = $post->fill($request->all())->save();
        $updated = $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post can not be updated'
            ], 500);

        // $post = auth()->user()->posts()->find($id);

        // if (!$post) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post not found'
        //     ]);
        // }

        // $updated = $post->fill($request->all())->save();

        // if ($updated)
        //     return response()->json([
        //         'success' => true
        //     ]);
        // else
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post can not be updated'
        //     ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $post = auth()->user()->posts()->find($id);
        if(!$post){
            return response() ->json([
                'success' => false,
                'message' => 'Post not found',
            ], 400);
        }
        //AQUI EJECUTAMOS LA ACCIÓN
        if($post -> delete()){
            return response() ->json([
                'success' => true,
            ], 200);
        } else {
            return response() ->json([
                'success' => false,
                'message' => 'Post can not be deleted',
            ], 500);
        }
    }
}