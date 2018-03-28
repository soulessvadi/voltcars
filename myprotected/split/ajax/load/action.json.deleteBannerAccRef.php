<?php // ajax json action
	
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$data = array('status'=>"error",'message'=>"");
	
	$ah = new ajaxHelp($dbh);
	
	$ref_id = $_POST['ref_id'];
	
	
	//
	
	$query = "DELETE FROM [pre]shop_banner_access_ref WHERE `id`=$ref_id LIMIT 1";
	
	$ref = $ah->rs($query);
	
	//
	
	$data['message'] = "Success banner_access_ref delete";
	
	$data['status'] = "success";
	
	
echo json_encode($data);
