<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit79e0237148fd9a4825bfe7411fed046e
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPFluent\\' => 9,
        ),
        'F' => 
        array (
            'FluentCrud\\Framework\\' => 21,
            'FluentCrud\\App\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPFluent\\' => 
        array (
            0 => __DIR__ . '/..' . '/wpfluent/framework/src/WPFluent',
        ),
        'FluentCrud\\Framework\\' => 
        array (
            0 => __DIR__ . '/..' . '/wpfluent/framework/src/WPFluent',
        ),
        'FluentCrud\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'FluentCrud\\Database\\DBMigrator' => __DIR__ . '/../..' . '/database/DBMigrator.php',
        'FluentCrud\\Database\\DBSeeder' => __DIR__ . '/../..' . '/database/DBSeeder.php',
        'FluentCrud\\Database\\Migrations\\AuthorMigrator' => __DIR__ . '/../..' . '/database/Migrations/AuthorMigrator.php',
        'FluentCrud\\Database\\Migrations\\BookMigrator' => __DIR__ . '/../..' . '/database/Migrations/BookMigrator.php',
        'FluentCrud\\Database\\Migrations\\ExampleMigrator' => __DIR__ . '/../..' . '/database/Migrations/ExampleMigrator.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit79e0237148fd9a4825bfe7411fed046e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit79e0237148fd9a4825bfe7411fed046e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit79e0237148fd9a4825bfe7411fed046e::$classMap;

        }, null, ClassLoader::class);
    }
}
