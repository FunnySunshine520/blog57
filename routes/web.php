<?php

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
    return view('welcome');
});

Route::get('test', 'test@index');


$permissions = config('permissions');

foreach ($permissions as $key => $module) {
    foreach ($module as $group) {
        Route::group([
            'middleware' =>isset($group['middleware'])?$group['middleware']:null,
            'prefix'     =>isset($group['prefix'])&&$group['prefix']?$group['prefix']:'api',
            'namespace'  =>isset($group['namespace'])?$group['namespace']:null
        ],function($router)use($group){

            foreach($group['routes'] as $k=>$node){
                if(isset($node['type']) && !in_array($node['type'],['menu','page'])){
                    continue;
                }
                $method = $node['method']?:'any';
                $router->{$method}($node['uri'],['uses'=>$node['uses'],'as'=>$k]);
            }
        });
    }
}
