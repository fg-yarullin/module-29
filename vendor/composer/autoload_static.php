<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite7877270b8a0286e7717da8143629e38
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Authentication' => __DIR__ . '/../..' . '/app/controllers/auth/authentication.php',
        'Controller' => __DIR__ . '/../..' . '/app/core/controller.php',
        'Controller_Login' => __DIR__ . '/../..' . '/app/controllers/controller_login.php',
        'Controller_Logout' => __DIR__ . '/../..' . '/app/controllers/controller_logout.php',
        'Controller_Main' => __DIR__ . '/../..' . '/app/controllers/controller_main.php',
        'Controller_Register' => __DIR__ . '/../..' . '/app/controllers/controller_register.php',
        'DatabaseTable' => __DIR__ . '/../..' . '/app/controllers/db/databaseTable.php',
        'Model' => __DIR__ . '/../..' . '/app/core/model.php',
        'Model_Login' => __DIR__ . '/../..' . '/app/models/model_login.php',
        'Model_Main' => __DIR__ . '/../..' . '/app/models/model_main.php',
        'Route' => __DIR__ . '/../..' . '/app/core/route.php',
        'View' => __DIR__ . '/../..' . '/app/core/view.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite7877270b8a0286e7717da8143629e38::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite7877270b8a0286e7717da8143629e38::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite7877270b8a0286e7717da8143629e38::$classMap;

        }, null, ClassLoader::class);
    }
}
