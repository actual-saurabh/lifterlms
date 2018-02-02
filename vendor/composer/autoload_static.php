<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit14cf215234f23b6555203d42943224f6
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LLMS\\' => 5,
        ),
        'H' => 
        array (
            'Hashids\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LLMS\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Hashids\\' => 
        array (
            0 => __DIR__ . '/..' . '/hashids/hashids/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit14cf215234f23b6555203d42943224f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit14cf215234f23b6555203d42943224f6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}