<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd132624d3fba137079ffe70e8fc4e0e6
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\CaBundle\\' => 18,
        ),
        'A' => 
        array (
            'Abraham\\TwitterOAuth\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\CaBundle\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/ca-bundle/src',
        ),
        'Abraham\\TwitterOAuth\\' => 
        array (
            0 => __DIR__ . '/..' . '/abraham/twitteroauth/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd132624d3fba137079ffe70e8fc4e0e6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd132624d3fba137079ffe70e8fc4e0e6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd132624d3fba137079ffe70e8fc4e0e6::$classMap;

        }, null, ClassLoader::class);
    }
}