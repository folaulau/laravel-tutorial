<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

use App\Providers\ArticleService;
 
class ArticleController extends Controller
{

    protected $articleService;

    function __construct(ArticleService $articleService) {
        $this->articleService = $articleService;
    }
    public function index()
    {
        //$articleService = new ArticleService();

        $this->articleService->validate();

        return Article::all();
    }

    public function show(Article $article)
    {
        return $article;
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}

