<?php

use Illuminate\Http\Request;
use App\Article;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//using middleware to restric access
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@register'); //register
Route::post('login', 'Auth\LoginController@login'); //login
Route::post('logout', 'Auth\LoginController@logout'); //logout

//Route Article
//return error 404 (not found) or 401 unauthenticated
Route::group(['middleware' => 'auth:api'], function(){ //unauthenticated
  Route::get('articles', 'ArticleController@index'); //all
  Route::get('articles/{article}', 'ArticleController@show'); //show
  Route::post('articles', 'ArticleController@create'); // create
  Route::put('articles/{article}', 'ArticleController@update'); // update
  Route::delete('articles/{article}', 'ArticleController@delete'); //delete
});

Auth::guard('api')->user(); //instance the logged user
Auth::guard('api')->check(); //check user is authenticated
auth::guard('api')->id(); //id of the authenticated user
