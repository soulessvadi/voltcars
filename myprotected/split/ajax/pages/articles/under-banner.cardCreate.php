<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardCreateHeader($headParams);
	
	// Start body content

	$cardItem = $zh->getSecondaryBannerItem($item_id);
	
	// Get positions List
	
	$mainBanners = $zh->getMainBanners();
	
	// Get categories List
	
	$catsList = $zh->getCatsList();

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название'				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>50, 'hold'=>'Name', 'onchange'=>"change_alias();" ) ),
					 
					 'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Alias' ) ),
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 
					 
					 'Главный баннер'		=>	array( 'type'=>'select', 	'field'=>'parent', 			'params'=>array( 'list'=>$mainBanners, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['parent'], 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'Не выбран', 'id'=>0 ) 
																														 ) ),
					 
					
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Содержание'			=>	array( 'type'=>'redactor', 	'field'=>'data', 			'params'=>array(  ) ),
					 
					 'Изображение'			=>	array( 'type'=>'header'),
					 
					 'Изображение баннера'=>	array( 'type'=>'image_mono','field'=>'file', 			'params'=>array( 'path'=>"/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),
					 
					 'Имя изображения'		=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"file" ) )
					 
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"createSecondaryBanner", 'ajaxFolder'=>'create', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
	
			<h3 class='new-line'>Форма создания вложенного баннера</h3>";
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>