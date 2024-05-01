<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StorePostRequest;
// use App\Http\Requests\UpdatePostRequest;
use App\Mail\WelcomeMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware as ControllersMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new ControllersMiddleware(['auth', 'verified'], except: ['index', 'show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],

        ]);

        $path = null;
        // Store Image if Exists
        if($request->hasFile('image')) {
            $path = Storage::disk('public')->put('post_images', $request->image);
        }

        // Create A Post
        $post = Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

        // Send Email
        Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $post));


        return back()->with('success','Your post was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post'=> $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:1000', 'mimes:png,jpg,webp']
        ]);

        // Store Image if Exists
        $path = $post->image ?? null;
        if($request->hasFile('image')) {
            // if file exist delete prev image
            if($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('post_images', $request->image);
        }

        // Update A Post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

        return redirect()->route('dashboard')->with('success','Your post was updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete image
        if($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with('delete','Your post was deleted!');
    }
}
