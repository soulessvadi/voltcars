<?php
$response = array('title'=>'Загрузка продукции с эксель файла и обновление информации', 'status'=>'error', 'message'=>'Error');

error_reporting(E_ALL);
ini_set('display_errors', 0);
	
require_once "../../require.base.php";
	
require_once "../library/AjaxHelp.php";
	
$ah = new ajaxHelp($dbh);

$fileName = $_FILES['import_chars_file']['name'];

if($ah->getExt($fileName)=="xls")
{
		$file_name = $ah->mtvc_add_files_file(array(
					'path'			=>"products-chars-import/",
					'name'			=>"4",
					'pre'			=>"import_prod_chars",
					'size'			=>200,
					'rule'			=>0,
					'max_w'			=>25000,
					'max_h'			=>25000,
					'files'			=>"import_chars_file",
					'resize_path'	=>"0",
					'resize_w'		=>0,
					'resize_h'		=>0,
					'resize_path_2'	=>"0",
					'resize_w_2'	=>0,
					'resize_h_2'	=>0
				  ));
	
	if($file_name)
	{
	
		chmod("products-chars-import/".$file_name,0777);
	
		require_once 'excel_reader2.php';
		$data = new Spreadsheet_Excel_Reader("products-chars-import/$file_name");
	
		//echo '<pre>'; print_r($data); echo '</pre>';
		//echo '<pre>'; print_r($sheets[0]['cells']); echo '</pre>';
		
		//echo $data->dump(true,true); 
	
		$result = "<table>";
		
		$rows_cnt = 0;
	
		$failed_rows = 0;
	
		$sheets = $data->sheets;
		foreach($sheets[0]['cells'] as $sheet)
		{
			$rows_cnt++;
			
			//if($rows_cnt==1) continue;
			
			$item = array();
			
			$cnt = 0;
			
			$row_cells = "";
			
				foreach($sheet as $cell)
				{
					$cnt++;
					
					$cell = strip_tags(str_replace("'","\'",$cell));
					
					switch($cnt)
					{
						case 1: $item['id'] 			= (int)$cell; break;
						case 2: $item['prod_id'] 		= (int)$cell; break;
						//case 3: $item['prod_name'] 		= str_replace("'","\'",$cell);break; // prod_name
						case 4: $item['char_id'] 		= (int)$cell; break;
						//case 5: $item['char_name'] 		= str_replace("'","\'",$cell);break; // char_name
						case 6: $item['value'] 			= str_replace("'","\'",$cell); break;
						case 7: $item['price_dif']		= (float)$cell; break;
						
						default: break;
					}
					
					$row_cells .= "<td>".str_replace('"',"\'",$cell)."</td>";
				}
				
				if($item['id']=='0')
				{
					$curr_char_id 	= $item['char_id'];
					$curr_prod_id 	= $item['prod_id'];
					$curr_value 	= $item['value'];
					$curr_price_dif	= $item['price_dif'];
					
					$query = "
								INSERT INTO [pre]shop_chars_prod_ref 
									(`char_id`,`prod_id`,`value`,`price_dif`)
										VALUES
									('$curr_char_id','$curr_prod_id','$curr_value','$curr_price_dif')
								";
					$ah->rs($query);
					//$failed_rows++;
					//$result .= "<tr>".$row_cells."</tr>";
					
				}else
				{
					$ref_id_search = $ah->rs("SELECT id FROM [pre]shop_chars_prod_ref WHERE `id`='".$item['id']."' LIMIT 1");
					if($ref_id_search)
					{
						$item_id = $ref_id_search[0]['id'];
						
						$query = "UPDATE [pre]shop_chars_prod_ref SET 	
																	`value`='".$item['value']."',
																	`price_dif`='".$item['price_dif']."' 
									WHERE `id`=$item_id LIMIT 1";
						
						$ah->rs($query);
					}
					else
					{
						$failed_rows++;
						$result .= "<tr>".$row_cells."</tr>";
					}
				}
		}
		
		$result .= "</table>";
	
	}else
	{
		$result = "<p>Не удалось загрузить файл.</p>";
	}
	
	
		$result = "<br><p>Записи, которых не нашлось в Базе Данных:</p>".$result;
	
		
	$response['status'] = "success";
	$response['message'] = "<p>Импорт обновлений по динамичным ценам успешно завершился.</p>".($failed_rows > 1 ? $result : "");
}else{
	$response['status'] = "failed";
	$response['message'] = "<p>Импорт файл должен быть в формате .xls</p>";
	}
	
echo json_encode($response);