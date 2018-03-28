<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	$appTable = $_POST['appTable'];
	
	$item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : 0);
	
	$cardUpd = array(
					'name'			=> strip_tags(trim(str_replace("'","\'",$_POST['name']))),
					'alias'			=> $_POST['alias'],
					'cat_id'		=> $_POST['cat_id'],
					
					'pos_id'		=> $_POST['pos_id'],
					'block'			=> $_POST['block'][0],
					'target'		=> $_POST['target'][0],
					
					'content'		=> str_replace("'","\'",$_POST['content']),
					
					'gallery_id'	=> $_POST['gallery_id'],
					'script_name'	=> strip_tags(trim(str_replace("'","\'",$_POST['script_name']))),
					'is_video'		=> $_POST['is_video'][0],

					
					'text_pos'		=> $_POST['text_pos'],
					'gallery_pos'	=> $_POST['gallery_pos'],
					'script_pos'	=> $_POST['script_pos'],

					'meta_title'	=> $_POST['meta_title'],
					'meta_keys'		=> $_POST['meta_keys'],
					'meta_desc'		=> $_POST['meta_desc'],
					
					'dateCreate'	=> date("Y-m-d H:i:s", strtotime($_POST['dateCreate'])),
					'dateModify'	=> date("Y-m-d H:i:s", time())
					);
					
	// File upload 

	$filename = "filename";
	
	if(isset($_FILES[$filename]) && $_FILES[$filename]['size'] > 0)
	{
		$file_path = "../../../../split/files/images/";
		
		$file_update = $ah->mtvc_add_files_file(array(
				'path'			=>$file_path,
				'name'			=>5,
				'pre'			=>"artc_",
				'size'			=>10,
				'rule'			=>0,
				'max_w'			=>2500,
				'max_h'			=>2500,
				'files'			=>$filename,
				'resize_path'	=>$file_path."crop/",
				'resize_w'		=>330,
				'resize_h'		=>272,
				'resize_path_2'	=>"0",
				'resize_w_2'	=>0,
				'resize_h_2'	=>0
			  ));
		if($file_update)
		{
			$cardUpd[$filename] = $file_update;
		}
	}
	
	$query = "SELECT id FROM [pre]articles WHERE `alias`='".$cardUpd['alias']."' LIMIT 1";
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
					
				$ah->rs($query);
				
				$item_id = mysql_insert_id();
				
				if($item_id)
				{
					$data['item_id'] = $item_id;
					
					// Upload files
				
				$filename = "docs";
				
				if(isset($_FILES[$filename]) && count($_FILES[$filename]) > 0)
				{
					$file_path = "../../../../split/files/documents/";
					
					$files_upload = $ah->mtvc_add_files_file_miltiple(array(
							'path'			=>$file_path,
							'name'			=>5,
							'pre'			=>"doc_",
							'size'			=>20,
							'rule'			=>0,
							'max_w'			=>2500,
							'max_h'			=>2500,
							'files'			=>$filename
						  ));
					if($files_upload)
					{
						foreach($files_upload as $file_upload)
						{
							$query = "INSERT INTO [pre]docs_ref (`ref_table`, `ref_id`, `file`, `crop`, `path`) VALUES ('articles', '$item_id', '$file_upload', '0', 'split/files/documents/')";
							
							$ah->rs($query);
						}
					}
				}
				}else
				{
					$data['item_id'] = 0;
				}
		}else{
			$data['status'] = "failed";
			$data['message'] = "Материал с таким Алиасом уже существует";
			}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Укажите Название материала";
		}
	
	$data['message'] = "Новый материал успешно создан.";
	