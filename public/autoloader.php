<?php

namespace Autoloader;

$directoryRoot = dirname( dirname( __FILE__ ) ) . \DIRECTORY_SEPARATOR;

/** Doctrine Autoloader **/
use \Doctrine\Common\ClassLoader;
require_once $directoryRoot . '/lib/Doctrine/Common/ClassLoader.php';
spl_autoload_register( array( new ClassLoader( 'Kava', $directoryRoot . 'lib' ), 'loadClass' ) );
spl_autoload_register( array( new ClassLoader( 'Doctrine', $directoryRoot . 'lib' ), 'loadClass' ) );

unset( $directoryRoot );