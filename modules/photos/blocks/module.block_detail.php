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

if( ! nv_function_exists( 'block_photo_detail' ) )
{
 
	function block_photo_detail( $block_config )
	{
		global $data_album, $module_photo_cat, $lang_module, $op, $client_info, $site_mods, $module_info, $db, $module_config, $global_config, $my_head;

		if(  $op == 'detail_album' )
		{
			$module = $block_config['module'];
			$mod_data = $site_mods[$module]['module_data'];
			$mod_file = $site_mods[$module]['module_file'];
			
			if( file_exists( NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/'. $mod_file .'/module.block_detail.tpl' ) )
			{
				$block_theme = $module_info['template'];
			}
			else
			{
				$block_theme = 'default';
			}
			$xtpl = new XTemplate( 'module.block_detail.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/'. $mod_file .'/' );
			$xtpl->assign( 'LANG', $lang_module );
			$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
			$xtpl->assign( 'TEMPLATE', $module_info['template'] );
			$xtpl->assign( 'MODULE_FILE', $mod_file );
			$xtpl->assign( 'SELFURL', $client_info['selfurl'] );
			
			$data_album['image'] = NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/images/' . $data_album['file'];
			$data_album['thumb'] = NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/thumbs/' . $data_album['thumb'];
			
			$ratingwidth = ( $data_album['total_rating'] > 0 ) ? ( $data_album['total_rating'] * 100 / ( $data_album['click_rating'] * 5 ) ) * 0.01 : 0;
			
			$data_album['langstar'] = array(
			'note' => $lang_module['star_note'],
			'verypoor' => $lang_module['star_verypoor'],
			'poor' => $lang_module['star_poor'],
			'ok' => $lang_module['star_ok'],
			'good' => $lang_module['star_good}'],
			'verygood' => $lang_module['star_verygood']
			);

		 
			$xtpl->assign( 'RATINGVALUE', ( $data_album['total_rating'] > 0 ) ? round( $data_album['total_rating']/$data_album['click_rating'], 1) : 0 );
			$xtpl->assign( 'RATINGCOUNT', $data_album['click_rating'] );
			$xtpl->assign( 'REVIEWCOUNT', $data_album['total_rating'] );
			$xtpl->assign( 'RATINGWIDTH', round( $ratingwidth, 2) );
			$xtpl->assign( 'ALBUM_ID', $data_album['album_id']);
			$xtpl->assign( 'LANGSTAR', $data_album['langstar']);

			$checkss = md5( $data_album['album_id'] . session_id() . $global_config['sitekey'] );
			$xtpl->assign( 'CHECKSS', $checkss);
			$xtpl->assign( 'LINK_RATE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module . '&' . NV_OP_VARIABLE . '=rating&album_id=' . $data_album['album_id'] );
			
			$data_album['capturedate'] = nv_date('d-m-Y', $data_album['capturedate']);
			$xtpl->assign( 'DATA', $data_album );

			$xtpl->parse( 'main' );
			return $xtpl->text( 'main' );
		}
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $global_photo_cat, $module_photo_cat;
	$module = $block_config['module'];
	if( isset( $site_mods[$module] ) )
	{
 
		if( $module == $module_name )
		{
			$module_photo_cat = $global_photo_cat;
			unset( $module_photo_cat[0] );
		}
		else
		{
			$module_photo_cat = array();
			$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_category ORDER BY sort_order ASC';
			$list = nv_db_cache( $sql, 'category_id', $module  );
			foreach( $list as $l )
			{
				$module_photo_cat[$l['category_id']] = $l;
				$module_photo_cat[$l['category_id']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
				
			}
		}
		$content = block_photo_detail( $block_config  );
	}
}