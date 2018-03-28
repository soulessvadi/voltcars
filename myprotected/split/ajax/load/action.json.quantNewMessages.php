<?php // ajax json action
	require_once "../../../require.base.php";
	require_once "../../adminHelper.class.php";
	
	$data = array('status'=>"error",'message'=>"Tech error", 'tasks'=>"", 'directorTasks'=>"", 'directorTasksQ'=>"");
	
	$ah = new adminHelper();

	///////////////////////////////////////////////////////////
	// GET QUICK ORDERS QUANT

	$qquant = 0;
	
	$query = "SELECT COUNT(*) FROM [pre]shop_quick_orders WHERE `status`=1 ORDER BY id LIMIT 1000";
			
	$_stmt = $dbh->prepare($query);
	$_arr = $_stmt->execute();
		
		$_res = $_arr->fetchallAssoc();
		$qquant = (int)$_res[0]['COUNT(*)'];
		
	$data['QuickTasksQ'] = $qquant;
		
	if($qquant > 0)
	{
		$query = "SELECT id,dateCreate FROM [pre]shop_quick_orders WHERE `status`=1 ORDER BY id LIMIT 10";
		$_stmt = $dbh->prepare($query);
		$_arr = $_stmt->execute();
		$_res = $_arr->fetchallAssoc();
		
		foreach($_res as $order_item)
		{
			$data['QuickTasks'] .= "
							<li onclick=\"loadPage('shop','quick-order-form',20,".$order_item['id'].",'cardView',{});\">Заказ ".($order_item['id'])." 
                                		<span class='right'>".$ah->deformat_date($order_item['dateCreate'])."</span>
                            </li>
			";
		}
	}

	///////////////////////////////////////////////////////////
	// GET ORDERS QUANT

	$quant = 0;
	
	$query = "SELECT COUNT(*) FROM [pre]shop_orders WHERE `status`=1 ORDER BY id LIMIT 1000";
			
	$_stmt = $dbh->prepare($query);
	$_arr = $_stmt->execute();
		
		$_res = $_arr->fetchallAssoc();
		$quant = (int)$_res[0]['COUNT(*)'];
		
	$data['tasksQ'] = $quant;
		
	if($quant > 0)
	{
		$query = "SELECT id,dateCreate FROM [pre]shop_orders WHERE `status`=1 ORDER BY id LIMIT 10";
		$_stmt = $dbh->prepare($query);
		$_arr = $_stmt->execute();
		$_res = $_arr->fetchallAssoc();
		
		foreach($_res as $order_item)
		{
			$data['tasks'] .= "
							<li onclick=\"loadPage('shop','order-form',20,".$order_item['id'].",'cardView',{});\">Заказ ".($order_item['id']+5000)." 
                                		<span class='right'>".$ah->deformat_date($order_item['dateCreate'])."</span>
                            </li>
			";
		}
	}
	
	$query = "SELECT T.subject FROM [pre]tasks as T, [pre]task_admin_ref as M WHERE T.status<2 AND T.id=M.task_id  AND ( M.responsible_id='".ADMIN_ID."' OR M.admin_id='".ADMIN_ID."' ) GROUP BY M.id LIMIT 1000";
			
	$_stmt = $dbh->prepare($query);
	$_arr = $_stmt->execute();
	
		$tasks = $_arr->fetchallAssoc();
		$data['directorTasksQ'] = count($tasks);
		$quant += $data['directorTasksQ'];
	
	$query = "SELECT M.*, 
			(SELECT name FROM [pre]users WHERE id=M.from_id) as friend_name 
			FROM [pre]users_dialogs as M 
			WHERE `to_id`='".ADMIN_ID."' AND `status`=0 
			ORDER BY dateCreate DESC 
			LIMIT 10";
	
	$_stmt = $dbh->prepare($query);
	$_arr = $_stmt->execute();
	
		$_res = $_arr->fetchallAssoc();
		$dialogs = $_res;
	
	$data['messQ'] = count($dialogs);
	
	$last_name = "";
	$last_message = "";
	$last_date = "";
	
	$last_mess = "";
	
	if(count($_res) > 0)
	{
		foreach($dialogs as $lastM)
		{
		
			$last_name		= $lastM['friend_name'];
			$last_message	= $ah->next_sub_str($lastM['message'],50);
			$last_date		= $ah->deformat_date($lastM['dateCreate']);
		
			$last_mess .= "<li id='mess_loop_".$lastM['id']."' title='Прочитать' onclick=\"loadPage('personal','profile-message',29,".$lastM['id'].",'cardView',{});\"><span class='left'>$last_name</span><span class='right'>$last_date</span><br>$last_message</li>";
		}
	}
	
	$quant += count($dialogs);
	
	$data['status'] = "success";
	
	$data['last_mess']	= $last_mess;
	$data['last_name']	= $last_name;
	$data['last_date']	= $last_date;
	$data['quant']		= $quant;
	
	$data['mess_path'] = "index.php?control=personal&item=29&id=".$lastM['id'];
	
echo json_encode($data);
