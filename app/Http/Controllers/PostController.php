<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::all();  // Fetch all posts
        return view('posts.index', compact('posts'));  // Return the view with posts
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public'); // Save image in 'public/post_images'
        }

        // Create the post record
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        // If an image was uploaded, save it in the PostImage table
        if ($imagePath) {
            PostImage::create([
                'post_id' => $post->id,
                'image_path' => $imagePath,
            ]);
        }

        // Redirect to posts index with success message
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    public function edit(Post $post)
    {

        if (Gate::allows('edit-post', $post)) {
            return view('posts.edit', compact('post'));
        }

        return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
    }


    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate image
        ]);


        if (Gate::denies('edit-post', $post)) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
        }


        if ($request->hasFile('image')) {

            if ($post->image_path && Storage::exists('public/' . $post->image_path)) {
                Storage::delete('public/' . $post->image_path);
            }


            $imagePath = $request->file('image')->store('posts', 'public');
        } else {
            $imagePath = $post->image_path;
        }


        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    public function destroy(Post $post)
    {

        if (Gate::allows('delete-post', $post)) {

            if ($post->image_path && Storage::exists('public/' . $post->image_path)) {
                Storage::delete('public/' . $post->image_path);
            }

            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        }

        return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post.');
    }
}
