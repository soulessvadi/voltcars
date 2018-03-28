<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getProductCommentItem($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'ID отзыва'					=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),
					 'ID товара'					=>	array( 'type'=>'text', 		'field'=>'prod_id', 				'params'=>array() ),
					 'Товар'					=>	array( 'type'=>'text', 		'field'=>'prod_name', 		'params'=>array() ),
					 'Пользователь'			=>	array( 'type'=>'text', 		'field'=>'user_email', 		'params'=>array() ),
					 'Имя на сайте'			=>	array( 'type'=>'text', 		'field'=>'user_name', 		'params'=>array() ),
					 'Имя в комментарии'		=>	array( 'type'=>'text', 		'field'=>'name', 			'params'=>array() ),
					 'Рейтинг'				=>	array( 'type'=>'text', 		'field'=>'rating', 			'params'=>array() ),
					 'Заголовок'				=>	array( 'type'=>'text', 		'field'=>'caption', 		'params'=>array() ),
					 'Комментарий'			=>	array( 'type'=>'text', 		'field'=>'comment', 		'params'=>array() ),
					 
					 'Публикация'			=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Да', '1'=>'Нет') ) ),
					 
					 'Дата создания'		=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array() ),
					 'Дата редактирования'	=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array() )
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Детальный просмотр отзыва к товару</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>