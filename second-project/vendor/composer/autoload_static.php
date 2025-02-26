<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd751713988987e9331980363e24189ce
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Classes\\AuthController' => __DIR__ . '/../..' . '/src/classes/auth/auth.controller.php',
        'App\\Classes\\HomeController' => __DIR__ . '/../..' . '/src/classes/home/home.controller.php',
        'App\\Classes\\PDO' => __DIR__ . '/../..' . '/src/classes/PDO/pdo.php',
        'App\\Classes\\PostsController' => __DIR__ . '/../..' . '/src/classes/posts/posts.controller.php',
        'App\\Controller' => __DIR__ . '/../..' . '/src/controller.php',
        'App\\Router' => __DIR__ . '/../..' . '/src/router.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd751713988987e9331980363e24189ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd751713988987e9331980363e24189ce::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd751713988987e9331980363e24189ce::$classMap;

        }, null, ClassLoader::class);
    }
}
