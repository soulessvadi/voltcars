<?php // ajax json action
	
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$data = array('status'=>"error",'message'=>"");
	
	$ah = new ajaxHelp($dbh);
	
	$ref_id = $_POST['ref_id'];
	
	
	//
	
	$query = "SELECT * FROM [pre]shop_prod_present_ref WHERE `id`=$ref_id LIMIT 1";
	
	$ref = $ah->rs($query);
	
	if($ref)
	{
		$prod_id = $ref[0]['prod_id'];
		$acc_id = $ref[0]['acc_id'];
		
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
				$query = "DELETE FROM [pre]shop_prod_present_ref WHERE `prod_id`='".$p['id']."' AND `acc_id`='$acc_id'";
				$ah->rs($query);
			}
		}else
		{
			$query = "DELETE FROM [pre]shop_prod_present_ref WHERE `id`=$ref_id LIMIT 1";
			$ah->rs($query);
		}
	}
	
	//
	
	$data['message'] = "Success prod_present_ref delete";
	
	$data['status'] = "success";
	
	
echo json_encode($data);
