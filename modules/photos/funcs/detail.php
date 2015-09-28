<?php

/**
 * @Project NUKEVIET 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com) 
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS 
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Wed, 21 Jan 2015 14:00:59 GMT
 */

if( ! defined( 'NV_IS_MOD_PHOTO' ) ) die( 'Stop!!!' );

$contents = '';
$date_added = 0;
// kiem tra tu cach xem album
if( nv_user_in_groups( $global_photo_cat[$category_id]['groups_view'] ) && nv_user_in_groups( $global_photo_album[$album_id]['groups_view'] ) )
{	
	// anh trong album
	$db->sqlreset()
		->select( '*' )
		->from( TABLE_PHOTO_NAME . '_rows' )
		->where( 'status=1 AND row_id=' . $row_id )
		->order( 'date_added ASC' );

	$photo = $db->query( $db->sql() );
	$row = $photo->fetch();

 	if( $row['row_id'] > 0 )
	{
		if( defined( 'NV_IS_MODADMIN' ) or ( $row['status'] == 1 ) )
		{
			// cap nhat luot xem
			$time_set = $nv_Request->get_int( $module_data . '_' . $op . '_' . $row['row_id'], 'session' );
			if( empty( $time_set ) )
			{
				$nv_Request->set_Session( $module_data . '_' . $op . '_' . $row['row_id'], NV_CURRENTTIME );
				$db->query( 'UPDATE ' . TABLE_PHOTO_NAME . '_rows SET viewed=viewed+1 WHERE row_id=' . $row['row_id'] );
			}
		}
	}
	
	$album_id = $row['album_id'];
	
	$next_photo = $previous_photo = '';
	//Next Photo
	$sql = 'SELECT row_id, album_id, name, status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE row_id > '.$row['row_id'].' AND album_id='.$row['album_id'].' ORDER BY row_id ASC LIMIT 1';
	$list = nv_db_cache( $sql, 'row_id', $module_name );
	foreach( $list as $next )
	{
		$next_photo['link'] = $global_photo_album[$next['album_id']]['link'] . '/' . $next['row_id'] . $global_config['rewrite_exturl'];
	}
	unset($sql,$list);
	
	//Previous Photo
	$sql = 'SELECT row_id, album_id, name, status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE row_id < '.$row['row_id'].' AND album_id='.$row['album_id'].' ORDER BY row_id DESC LIMIT 1';
	$list = nv_db_cache( $sql, 'row_id', $module_name );
	foreach( $list as $previous )
	{
		$previous_photo['link'] = $global_photo_album[$previous['album_id']]['link'] . '/' . $previous['row_id'] . $global_config['rewrite_exturl'];
	}
	unset($sql,$list);
	
	// rewrite link
	$base_url_rewrite = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_photo_cat[$category_id]['alias'] . '/' . $global_photo_album[$row['album_id']]['alias'] . '-' . $row['album_id'] .'/'.$row['row_id']. $global_config['rewrite_exturl'], true );
	if( $_SERVER['REQUEST_URI'] != $base_url_rewrite )
	{
		Header( 'Location: ' . $base_url_rewrite );
		die();
	}
	// truyen bien ra module block
	global $data_detail;
	$data_detail = $row;

	// truyen thong tin seo
	$page_title = !empty($global_photo_album[$row['album_id']]['meta_title'])?$global_photo_album[$row['album_id']]['meta_title']:$global_photo_album[$row['album_id']]['name'];
	$key_words = !empty($global_photo_album[$row['album_id']]['meta_keyword'])?$global_photo_album[$row['album_id']]['meta_keyword']:$global_photo_album[$row['album_id']]['name'];
	$description = !empty($global_photo_album[$row['album_id']]['meta_description'])?$global_photo_album[$row['album_id']]['meta_description']:strip_tags($global_photo_album[$row['album_id']]['description']);
	
	// goi ham xu ly giao dien 
	$contents = detail( $row, $next_photo, $previous_photo );
}
else
{
	$contents = no_permission($lang_module['no_permission_detailed']);
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
