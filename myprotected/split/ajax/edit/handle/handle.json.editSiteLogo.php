<?php 
	//********************
	//** WEB MIRACLE TECHNOLOGIES
	//********************
	
	// get post

	function pseudoext($filename) {
   			$result = strtolower(substr( strstr(basename($filename), '.'), 1 ));

   			return $result;
		}
	
	$appTable = $_POST['appTable'];
	
	$item_id = $_POST['item_id'];
	
	$logo_filename = "";


	$query = "SELECT * FROM [pre]logo WHERE `id`='$item_id' LIMIT 1";
	$logo_data = $ah->rs($query);

	if($logo_data)
	{
		$logo_filename = $logo_data[0]['file'];

		$logo_size_w = $logo_data[0]['w'];
		$logo_size_h = $logo_data[0]['h'];

		$logo_ext = pseudoext($logo_filename);

		$logo_prefix = str_replace(".".$logo_ext,"",$logo_filename);

		// PROCESSING 

		// File upload 
	
	
		$filename = "file";
		
		if(isset($_FILES[$filename]) && $_FILES[$filename]['size'] > 0)
		{
			$file_path = "../../../../split/files/images/";

			ob_start();
			
			$file_update = $ah->mtvc_add_files_file(array(
					'path'			=>$file_path,
					'name'			=>4,
					'pre'			=>$logo_prefix,
					'size'			=>2,
					'rule'			=>3,
					'max_w'			=>$logo_size_w,
					'max_h'			=>$logo_size_h,
					'files'			=>$filename,
					'resize_path'	=>"0",
					'resize_w'		=>0,
					'resize_h'		=>0
				  ));

			$data['message'] = ob_get_contents();

			ob_end_clean();

			if($file_update)
			{
				$query = "UPDATE [pre]logo SET `file`='$file_update' WHERE `id`='$item_id' LIMIT 1";
				$ah->rs($query);

				$data['status'] = "success";
				$data['message'] = "Лого успешно обновлен.";

			}else{
				$data['status'] = "failed";
				$data['message'] = "Ошибочный размер файла!";
			}
		}else{
			$data['status'] = "failed";
		$data['message'] = "Файл не найден на сервере.";
		}

	}else{
		$data['status'] = "failed";
		$data['message'] = "Такой логотип не найден в базе. ";
	}

	
	