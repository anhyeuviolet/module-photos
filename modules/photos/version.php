<?php

/**
 * @Project NUKEVIET 4.x
 * @Author KENNYNGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2013 tradacongnghe.com. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Wed, 21 Jan 2015 14:00:59 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(  
	'name' => 'Photos', 
	'modfuncs' => 'main, detail_album, detail, viewcat', 
	'submenu' => 'main, detail_album, detail, viewcat', 
	'is_sysmod' => 0, 
	'virtual' => 1,  
	'version' => '1.1.01',  
	'date' => 'Wed, 16 Sep 2015 14:00:59 GMT',  
	'author' => 'KENNYNGUYEN (nguyentiendat713@gmail.com)',  
	'uploads_dir' => array(
		$module_upload,
		$module_upload.'/images',
		$module_upload.'/thumbs',
		$module_upload.'/temp'
	),  
	'note' => '' 
);