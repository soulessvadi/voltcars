<?php 
	//********************
	//** WEB INSPECTOR
	//********************
	
	require_once "../../../require.base.php";
	
	require_once "../../library/AjaxHelp.php";
	
	$ah = new ajaxHelp($dbh);
	
	$id = $_POST['id'];
	
	$catalog = $ah->getCatalogParents();
	
	$select_html = $ah->print_select(
									"Выбрать категорию", 
									0, 
									$catalog,
									'id', 
									'name', 
									'acc_cat_id', 
									"reload_cat_products_modal($(this).val(),$id);", 
									array( 'name'=>'-- Категория не выбрана --', 'id'=>0 ),
									'allCatalog',
									'margin-left:25px;',
									''
									);
	$onchange = "reload_search_access_banner_modal($('#save-search-products').val(),$id);";
	
	$select_html .=  "
			
			<div class='zen-form-item'>
				<label for='save-search-products'>Search key</label><br>
				<div class='zif-wrap'>
                	<input	id='save-search-products' class='my-field' type='text' placeholder='Search key' value='' name='skey' size='25' />
					
					&nbsp;&nbsp;
					
					<button class='r-z-h-s-create nssBut fRight' type='button' onclick=\"$onchange\">НАЙТИ &nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
			
            ";
 ?>
<!DOCTYPE>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BANNER Accessuares SCRIPT</title>
</head>

<body>
	<button class="close-modal" onClick="close_modal();">Закрыть окно</button>
    <div class="modalW" id="modalW-1">
    	<h4>Выберите категорию, затем товары из списка</h4>
        
        <?php
        //echo "<pre>"; print_r($catalog); echo "</pre>";
		echo $select_html;
		?>
        
        <div id="reloadAddingProductsAccess"></div>
    </div>
</body>
</html>