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
if( nv_user_in_groups( $global_photo_cat[$category_id]['groups_view'] ) )
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
	
	// rewrite link
	$base_url_rewrite = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_photo_cat[$category_id]['alias'] . '/' . $global_photo_album[$row['album_id']]['alias'] . '-' . $row['album_id'] .'/'.$row['row_id']. $global_config['rewrite_exturl'], true );
	if( $_SERVER['REQUEST_URI'] != $base_url_rewrite )
	{
		Header( 'Location: ' . $base_url_rewrite );
		die();
	}
	// truyen thong tin seo
	$page_title = $global_photo_album[$row['album_id']]['meta_title'];
	$key_words = $global_photo_album[$row['album_id']]['meta_keyword'];
	$description = $global_photo_album[$row['album_id']]['meta_description'];
	
	// goi ham xu ly giao dien 
	$contents = detail( $row );
}
else
{
	$contents = no_permission( $global_photo_cat[$category_id]['groups_view'] );
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
