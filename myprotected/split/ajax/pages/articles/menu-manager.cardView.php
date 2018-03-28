<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getMenuItem($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Пункт меню'				=>	array( 'type'=>'text', 		'field'=>'name', 			'params'=>array() ),
					 /*'Подпись'					=>	array( 'type'=>'text', 		'field'=>'link', 			'params'=>array() ),*/
					 'Алиас'					=>	array( 'type'=>'text', 		'field'=>'alias', 			'params'=>array() ),
					 'ID'						=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),
					 'Позиция'					=>	array( 'type'=>'text', 		'field'=>'pos_id', 			'params'=>array() ),
					 //'Изображение'				=>	array( 'type'=>'image',		'field'=>'filename',		'params'=>array( 'path'=>'/split/files/banners/' ) ),
					 //'Отображать в шапке?'		=>	array( 'type'=>'text', 		'field'=>'top_view', 		'params'=>array( 'replace'=>array('0'=>'Нет', '1'=>'Да') ) ),
					 'Публикация'				=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Да', '1'=>'Нет') ) ),
					 'Заголовок'				=>	array( 'type'=>'text', 		'field'=>'header', 		'params'=>array() ),
					 'Подзаголовок'				=>	array( 'type'=>'text', 		'field'=>'sub_header', 		'params'=>array() ),
					 'Содержание'				=>	array( 'type'=>'text', 		'field'=>'details', 		'params'=>array() ),
					 'Открывать в новом окне?'	=>	array( 'type'=>'text', 		'field'=>'target', 			'params'=>array( 'replace'=>array('0'=>'Нет', '1'=>'Да') ) ),
					 'Дата создания'			=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array() ),
					 'Дата редактирования'		=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array() ),

					 'Meta-title'			=>	array( 'type'=>'text', 		'field'=>'meta_title', 		'params'=>array() ),
					 'Meta-keywords'		=>	array( 'type'=>'text', 		'field'=>'meta_keys', 	'params'=>array() ),
					 'Meta-description'		=>	array( 'type'=>'text', 		'field'=>'meta_desc', 	'params'=>array() )
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Детальный просмотр пункта меню #$item_id</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>