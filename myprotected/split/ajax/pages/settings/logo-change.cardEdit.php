<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'global-settings' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getLogoItem($item_id);

	$rootPath = "../../../../..";
	
	$file_field_size = $cardItem['w'] . "x" . $cardItem['h'];

	$cardTmp = array(
					 'Лого в шапке ('.$file_field_size.')'=>	array( 'type'=>'image_mono','field'=>'file', 		'params'=>array( 'path'=>"/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id, 'option_delete'=>false ) ),
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editSiteLogo", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Логотипы сайта (режим редактирования)</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>