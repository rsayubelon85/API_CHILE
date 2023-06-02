<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(PassportAuthController::class)->group(function(){    
    Route::post('login','login');
    Route::post('logout','logout')->middleware('auth:api');
});

Route::controller(PermissionController::class)->middleware('auth:api')->group(function(){
    
    Route::get('permisos','index');

    Route::get('permisos/{role}','set_Rol')->name('permiso.setrol');

    Route::post('permisos','asignacion_permiso')->name('asigna.perm');

});

Route::resource('users',UserController::class)->except('show','create')->middleware('auth:api');

Route::resource('categories',CategorieController::class)->except('show','create')->middleware('auth:api');

Route::resource('articles',ArticleController::class)->except('show','create')->middleware('auth:api');

Route::controller(ArticleController::class)->middleware('auth:api')->group(function(){
    Route::get('articles/bycategorie/{categorie}','ArticleByCategorie')->name('art_by_categorie');
    
    Route::get('articles/byarticle/{article}','ImageByArticle')->name('img_by_article');

    Route::post('articles/findart','FindArticles');

    Route::post('articles/findcantart','FindCantArticles');

    Route::get('articles/nostock','ArticleNotStock');

    Route::get('articles/totalprofit','ShowTotalProfit');

    Route::get('articles/articlesbuy','ArticulosVendidos');

    Route::post('articles/sellart/{article}','SellArticle');
    
});




Route::resource('roles',RolController::class)->middleware('auth:api')->except('show');


/*FindArticles($name,$price,$availability,$categorie_id,$tags,$description,$add_information,$star_rating,$sku)
FindCantArticles($name,$price,$availability,$categorie_id,$tags,$description,$add_information,$star_rating,$sku)
ArticleNotStock
SellArticulo(Article $article)
ShowTotalProfit()
*/

