<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('home');

    Route::resource('/categorie', 'CategorieController');
    Route::get('categorie-resultat', 'CategoriesController@search')->name('categorie.search');

    Route::resource('/rayon', 'RayonController');
    Route::get('rayon-resultat', 'RayonController@search')->name('rayon.search');

    Route::resource('produit', 'ProduitController');
    Route::get('produit-resultat', 'ProduitController@search')->name('produit.search');
    Route::get('findRayon', 'ProduitController@findRayon')->name('rayon.find');

    Route::resource('utilisateur', 'UserController');
    Route::get('profil', 'UserController@profile')->name('user.profile');
    Route::put('info-profil', 'UserController@update_profile')->name('user.update_profile');
    Route::put('pass-profil', 'UserController@update_password')->name('user.update_password');

});

Route::group(['middleware' => ['isResp']], function () {
    Route::get('/dashboard', 'DashboardController@user')->name('resp.home');

    Route::get('responsable/categorie', 'CategoriesController@indexResp')->name('cat');
    Route::post('responsable/categorie', 'CategoriesController@storeResp')->name('cat.store');
    Route::put('responsable/categorie/{categorie}', 'CategoriesController@updateResp')->name('cat.update');
    Route::delete('responsable/categorie/{categorie}', 'CategoriesController@destroyResp')->name('cat.destroy');
    Route::get('categorie-resultats', 'CategoriesController@c_search')->name('cat.search');

    Route::get('me', 'UserController@profile')->name('resp.profile');
    Route::put('info-profil-r', 'UserController@update_profile_r')->name('user.update_profile_r');
    Route::put('pass-profil-r', 'UserController@update_password_r')->name('user.update_password_r');

    Route::get('responsable/produit', 'ProduitController@indexResp')->name('prod');
    Route::get('/findRayonR', 'ProduitController@findRayon_r')->name('r.find');
    Route::post('responsable/produit', 'ProduitController@storeResp')->name('pro.store');
    Route::put('responsable/produit/{produit}', 'ProduitController@updateResp')->name('pro.update');
    Route::delete('responsable/produit/{produit}', 'ProduitController@destroyResp')->name('pro.destroy');
    Route::get('produit-resultats', 'ProduitController@c_search')->name('pro.search');
});
