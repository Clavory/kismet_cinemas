<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf54fce5354343b9454a3d9073e898ea7
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ryzen\\KismetCinemaOopMaster\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ryzen\\KismetCinemaOopMaster\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Mustache' => 
            array (
                0 => __DIR__ . '/..' . '/mustache/mustache/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf54fce5354343b9454a3d9073e898ea7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf54fce5354343b9454a3d9073e898ea7::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf54fce5354343b9454a3d9073e898ea7::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf54fce5354343b9454a3d9073e898ea7::$classMap;

        }, null, ClassLoader::class);
    }
}
