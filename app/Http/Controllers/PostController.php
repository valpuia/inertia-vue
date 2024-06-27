<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Inertia\Response;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(
                middleware: HandlePrecognitiveRequests::class,
                only: ['store', 'update']
            ),
        ];
    }

    public function index(): Response
    {
        $posts = Post::latest()
            ->with('user:id,name')
            ->filter(request()->only('s'))
            ->paginate(7, ['id', 'title', 'slug', 'created_at', 'user_id'])
            ->withQueryString();

        return inertia('Home', [
            'posts' => $posts,
            'filters' => request()->only('s'),
        ]);
    }

    public function create(): Response
    {
        return inertia('Posts/Create');
    }

    public function store(StorePostRequest $request)
    {
        auth()->user()->post()->create($request->validated());

        return to_route('home');
    }

    /**
     * Show the form for viewing the specified resource.
     */
    public function show(Post $post)
    {
        return inertia('Posts/View', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): Response
    {
        Gate::authorize('update', $post);

        return inertia('Posts/Edit', [
            'post' => $post,
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return to_route('home');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return to_route('home');
    }
}
