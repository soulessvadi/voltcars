<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);
	
	$cardUpd = array(
					'name'			=> str_replace("'","\'",$_POST['name']),
					'alias'			=> $_POST['alias'],
					'order_id'		=> $_POST['order_id'],
					'block'			=> $_POST['block'][0],
					'specs_group_id'=> $_POST['charsGroup'],

					/*'index'			=> $_POST['index'][0],
					'parent'		=> $_POST['parent'],
					'details'		=> str_replace("'","\'",$_POST['details']),
					'meta_title'	=> $_POST['meta_title'],
					'meta_keys'		=> $_POST['meta_keys'],
					'meta_desc'		=> $_POST['meta_desc'],
					'startPublish'	=> date("Y-m-d H:i:s", strtotime($_POST['startPublish'])),
					'finishPublish'	=> date("Y-m-d H:i:s", strtotime($_POST['finishPublish'])),
					
					'adminMod'=>ADMIN_ID,*/
					
					'dateCreate'	=> date("Y-m-d H:i:s", time()),
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);

$query = "SELECT id FROM [pre]shop_catalog WHERE `alias`='".$cardUpd['alias']."' LIMIT 1";
$test_alias = $ah->rs($query);					

if(strlen($cardUpd['name'])>1)
{
	if(!$test_alias)
	{


	// Create main table item
	
	$query = "INSERT INTO [pre]$appTable ";
	
	$fieldsStr = " ( ";
	
	$valuesStr = " ( ";
	
	$cntUpd = 0;
	foreach($cardUpd as $field => $itemUpd)
	{
		$cntUpd++;
		
		$fieldsStr .= ($cntUpd==1 ? "`$field`" : ", `$field`");
		
		$valuesStr .= ($cntUpd==1 ? "'$itemUpd'" : ", '$itemUpd'");
	}
	
	$fieldsStr .= " ) ";
	
	$valuesStr .= " ) ";
	
	$query .= $fieldsStr." VALUES ".$valuesStr;
		
	$data['block'] = $cardUpd['block'];
	
	$data['query'] = $query;
		
	$ah->rs($query);
	
	$item_id = mysql_insert_id();
	
if($item_id)
{
	$data['item_id'] = $item_id;
					
	// File upload 
	
	$filename = "filename";
	
	if(isset($_FILES[$filename]) && $_FILES[$filename]['size'] > 0)
	{
		$file_path = "../../../../split/files/shop/categories/";
		
		$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>5,
				'pre'			=>"cat_",
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$filename
			  ));
		if($file_update)
		{
			$cardUpd[$filename] = $file_update;
			
			$query = "UPDATE [pre]$appTable SET `$filename`='$file_update' WHERE `id`='$item_id' LIMIT 1";
			$ah->rs($query);
		}
	}
	
	// Update chars group
	
	if(isset($_POST['charsGroup']))
	{
		$charsGroup = $_POST['charsGroup'];
		
		$query = "SELECT `id`,`group_id` FROM [pre]shop_cat_chars_group_ref WHERE `cat_id`=$item_id LIMIT 1";
		$result = $ah->rs($query);
		
		if($charsGroup==0)
		{
			$query = "DELETE FROM [pre]shop_cat_chars_group_ref WHERE `cat_id`=$item_id";
			$ah->rs($query);
		
		}elseif($result)
		{
			if($result[0]['group_id'] != $charsGroup)
			{
				$query = "UPDATE [pre]shop_cat_chars_group_ref SET `group_id`=$charsGroup WHERE `id`='".$result[0]['id']."' LIMIT 1";
				$ah->rs($query);
			}
		}else
		{
			$query = "INSERT INTO [pre]shop_cat_chars_group_ref (`cat_id`,`group_id`) VALUES ('$item_id','$charsGroup')";
			$ah->rs($query);
		}
	}
	
	$data['status'] = "success";
	$data['message'] = "Новая категория успешно создана. ID = $item_id";	
	
}else{
	
	$data['status'] = "failed";
	$data['message'] = "Basic create: ID not found";
	
	}
	
	}else{
		$data['status'] = "failed";
		$data['message'] = "Категория с таким Алиасом уже существует.";
		}
}
else{
	$data['status'] = "failed";
	$data['message'] = "Укажите название категории.";
	}
	