<?php

namespace App\Http\Controllers;
use App\Article;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
  //all
  public function index(){
    return Article::all();
  }

  //show
  public function show(Article $article){
    return $article;
  }

  //create
  public function store(Request $request){
    $article = Article::create($request->all());
      return response()->json($article, 201); //201 = object created
  }

  //update
  public function update(Request $request, Article $article ){
    $article->update($request->all());
      return response()->json($article, 200); //200 = success code
  }

  //delete
  public function delete(Article $article){
    $article->delete();
      return response()->json(null, 204); //204 = return no content
  }

}
