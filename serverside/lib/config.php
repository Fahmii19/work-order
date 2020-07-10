<?php
/*ini_set( "display_errors", true );
define( "DB_DSN", "mysql:host=localhost;dbname=db_pegawai" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );
define('DB_CHARACSET', 'utf8');*/

ini_set( "display_errors", true );
define( "DB_DSN", "mysql:host=127.0.0.1;dbname=k0762615_pegawai_1" );
define( "DB_USERNAME", "k0762615_pegawai" );
define( "DB_PASSWORD", "PegawaiLrcom123!@#" );
define('DB_CHARACSET', 'utf8');

require_once ('database.php');
require_once ('dtable.php');

$db=new Database();
$datatable=New Dtable();

function handleException( $exception ) {
  echo  $exception->getMessage();
}

set_exception_handler( 'handleException' );
?>
