<?php

/**
 * @Project NUKEVIET 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com) 
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS 
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(  
	'name' => 'Photos', 
	'modfuncs' => 'main, detail_album, detail, viewcat', 
	'submenu' => 'main, detail_album, detail, viewcat', 
	'is_sysmod' => 0, 
	'virtual' => 1,  
	'version' => '1.2.03',  
	'date' => 'Fri, 18 Sep 2015 11:52:59 GMT',  
	'author' => 'KENNYNGUYEN (nguyentiendat713@gmail.com)',  
	'uploads_dir' => array(
		$module_upload,
		$module_upload.'/images',
		$module_upload.'/thumbs',
		$module_upload.'/temp'
	),  
	'note' => '' 
);