<?php // ajax json action
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$ah = new ajaxHelp($dbh);

	$cat_id			= (int)$_POST['cat_id'];
	
	ob_start();
	
	// Вытягиваем данные о группе свойств
	$category = array();
	
	if($cat_id)
	{
		$query = "SELECT M.specs_group_id, M.name FROM [pre]shop_catalog as M  WHERE M.id = ".$cat_id." LIMIT 1";
		$category = $ah->rs($query);
		
		if($category)
		{
			$category = $category[0];
		}
	}
	
	// Вытягиваем значения свойств
	$chars = array();
	
	if($category)
	{
		$query = "SELECT M.id as id, M.name as name, M.measure as measure
				 FROM [pre]shop_chars as M
				 WHERE M.group_id=".$category['specs_group_id']." 
				 ORDER BY pos 
				 LIMIT 100";
		$charsList = $ah->rs($query);
		
		if($charsList)
		{
			$chars = $charsList;
			
			echo "  <p title='Группа характеристик'>Группа свойств: <b>".$category['name']."</b></p>
					<br>
					<table class='chars-table'>";
					foreach($chars as $char)
					{
						echo "
						<tr>
							<td style='text-align:left;'><b>".$char['name']."".($char['measure']!="" ? ", ".$char['measure'] : "")."</b></td>
							<td> Номер колонки в таблице: </td>
							<td>
								<input id='char-filter-".$char['id']."' class='my-field' type='number' placeholder='".$char['name']."' value='0' name='filter[".$char['id']."]' size='15' maxlength='10'>
							</td>
						</tr>
						";
					}
					echo "
					</table>
				";
			}else
			{
				echo "<br>
							<p title='Группа характеристик'>Для групы свойств: <b>".$category['name']."</b> еще не назначены свойства.</p>";
			}
		}else{
			echo "<br>
							<p title='Группа характеристик'>Для текущей категории еще не назначена группа свойств.</p>";
			}

	
	$data['message'] = ob_get_contents();
	
	ob_end_clean();
	
	$data['status'] = "success";
	
	
echo json_encode($data);
