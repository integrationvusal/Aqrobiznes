<?php

Route::match(['get', 'post'],'/contact/{slug}', 'SiteController@contact')->name('contact');
Route::get('/category/{slug}', 'SiteController@category')->name('category');
Route::get('/gallery/{slug}', 'SiteController@gallery')->name('gallery');
Route::get('/news/{slug}', 'SiteController@news_read')->name('news_read');
Route::get('/news/', 'SiteController@news')->name('news');
Route::get('/photodays/', 'SiteController@photodays')->name('photodays');
Route::get('/photodays_read/{slug}', 'SiteController@photodays_read')->name('dayphoto');
Route::get('/videos/', 'SiteController@videos')->name('videos');
Route::get('/wholesales/', 'SiteController@wholesales')->name('wholesales');
Route::get('/agrocalendar/', 'SiteController@agrocalendar')->name('agrocalendar');
Route::get('/questions/', 'SiteController@questions')->name('questions');
Route::post('/addquestion/', 'SiteController@addquestion');
Route::get('/clauses/{slug}', 'SiteController@clauses')->name('clauses');
Route::get('/clauses', 'SiteController@clauses')->name('clauses_list');
Route::get('/interview/{slug}', 'SiteController@interview')->name('interview');
Route::get('/interview', 'SiteController@interview')->name('interview_list');
Route::get('/personalities/{slug}', 'SiteController@personalities')->name('personalities');
Route::post('/loadmore', 'SiteController@loadmore')->name('loadmore');
Route::get('/resize/{url}/{width?}/{height?}', 'SiteController@resize')->name('resize');
Route::get('/', 'SiteController@home')->name('home');



