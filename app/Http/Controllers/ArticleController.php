<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        return Article::all();
    }


    public function store(Request $request){
        $user = auth()->user();
        // $article = Article::create([
        //     "title"  => $request->get('title'),
        //     "description"  => $request->get('description'),
        //     "user_id"   => $user->id

        // ]);
        $article = $user->articles()->create($request->all());
        return $article;
    }



    public function find($id){
        return Article::find($id);
        
    }


    public function update(Request $request, $id){
        $user = auth()->user();

        $article = Article::find($id);
        if ($user->id !== $article->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $article->update($request->all());
        return $article;    
}


    public function destroy($id){
        $user = auth()->user();
        $article = Article::find($id);
        if ($user->id !== $article->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $article->delete();
        return "deleted";
    }
}

