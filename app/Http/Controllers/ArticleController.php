<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleStoreRequest;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(15)->sortByDesc('publish_on');
        return view('articles.index', ['articles' => $articles, 'currentUser' => Auth::user()]);
    }

    public function update($id)
    {
        $article = Article::findOrFail($id);
        $authors = User::whereHas('roles', function ($q) {
            $q->whereNotIn('role_id', [Role::ADMINISTRATOR]);
        })->get();

        return view('articles.update', ['article' => $article, 'authors' => $authors]);
    }

    public function save($id)
    {
        $article = Article::findOrFail($id);
        $article->update(Input::all());

        return redirect('articles/' . $article->id);
    }

    public function erase($id)
    {
        $article = Article::findOrFail($id);
        $article->forceDelete();

        return redirect('articles');
    }

    public function create()
    {
        $authors = User::whereHas('roles', function ($q) {
            $q->whereNotIn('role_id', [Role::ADMINISTRATOR]);
        })->get();
        return view('articles.create', ['authors' => $authors, 'currentUser' => Auth::user()]);
    }

    public function store(ArticleStoreRequest $articleStoreRequest)
    {
        $image = $articleStoreRequest->image;
        $imagePath = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imagePath);

        $newPost = new Article();
        $fillables = $newPost->getFillable();
        foreach ($fillables as $fillable) {
            if (isset($articleStoreRequest->$fillable)) {
                $newPost->$fillable = $articleStoreRequest->$fillable;
            }
        }
        $newPost->image_url = $imagePath;
        $newPost->save();

        return redirect('articles/' . $newPost->id);
    }

    public function detail($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.detail', ['article' => $article]);
    }
}
