<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$cardUpd = array(
					'name'			=> $_POST['name'],
					'alias'			=> $_POST['alias'],
					'group_id'		=> $_POST['group_id'],
					'block'			=> $_POST['block'][0],
					'show_site'		=> $_POST['show_site'][0],
					//'show_admin'	=> $_POST['show_admin'][0],
					//'is_dinamic'	=> $_POST['is_dinamic'][0],
					//'default'		=> $_POST['default'],
					'measure'		=> $_POST['measure'],
					'title'			=> $_POST['title'],
					
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);

$may_do_it = true;

//$is_dinamic = $cardUpd['is_dinamic'];
$group_id = $cardUpd['group_id'];

/*
if($is_dinamic)
{
	$query = "SELECT id FROM [pre]shop_chars WHERE `group_id`=$group_id AND `is_dinamic`=1 AND `id`!=$item_id LIMIT 1";
	$dinamic_isset = $ah->rs($query);

	if($dinamic_isset) $may_do_it = false;
}
*/

if($may_do_it) {

	// Update main table
	
	$query = "UPDATE [pre]$appTable SET ";
	
	$cntUpd = 0;
	foreach($cardUpd as $field => $itemUpd)
	{
		$cntUpd++;
		$query .= ($cntUpd==1 ? "`$field`='$itemUpd'" : ", `$field`='$itemUpd'");
	}
	
	$query .= " WHERE `id`=$item_id LIMIT 1";
		
	$data['query'] = $query;
		
	$ah->rs($query);
	
	
	$data['status'] = "success";
	$data['message'] = "Параметр успешно сохранен";

}else{
	$data['status'] = "failed";
	$data['message'] = "Ошибка при сохранении!";
}
