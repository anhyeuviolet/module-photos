<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com) 
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS 
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */
  

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

global $global_photo_cat, $global_photo_album, $photo_config;

$photo_config = array();
$sql = 'SELECT *  FROM ' . NV_PREFIXLANG . '_' . $module_data . '_setting';
$list = nv_db_cache( $sql, 'setting', $module_name );
foreach( $list as $l )
{
	$photo_config[$l['config_name']] = $l['config_value'];
}
unset( $sql, $list );

$global_photo_cat = array();
$sql = 'SELECT * FROM ' . TABLE_PHOTO_NAME . '_category ORDER BY sort_order ASC';
$list = nv_db_cache( $sql, 'category_id', $module_name );
foreach( $list as $l )
{
	$global_photo_cat[$l['category_id']] = $l;
	$global_photo_cat[$l['category_id']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
	
}
unset( $sql, $list );

$global_photo_album = array();
$sql = 'SELECT * FROM ' . TABLE_PHOTO_NAME . '_album ORDER BY weight ASC';
$list = nv_db_cache( $sql, 'album_id', $module_name );
foreach( $list as $l )
{
	$global_photo_album[$l['album_id']] = $l;
	$global_photo_album[$l['album_id']]['link'] = $global_photo_cat[$l['category_id']]['link'] . '/' . $l['alias'] . '-' . $l['album_id'] . $global_config['rewrite_exturl'];
	
}
unset( $sql, $list );