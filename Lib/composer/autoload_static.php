<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit985a3f5fd0709ff16292ebdcc2746469
{
    public static $files = array (
        'c65d09b6820da036953a371c8c73a9b1' => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook/polyfills.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook_Group_Ads\\' => 19,
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook_Group_Ads\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit985a3f5fd0709ff16292ebdcc2746469::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit985a3f5fd0709ff16292ebdcc2746469::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
