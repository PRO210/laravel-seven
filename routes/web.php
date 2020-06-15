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
            //  Profiles      //  Profiles      //  Profiles
            Route::any('/profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
            Route::resource('/profiles', 'ACL\ProfileController');
            /**
             * Plan x Profile   * Plan x Profile    * Plan x Profile
             */
            Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');
            Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
            Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
            Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
            Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');
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
            //
            // Router Users      // Router Users      // Router Users
            Route::any('users/search', 'UserController@search')->name('users.search');
            Route::resource('users', 'UserController');
            //
            //Routes Roles
            //
            Route::any('roles/search', 'ACL\RoleController@search')->name('roles.search');
            Route::resource('roles', 'ACL\RoleController');
            //
            //Routes Tenants
            //
            Route::any('tenants/search', 'TenantController@search')->name('tenants.search');
            Route::resource('tenants', 'TenantController');
            //
            // Role x User
            Route::get('users/{id}/role/{idRole}/detach', 'ACL\RoleUserController@detachRoleUser')->name('users.role.detach');
            Route::post('users/{id}/roles', 'ACL\RoleUserController@attachRolesUser')->name('users.roles.attach');
            Route::any('users/{id}/roles/create', 'ACL\RoleUserController@rolesAvailable')->name('users.roles.available');
            Route::get('users/{id}/roles', 'ACL\RoleUserController@roles')->name('users.roles');
            Route::get('roles/{id}/users', 'ACL\RoleUserController@users')->name('roles.users');


        });

/**
 * Site
 */
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');
//
//
//Auth Routes       Auth Routes     Auth Routes
Auth::routes();
//
