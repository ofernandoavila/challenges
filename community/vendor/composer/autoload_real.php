<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit78ebf90aef2289a1e5614378b93807ef
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit78ebf90aef2289a1e5614378b93807ef', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit78ebf90aef2289a1e5614378b93807ef', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit78ebf90aef2289a1e5614378b93807ef::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
