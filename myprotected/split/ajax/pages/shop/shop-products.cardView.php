<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getProductsItemDetails($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название'				=>	array( 'type'=>'text', 		'field'=>'name', 			'params'=>array() ),
					 'Категория'			=>	array( 'type'=>'arr_mono',	'field'=>'category', 		'params'=>array( 'fields' => array('brand_name','name') ) ),
					 'ID'					=>	array( 'type'=>'text', 		'field'=>'id', 				'params'=>array() ),
					 'Алиас'				=>	array( 'type'=>'text', 		'field'=>'alias', 			'params'=>array() ),
					 'Описание'				=>	array( 'type'=>'text', 		'field'=>'details', 			'params'=>array() ),
					 'Цена (USD)'			=>	array( 'type'=>'text', 		'field'=>'price', 			'params'=>array() ),
					 'Публикация'			=>	array( 'type'=>'text', 		'field'=>'block', 			'params'=>array( 'replace'=>array('0'=>'Да', '1'=>'Нет') ) ),
					 
					 
					 'Изображения'			=>	array( 'type'=>'images',	'field'=>'images',			'params'=>array( 'path'=>'/split/files/shop/products/', 'field'=>'file' ) ),


					 'Meta-title'			=>	array( 'type'=>'text', 		'field'=>'title', 		'params'=>array() ),
					 'Meta-keywords'		=>	array( 'type'=>'text', 		'field'=>'keys', 		'params'=>array() ),
					 'Meta-description'		=>	array( 'type'=>'text', 		'field'=>'desc', 		'params'=>array() ),

					

					 'Дата создания'		=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array() ),
					 'Дата редактирования'	=>	array( 'type'=>'date', 		'field'=>'dateModify', 		'params'=>array() )
					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Детальный просмотр карточки товара</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>