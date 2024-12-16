<?php
return array(
    '/'                 => "HomeController@index",
    "/demo"             => "DemoController@demo",
    '/dbconnect'        => 'DemoController@dbconnect',
    '/debug'            => 'HomeController@debug',
    '/error'            => 'DemoController@error',
    '/requestdata'      => 'DemoController@requestdata',
    '/gerichte'         => 'HomeController@index',

    // Beispielrouten
    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4'                   => 'ExampleController@m4_6a_queryparameter',
    '/m4_7a_queryparameter' => 'ExampleController@m4_7a_queryparameter',
    '/m4_7b_kategorie'      => 'ExampleController@m4_7b_kategorie',
    '/m4_7c_gerichte'       => 'ExampleController@m4_7c_gerichte',
    '/m4_7d_layout'         => 'ExampleController@m4_7d_layout',

    // Admin-Routen
    '/admin/login'          => 'AdminController@showLogin',
    '/admin/auth'           => 'AdminController@login',
    '/admin/logout'         => 'AdminController@logout',
    '/admin/dashboard'      => 'AdminController@dashboard',
    '/anmeldung_verifizieren' => 'AdminController@verifyLogin',




);
