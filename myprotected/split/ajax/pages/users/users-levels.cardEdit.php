<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'users-levels' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getUserTypeInfo($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 
					 'Имя группы'			=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>25, 'hold'=>'Name', 'onchange'=>"change_alias();" ) ),
					 
					 'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>25, 'hold'=>'Alias' ) ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Доступ в админ'		=>	array( 'type'=>'block', 	'field'=>'admin_enter', 	'params'=>array( 'reverse'=>false ) ),
					 
					 'Смена пароля'			=>	array( 'type'=>'block', 	'field'=>'change_login', 	'params'=>array( 'reverse'=>false ) )
					 
					 );
					 
	foreach($cardItem['parents'] as $parent)
	{
		$cardTmp[$parent['name']] = array( 'type'=>'header');
		
		foreach($parent['childs'] as $child)
		{
			$cardTmp[$child['name']] = array( 'type'=>'block', 	'field'=>'ac', 	'params'=>array( 'reverse'=>false, 'type'=>'selfName', 'id'=>$child['id'], 'value'=>$child['access'] ) );
		}
	}

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editUsersTypes", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования группы пользователей #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>