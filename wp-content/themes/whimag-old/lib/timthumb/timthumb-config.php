<?php
if( is_file( '../../../../../wp-config.php' ) ) {
require_once('../../../../../wp-config.php');
} else {
require_once('../../../../wp-config.php');
}
define ('ALLOW_EXTERNAL', FALSE);
$tim_uploads = wp_upload_dir();
$tim_upload_path = $tim_uploads['basedir'] . '/cache/';
$tim_upload_path_check = $tim_uploads['basedir'] . '/cache';
//Create the upload directory with the right permissions if it doesn't exist
if( !is_dir( $tim_upload_path_check ) ){
mkdir($tim_upload_path_check, 0777);
chmod($tim_upload_path_check, 0777);
}
define ( 'FILE_CACHE_DIRECTORY', $tim_upload_path_check );
?>
