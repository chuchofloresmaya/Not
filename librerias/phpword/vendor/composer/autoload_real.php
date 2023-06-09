<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit8b66bae0de6bbbd5fd8e13e591341f68
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit8b66bae0de6bbbd5fd8e13e591341f68', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit8b66bae0de6bbbd5fd8e13e591341f68', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInit8b66bae0de6bbbd5fd8e13e591341f68::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}
