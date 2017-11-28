<?php

/* PAGES ROUTES */
get('/login', ['as' => 'login', 'uses' => 'SteamController@login']);
get('/', ['as' => 'index', 'uses' => 'GameController@currentGame']);
get('/about', ['as' => 'about', 'uses' => 'PagesController@about']);
get('/fairplay/{game}', ['as' => 'fairplay', 'uses' => 'PagesController@fairplay']);
get('/fairplay', ['as' => 'fairplay_no', 'uses' => 'PagesController@fairplay_no']);
get('/support', ['as' => 'support', 'uses' => 'PagesController@support']);
get('/top', ['as' => 'top', 'uses' => 'PagesController@top']);
get('/game/{game}', ['as' => 'game', 'uses' => 'PagesController@game']);
get('/user/{user}', ['as' => 'user', 'uses' => 'PagesController@user']);
get('/history', ['as' => 'history', 'uses' => 'PagesController@history']);
get('/donate', 'DonateController@GDonateDonate');
get('/escrow', ['as' => 'escrow', 'uses' => 'PagesController@escrow']);

/* MINI API SITE */
post('ajax', ['as' => 'ajax', 'uses' => 'AjaxController@parseAction']);
get('/chat', ['as' => 'chat', 'uses' => 'ChatController@chat']);

/* SHOP ROUTES */
get('/cards', ['as' => 'cards', 'uses' => 'ShopController@index']);
get('/cards/history', ['as' => 'cards-history', 'uses' => 'ShopController@history']);

Route::group(['middleware' => 'auth'], function () {
	get('/send', ['as' => 'send', 'uses' => 'SendController@send']);
    get('/gmoney', ['as' => 'gmoney', 'uses' => 'SendController@gmoney']);
    get('/pay', ['as' => 'pay', 'uses' => 'PagesController@pay']);
    get('/deposit', ['as' => 'deposit', 'uses' => 'GameController@deposit']);
    get('/settings', ['as' => 'settings', 'uses' => 'PagesController@settings']);
    post('/settings/save', ['as' => 'settings.update', 'uses' => 'SteamController@updateSettings']);
    post('/chat', ['as' => 'chat', 'uses' => 'ChatController@chatMessage']);
    get('/my-history', ['as' => 'my-history', 'uses' => 'PagesController@myhistory']);
    get('/my-inventory', ['as' => 'my-inventory', 'uses' => 'PagesController@myinventory']);
    post('/myinventory', ['as' => 'myinventory', 'uses' => 'PagesController@myinventory']);
    get('/logout', ['as' => 'logout', 'uses' => 'SteamController@logout']);
    post('/addTicket', ['as' => 'add.ticket', 'uses' => 'GameController@addTicket']);
    post('/getBalance', ['as' => 'get.balance', 'uses' => 'GameController@getBalance']);
    get('/winner', ['as' => 'admin', 'uses' => 'admin@winner', 'middleware' => 'access:admin']);
    get('/ref', ['as' => 'ref', 'uses' => 'RefController@ref']);    
    get('/getcoupon', ['as' => 'getcoupon', 'uses' => 'RefController@getcoupon']);
    get('/admin', ['as' => 'give', 'uses' => 'AdminController@admin']);	
get('/mute', ['as' => 'give', 'uses' => 'AdminController@mute']);	
post('/mute', ['as' => 'give', 'uses' => 'AdminController@mute']);	
get('/clearsupport', ['as' => 'give', 'uses' => 'AdminController@clearsupport']);	
get('/supportban', ['as' => 'give', 'uses' => 'AdminController@supportban']);	
get('/setadmin', ['as' => 'give', 'uses' => 'AdminController@setadmin']);	
get('/sendmoney', ['as' => 'give', 'uses' => 'AdminController@sendmoney']);
get('/removemoney', ['as' => 'give', 'uses' => 'AdminController@removemoney']);
post('/support', 'SupportController@support');
	
get('/support', ['as' => 'support.index', 'uses' => 'SupportController@support']);
	
get('/support/{ticket}', ['as' => 'ticket', 'uses' => 'SupportController@ticket']);
	
post('/support/{ticket}', ['as' => 'ticket', 'uses' => 'SupportController@ticket']);

    /* SHOP ROUTES */
    post('/shop/buy', ['as' => 'settings.update', 'uses' => 'ShopController@buyItem']);
});


Route::group(['prefix' => 'api', 'middleware' => 'secretKey'], function () {
    post('/checkOffer', 'GameController@checkOffer');
    post('/newBet', 'GameController@newBet');
    post('/setGameStatus', 'GameController@setGameStatus');
    post('/setPrizeStatus', 'GameController@setPrizeStatus');
    post('/getCurrentGame', 'GameController@getCurrentGame');
    post('/getWinners', 'GameController@getWinners');
    post('/getPreviousWinner', 'GameController@getPreviousWinner');
    post('/Shoka', 'GameController@newGame');
    post('/getPriceItems', 'GameController@getPriceItems');
	post('/chat', ['as' => 'chat', 'uses' => 'ChatController@chat']);

    /* SHOP BOT ROUTES */
    post('/shop/newItems', 'ShopController@addItemsToSale');
    post('/shop/setItemStatus', 'ShopController@setItemStatus');
});

/* CHAT ROUTES */

Route::group(['middleware' => 'auth'], function () {
    post('/add_message', ['as' => 'chat', 'uses' => 'ChatController@add_message']);
    post('/delete_message', ['as' => 'chat', 'uses' => 'ChatController@delete_message']);
    post('/ban_user', ['as' => 'chat', 'uses' => 'ChatController@ban_user']);
	post('/chat', ['as' => 'chat', 'uses' => 'ChatController@chat']);
});


Route::group(['prefix' => 'api', 'middleware' => 'secretKey'], function () {
    post('/lastwinner', 'GameController@lastwinner');
    post('/todaylucky', 'GameController@todaylucky');
    post('/alllucky', 'GameController@alllucky');
});
