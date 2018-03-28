<?php // ajax json action
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$data = array('status'=>"error",'message'=>"",'item_html'=>"");
	
	$ah = new ajaxHelp($dbh);
	
	$ref_id = (int)$_POST['ref_id'];
	
	$prod_sku = strip_tags(str_replace("'","\'",$_POST['prod_sku']));
	
	$id1 = ADMIN_ID;
	
	
	$query = "SELECT M.* , 
				(SELECT file FROM [pre]files_ref WHERE `ref_table`='shop_products' AND `ref_id`=M.id AND `file`!='fail' AND `file`!='0' AND `file`!='' AND `file`!='NULL' ORDER BY id LIMIT 1) as myphoto
				FROM [pre]shop_products as M 
				WHERE M.sku='$prod_sku' 
				LIMIT 1";
	$acc_data = $ah->rs($query);	
	
	if($acc_data)
	{
		$acc = $acc_data[0];
			
		$prod_id = $acc['id'];
		$sub_acc_id = $acc['id'];
		$sub_acc_name = $acc['name'];
		$sub_acc_photo = $acc['myphoto'];
		
		$query = "INSERT INTO [pre]shop_banner_prod_access_ref (`banner_ref_id`,`prod_id`) VALUES ('$ref_id','$prod_id')";
		$ah->rs($query);
	
		$sub_ref_id = mysql_insert_id();
		
		$data['status'] = 'success';
		$data['message'] = "Аксессуар добавлен.";
		$data['item_html'] = "
		<li id='bpal-item-$sub_ref_id'>
			<div class='bpal-image'>
				<a class='theater' href='/split/files/shop/products/$sub_acc_photo' title='Аксессуар: ".str_replace("'","",$sub_acc_name)."'>
					<img class='img-mini' alt='NO PHOTO' src='/split/files/shop/products/crop/320x240_$sub_acc_photo' />
				</a>
			</div>
			<div class='bpal-name'>".str_replace("'","",$sub_acc_name)."</div>
			<div class='bpal-del'><button class='close-option r-z-h-s-close' type='button' title='Удалить' onclick='delete_banner_prod_accessuare($sub_ref_id);'></button></div>
			<div class='clear'></div>
		</li>
		";
	}else{
		$data['message'] = 'Товар по артикулу не найден!';
		}
	
	
echo json_encode($data);

