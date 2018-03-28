<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post
	
	function pseudoext($filename) {
   			$result = strtolower(substr( strstr(basename($filename), '.'), 1 ));

   			/*
   			$split_res = mb_split(".",$result);
   			if($split_res) {
   				$result = $split_res[count($split_res)-1];
   			}
   			*/

   			return $result;
		}

	function clearFilename($filename){
		$result = str_replace(".jpg","",$filename);
		$result = str_replace(".jpeg","",$result);
		$result = str_replace(".JPEG","",$result);
		$result = str_replace(".JPG","",$result);
		$result = str_replace(".png","",$result);
		$result = str_replace(".PNG","",$result);

		return $result;
	}
	
	$field	= (isset($_POST['field']) ? strip_tags(str_replace("'","",$_POST['field'])) : 'images');
	
	if($field == 'docs'){
			$appTable = "docs_ref";
		}else{
			$appTable = "files_ref";
			}
	
	$id	= (int)$_POST['id'];
	
	$val	= strip_tags(str_replace("'","",trim($_POST['val'])));
	
	$data['status'] = "failed";
	$data['message'] = "Operation failed :(";
	
	//echo json_encode($data);
	//exit();
	
	$query = "SELECT * FROM [pre]$appTable WHERE `id`=$id LIMIT 1";
	$fileData = $ah->rs($query);
	
	$file_path = "../../../../split/files/shop/products/";
	$file_path_crop = "../../../../split/files/shop/products/crop/330x270_";
	
	$file_path2 = "../../../../split/files/content/";
	$file_path_crop2 = "../../../../split/files/content/crop/300x300_";
	
	$file_path3 = "../../../../split/files/documents/";
	$file_path_crop3 = "../../../../split/files/documents/crop/";
	
	if($fileData)
	{
		$file = $fileData[0];
		
		$file_ext = pseudoext($file['file']);
		
		if($file_ext && file_exists($file_path.$file['file']))
		{
			//$data['message'] = "File exists!";
			//echo json_encode($data);
			//exit();
			
			$filename = str_replace('.'.$file_ext,"",$file['file']);
			$filename = clearFilename($filename);
		
			if(rename($file_path.$file['file'], $file_path.$val.'.'.$file_ext))
			{
				rename($file_path_crop.$file['file'], $file_path_crop.$val.'.'.$file_ext);
				
				$query = "UPDATE [pre]$appTable SET `file`='".$val.".".$file_ext."',`crop`='330x270_".$val.".".$file_ext."' WHERE `id`=$id LIMIT 1";
				$ah->rs($query);
				
				$data['status'] = "success";
				$data['message'] = "Название файла успешно сохранено.";
				
			}else{
				$data['message'] = "Не хватает прав на переименование файла.";
				}
		}elseif($file_ext && file_exists($file_path2.$file['file']))
		{
			//$data['message'] = "File exists!";
			//echo json_encode($data);
			//exit();
			
			$filename = str_replace('.'.$file_ext,"",$file['file']);
		
			if(rename($file_path2.$file['file'], $file_path2.$val.'.'.$file_ext))
			{
				rename($file_path_crop2.$file['file'], $file_path_crop2.$val.'.'.$file_ext);
				
				$query = "UPDATE [pre]$appTable SET `file`='".$val.".".$file_ext."',`crop`='300x300_".$val.".".$file_ext."' WHERE `id`=$id LIMIT 1";
				$ah->rs($query);
				
				$data['status'] = "success";
				$data['message'] = "Название файла успешно сохранено.";
				
			}else{
				$data['message'] = "Не хватает прав на переименование файла.";
				}
		}elseif($file_ext && file_exists($file_path3.$file['file']))
		{
			$filename = str_replace('.'.$file_ext,"",$file['file']);
		
			if(rename($file_path3.$file['file'], $file_path3.$val.'.'.$file_ext))
			{
				$query = "UPDATE [pre]$appTable SET `file`='".$val.".".$file_ext."' WHERE `id`=$id LIMIT 1";
				$ah->rs($query);
				
				$data['status'] = "success";
				$data['message'] = "Название файла успешно сохранено.";
				
			}else{
				$data['message'] = "Не хватает прав на переименование файла.";
				}
		}else{
			$data['message'] = "Не удалось прочитать имя файла: ".$file_path.$file['file'];
			}
	}else{
		$data['message'] = "Файл не найден.";
		}
	
	
	
	