<?php // ajax json action
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$ah = new ajaxHelp($dbh);
	
	$result = "";
	
	$appTable	= "shop_products";

	$catId		= $_POST['catId'];
	
	$prodId		= $_POST['prodId'];
	
	if($catId > 0)
	{
	
		$query = "SELECT M.*, 
					
					(SELECT file FROM [pre]files_ref WHERE `ref_table`='shop_products' AND `ref_id`=M.id LIMIT 1) as file 
					
					FROM 
					[pre]$appTable as M
					LEFT JOIN [pre]shop_cat_prod_ref as R ON M.id=R.prod_id  
					WHERE R.cat_id=$catId 
					ORDER BY id 
					LIMIT 10000";
	
		$productsMassive = $ah->rs($query);
		
		if($productsMassive)
		{
			//$result = "Products: ".count($productsMassive);
			$result = $ah->print_adding_products_for_accessuares($productsMassive,$prodId,"add_banner_accessuare_from_modal");
		}else
		{
			$result = "В категории нет ни одного доступного товара.";
		}
	
	}elseif(isset($_POST['key']) && $_POST['key']!='')
	{
		$key = trim(strip_tags($_POST['key']));
		
		$query = "SELECT M.* , 
					
					(SELECT file FROM [pre]files_ref WHERE `ref_table`='shop_products' AND `ref_id`=M.id LIMIT 1) as file 
					
					FROM 
					[pre]$appTable as M
					LEFT JOIN [pre]shop_cat_prod_ref as R ON M.id=R.prod_id  
					WHERE M.sku LIKE '%$key%' || model LIKE '%$key%'
					ORDER BY id 
					LIMIT 10000";
	
		$productsMassive = $ah->rs($query);
		
		if(!$productsMassive)
			{
				$keys = explode(" ",$key);
				
				$or_q = "";
				
				foreach($keys as $i => $k)
				{
					if($i>0){
						$or_q .= " AND ";
					}
					$or_q .= " (`name`LIKE'%$k%') ";
				}
				$query = "SELECT M.* , 
					
					(SELECT file FROM [pre]files_ref WHERE `ref_table`='shop_products' AND `ref_id`=M.id LIMIT 1) as file 
					
								FROM [pre]shop_products as M 
								
								WHERE (`id`='$key') OR (`sku`='$key') OR ( $or_q ) 
								ORDER BY M.id 
								LIMIT 100";
		
				$productsMassive = $ah->rs($query);
			}
		
		if($productsMassive)
		{
			//$result = "Products: ".count($productsMassive);
			$result = $ah->print_adding_products_for_accessuares($productsMassive,$prodId,"add_banner_accessuare_from_modal");
		}else
		{
			$result = "По запросу нет ни одного доступного товара."; // ORDER BY id 
		}
	}
	else
		{
			$result = "Категория еще не выбрана.";
		}
	
	$data['message'] = $result;
	
	$data['status'] = "success";
	
	
echo json_encode($data);
