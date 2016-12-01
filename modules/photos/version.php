<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com) 
 * @Copyright (C) 2016 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS 
 * @License GNU/GPL version 2 or any later version
 * @Createdate Mon, 01 Dec 2016 09:00:00 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(  
	'name' => 'Photos',
	'modfuncs' => 'main, viewcat, detail_album, detail, detail_viewer, search', 
	'submenu' => 'rss,search',
	'is_sysmod' => 0, 
	'virtual' => 1,
	'version' => '1.4.01',
	'date' => 'Mon, 01 Dec 2016 09:00:00 GMT',
	'author' => 'KENNY NGUYEN (nguyentiendat713@gmail.com)',
	'uploads_dir' => array(
		$module_upload,
		$module_upload.'/images',
		$module_upload.'/thumbs',
		$module_upload.'/temp'
	),  
	'note' => ''
);