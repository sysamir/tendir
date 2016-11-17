<?php
Route::group([
    'domain' => env('ADMIN_SUB') . '.' . env('DOMAIN_NAME'),
], function ()
{

    Route::group([
        'namespace' => 'Admin',
    ], function ()
    {
        Route::group(['middleware' => 'auth:admin'], function ()
        {
            Route::get('/', [
                'as' => 'dashboard',
                'uses' => 'DashboardController@main'
            ]);

            /* Error log */
            Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('permission:bugs-read');

            Route::group(['middleware' => ['role:super_admin']], function ()
            {
                Route::resource('admins', 'AdminController');
                Route::resource('roles', 'RoleController');
            });

            /* Tenders */

            /* End Tenders */

            /* Users */
            Route::resource('users', 'UserController');
            /* End Users */

            /* Companies */
            Route::resource('companies', 'CompanyController');
            /* End Companies */


        });

        require 'auth.php';

    });

});