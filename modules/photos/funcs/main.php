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

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
$base_url_rewrite = nv_url_rewrite( $base_url, true );
$page_url_rewrite = $page ? nv_url_rewrite( $base_url . '/page-' . $page, true ) : $base_url_rewrite;
$request_uri = $_SERVER['REQUEST_URI'];
if( ! ( $home OR $request_uri == $base_url_rewrite OR $request_uri == $page_url_rewrite OR NV_MAIN_DOMAIN . $request_uri == $base_url_rewrite OR NV_MAIN_DOMAIN . $request_uri == $page_url_rewrite ) )
{
	$redirect = '<meta http-equiv="Refresh" content="3;URL=' . $base_url_rewrite . '" />';
	nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] . $redirect );
}

 
if( $photo_config['home_view'] == 'home_view_grid_by_cat' )
{
	$array_cate = array();
	if( ! empty( $global_photo_cat ) )
	{ 

		foreach( $global_photo_cat as $_category_id => $category  )
		{
			if( $category['parent_id'] == 0 and $category['inhome'] != 0 )
			{
				$array_cat = array();
				$array_cat = GetCatidInParent( $_category_id, true );

				// Fetch Limit
				$db->sqlreset()
				->select( 'COUNT(*)' )
				->from( TABLE_PHOTO_NAME . '_album' )
				->where( 'category_id IN (' . implode( ',', $array_cat ) . ') AND status =1' );
				
				$num_count = $db->query( $db->sql() )->fetchColumn();

				$db->sqlreset()
					->select( 'a.album_id, a.category_id, a.name, a.alias, a.capturelocal, a.description, a.num_photo, a.date_added, a.viewed, r.file, r.thumb' )
					->from( TABLE_PHOTO_NAME . '_album a' )
					->join('LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )')
					->where( ' a.status =1 AND r.defaults = 1 AND a.category_id IN (' . implode( ',', $array_cat ).' )')
					->order( 'a.album_id DESC' )
					->limit( $category['numlinks'] );
				$result = $db->query( $db->sql() );
				
				$array_content = array();
				while( list( $album_id, $category_id, $name, $alias, $capturelocal, $description, $num_photo, $date_added, $viewed, $file, $thumb ) = $result->fetch( 3 ) )
				{
					$array_content[] = array(
						'album_id' => $album_id,
						'category_id' => $category_id,
						'name' => $name,
						'alias' => $alias,
						'capturelocal' => $capturelocal,
						'description' => $description,
						'num_photo' => $num_photo,
						'date_added' => $date_added,
						'viewed' => $viewed,
						'file' => $file,
						'thumb' => $thumb,
						'link' => $global_photo_cat[$category_id]['link'] . '/' . $alias . '-' . $album_id . $global_config['rewrite_exturl'],
					);
				}

				$array_cate[] = array(
					'catid' => $category['category_id'],
					'subcatid' => $category['subcatid'],
					'name' => $category['name'],
					'link' => $global_photo_cat[$category['category_id']]['link'],
					'data' => $array_content,
					'num_count' => $num_count,
					'numlink' => $category['numlinks'],
					'num_album' => $category['num_album']
				);
			}
		}
	}
 
	$contents = home_view_grid_by_cat( $array_cate );
}
elseif( $photo_config['home_view'] == 'home_view_grid_by_album' )
{
	$per_page = $photo_config['per_page_album'];
	$array_album = array();
	if( ! empty( $global_photo_cat ) )
	{ 
		$db->sqlreset()
			->select( 'COUNT(*)' )
			->from( TABLE_PHOTO_NAME . '_album a' )
			->join('LEFT JOIN  ' . TABLE_PHOTO_NAME . '_rows r ON ( a.album_id = r.album_id )')
			->where( 'a.status=1 AND r.defaults=1' );
		$num_items = $db->query( $db->sql() )->fetchColumn();
				
		$db->select( 'a.album_id, a.name, a.category_id, a.alias, a.capturelocal, a.description, a.num_photo, a.date_added, a.viewed, r.file, r.thumb' )
			->order( 'a.date_added DESC' )
			->limit( $per_page )
			->where('a.status= 1 AND r.defaults = 1')
			->offset( ( $page - 1 ) * $per_page );
			
		$result = $db->query( $db->sql( ) );
		
		while( $item = $result->fetch() )
		{
			$item['link'] = $global_photo_cat[$item['category_id']]['link'] . '/' . $item['alias'] . '-' . $item['album_id'] . $global_config['rewrite_exturl'];
			
			$array_album[] = $item;
		}
		$result->closeCursor();
	}

	$generate_page = nv_alias_page( $page_title, $base_url, $num_items, $per_page, $page );
	$contents = home_view_grid_by_album( $array_album, $generate_page);	
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
