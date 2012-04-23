<?php

namespace Autoloader;

$directoryRoot = dirname( dirname( __FILE__ ) ) . \DIRECTORY_SEPARATOR;

/**
 * Symfony Autoloader
 * 
 * An excellent general purpose autoloader.
 */
use \Symfony\Component\ClassLoader\UniversalClassLoader;
require_once $directoryRoot . '/lib/ClassLoader/UniversalClassLoader.php';

$classLoader = new UniversalClassLoader;
$classLoader->registerNamespace( 'Kava', $directoryRoot . 'lib' );
$classLoader->register();