<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit621a31e96db7ad301e7f1ef2b4b52990
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
            'MVC\\' => 4,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'MVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit621a31e96db7ad301e7f1ef2b4b52990::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit621a31e96db7ad301e7f1ef2b4b52990::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit621a31e96db7ad301e7f1ef2b4b52990::$classMap;

        }, null, ClassLoader::class);
    }
}