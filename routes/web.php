<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceservice within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Admin'], function() {

Route::get('second', 'SecondController@showString');
});

Route::resource('news', 'Newscontroller');




Auth::routes(['verify'=>true]);







Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', function() {

    return  "home";
});


Route::get('auth/{provider}', 'SocialController@redirect');

Route::get('auth/{provider}/callback', 'SocialController@callback');




// Route::get('login/{service}/callback','SocialController@callback');
// Route::get('login/{service}', 'SocialController@redirect');


Route::get('fillable', 'CrudController@getOffers');



// Route::group(['prefix' => 'offers'], function () {
//    Route::get('create', 'CrudController@create');
//    Route::get('store', 'CrudController@store')->name('offers.store');

// });

Route::group( [


    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

], function () {


    Route::group(['prefix' => 'offers'] ,function() {
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');
    });


});






//     //   Route::post('store', 'CrudController@store')->name('offers.store');

//

// }
