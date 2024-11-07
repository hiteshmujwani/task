<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index']);
    }



    public function index()
    {
        // Show all posts
        $posts = Post::with('user')->get();
        return response()->json($posts);
    }

    public function create()
    {
        return response()->json(['message' => 'Post create form']);
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }


        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => Auth::id(),
            'image_path' => $imagePath,
        ]);


        return response()->json(['message' => 'Post created successfully!', 'post' => $post], 201);
    }


    public function edit(Post $post)
    {

        if (Gate::denies('edit-post', $post)) {
            return response()->json(['message' => 'You do not have permission to edit this post'], 403);
        }


        return response()->json($post);
    }


    public function update(Request $request, Post $post)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);


        if (Gate::denies('edit-post', $post)) {
            return response()->json(['message' => 'You do not have permission to update this post'], 403);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image_path = $imagePath;
        }


        $post->update($validatedData);

        return response()->json(['message' => 'Post updated successfully!', 'post' => $post]);
    }

    public function destroy(Post $post)
    {

        if (Gate::denies('delete-post', $post)) {
            return response()->json(['message' => 'You do not have permission to delete this post'], 403);
        }


        $post->delete();

        return response()->json(['message' => 'Post deleted successfully!']);
    }
}
