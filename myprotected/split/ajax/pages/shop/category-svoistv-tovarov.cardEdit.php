<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getCharsGroupItem($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название'				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>25, 'hold'=>'Name', 'onchange'=>"change_alias();" ) ),
					 
					 'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>25, 'hold'=>'Alias' ) ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Описание категории'	=>	array( 'type'=>'area', 		'field'=>'details', 		'params'=>array(  ) ),
					 
					 'Порядок свойств:'		=>	array( 'type'=>'header' ),
					 
					 'Свойства категории'	=>  array( 'type'=>'chars_list', 'field'=>'chars',			'params'=>array( ) )
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editShopCharsGroup", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования группы свойств #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>