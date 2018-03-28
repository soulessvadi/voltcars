<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable, 'type'=>'menu_edit' );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getMenuItem($item_id);
	
	// Get positions List
	
	$sitePositions = $zh->getPositions();
	
	// Get formats List
	
	$menuFormats = $zh->getMenuFormats();
	
	// Get Menu Categories
	
	$menuCategories = $zh->getCatsList();

	// Get Galleries List
	
	$galleriesList = $zh->getGalleriesList();
	
	$currRelations = (strlen($cardItem['relation']) > 3 ? unserialize($cardItem['relation']) : array());
	
	$hiddenRel_2 = true;
	$hiddenRel_3 = true;
	
	if($cardItem['type']==2) $hiddenRel_2 = false;
	if($cardItem['type']==3) $hiddenRel_3 = false;
	

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Пункт меню'			=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>50, 'hold'=>'Name', 'onchange'=>"change_alias();" ) ),

					 'Заголовок'			=>	array( 'type'=>'input', 	'field'=>'header', 			'params'=>array( 'size'=>50, 'hold'=>'Заголовок') ),

					 'Подзаголовок'			=>	array( 'type'=>'input', 	'field'=>'sub_header', 			'params'=>array( 'size'=>50, 'hold'=>'Подзаголовок') ),

					 
					 /*'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Alias' ) ),*/
					 
					 /*'Подпись'				=>	array( 'type'=>'input', 	'field'=>'link', 			'params'=>array( 'size'=>75, 'hold'=>'Link' ) ),*/
					 
					 'clear-1'				=>	array( 'type'=>'clear' ),
					 

					 'clear-2'				=>	array( 'type'=>'clear' ),
					 
					 'Позиция'				=>	array( 'type'=>'input', 	'field'=>'pos_id', 			'params'=>array( 'size'=>25, 'hold'=>'#Position' ) ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 /*'Отображать в шапке?'	=>	array( 'type'=>'block', 	'field'=>'top_view', 		'params'=>array( 'reverse'=>false ) ),*/
					 
					 'В новом окне?'		=>	array( 'type'=>'block', 	'field'=>'target', 			'params'=>array( 'reverse'=>false ) ),
					 
					 'Содержание'			=>	array( 'type'=>'redactor', 	'field'=>'details', 		'params'=>array(  ) ),
					 
					 'clear-3'				=>	array( 'type'=>'clear' ),

					 'Мета-теги'			=>	array( 'type'=>'header'),
					 
					 'Title'				=>	array( 'type'=>'input', 	'field'=>'meta_title', 			'params'=>array( 'size'=>50, 'hold'=>'Title' ) ),
					 'Keywords'				=>	array( 'type'=>'input', 	'field'=>'meta_keys', 			'params'=>array( 'size'=>50, 'hold'=>'Keywords' ) ),
					 'Description'			=>	array( 'type'=>'area', 		'field'=>'meta_desc', 			'params'=>array( 'size'=>50, 'hold'=>'Description' ) )
					 /*
					 'Галлерея'				=>	array( 'type'=>'select', 'field'=>'gallery_id', 'params'=>array( 'list'=>$galleriesList, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['gallery_id'], 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'Без галлереи', 'id'=>0 ) 
																														 ) ),
					 
					 'Дополнительный модуль из (/split/view_parts/pages/modules/)'	=>	array( 'type'=>'input', 	'field'=>'script_name', 'params'=>array( 'size'=>50, 'hold'=>'Script name [.php]' ) ),
					 
					 'clear-4'				=>	array( 'type'=>'clear' ),
					 
					 'Позиция текста из Редактора'		=>	array( 'type'=>'input', 	'field'=>'text_pos', 			'params'=>array( 'size'=>25, 'hold'=>'#Text' ) ),
					 
					 'Позиция Галлереи'					=>	array( 'type'=>'input', 	'field'=>'gallery_pos', 		'params'=>array( 'size'=>25, 'hold'=>'#Gallery' ) ),
					 
					 'Позиция доп. Модуля'	=>	array( 'type'=>'input', 	'field'=>'script_pos', 						'params'=>array( 'size'=>25, 'hold'=>'#Script' ) ),
					 
					 //'Изображения'			=>	array( 'type'=>'header'),
					 
					 //'Изображение пункта меню' =>	array( 'type'=>'image_mono','field'=>'filename', 	'params'=>array( 'path'=>"/split/files/content/", 'appTable'=>$appTable, 'id'=>$item_id ) ),
					 
					 'Имя изображения'		=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"filename" ) ),
					 
					 'Документы'			=>	array( 'type'=>'header'),
					 
					 'Выбор файлов'			=>	array( 'type'=>'image_mult', 'field'=>'docs', 			'params'=>array( 'path'=>"/split/files/documents/", 'appTable'=>$appTable, 'id'=>$item_id, 'field'=>'file' ) )
					 */
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editMenuItem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования пункта меню #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>