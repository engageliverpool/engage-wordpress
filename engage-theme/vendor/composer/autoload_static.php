<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce745f9191841a11655279b970ef9716
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce745f9191841a11655279b970ef9716::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce745f9191841a11655279b970ef9716::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
