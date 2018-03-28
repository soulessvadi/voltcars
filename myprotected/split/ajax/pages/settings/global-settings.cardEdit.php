<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'global-settings' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getSiteConfigs($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название сайта'		=>	array( 'type'=>'input', 	'field'=>'sitename', 			'params'=>array( 'size'=>35, 'hold'=>'Sitename', 'onchange'=>"change_alias();" ) ),

					 'clear-1'				=>	array( 'type'=>'clear' ),

					 'Email техподдержки'	=>	array( 'type'=>'input', 	'field'=>'support_email', 		'params'=>array( 'size'=>35, 'hold'=>'Support Email' ) ),
					 'Email входящих заявок'=>	array( 'type'=>'input', 	'field'=>'orders_email', 		'params'=>array( 'size'=>35, 'hold'=>'Orders Email' ) ),
					 'Email обратной связи'	=>	array( 'type'=>'input', 	'field'=>'feedback_email', 		'params'=>array( 'size'=>35, 'hold'=>'Feedback Email' ) ),

					 

					 'clear-6'				=>	array( 'type'=>'clear' ),

					 'Телефон в шапке'		=>	array( 'type'=>'input', 	'field'=>'header_phone', 		'params'=>array( 'size'=>35, 'hold'=>'(067) 000 0000' ) ),
					 'Номер телефона 1'		=>	array( 'type'=>'input', 	'field'=>'phone_number', 		'params'=>array( 'size'=>35, 'hold'=>'+38 (067) 000 0000' ) ),
					 'Номер телефона 2'		=>	array( 'type'=>'input', 	'field'=>'phone_number2', 		'params'=>array( 'size'=>35, 'hold'=>'+38 (067) 000 0000' ) ),
					 'Номер телефона 3'		=>	array( 'type'=>'input', 	'field'=>'phone_number3', 		'params'=>array( 'size'=>35, 'hold'=>'+38 (067) 000 0000' ) ),

					 'clear-2'				=>	array( 'type'=>'clear' ),

					 'Ссылка Facebook'		=>	array( 'type'=>'input', 	'field'=>'fb_link', 			'params'=>array( 'size'=>35, 'hold'=>'https://www.facebook.com' ) ),
					 'Ссылка VK'		=>	array( 'type'=>'input', 		'field'=>'vk_link', 			'params'=>array( 'size'=>35, 'hold'=>'https://vk.com/' ) ),
					 'Ссылка Google +'		=>	array( 'type'=>'input', 	'field'=>'gp_link', 			'params'=>array( 'size'=>35, 'hold'=>'https://plus.google.com/' ) ),
					 'Ссылка Youtube'		=>	array( 'type'=>'input', 	'field'=>'yt_link', 			'params'=>array( 'size'=>35, 'hold'=>'https://www.youtube.com' ) ),

					 'clear-2'				=>	array( 'type'=>'clear' ),
					 
					 'Адрес'				=>	array( 'type'=>'area', 		'field'=>'address', 			'params'=>array('hold'=>'Адрес' ) ),
					 	
					 'Индексация'			=>	array( 'type'=>'block', 	'field'=>'index', 				'params'=>array( 'reverse'=>false ) ),
					 
					 'Мета теги на главной'	=>	array( 'type'=>'header'),
					 
					 'Title'				=>	array( 'type'=>'input', 	'field'=>'meta_title', 			'params'=>array( 'size'=>50, 'hold'=>'Title', 'onchange'=>"" ) ),
					 
					 'Keywords'				=>	array( 'type'=>'input', 	'field'=>'meta_keys', 			'params'=>array( 'size'=>50, 'hold'=>'Keywords', 'onchange'=>"" ) ),
					 
					 'Description'			=>	array( 'type'=>'area', 		'field'=>'meta_desc', 			'params'=>array( 'size'=>100, 'hold'=>'Description' ) ),
					 
					 'Вставки кода на все страницы'			=>	array( 'type'=>'header'),
					 
					 'HEAD'					=>	array( 'type'=>'area', 		'field'=>'intro_head', 			'params'=>array( 'size'=>100, 'hold'=>'Google Analytics code, etc.' ) ),
					 
					 'aftert BODY'			=>	array( 'type'=>'area', 		'field'=>'intro_foot', 			'params'=>array( 'size'=>100, 'hold'=>'Счетчики и т.д.' ) ),
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editSiteConfig", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Глобальные настройки сайта (режим редактирования)</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>