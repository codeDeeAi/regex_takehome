<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Get Blog Posts
    public function index(Request $request)
    {
        return Blog::loadTable()->approved()->get();
    }

    // Get Moderation Blog Posts
    public function getModerationBlogs(Request $request)
    {
        return Blog::loadTable()->unapproved()->get();
    }

    // Create Blog
    public function create(CreateBlogRequest $request)
    {
        try {
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->store('public/images');
            $path = str_replace('public', 'storage', $path);

            $blog = Blog::create([
                'user_id' => $request->user->id ?? null,
                'image' => $path,
                'title' => $request->title,
                'description' => $request->description,
                'approved' => (!is_null($request->user)) ? true : false
            ]);

            // Response
            return response()->json([
                'message' => 'Post created sucessfully',
                'post' => $blog
            ], 200);
        } catch (\Throwable $th) {
            // Response
            return  response()->json(['message' => 'Could not create post :('], 500);
        }
    }

    // Approved Moderated Blog
    public function approveBlog(Request $request, Blog $blog)
    {
        $blog->update([
            'approved' => true
        ]);

        // Response
        return response()->json([
            'message' => 'Post approved sucessfully',
            'post' => $blog
        ], 200);
    }
}
