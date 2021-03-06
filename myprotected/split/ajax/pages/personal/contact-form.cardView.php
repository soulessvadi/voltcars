<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'contactFormView' );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getContactMessageItem($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'ID'						=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),
					 'Имя'						=>	array( 'type'=>'text', 		'field'=>'name'),
					 'Email'					=>	array( 'type'=>'text', 		'field'=>'email'),
					 'Сообщение'					=>	array( 'type'=>'style-text', 		'field'=>'message'),
					 
					 
					 'Дата сообщения'			=>	array( 'type'=>'date', 		'field'=>'date_created', 		'params'=>array() ),
					 
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Детальный просмотр сообщения контактной формы #$item_id</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>