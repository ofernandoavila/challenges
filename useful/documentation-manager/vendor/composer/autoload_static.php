<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite598cf20dcf0e36afd89061d6ac8b849
{
    public static $prefixLengthsPsr4 = array (
        'o' => 
        array (
            'ofernandoavila\\challenges\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ofernandoavila\\challenges\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite598cf20dcf0e36afd89061d6ac8b849::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite598cf20dcf0e36afd89061d6ac8b849::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite598cf20dcf0e36afd89061d6ac8b849::$classMap;

        }, null, ClassLoader::class);
    }
}
