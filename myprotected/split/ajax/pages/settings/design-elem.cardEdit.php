<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getDesignItem($item_id);

	$rootPath = "../../../../..";

	$cardTmp = array(
					'Алиас'		=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>35, 'hold'=>'Алиас' ) ),
					
					'clear-1'		=>	array( 'type'=>'clear' ),

					'HTML'		=>	array( 'type'=>'redactor', 	'field'=>'html', 		'params'=>array() ),

					'clear-2'		=>	array( 'type'=>'clear' ),

					'Шаблон'		=>	array( 'type'=>'code_html', 	'field'=>'template', 		'params'=>array() )

					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editDesignElem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Инфо блок (режим редактирования)</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>