<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'appTable'=>$appTable);
	
	$data['headContent'] = $zh->getLandingHeader($headParams);
	
	// Get page items
	
	$itemsList = $zh->getAllShopProducts($params);

	$totalItems = $zh->getCountShopProducts($params);
	
	// Pagination operations
	
	$on_page = (isset($_COOKIE['global_on_page']) ? $_COOKIE['global_on_page'] : GLOBAL_ON_PAGE);
	
	$pages = ceil($totalItems/$on_page);
	
	$start_page = (isset($params['start']) ? $params['start'] : 1);
	
	$frst_page = 1;
	$prev_page = 1;
	$next_page = $pages;
	$last_page = $pages;
				
	if($start_page < $pages) $next_page = $start_page+1;
	if($start_page > 1) $prev_page = $start_page-1;
	
	// Filter JS open
	
	if(isset($_COOKIE['filter-1']) && $_COOKIE['filter-1']) $data['filter']['f1'] = 1;
	if(isset($_COOKIE['filter-2']) && $_COOKIE['filter-2']) $data['filter']['f2'] = 1;
	if(isset($_COOKIE['filter-3']) && $_COOKIE['filter-3']) $data['filter']['f3'] = 1;
	
	// Prepare filter data
	
	/*$catalogList = $zh->getCatalogList();
	
	// Prepare arrays for filter
	
	$catalogListFilter = array();
	foreach($catalogList as $catalogItem)
	{
		$catalogListFilter[$catalogItem['name']]=$catalogItem['id'];
	}
	*/
	
	$catalogList = $zh->getCatalogParents();

	$mf_list = $zh->getAllMf();

	$delivers_list = $zh->getAllDelivers();

	// Prepare arrays for filter

	$mfListFilter = array();
	foreach($mf_list as $mfItem)
	{
		$mfListFilter[$mfItem['name']]=$mfItem['id'];
	}

	$deliverListFilter = array();
	foreach($delivers_list as $deliverItem)
	{
		$deliverListFilter[$deliverItem['name']]=$deliverItem['id'];
	}

	
	// Filter arrays

	$filter1_options = array( 'По ID'=>'M.id', 'По имени'=>'M.name');
	
	$filter2_options = array( 
							'Публикация' => array( 'fieldName'=>'M.block', 'params' => array('Yes'=>'0', 'No'=>'1') ) ,
							'Категория' => array( 'fieldName'=>'C.id', 'params' => $catalogList, 'type'=>'allCatalog' )
							/*'Производитель' => array( 'fieldName'=>'M.mf_id', 'params' => $mfListFilter ),
							'Поставщик' => array( 'fieldName'=>'M.deliver_id', 'params' => $deliverListFilter )*/
							);
							
	$filter3_options = array( 
							'sort' => array( 'ID'=>'id', 'Названию'=>'name', 'Категории'=>'cat_name'),
							'order' => array( 'По возрастанию'=>'', 'По убыванию'=>' DESC' ) 
							);
	// Start data content
	
	$filterFormParams = array(	'params'=>$params, 
								'headParams'=>$headParams, 
								'filter1_options'=>$filter1_options, 
								'filter2_options'=>$filter2_options, 
								'filter3_options'=>$filter3_options, 
								'on_page'=>$on_page 
							  );
	
	$filterFormStr = $zh->getLandingFilterForm($filterFormParams);
	
	// Table structure
	
	$tableColumns = array(
						  'Checkbox'		=>	array('type'=>'checkbox',	'field'=>''),
						  'ID'				=>	array('type'=>'text',		'field'=>'id'),
						  /*'Артикул'			=>	array('type'=>'text',		'field'=>'sku'),*/
						  'Название'		=>	array('type'=>'text',		'field'=>'name'),
						  /*'Производитель'	=>	array('type'=>'text',		'field'=>'mf_name'),*/
						  /*'Поставщик'   	=>	array('type'=>'text',		'field'=>'deliver_name'),
							'Кто создал'	=>	array('type'=>'text',		'field'=>'admin_name',				'params'=>array( 'secondField'=>'admin_fname', 'separate'=>" " ) ),*/
						  'Категория'   	=>	array('type'=>'parent',		'field'=>'cat_name'),
						  'Публицакия'  	=>	array('type'=>'block',		'field'=>'block'),
						  'Просмотр'		=>	array('type'=>'cardView',	'field'=>'Смотреть'),
						  'Редактирование'	=>	array('type'=>'cardEdit',	'field'=>'Редактировать')
						  );
	
	$tableParams = array( 'itemsList'=>$itemsList, 'tableColumns'=>$tableColumns, 'headParams'=>$headParams );
	
	$tableStr = $zh->getItemsTable($tableParams);
	
	// START PAGINATION
	
	$pagiParams = array( 'headParams'=>$headParams, 'start_page'=>$start_page, 'pages'=>$pages, 'on_page'=>$on_page );
	
	$pagiStr = $zh->getLandingPagination($pagiParams);
	
	// Join Content
	
	$data['bodyContent'] = $filterFormStr;
	
	$data['bodyContent'] .= $tableStr;
	
	$data['bodyContent'] .= $pagiStr;

?>