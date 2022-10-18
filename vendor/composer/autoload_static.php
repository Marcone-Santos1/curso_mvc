<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit582a20ecd453e7648e36449d80b60350
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
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit582a20ecd453e7648e36449d80b60350::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit582a20ecd453e7648e36449d80b60350::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit582a20ecd453e7648e36449d80b60350::$classMap;

        }, null, ClassLoader::class);
    }
}