<?php // ajax json action
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$data = array('status'=>"error",'message'=>"");
	
	$ah = new ajaxHelp($dbh);
	
	$prod_id = $_POST['prod_id'];
	
	$acc_id = $_POST['acc_id'];
	
	$id1 = ADMIN_ID;
	
	//
	
	$query = "SELECT M.model
				FROM [pre]shop_products as M 
				WHERE M.id='$prod_id' 
				LIMIT 1";
	$prod_data = $ah->rs($query);
	
	if($prod_data && trim($prod_data[0]['model'])!='')
	{
		$model = $prod_data[0]['model'];
		
		$query = "SELECT M.id
				FROM [pre]shop_products as M 
				WHERE M.model='$model' 
				LIMIT 100";
		$models = $ah->rs($query);
		
		foreach($models as $p)
		{
			$query = "INSERT INTO [pre]shop_prod_present_ref (`prod_id`,`prod_sku`,`acc_id`) VALUES ('".$p['id']."','0','$acc_id')";
			$ah->rs($query);
		}
	}else
	{
		$query = "INSERT INTO [pre]shop_prod_present_ref (`prod_id`,`prod_sku`,`acc_id`) VALUES ('$prod_id','0','$acc_id')";
		$ah->rs($query);
	}
	
	//
	
	$ref_id = mysql_insert_id();
	
	$query = "SELECT M.* , 
				(SELECT file FROM [pre]files_ref WHERE `ref_table`='shop_products' AND `ref_id`='$acc_id' ORDER BY id LIMIT 1) as myphoto
				FROM [pre]shop_products as M 
				WHERE M.id='$acc_id' 
				LIMIT 1";
	$acc_data = $ah->rs($query);	
	
	if($acc_data)
	{
		$acc = $acc_data[0];
		
		$acc_id = $acc['id'];
		$acc_name = $acc['name'];
		$acc_photo = $acc['myphoto'];
		
		$acc_price = $acc['price'];
		$c_price = 0;
		
		$data['status'] = 'success';
		$data['message'] = "
							<tr id='prod_present_ref_$ref_id'>
								<td>ID: $acc_id</td>
								<td>Цена: <b>$acc_price</b> грн</td>
								<td>В подарок: <input class='my-field' type='number' placeholder='Цена в комплекте' onchange=\"change_present_price($(this).val(),$ref_id)\" value='$c_price' name='c_prices[$ref_id]' size='25'> грн<br>
									<span id='present_price_saved_$ref_id'></span>
								</td>
								<td class='img'><a class='theater' href='/split/files/shop/products/$acc_photo' title='Товар в подарок: ".str_replace("'","",$acc_name)."'><img alt='NO PHOTO' src='/split/files/shop/products/$acc_photo' /></a></td>
								<td>$acc_name</td>
								<td class='last'> <button class='close-option r-z-h-s-close' type='button' title='Удалить' onclick='delete_prod_present_ref($ref_id);'></button> </td>
							</tr>
							";
	}else{
		$data['status'] = 'PRESENT ID NOT FOUND';
		}
	
	
echo json_encode($data);

