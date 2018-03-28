<?php // ajax json action
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$ah = new ajaxHelp($dbh);

	$id = (int)$_POST['id'];

	$query = "UPDATE [pre]test_drive_orders SET `viewed` = 1 WHERE `id`= $id LIMIT 1";
	
	$ref = $ah->rs($query);
	
	$data['status'] = "success";
	
	
echo json_encode($data);
