<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit40eff873f3edcd2d2d53e97af9079162
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rapidapi\\FootballApi\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rapidapi\\FootballApi\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit40eff873f3edcd2d2d53e97af9079162::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit40eff873f3edcd2d2d53e97af9079162::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit40eff873f3edcd2d2d53e97af9079162::$classMap;

        }, null, ClassLoader::class);
    }
}
