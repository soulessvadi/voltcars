<?php
	$response = array('title'=>'Выгрузка в XML HotLine Продукции по фильтру', 'status'=>'error', 'message'=>'Error');
	
	require_once "../../require.base.php";
	
	require_once "../library/AjaxHelp.php";
	
	$ah = new ajaxHelp($dbh);
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$data_arr = array();
	
	$cur_date = date("Y-m-d H-i-s");
	$fileName = "products-hotline-xml/ms-hotline-export-products.xml";
	

	///////////////////////////////////////////////////////////////
	// GET PRODUCTS
	
	$params = array();
	
	$params['filtr'] = $_POST['filtr'];
	
	if($params['filtr'])
		{
			parse_str($params['filtr'],$prmFiltr);
		}else
		{
			$prmFiltr = array();
		}
	$params['filtr'] = $prmFiltr;
	
	$appTable = "shop_products"; // Main table

	$params['filtr']['massive']['hotline'] = 1;

	$products = $ah->getAllShopProducts($params);
	
	$allCatalog = $ah->getAllCatalogList();
	
	$allCatalog = $ah->getAllCatalogList();
	
	///////////////////////////////////////////////////////////////


	//=============================================================
	// XML GENERATOR
	//=============================================================
	
	$dom = new domDocument("1.0", "utf-8"); 						// Создаём XML-документ версии 1.0 с кодировкой utf-8
  	
	$root = $dom->createElement("price"); 							// Создаём корневой элемент
  	
	$dom->appendChild($root);
	
	
	$date 		= $dom->createElement("date",date("Y-m-d H:i"));
	
	$firmName 	= $dom->createElement("firmName","MyStore");
	
	$firmId 	= $dom->createElement("firmId",20362);
	
	$rate 		= $dom->createElement("rate",$ah->USD_EX);
	
	
	$root->appendChild($date);
	
	$root->appendChild($firmName);
	
	$root->appendChild($firmId);
	
	$root->appendChild($rate);
	
	
	$categories 	= $dom->createElement("categories");
	
	foreach($allCatalog as $catalogItem)
	{
		$category 	= $dom->createElement("category");
		
			$categId = $dom->createElement("id",$catalogItem['id']);
			
			$category->appendChild($categId);
			
			$categName = $dom->createElement("name",$catalogItem['name']);
			
			$category->appendChild($categName);
			
			if($catalogItem['parent'])
			{
				$parentId = $dom->createElement("parentId",$catalogItem['parent']);
				
				$category->appendChild($parentId);
			}
			
		$categories->appendChild($category);
	}
	
	$root->appendChild($categories);

  	
	$items = $dom->createElement("items");
	
	foreach($products as $product)
	{
		$item = $dom->createElement("item");
	
			// params INI start
			
			$curr_link = "http://mystore.com.ua";
								
			$img_url = $curr_link."/split/files/shop/products/".$product['filename'];
								
			foreach($product['cat_tree'] as $ct_item)
			{
				$curr_link .= "/".$ct_item['alias'];
			}
			
			$curr_link .= "/".$product['alias'];
			
			$price_UAH = (!$product['sale_price'] ? $product['price'] : $product['sale_price']);
			
			$price_USD = $product['usd_price'];
		
			$price_OLD = ($product['sale_price'] ? $product['price'] : $product['sale_price']);
			
			// params INI finish
		
			$id 			= $dom->createElement("id",			$product['id']);
			$item->appendChild($id);
			
			$categoryId 	= $dom->createElement("categoryId",	$product['cat_id']);
			$item->appendChild($categoryId);
			
			$code 			= $dom->createElement("code",		$product['sku']);
			$item->appendChild($code);
			
			$barcode 		= $dom->createElement("barcode",	$product['code']);
			$item->appendChild($barcode);
			
			$vendor 		= $dom->createElement("vendor",		$product['mf_name']);
			$item->appendChild($vendor);
			
			$name 			= $dom->createElement("name",		strip_tags(trim(str_replace("&nbsp;"," ",(str_replace("</div>"," ",str_replace("</p>"," ",str_replace("</li>"," ",$product['name']))))))));
			$item->appendChild($name);
			
			$description 	= $dom->createElement("description",strip_tags(trim(str_replace("&nbsp;"," ",(str_replace("</div>"," ",str_replace("</p>"," ",str_replace("</li>"," ",$product['details']))))))));
			$item->appendChild($description);
			
			$url 			= $dom->createElement("url",		$curr_link);
			$item->appendChild($url);
			
			$image 			= $dom->createElement("image",		$img_url);
			$item->appendChild($image);
			
			$priceRUAH 		= $dom->createElement("priceRUAH",	$price_UAH);
			$item->appendChild($priceRUAH);
			
			if($product['sale_price'])
			{
				$oldprice 		= $dom->createElement("oldprice",	$price_OLD);
				$item->appendChild($oldprice);
			}
			if($price_USD)
			{
				$priceRUSD 		= $dom->createElement("priceRUSD",	$price_USD);
				$item->appendChild($priceRUSD);
			}
			
			$stock 			= $dom->createElement("stock",		"В наличии");
			$item->appendChild($stock);
			
			$guarantee 		= $dom->createElement("guarantee",	"12 месяцев, от производителя");
			$item->appendChild($guarantee);
		
			/*
            <param name="Страна изготовления">Украина</param>
	    	<param name="Оригинальность">Оригинал</param>
			*/
		
		$items->appendChild($item);
	}
	
	$root->appendChild($items);
	
	$dom->save($fileName); // Сохраняем полученный XML-документ в файл
	
	/*
		$user->setAttribute("id", $id); 							// Устанавливаем атрибут "id" у узла "user"  
	*/
	
	
	/*
	
	ob_start();
	
	echo "<pre>PRODUCTS:"; print_r($products); echo "</pre>";
	
	$response['message'] = ob_get_contents();
		
	ob_end_clean();

	*/

	$response['status'] = "success";
	$response['message'] = "<p><a href='split/excel/".$fileName."' target='_blank'>Открыть сформированный XML файл</a></p>";
	
	echo json_encode($response);