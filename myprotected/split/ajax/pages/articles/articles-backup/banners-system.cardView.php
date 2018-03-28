<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getBannerItem($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название'					=>	array( 'type'=>'text', 		'field'=>'name', 			'params'=>array() ),
					 'ID'						=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),
					 'Позиция'					=>	array( 'type'=>'text', 		'field'=>'pos_name', 		'params'=>array() ),
					 
					 'Товаров'					=>	array( 'type'=>'text', 		'field'=>'prod_count', 		'params'=>array() ),
					 'Аксессуаров'				=>	array( 'type'=>'text', 		'field'=>'access_count', 	'params'=>array() ),
					 
					 'Изображение'				=>	array( 'type'=>'image',		'field'=>'file',			'params'=>array( 'path'=>'/split/files/props/' ) ),
					 'Публикация'				=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Да', '1'=>'Нет') ) ),
					 'Содержание'				=>	array( 'type'=>'text', 		'field'=>'data', 			'params'=>array() ),
					 'Алиас'					=>	array( 'type'=>'text', 		'field'=>'alias', 			'params'=>array() ),
					 'Начало публикации'		=>	array( 'type'=>'date', 		'field'=>'startPublish', 	'params'=>array() ),
					 'Завершение публикации'	=>	array( 'type'=>'date', 		'field'=>'finishPublish', 	'params'=>array() ),
					 'Ссылка'					=>	array( 'type'=>'text', 		'field'=>'link', 			'params'=>array() ),
					 'Открывать в новом окне?'	=>	array( 'type'=>'text', 		'field'=>'target', 			'params'=>array( 'replace'=>array('0'=>'Нет', '1'=>'Да') ) ),
					 'Дата создания'			=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array() ),
					 'Дата редактирования'		=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array() )
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Детальный просмотр баннера #$item_id</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>