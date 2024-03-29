<?php

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    Route::get('/', function () {
        echo 'Welcome to User API';
    });
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register', 'Auth\ApiAuthController@register')->name('register.api');
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    });
});
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\User'], function () {
    Route::get('/', function () {
        echo 'Welcome to User API';
    });

    /* API banner */
    Route::macro('banner', function ($uri, $controller) {
        Route::resource($uri, $controller);
    });
    Route::banner('banner', 'BannerController');

    /* API Game */
    Route::macro('gamesAndPlus', function ($uri, $controller) {
        // get all games + gampanion data
        Route::get("{$uri}/AllAndGampanions", "{$controller}@AllAndGampanions")->name("{$uri}.AllAndGampanions");
        Route::post("{$uri}/media", "{$controller}@storeMedia")->name("{$uri}.storeMedia");
        Route::resource($uri, $controller);
    });
    Route::gamesAndPlus('games', 'GamesApiController');

    /* API Gampanion */
    Route::macro('gamespanionAndPlus', function ($uri, $controller) {
        // get all gampanions + game data with is_featured = 1 + user data
        Route::get("{$uri}/featuredGampanions", "{$controller}@featuredGampanions")->name("{$uri}.featuredGampanions");
        Route::get("{$uri}/index2", "{$controller}@index2")->name("{$uri}.index2");
        Route::post("{$uri}/add", "{$controller}@add")->name("{$uri}.add");
        Route::delete("{$uri}/delete/{id}", "{$controller}@delete")->name("{$uri}.delete");
        Route::post("{$uri}/add-game", "{$controller}@addGame")->name("{$uri}.add-game");
        Route::post("{$uri}/send-request", "{$controller}@SendRequest")->name("{$uri}.send-request");
        Route::get("{$uri}/requests", "{$controller}@Requests")->name("{$uri}.requests");
        Route::post("{$uri}/request-response/{id}", "{$controller}@RequestResponse")->name("{$uri}.request-response");
        Route::resource($uri, $controller);
    });
    Route::gamespanionAndPlus('gampanions', 'GampanionApiController');

    /* API Order */
    Route::macro('ordersAndPlus', function ($uri, $controller) {
        Route::get("{$uri}/ordersUser1", "{$controller}@ordersUser1")->name("{$uri}.ordersUser1");
        Route::get("{$uri}/ordersUser2", "{$controller}@ordersUser2")->name("{$uri}.ordersUser2");
        Route::get("{$uri}/show1/{id}", "{$controller}@show1")->name("{$uri}.show1");
        Route::get("{$uri}/show2/{id}", "{$controller}@show2")->name("{$uri}.show2");
        //Route::resource($uri, $controller);
    });
    Route::ordersAndPlus('orders', 'OrdersApiController');

    /* API Favorite */
    Route::macro('favoriteAndPlus', function ($uri, $controller) {
        Route::get("{$uri}/index1", "{$controller}@index1")->name("{$uri}.index1");
        Route::get("{$uri}/index2", "{$controller}@index2")->name("{$uri}.index2");
        Route::get("{$uri}/index3", "{$controller}@index3")->name("{$uri}.index3");
        Route::post("{$uri}/add", "{$controller}@add");
        Route::post("{$uri}/destroy", "{$controller}@destroy");
        //Route::resource($uri, $controller);
    });
    Route::favoriteAndPlus('favorites', 'FavoritesApiController');

    /* API Wallet */
    Route::macro('walletAndPlus', function ($uri, $controller) {
        Route::get("{$uri}/", "{$controller}@show")->name("{$uri}.show");
        //Route::resource($uri, $controller);
    });
    Route::walletAndPlus('wallets', 'WalletsApiController');

    /* API Withdraw */
    Route::macro('withdrawAndPlus', function ($uri, $controller) {
        Route::post("{$uri}/store", "{$controller}@store")->name("{$uri}.store");
        Route::get("{$uri}/index", "{$controller}@index")->name("{$uri}.index");
        //Route::resource($uri, $controller);
    });
    Route::withdrawAndPlus('withdraws', 'WithdrawsApiController');


    /* API User */
    Route::macro('userAndPlus', function ($uri, $controller) {
        Route::get("{$uri}/currentUser", "{$controller}@currentUser")->name("{$uri}.currentUser");
        Route::get("{$uri}/is-provider", "{$controller}@isProvider")->name("{$uri}.is-provider");
        Route::post("{$uri}/update", "{$controller}@update")->name("{$uri}.update");
        Route::delete("{$uri}/softDelete/{id}", "{$controller}@delete")->name("{$uri}.delete");
        Route::get("{$uri}/userById/{email}", "{$controller}@show")->name("{$uri}.show");
        Route::get("{$uri}/idByEmail/{email}", "{$controller}@selectUserEmail")->name("{$uri}.selectUserEmail");
        Route::get("{$uri}/recentsUsersPhotos", "{$controller}@recentsUsersPhotos")->name("{$uri}.recentsUsersPhotos");
        Route::get("{$uri}/alerts", "{$controller}@alerts")->name("{$uri}.alerts");
        Route::get("{$uri}/userPhotosById/{id}", "{$controller}@userPhotosById")->name("{$uri}.userPhotosById");
        Route::post("{$uri}/addProfilePhoto", "{$controller}@addProfilePhoto")->name("{$uri}.addProfilePhoto");
        //Route::resource($uri, $controller);
    });
    Route::userAndPlus('users', 'UsersApiController');


});
