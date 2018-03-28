<?php
$response = array('title'=>'Загрузка продукции с эксель файла и обновление информации', 'status'=>'error', 'message'=>'Error');
	
require_once "../../require.base.php";
	
require_once "../library/AjaxHelp.php";
	
$ah = new ajaxHelp($dbh);

$fileName = "ms_20151224122014177.xls";

echo $fileName;

if($ah->getExt($fileName)=="xls")
{
		
	$file_name = $fileName;
	
	if($file_name)
	{
	
		chmod("import/".$file_name,0777);
	
		error_reporting(E_ALL ^ E_NOTICE);
		require_once 'excel_reader2.php';
		$data = new Spreadsheet_Excel_Reader("import/$file_name");
	
		//echo '<pre>'; print_r($data); echo '</pre>';
		echo '<pre>'; print_r($sheets[0]['cells']); echo '</pre>';
		
		//echo $data->dump(true,true); 
	
		$result = "<table>";
		
		$rows_cnt = 0;
	
		$failed_rows = 0;
	
						$cat_id = 26;
						
						$char_ids = array(90, 91, 92, 94, 93);
	
		$sheets = $data->sheets;
		foreach($sheets[0]['cells'] as $sheet)
		{
			$rows_cnt++;
			
			//if($rows_cnt==1) continue;
			
			$item = array();
			
			$cnt = 0;
			
			$row_cells = "";
			
				//echo '<pre>'.$cnt." : "; print_r($sheet); echo '</pre>'; break;
			
				foreach($sheet as $i => $cell)
				{
					$cnt++;
					
					$cell = str_replace("'","\'",$cell);
					
					//echo '<pre>'.$cnt." : "; print_r($cell); echo '</pre>'; break;
					
					switch($i)
					{
						case 1: $item['name'] 		= $cell; break;
						case 2: $item['sku'] 		= $cell; break;
						case 3: $item['details'] 	= $cell; break;
						case 5: $item['table_details'] 	= $cell; break;
						
						case 6: $item['price_usd'] 	= $cell; break;
						case 7: $item['price_eur'] 	= $cell; break;
						case 8: $item['mf'] 		= $cell; break;
						
						case 9: $item['char_90'] 	= $cell; break;
						case 10: $item['char_91'] 	= $cell; break;
						case 11: $item['char_92'] 	= $cell; break;
						case 11: $item['char_94'] 	= $cell; break;
						case 12: $item['char_93'] 	= $cell; break;
						
						default:{ 
									if(!isset($item['price_eur'])) $item['price_usd'] = 0;
									break;
								}
					}
					
					//$row_cells .= "<td>".str_replace('"',"\'",$cell)."</td>";
				}
				
				$product_id_search = $ah->rs("SELECT id FROM [pre]shop_products WHERE `sku`='".$item['sku']."' LIMIT 1");
				if($product_id_search)
				{
					$product_id = $product_id_search[0]['id'];
					
					echo $product_id . ": " .$item['table_details']." <br><hr>";
					
					$query = "UPDATE [pre]shop_products SET 	`name`='".$item['name']."',
																`details`='".$item['details']."',
																`table_details`='".$item['table_details']."'
								WHERE `id`=$product_id LIMIT 1";
					
					//echo $product_id . ": " .$query." <br><hr>";
					
					$ah->rs($query);
					
				}else
				{
					$failed_rows++;
					
					if($failed_rows==1) continue;
					
					//echo "<pre>TEST "; print_r($item); echo "</pre>"; break;
					
					$query = "INSERT INTO [pre]shop_products 
									(`name`,`sku`,`usd_price`,`eur_price`,`details`,`table_details`,`dateCreate`,`dateModify`) 
									VALUES 
									('".$item['name']."','".$item['sku']."','".$item['price_usd']."','".$item['price_eur']."','".$item['details']."','".$item['table_details']."','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')";
									
					$ah->rs($query);
					
					$p_id = mysql_insert_id();
					
					if($p_id)
					{
						$_image = $item['sku'].".jpg";
						
						$query = "INSERT INTO [pre]shop_cat_prod_ref (`cat_id`,`prod_id`) VALUES ('$cat_id','$p_id')";
						
						$ah->rs($query);
						
						$query = "INSERT INTO [pre]files_ref (`ref_table`,`ref_id`,`file`,`path`) VALUES ('shop_products','$p_id','$_image','split/files/shop/products/')";
						
						$ah->rs($query);
						
						foreach($char_ids as $char_id)
						{
							$query = "INSERT INTO [pre]shop_chars_prod_ref (`char_id`,`prod_id`,`value`,`value2`,`filter`) VALUES ('$char_id','$p_id','".$item['char_'.$char_id]."','".$item['char_'.$char_id]."','1')";
							
							$ah->rs($query);
						}
					}
					
					//if($failed_rows > 3) break;
					//$result .= "<tr>".$row_cells."</tr>";
				}
				
				
				//$result .= "<tr>".$row_cells."</tr>";
		}
		
		$result .= "</table>";
	
	}else
	{
		$result = "<p>Не удалось загрузить файл.</p>";
	}
	
	
		$result = "<br><p>Товары, которых не нашлось в Базе Данных:</p>".$result;
	
	
	echo $result;
		
	$response['status'] = "success";
	$response['message'] = "<p>Импорт обновлений по товарам успешно завершился.</p>".($failed_rows > 1 ? $result : "");
	
	echo $response['message'];
}else{
	$response['status'] = "failed";
	$response['message'] = "<p>Импорт файл должен быть в формате .xls</p>";
	}
	
//echo json_encode($response);