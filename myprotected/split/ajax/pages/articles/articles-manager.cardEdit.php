<?php 
	// Start header content

	$headParams = array( 'parent'=>$parent, 'alias'=>$alias, 'id'=>$id, 'item_id'=>$item_id, 'appTable'=>$appTable );
	
	$data['headContent'] = $zh->getCardEditHeader($headParams);
	
	// Start body content
	
	$cardItem = $zh->getArticleItem($item_id);
	
	// Get positions List
	
	$sitePositions = $zh->getPositions();
	
	// Get formats List
	
	$menuFormats = $zh->getMenuFormats();
	
	// Get Menu Categories
	
	$catsList = $zh->getCatsList();

	// Get Galleries List
	
	$galleriesList = $zh->getGalleriesList();

	$rootPath = "../../../../..";
	
	$cardTmp = array(
					 'Название'				=>	array( 'type'=>'input', 	'field'=>'name', 			'params'=>array( 'size'=>125, 'hold'=>'Name', 'onchange'=>"change_alias();" ) ),
					 
					 'Алиас'				=>	array( 'type'=>'input', 	'field'=>'alias', 			'params'=>array( 'size'=>50, 'hold'=>'Alias' ) ),
					 
					 'clear-0'				=>	array( 'type'=>'clear' ),
					 
					 'Публикация'			=>	array( 'type'=>'block', 	'field'=>'block', 			'params'=>array( 'reverse'=>true ) ),
					 
					 'Дата публикации'		=>	array( 'type'=>'date', 		'field'=>'dateCreate', 		'params'=>array(  ) ),
					 
					 'Позиция'				=>	array( 'type'=>'input', 	'field'=>'pos_id', 			'params'=>array( 'size'=>25, 'hold'=>'#Position' ) ),
					 
					  'В новом окне?'		=>	array( 'type'=>'block', 	'field'=>'target', 			'params'=>array( 'reverse'=>false ) ),
					  
					  
					 
					
					
					 'Категория материалов'	=>	array( 'type'=>'select', 	'field'=>'cat_id', 		'params'=>array( 'list'=>$catsList, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['cat_id'], 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'No select', 'id'=>0 ) 
																														 ) ),
					 
					/*'Видеоматериал?'		=>	array( 'type'=>'block', 	'field'=>'is_video', 		'params'=>array( 'reverse'=>false ) ),*/
					
					 'clear-2'				=>	array( 'type'=>'clear' ),
					 
					 'Содержание'			=>	array( 'type'=>'redactor', 		'field'=>'content', 	'params'=>array(  ) ),
					 
					 'clear-3'				=>	array( 'type'=>'clear' ),
					 
					 'Галлерея'				=>	array( 'type'=>'select', 'field'=>'gallery_id', 'params'=>array( 'list'=>$galleriesList, 
					 																									 'fieldValue'=>'id', 
																														 'fieldTitle'=>'name', 
																														 'currValue'=>$cardItem['gallery_id'], 
																														 'onChange'=>"", 
																														 'first'=>array( 'name'=>'Без галлереи', 'id'=>0 ) 
																														 ) ),
					 
					 /*'Дополнительный модуль из (/split/view_parts/pages/modules/)'	=>	array( 'type'=>'input', 	'field'=>'script_name', 'params'=>array( 'size'=>50, 'hold'=>'Script name [.php]' ) ),*/
					 
					 'clear-4'				=>	array( 'type'=>'clear' ),
					 
					 /*'Позиция текста из Редактора'		=>	array( 'type'=>'input', 	'field'=>'text_pos', 			'params'=>array( 'size'=>25, 'hold'=>'#Text' ) ),
					 
					 'Позиция Галлереи'					=>	array( 'type'=>'input', 	'field'=>'gallery_pos', 		'params'=>array( 'size'=>25, 'hold'=>'#Gallery' ) ),
					 
					 'Позиция доп. Модуля'	=>	array( 'type'=>'input', 	'field'=>'script_pos', 						'params'=>array( 'size'=>25, 'hold'=>'#Script' ) ),*/
					 
					 'Изображения'			=>	array( 'type'=>'header'),
					 
					 'Изображение материала'=>	array( 'type'=>'image_mono','field'=>'filename', 		'params'=>array( 'path'=>"/split/files/images/", 'appTable'=>$appTable, 'id'=>$item_id ) ),
					 
					 'Имя изображения'		=>	array( 'type'=>'hidden',	'field'=>'curr_filename', 	'params'=>array( 'field'=>"filename" ) ),
					 
					 /*'Документы'			=>	array( 'type'=>'header'),
					 
					 'Выбор файлов'			=>	array( 'type'=>'image_mult', 'field'=>'docs', 			'params'=>array( 'path'=>"/split/files/documents/", 'appTable'=>$appTable, 'id'=>$item_id, 'field'=>'file' ) )*/

					 'Мета-теги'			=>	array( 'type'=>'header'),
					 
					 'Title'				=>	array( 'type'=>'input', 	'field'=>'meta_title', 			'params'=>array( 'size'=>50, 'hold'=>'Title' ) ),
					 'Keywords'				=>	array( 'type'=>'input', 	'field'=>'meta_keys', 			'params'=>array( 'size'=>50, 'hold'=>'Keywords' ) ),
					 'Description'			=>	array( 'type'=>'area', 		'field'=>'meta_desc', 			'params'=>array( 'size'=>50, 'hold'=>'Description' ) )
					 
					 );

	$cardEditFormParams = array( 'cardItem'=>$cardItem, 'cardTmp'=>$cardTmp, 'rootPath'=>$rootPath, 'actionName'=>"editArticleItem", 'ajaxFolder'=>'edit', 'appTable'=>$appTable );
	
	$cardEditFormStr = $zh->getCardEditForm($cardEditFormParams);
	
	// Join content
	
	$data['bodyContent'] .= "
		<div class='ipad-20' id='order_conteinter'>
			<h3 class='new-line'>Форма редактирования материала #$item_id</h3>";
	
	$data['bodyContent'] .= $cardEditFormStr;
				
	$data['bodyContent'] .=	"
		</div>
	";

?>