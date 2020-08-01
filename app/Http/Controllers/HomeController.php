<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Model\Article;

class HomeController extends Controller
{
    public function index()
    {
        return view ('crud_vue');
    }

    public function getArtikel()
    {
        $artikel = Article::orderBy('created_at', 'desc')->get();

        return ArticleResource::collection($artikel);
    }

    public function store(Request $request)
    {
        $artikel = Article::create([
            'judul' => $request->judul,
            'desc' => $request->desc
        ]);

        return new ArticleResource($artikel);
    }

    public function edit($id)
    {
        $artikel = Article::find($id);
        $artikel->update([
            'judul' => $request->judul,
            'desc' => $request->desc,
        ]);

        return new ArticleResource($artikel);
    }

    public function delete($id)
    {
        Article::destroy($id);
        return "success";
    }
}
