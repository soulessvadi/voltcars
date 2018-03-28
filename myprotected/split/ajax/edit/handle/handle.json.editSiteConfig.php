<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$cardUpd = array(
					'sitename'		=> $_POST['sitename'],
					'support_email'	=> $_POST['support_email'],
					'orders_email'	=> $_POST['orders_email'],
					'feedback_email'	=> $_POST['feedback_email'],

					'header_phone'	=> $_POST['header_phone'],

					'phone_number'	=> $_POST['phone_number'],
					'phone_number2'	=> $_POST['phone_number2'],
					'phone_number3'	=> $_POST['phone_number3'],

					'fb_link'		=> $_POST['fb_link'],
					'vk_link'		=> $_POST['vk_link'],
					'gp_link'		=> $_POST['gp_link'],
					'yt_link'		=> $_POST['yt_link'],

					'address'		=> $_POST['address'],


					'index'			=> $_POST['index'][0],
					'meta_title'	=> $_POST['meta_title'],
					'meta_keys'		=> $_POST['meta_keys'],
					'meta_desc'		=> $_POST['meta_desc'],
					
					'intro_head'		=> $_POST['intro_head'],
					
					'intro_foot'		=> $_POST['intro_foot'],
					
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);
					
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
	
	
	
	$data['message'] = "Настройки успешно вступили в силу";
	