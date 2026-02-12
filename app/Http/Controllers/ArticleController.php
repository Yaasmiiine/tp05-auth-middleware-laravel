<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::with('user')->where('user_id', auth()->id()); // only current user

        // Bonus: search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(5);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')
                ->store('articles', 'public');
        }

        $data['user_id'] = auth()->id();

        Article::create($data);

        return redirect()->route('articles.index')
            ->with('success', 'Article créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // Ensure user can only view their own article
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Accès interdit');
        }

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Ensure user can only edit their own article
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Accès interdit');
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // Ensure user can only update their own article
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Accès interdit');
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            if ($article->image_path) {
                Storage::disk('public')->delete($article->image_path);
            }

            $data['image_path'] = $request->file('image')
                ->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('articles.index')
            ->with('success', 'Article modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Ensure user can only delete their own article
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Accès interdit');
        }

        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article supprimé avec succès !');
    }
}
