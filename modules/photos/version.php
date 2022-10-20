<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 17 April 2019 08:00:00 GMT
 * @ Thanks to Sebastian Tschan for BlueIMP gallery
 */

if( !defined( 'NV_MAINFILE' ) )
	die( 'Stop!!!' );

$module_version = array(
	'name' => 'Photos',
	'modfuncs' => 'main, viewcat, detail_album, detail, detail_viewer, search, upload',
	'submenu' => 'rss,search',
	'is_sysmod' => 0,
	'virtual' => 1,
	'version' => '1.4.05',
	'date' => 'Thu, 20 Oct 2022 08:00:00 GMT',
	'author' => 'KENNY NGUYEN (nguyentiendat713@gmail.com)',
	'uploads_dir' => array(
		$module_upload,
		$module_upload . '/images',
		$module_upload . '/thumbs',
		$module_upload . '/temp'
	),
	'note' => ''
);
