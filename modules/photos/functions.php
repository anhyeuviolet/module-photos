<?php

/**
 * @Project NUKEVIET 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com) 
 * @Copyright (C) 2013 Webdep24.com. All rights reserved
 * @Based on NukeViet CMS * @License GNU/GPL version 2 or any later version
 * @Createdate  Wed, 21 Jan 2015 14:00:59 GMT
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_PHOTO', true );

define( 'TABLE_PHOTO_NAME', NV_PREFIXLANG . '_' . $module_data ); 

define( 'ACTION_METHOD', $nv_Request->get_string( 'action', 'get,post', '' ) ); 
 
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';  
 
$category_id = 0;
$parent_id = 0;
$alias_cat_url = isset( $array_op[0] ) ? $array_op[0] : '';
$array_mod_title = array();
 
foreach( $global_photo_cat as $_key => $l )
{
	if( $alias_cat_url == $l['alias'] )
	{
		$category_id = $l['category_id'];
		$parent_id = $l['parent_id'];
	}
}

//Xac dinh RSS
if( $module_info['rss'] )
{
	$rss[] = array(  
		'title' => $module_info['custom_title'],  
		'src' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=rss' //
	);
}

foreach( $global_photo_cat as $category_id_i => $array_cat_i )
{
	if( $category_id_i > 0 and $array_cat_i['parent_id'] == 0 )
	{
		$act = 0;
		$submenu = array();
		if( $category_id_i == $category_id or $category_id_i == $parent_id )
		{
			$act = 1;
			if( ! empty( $global_photo_cat[$category_id_i]['subcategory_id'] ) )
			{
				$array_category_id = explode( ',', $global_photo_cat[$category_id_i]['subcategory_id'] );
				foreach( $array_category_id as $sub_category_id_i )
				{
					$array_sub_cat_i = $global_photo_cat[$sub_category_id_i];
					$sub_act = 0;
					if( $sub_category_id_i == $category_id )
					{
						$sub_act = 1;
					}
					$submenu[] = array(
						$array_sub_cat_i['title'],
						$array_sub_cat_i['link'],
						$sub_act
					);
				}
			}
		}
		$nv_vertical_menu[] = array(
			$array_cat_i['name'],
			$array_cat_i['link'],
			$act,
			'submenu' => $submenu );
	}
	//Xac dinh RSS
	if( $category_id_i and $module_info['rss'] )
	{
		$rss[] = array(  
			'title' => $module_info['custom_title'] . ' - ' . $array_cat_i['name'],  
			'src' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=rss/' . $array_cat_i['alias'] //
		);
	}
}
unset( $result, $category_id_i, $parent_id_i, $title_i, $alias_i );
$module_info['submenu'] = 0;

$page = 1;
$count_op = sizeof( $array_op );

if( ! empty( $array_op ) and $op == 'main' )
{
	if( $category_id == 0 )
	{
		$contents = $lang_module['nocatpage'] . $array_op[0];
		if( isset( $array_op[0] ) and substr( $array_op[0], 0, 5 ) == 'page-' )
		{
			$page = intval( substr( $array_op[0], 5 ) );
		}
		elseif( ! empty( $alias_cat_url ) )
		{
			$redirect = '<meta http-equiv="Refresh" content="3;URL=' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name, true ) . '" />';
			nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] . $redirect );
		}
	}
	else
	{
		$op = 'main';
		if( $count_op == 1 or substr( $array_op[1], 0, 5 ) == 'page-' )
		{
			$op = 'viewcat';
			if( $count_op > 1 )
			{
				$page = intval( substr( $array_op[1], 5 ) );
			}
			$parent_id = $category_id;
			while( $parent_id > 0 )
			{
				$array_cat_i = $global_photo_cat[$parent_id];
				$array_mod_title[] = array(
					'category_id' => $parent_id,
					'title' => $array_cat_i['name'],
					'link' => $array_cat_i['link']
				);
				$parent_id = $array_cat_i['parent_id'];
			}
		}
		elseif( $count_op == 2 )
		{
			$array_page = explode( '-', $array_op[1] );
			$album_id = intval( end( $array_page ) );
			$number = strlen( $album_id ) + 1;
			$alias_url = substr( $array_op[1], 0, -$number );
			if( $album_id > 0 and $alias_url != '' )
			{
				$op = 'detail_album';
			}
			$array_mod_title[] = array(
				'category_id' => $album_id,
				'title' => $global_photo_album[$album_id]['name'],
				'link' => $global_photo_album[$album_id]['link']
			);
		}
		elseif( $count_op == 3 )
		{
			$array_alid = explode( '-', $array_op[1] );
			$album_id = intval( end( $array_alid ) );
			$array_page = explode( '-', $array_op[2] );
			$row_id = intval( end( $array_page ) );
			$number = strlen( $row_id ) + 1;
			if( $row_id > 0 )
			{
				$op = 'detail';
				$array_mod_title[] = array(
				'category_id' => $album_id,
				'title' => $global_photo_album[$album_id]['name'],
				'link' => $global_photo_album[$album_id]['link']
				);
			}
		}

		sort( $array_mod_title, SORT_NUMERIC );
	}
}

function gltJsonResponse( $error = array(), $data = array() )
{
	$contents = array(
		'jsonrpc' => '2.0',
		'error' => $error,
		'data' => $data,
	);
	
	header( 'Content-Type: application/json' ); 
	echo json_encode( $contents ); 
	die();
}
/**
* Back-end create thumbs
* Upload function
**/
function creatThumb( $file, $dir, $width, $height = 0 )
{

	$image = new image( $file, NV_MAX_WIDTH, NV_MAX_HEIGHT );

	if( empty( $height ) )
	{
		$image->resizeXY( $width, NV_MAX_HEIGHT );
	}
	else
	{
		if( ( $width * $image->fileinfo['height'] / $image->fileinfo['width'] ) > $height )
		{
			$image->resizeXY( $width, NV_MAX_HEIGHT );
		}
		else
		{
			$image->resizeXY( NV_MAX_WIDTH, $height );
		}

		$image->cropFromCenter( $width, $height );
	}

	// Kiem tra anh ton tai
	$fileName = $width . 'x' . $height . '-' . basename( $file );
	$fileName2 = $fileName;
	$i = 1;
	while( file_exists( $dir . '/' . $fileName2 ) )
	{
		$fileName2 = preg_replace( '/(.*)(\.[a-zA-Z0-9]+)$/', '\1-' . $i . '\2', $fileName );
		++$i;
	}
	$fileName = $fileName2;

	// Luu anh
	$image->save( $dir, $fileName );
	$image->close();

	return substr( $image->create_Image_info['src'], strlen( $dir . '/' ) );
}

