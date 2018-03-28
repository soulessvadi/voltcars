<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'global-settings' );
	
	$data['headContent'] = $zh->getCardViewHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getLogoItem($item_id);

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 
					 'ID'					=>	array( 'type'=>'text', 		'field'=>'id', 	'params'=>array() ),
					 'Alias'				=>	array( 'type'=>'text', 		'field'=>'alias', 	'params'=>array() ),
					 'Изображение'			=>	array( 'type'=>'image',		'field'=>'file',			'params'=>array( 'path'=>'/split/files/images/' ) ),
					 'Правильное имя файла'	=>	array( 'type'=>'text',		'field'=>'filename_tmp',			'params'=>array(  ) )


					 );

	$cardViewTableParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath );
	
	$cardViewTableStr = $zh->getCardViewTable($cardViewTableParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3>Логотипы сайта (режим просмотра)</h3>";
	
	$data['bodyContent'] .= $cardViewTableStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>