<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$cardUpd = array(
					'caption'		=> $_POST['caption'],
					'description'	=> $_POST['description'],

					'text1'	=> $_POST['text1'],
					'text2'	=> $_POST['text2'],
					'text3'	=> $_POST['text3'],
					'text4'	=> $_POST['text4'],
					'text5'	=> $_POST['text5'],
					'text6'	=> $_POST['text6'],
					'text7'	=> $_POST['text7'],
					'text8'	=> $_POST['text8'],

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
	