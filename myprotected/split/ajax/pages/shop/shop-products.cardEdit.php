<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getProductsItemDetails($item_id);

	$catalogList = $zh->getCatalogParents();
	
	$charsGroups = $zh->getCharsGroups();
	
	$productsGroups = $zh->getProductsGroups();

	$galleriesList = $zh->getGalleriesList();

	//$mf_list = $zh->getCategoryMf($cardItem['category']['id']);
	
	$mf_list = $zh->getAllMf();

	$delivers_list = $zh->getAllDelivers();

	$access_list = $zh->getProdAccessuares($item_id);
	
	$complect_list = $zh->getProdComplect($item_id);
	
	$colors = $zh->getColors();

	$rootPath = "../../../../..";
	
	$tmp = array();
	
	$cardTmp = array(
					 'Название'				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>50, 'hold'=>'Наименование', 'onchange'=>"change_alias();" ) ),
					 
					'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>25, 'hold'=>'Алиас' ) ),

					'Категория'			=>	array( 'type'=>'select', 	'field'=>'cat_id', 			'params'=>array( 'list'=>$catalogList, 
					 																									 'type'=>'allCatalog', 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['category']['id'], 
					'onChange'=>"updateProductCharsForm(".$cardItem['category']['id'].",".str_replace('"',"'",json_encode($cardItem['charsGroup'])).",".str_replace('"',"'",json_encode($cardItem['chars'])).",$(this).val(), ".$item_id.");", 
																														 'first'=>array( 'name'=>'-- Без категории --', 'id'=>0 ) 
																														 ) ),

					'Цена (USD)'			=>	array( 'type'=>'input', 	'field'=>'price', 			'params'=>array( 'size'=>25, 'hold'=>'Цена (USD)' ) ),

					'Сопровождающий текст'	=>	array( 'type'=>'input', 	'field'=>'dop_text', 		'params'=>array( 'size'=>100, 'hold'=>'Текст возле наименования товара' ) ),
					 					 
					//'Описание товара'		=>	array( 'type'=>'redactor', 	'field'=>'details', 		'params'=>array(  ) ),

					'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),


					 
					'clear-0'				=>	array( 'type'=>'clear' ),
					 
					'Характеристики товара'			=>	array( 'type'=>'header'),
					 
					/*
					'Модель'				=>	array( 'type'=>'input', 	'field'=>'model', 			'params'=>array( 'size'=>25, 'hold'=>'Название модели' ) ),

					'Цвет'					=>	array( 'type'=>'select', 	'field'=>'color_id', 		'params'=>array( 'list'=>$colors, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>0, 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'Выберите цвет', 'id'=>0 ) 
																														 ) ),

					'Комплектация'			=>	array( 'type'=>'area', 	'field'=>'equipment', 			'params'=>array( 'size'=>20, 'hold'=>'Комплектация товара' ) ),
					 
					*/

					'Текущая категория'		=>	array( 'type'=>'hidden',	'field'=>'prevent_cat_id', 	'params'=>array( 'field'=>"category", 'arr_field'=>'id' ) ),
					
					'Наличие свойств'		=>	array( 'type'=>'hidden', 	'field'=>'has_chars', 		'params'=>array( 'size'=>25, 'hold'=>'Has chars?' ) ),
					
					$cardItem['charsGroup']['name'] => array( 'type'=>'shopProductChars', 'field'=>'char', 'params'=>array('chars'=>$cardItem['chars'],'has_chars'=>$cardItem['has_chars']) ),

					 
					'clear-5'				=>	array( 'type'=>'clear' ),
					 
					'Описание товара'		=>	array( 'type'=>'redactor', 	'field'=>'details', 		'params'=>array(  ) ),
					 

					'clear-1'				=>	array( 'type'=>'clear' ),

					/*

					'Год выпуска'			=>	array( 'type'=>'input', 	'field'=>'year', 			'params'=>array( 'size'=>25, 'hold'=>'Год выпуска' ) ),

					'Пробег'				=>	array( 'type'=>'input', 	'field'=>'mileage', 		'params'=>array( 'size'=>25, 'hold'=>'Пробег' ) ),

					'Цена (грн)'			=>	array( 'type'=>'input', 	'field'=>'price', 			'params'=>array( 'size'=>25, 'hold'=>'Цена (грн)' ) ),

					'Дополнительные опции'	=>	array( 'type'=>'area', 	'field'=>'ad_options', 			'params'=>array( 'size'=>25, 'hold'=>'Дополнительные опции' ) ),

					*/
					 
					'clear-3'				=>	array( 'type'=>'clear' ),
					 					 
					'Изображения'			=>	array( 'type'=>'header'),

					'Галлерея'				=>	array( 'type'=>'select', 'field'=>'gallery_id', 'params'=>array( 'list'=>$galleriesList, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['gallery_id'], 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'Без галлереи', 'id'=>0 ) 
																														 ) ),
					 
					'Выбор файлов (960x555 px)'			=>	array( 'type'=>'image_mult','field'=>'images', 		'params'=>array( 'path'=>"/split/files/shop/products/", 'appTable'=>$appTable, 'id'=>$item_id, 'field'=>'file', 'method'=>'edit' ) ),

					'Мета-теги'			=>	array( 'type'=>'header'),
					 
					 'Title'				=>	array( 'type'=>'input', 	'field'=>'title', 			'params'=>array( 'size'=>50, 'hold'=>'Title' ) ),
					 'Keywords'				=>	array( 'type'=>'input', 	'field'=>'keys', 			'params'=>array( 'size'=>50, 'hold'=>'Keywords' ) ),
					 'Description'			=>	array( 'type'=>'area', 		'field'=>'desc', 			'params'=>array( 'size'=>50, 'hold'=>'Description' ) )
										
					 );
		
		

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editShopProductsItem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Next/Prev product links
	
	$prev_link = "";
	$next_link = "";
	
	if($cardItem['prev_prod'])
	{
		$prev_link = "<a style='float:left; color:green;' href='javascript:void(0);' title='".stripslashes($cardItem['prev_prod']['name'])."' onclick=\"loadPage('shop','shop-products',18,".$cardItem['prev_prod']['id'].",'cardEdit',{});\">&lsaquo; Предыдущий товар</a>";
	}
	
	if($cardItem['next_prod'])
	{
		$next_link = "<a style='float:right; color:green;' href='javascript:void(0);' title='".stripslashes($cardItem['next_prod']['name'])."' onclick=\"loadPage('shop','shop-products',18,".$cardItem['next_prod']['id'].",'cardEdit',{});\">Следующий товар &rsaquo;</a>";
	}
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<div class='new-line' style='text-align:center; min-height:20px;'>$prev_link Форма редактирования карточки товара #$item_id $next_link</div>
			<div class='clear'></div>
			";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>