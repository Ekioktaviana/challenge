<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//siswa
$router->get('/siswa', ['uses' => 'SiswaController@show']);
// $router->get('/siswa/{id}', ['uses' => 'SiswaController@showByRombel']);
$router->post('/siswa', ['uses' => 'SiswaController@store']);
$router->patch('/siswa/{id}', ['uses' => 'SiswaController@update']);
$router->delete('/siswa/{id}', ['uses' => 'SiswaController@delete']);
$router->get('/siswa/kelas/{id}', ['uses' => 'SiswaController@showByRombel']);
$router->get('/siswa/sekolah/{id}', ['uses' => 'SiswaController@showBySekolah']);
$router->get('/siswa/sekolah/kelas/{id}', ['uses' => 'SiswaController@sortirKelas']);
$router->get('/belajarArray', ['uses' => 'SiswaController@belajarArray']);

//Kelas
$router->get('/kelas', ['uses' => 'KelasController@show']);
$router->get('/kelas/{id}', ['uses' => 'KelasController@showByRombel']);
$router->post('/kelas', ['uses' => 'KelasController@store']);
$router->patch('/kelas/{id}', ['uses' => 'KelasController@update']);
$router->delete('/kelas/{id}', ['uses' => 'KelasController@delete']);

//Sekolah
$router->get('/sekolah', ['uses' => 'SekolahController@show']);
$router->get('/sekolah/{id}', ['uses' => 'SekolahController@showByRombel']);
$router->post('/sekolah', ['uses' => 'SekolahController@store']);
$router->patch('/sekolah/{id}', ['uses' => 'SekolahController@update']);
$router->delete('/sekolah/{id}', ['uses' => 'SekolahController@delete']);