/**
 * creat_thumbs()
 * front-end thumbs create
 *
 */
if( ! nv_function_exists( 'creat_thumbs' ) )
{
	function creat_thumbs( $id, $file, $module_upload, $width = 200, $height = 150, $quality = 90 )
	{
		if( $width >= $height ) $rate = $width / $height;
		else  $rate = $height / $width;

		$image = NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/images/' . $file;
 
		if( $file != '' and file_exists( $image ) )
		{
			$imgsource = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $file;
			$imginfo = nv_is_image( $image );

			$basename = $module_upload . '_' . $width . 'x' . $height . '-' . $id . '-' . md5_file( $image ) . '.' . $imginfo['ext'];

			if( file_exists( NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload. '/' . $basename ) )
			{
				$imgsource = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload. '/' . $basename;
			}
			else
			{

				$_image = new image( $image, NV_MAX_WIDTH, NV_MAX_HEIGHT );

				if( $imginfo['width'] <= $imginfo['height'] )
				{
					$_image->resizeXY( $width, 0 );

				}
				elseif( ( $imginfo['width'] / $imginfo['height'] ) < $rate )
				{
					$_image->resizeXY( $width, 0 );
				}
				elseif( ( $imginfo['width'] / $imginfo['height'] ) >= $rate )
				{
					$_image->resizeXY( 0, $height );
				}

				$_image->cropFromCenter( $width, $height );

				$_image->save( NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload, $basename, $quality );

				if( file_exists( NV_ROOTDIR . '/' . NV_FILES_DIR . '/' . $module_upload. '/' . $basename ) )
				{
					$imgsource = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload. '/' . $basename;
				}
			}
		}
		elseif( nv_is_url( $file ) )
		{
			$imgsource = $file;
		}
		else
		{
			$imgsource = '';
		}
		return $imgsource;
	}
}