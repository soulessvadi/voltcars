<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'global-settings' );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getSiteConfigs($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название сайта'		=>	array( 'type'=>'text', 		'field'=>'sitename', 		'params'=>array() ),

					 'Email техподдержки'		=>	array( 'type'=>'text', 		'field'=>'support_email', 	'params'=>array() ),
					 'Email входящих заявок'	=>	array( 'type'=>'text', 		'field'=>'orders_email', 	'params'=>array() ),
					 'Email обратной связи'		=>	array( 'type'=>'text', 		'field'=>'feedback_email', 	'params'=>array() ),

					 'Телефон в шапке'			=>	array( 'type'=>'text', 		'field'=>'header_phone', 	'params'=>array() ),

					 'Телефон 1'				=>	array( 'type'=>'text', 		'field'=>'phone_number', 	'params'=>array() ),
					 'Телефон 2'				=>	array( 'type'=>'text', 		'field'=>'phone_number2', 	'params'=>array() ),
					 'Телефон 3'				=>	array( 'type'=>'text', 		'field'=>'phone_number3', 	'params'=>array() ),

					 'Ссылка Facebook'			=>	array( 'type'=>'text', 		'field'=>'fb_link', 	'params'=>array() ),
					 'Ссылка VK'				=>	array( 'type'=>'text', 		'field'=>'vk_link', 	'params'=>array() ),
					 'Ссылка Google +'			=>	array( 'type'=>'text', 		'field'=>'gp_link', 	'params'=>array() ),
					 'Ссылка Youtube'			=>	array( 'type'=>'text', 		'field'=>'yt_link', 	'params'=>array() ),

					 'Адрес'				=>	array( 'type'=>'text', 		'field'=>'address', 	'params'=>array() ),

					 'Индексация'			=>	array( 'type'=>'text', 		'field'=>'index', 			'params'=>array( 'replace'=>array('1'=>'Да', '0'=>'Нет') ) ),
					 'Meta title'			=>	array( 'type'=>'text', 		'field'=>'meta_title', 		'params'=>array() ),
					 'Meta keywords'		=>	array( 'type'=>'text', 		'field'=>'meta_keys', 		'params'=>array() ),
					 'Meta description'		=>	array( 'type'=>'text', 		'field'=>'meta_desc', 		'params'=>array() ),
					 'Дата редактирования'	=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array() )
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Глобальные настройки сайта (режим просмотра)</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>