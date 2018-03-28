<?php // ajax json action LOAD ORDER PRODUCTS TABLE
	
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$ajax_cart_response = array('status'=>"failed",'cart_html'=>"");
	
	$ah = new ajaxHelp($dbh);
	
	
	$orderId = (int)$_POST['orderId'];
	
	$cart_action = (isset($_POST['cart_action']) ? $_POST['cart_action'] : "");
	
	$cart_result = $ah->getUserCartTableHtml( $orderId, "../../../../split/view_parts/inc/_cart_table_admin.php", 1, $cart_action );
	
	
	$ajax_cart_response['status'] 				= "success";
	$ajax_cart_response['cart_total_quant']		= $cart_result['cart_total_quant'];
	$ajax_cart_response['cart_total_summ']		= $cart_result['cart_total_summ'];
	$ajax_cart_response['cart_html'] 			= $cart_result['cart_html'];
	
	echo json_encode($ajax_cart_response);
	exit();
