<?php
	$response = array('title'=>'Выгрузка в эксель Продукции по фильтру', 'status'=>'error', 'message'=>'Error');
	
	require_once "../../require.base.php";
	
	require_once "../library/AjaxHelp.php";
	
	$ah = new ajaxHelp($dbh);
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$data_arr = array();
	
	include("excelwriter.inc.php");
	$cur_date = date("Y-m-d H-i-s");
	$fileName = "products-chars-report/prod-chars-".$cur_date.".xls";
	$excel = new ExcelWriter($fileName);
	
	if( $excel == false )
	{
		echo $excel->error;
		die;
	}
	
	$myArr = array(
					"<strong> ID </strong>",
					"<strong> PROD ID </strong>",
					"<strong> PROD NAME </strong>",
					"<strong> CHAR ID </strong>",
					"<strong> CHAR NAME </strong>",
					"<strong> VALUE </strong>",
					"<strong> PRICE </strong>"
				   	);
	$excel->writeLine($myArr, array('text-align'=>'center', 'color'=> 'blue', 'border-bottom' => '1px solid black'));

	///////////////////////////////////////////////////////////////

	$params = array();
	
	$params['filtr'] = $_POST['filtr'];
	
	if($params['filtr'])
		{
			parse_str($params['filtr'],$prmFiltr);
		}else
		{
			$prmFiltr = array();
		}
	$params['filtr'] = $prmFiltr;
	
	$appTable = "shop_products"; // Main table

	$data_arr = $ah->getAllShopProducts($params);
	
	///////////////////////////////////////////////////////////////

	$col_params = array(
			'text-align' => 'left',
			'color' => 'black',
			'font-size' => '14px',
			'line-height'	=> '25px',
			'border-right' => '1px solid black');

	foreach($data_arr as $data)
	{
		$curr_prod_id = $data['id'];
		
		$prod_dinamic_chars = $ah->get_prod_dinamic_chars($curr_prod_id);
		
		foreach($prod_dinamic_chars as $item)
		{
			$excel->writeRow(); //создаем пустую строку
		
			// Записываем столбци
			$excel->writeCol($item['id'], $col_params);
			$excel->writeCol($data['id'], $col_params);
			$excel->writeCol($data['name'], $col_params);
			$excel->writeCol($item['char_id'], $col_params);
			$excel->writeCol($item['char_name'], $col_params);
			$excel->writeCol($item['value'], $col_params);
			$excel->writeCol($item['price_dif'], $col_params);	
		}
	}

	$excel->close();

	$response['status'] = "success";
	$response['message'] = "<p><a href='split/excel/products-chars-report/prod-chars-".$cur_date.".xls' target='_blank'>Открыть сформированный Excel файл</a></p>";
	
	echo json_encode($response);