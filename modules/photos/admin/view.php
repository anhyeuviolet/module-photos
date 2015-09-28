<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$rowcontent['id'] = $nv_Request->get_int( 'id', 'get,post', 0 );
if( $rowcontent['id'] > 0 )
{
	$rowcontent = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows where id=' . $rowcontent['id'] )->fetch();
}
$check_permission = true;
if( $check_permission )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $global_array_cat[$rowcontent['catid']]['alias'] . '/' . $rowcontent['alias'] . '-' . $rowcontent['id'] . $global_config['rewrite_exturl'], true ) );
	die();
}
else
{
	nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['admin_no_allow_func'] );
}