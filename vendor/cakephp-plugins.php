<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'AdminLTE' => $baseDir . '/vendor/maiconpinto/cakephp-adminlte-theme/',
        'AdminTheme' => $baseDir . '/vendor/falco442/cake-3-admin-theme/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Josegonzalez/Upload' => $baseDir . '/vendor/josegonzalez/cakephp-upload/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Proffer' => $baseDir . '/vendor/davidyell/proffer/',
        'WyriHaximus/TwigView' => $baseDir . '/vendor/wyrihaximus/twig-view/'
    ]
];