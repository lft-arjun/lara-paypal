<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	$params = array(
    'q'             => 'Adele',
    'chart'         => 'mostPopular',
    'type'          => 'video',
    'part'          => 'id, snippet',
    'maxResults'    => 10
);
	$results = Youtube::searchAdvanced($params, true);
    $youtube = array();
    foreach ($results['results'] as $key => $value) {
        $youtube[$key]['videoId'] = $value->id->videoId;
        $youtube[$key] ['title'] = $value->snippet->title;
        $youtube[$key] ['description'] = $value->snippet->description;
        $youtube[$key] ['thumbnails'] = $value->snippet->thumbnails->high->url;
        $youtube[$key] ['url'] = 'https://youtube.com/watch?v='. $value->id->videoId;

      // print_r($value->snippet->thumbnails->high);
	   // print_r($value->id->videoId);
    }
    var_dump($youtube);
    // return $results;
});

Route::get('pay', ['uses' => 'PaypalController@store']);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
