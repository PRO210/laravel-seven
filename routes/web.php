<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function() {

            //Planos        //Planos        //Planos
            Route::put('/plans/{url}/', 'PlanController@update')->name('plans.update');
            Route::any('/plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
            Route::any('/search', 'PlanController@search')->name('plans.search');
            Route::get('/plans', 'PlanController@index')->name('plans.index');
            Route::post('/plans', 'PlanController@store')->name('plans.store');
            Route::get('/plans/create/', 'PlanController@create')->name('plans.create');
            Route::get('/plans/{url}', 'PlanController@show')->name('plans.show');
            Route::delete('/plans/{url}', 'PlanController@delete')->name('plans.delete');
            //
            //Routes Details Plan       //Routes Details Plan       //Routes Details Plan
            Route::delete('/plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
            Route::put('/plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
            Route::get('/plans/{url}/details/{idPlan}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
            Route::get('/plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');
            Route::post('/plans/{url}/details/', 'DetailPlanController@store')->name('details.plan.store');
            Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
            Route::get('/plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
            //
            // Router Profiles      // Router Profiles      // Router Profiles
            Route::any('/profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
            Route::resource('/profiles', 'ACL\ProfileController');
            //
            // Router Permission      // Router Permissions      // Router Permission
            Route::any('/permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
            Route::resource('/permissions', 'ACL\PermissionController');
            //
            /**
             * Permission x Profile
             */
            Route::get('/profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permission.detach');
            Route::post('/profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
            Route::any('/profile/{idProfile}/permissions/create', 'ACL\PermissionProfileController@profilePermissionsAvailable')->name('profiles.permissions.available');
            Route::get('/profile/{idProfile}/permissions/', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
            //
            //
            Route::get('/', 'PlanController@index')->name('admin.index');
        });

Route::get('/', function () {
    return view('welcome');
});

//
//Auth Routes
Auth::routes();
//

//Route::get('/home', 'HomeController@index')->name('home');
