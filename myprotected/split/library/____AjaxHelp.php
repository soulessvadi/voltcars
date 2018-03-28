<?php
	/*	MIRACLE WEB TECHNOLOGIES	*/
	/*	***************************	*/
	/*	Author: Sivkovich Maxim		*/
	/*	***************************	*/
	/*	Developed: from 2014		*/
	/*	***************************	*/
	
	// AjaxHelp class
	
class ajaxHelp
{
		public $dbh;
		
		public function __construct($dbh)
		{
			$this->dbh = $dbh;
		} 
		
		public function rs($query,$view=false)
		{
			try
			{
				if($view) echo '<p>'.$query.'</p>';
				
				$_stmt	= $this->dbh->prepare($query);
				$_res	= $_stmt->execute();
				$_arr 	= $_res->fetchallAssoc();
				
				return $_arr;
			}catch(Exception $e)
			{
				echo 'WP WARNING: '.$e;
				return array();
			}
		}
	
	public function getAllCatalogList()
	{
		$query = "SELECT id,name,parent FROM [pre]shop_catalog WHERE 1 ORDER BY parent, id LIMIT 10000";
		
		return $this->rs($query);
	}
		
	
	public function getCatalogParents($catalog=array(), $parent=0, $params=array())
		{
			$query = "SELECT id,parent,name,alias FROM [pre]shop_catalog WHERE `parent`=$parent ORDER BY id LIMIT 10000";
			
			$childs = $this->rs($query);
			
			foreach($childs as $step => $child)
			{
				$childID = $child['id'];
				
				$catalog[$step] = $child; 
				
				$catalog[$step]['childs'] = $this->getCatalogParents(array(),$childID,$params);
			}
			
			return $catalog;
		}
		
	// Send mail
	public function wp_send_letter($to_mail,$from,$subject_mail,$message_mail,$system="MYSTORE")
	{
		try
		{
			$date = date("d.m.y H:i");
			$message_date = "<p> </p><p>Date of send: ".$date."</p>";
			
			$to  = $to_mail." <".$to_mail.">" ;

      		$subject = "=?UTF-8?B?".base64_encode($subject_mail)."?=";

			$message_attach = "<br> <p>Best regards, <a href=\"http://www.mystore.com.ua\">MyStore.com.ua</a></p>".$message_date;

			$message = ' 
				<html> 
  					<head> 
  					<title>'.$system.'</title> 
  					</head> 
  					<body> 
					'.$message_mail.$message_attach.'
  					</body> 
				</html>';
      		//$message = wordwrap($message, 70, "\r\n");

			$to = $to_mail;
			//$subject = $subject_mail;
			//$message = $message_mail;
			
			$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
			$headers .= "MIME-Version: 1.0\r\n"; 
			$headers .= "From: ".$system." <".$from.">\r\n"; 
			//$headers .= "Bcc: ".$from."\r\n";
      		$headers .= "X-Mailer: ".$system." mail sender \r\n";

			if(mail($to, $subject, $message, $headers))
			{
				return true;
			}else{
				
				//echo "<br>From:<br> $from <br>To:<br> $to_mail <br>Message<br>:$message  <br>Headers:<br> $headers";
				
				return false;
			} 
			
		}catch(Exception $e){
			return "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}
		
		// Метод предназначен для создания превью файла
	public function mtvc_ChangeImageSize($filename, $savepath, $ext, $neww, $newh)
  	{
		try{
	 		$idata=getimagesize($filename);
     		$oldw=$idata[0];
     		$oldh=$idata[1];
     		$ext = strtolower($ext);
     		if($ext=='jpg' or $ext=='jpeg')
    		{ 
				$im=@imagecreatefromjpeg($filename);
      			if($im)
      			{
					if($oldw>$oldh) (double)$ratio=(double)$oldw/ (double)$neww;
        			else(double)$ratio=(double)$oldh/ (double)$newh;
        			$dest=imagecreatetruecolor($oldw/$ratio,$oldh/$ratio);
        			$white = ImageColorAllocate($dest, 255,255,255);
        			imagefill($dest, 1, 1, $white);
        			imagecopyresampled($dest, $im, 0, 0, 0, 0, $oldw/$ratio, $oldh/$ratio, $oldw, $oldh);
					imageJPeG($dest,$savepath);
        			imageDestroy($im);
        			imageDestroy($dest);
        			return true;
      			}
			}elseif($ext=='gif')
    		{
				$im=imagecreatefromgif($filename);
      			if($oldw>$oldh) (double)$ratio=(double)$oldw/ (double)$neww;
      			else(double)$ratio=(double)$oldh/ (double)$newh;
      			$dest=imagecreatetruecolor($oldw/$ratio,$oldh/$ratio);
      			$white = ImageColorAllocate($dest, 255,255,255);
      			imagefill($dest, 1, 1, $white);
      			imagecopyresampled($dest, $im, 0, 0, 0, 0, $oldw/$ratio, $oldh/$ratio, $oldw, $oldh);
      			imagegif($dest,$savepath);
      			imageDestroy($im);
      			imageDestroy($dest);
      			return true;
			}elseif($ext=='png')
    		{
				$im=imagecreatefrompng($filename);
      			if($oldw>$oldh) (double)$ratio=(double)$oldw/ (double)$neww;
      			else (double)$ratio=(double)$oldh/ (double)$newh;
      			$dest=imagecreatetruecolor($oldw/$ratio,$oldh/$ratio);
      			$white = ImageColorAllocate($dest, 255,255,255);
      			imagefill($dest, 1, 1, $white);
      			imagecopyresampled($dest, $im, 0, 0, 0, 0, $oldw/$ratio, $oldh/$ratio, $oldw, $oldh);
      			imagepng($dest,$savepath);
      			imageDestroy($im);
      			imageDestroy($dest);
      			return true;
			}
			return false;
		}catch(Exception $e){
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
  	}

	// Метод возвращает название разширения файла
	public function mtvc_get_file_ext($filename)
	{
		try{
			$test = $filename;
			$result = "";
			$cnt = 0;
			while($cnt < strlen($test))
			{
				if($test[strlen($test)-$cnt] == '.'){break;}
				$result .= $test[strlen($test)-$cnt];
				$cnt++;
			}
			$result = strrev($result);
			return $result;
		}catch(Exception $e){
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}
	
	// Метод приема картинки через массив $_FILES
	public function mtvc_add_files_file($arr,$multi = false)
	{
	/*	array(
				'path'			=>"Путь к каталогу",
				'name'			=>"имя картинки [1-5]",
				'pre'			=>"приставка к имени файла",
				'size'			=>"допустимый размер в Мб",
				'rule'			=>"тип правила проверки размерности [0-4]",
				'max_w'			=>"максимальная ширина",
				'max_h'			=>"максимальная высота",
				'files'			=>"имя $_FILES",
				'resize_path'	=>"путь к папке превью mid | 0",
				'resize_w'		=>"ширина mid фалйа | 0",
				'resize_h'		=>"высота mid фалйа | 0",
				'resize_path_2'	=>"путь к папке превью min | 0",
				'resize_w_2'	=>"ширина min фалйа | 0",
				'resize_h_2'	=>"высота mid фалйа | 0"
			  ) */
		/* 1  */ $path			= $arr['path'];				// путь к каталогу
		/* 2  */ $name			= $arr['name'];				// имя картинки: ->
									// 1 - оставить
									// 2 - сгенерировать используя текущую дату и время + то что было
									// 3 - сгенерировать используя текущую дату и время
									// 4 - использовать приставку (пункт 4)
									// 5 - приставка из п.4 + сгенерированное имя из даты и времени
								
		/* 3  */ $pre			= $arr['pre'];				// приставка имени файла
		/* 4  */ $size			= $arr['size'];				// допустимый размер файла в Mb
		/* 5  */ $rule			= (int)$arr['rule'];				// Тип правила проверки на правильность расзмерности файла: ->
									// 0 - без проверки
									// 1 - учитывать пункт 6 и 7
									// 2 - строго квадрат
									// 3 - строго учитывать равность пункта 6 и 7
									// 4 - учтение пропорции [W:H] между пунктами 6 и 7
								
		/* 6  */ $max_w				= (int)$arr['max_w'];			// максимальная ширина
		/* 7  */ $max_h				= (int)$arr['max_h'];			// максимальная высота
		/* 8  */ $files				= $arr['files'];			// имя $_FILES
		/* 9  */ $resize_path 		= (isset($arr['resize_path']) ? $arr['resize_path'] : "0");		// путь к папке превью mid | 0
		/* 10 */ $resize_w			= (isset($arr['resize_w']) ? $arr['resize_w'] : 0);			// ширина mid фалйа | 0
		/* 11 */ $resize_h			= (isset($arr['resize_h']) ? $arr['resize_h'] : 0);			// высота mid фалйа | 0
		/* 12 */ $resize_path_2		= (isset($arr['resize_path_2']) ? $arr['resize_path_2'] : "0");	// путь к папке превью min | 0
		/* 13 */ $resize_w_2		= (isset($arr['resize_w_2']) ? $arr['resize_w_2'] : 0);		// ширина min фалйа | 0
		/* 14 */ $resize_h_2		= (isset($arr['resize_h_2']) ? $arr['resize_h_2'] : 0);		// высота mid фалйа | 0
		
	if($name < 1 || $name > 5){$name = 1;}
	if($rule < 0 || $rule > 4){$rule = 0;}
	
	$filepath = $path;
	if(!$multi)$filename = $_FILES[$files]['name'];else $filename = $_FILES[$files]['name'][$multi];
	
	$buf_filename = $filename;
	
	$file_extension = $this->mtvc_get_file_ext($filename);
	
	if($name == 1){$filename = $buf_filename;}
	if($name == 2){$filename = date('YmdHis').rand(100,1000)."_".$buf_filename;}
	if($name == 3){$filename = date('YmdHis').rand(100,1000).'.'.$file_extension;}
	if($name == 4){$filename = $pre.'.'.$file_extension;}
	if($name == 5){$filename = $pre.date('YmdHis').rand(100,1000).'.'.$file_extension;}
	
	$filepath .= $filename;
	
	if($resize_path != "0"){$resize_path .= $resize_w."x".$resize_h."_".$filename;}
	if($resize_path_2 != "0"){$resize_path_2 .= $resize_w_2."x".$resize_h_2."_".$filename;}
	
	if(!$multi)$buf_size = $_FILES[$files]['size']; else $buf_size = $_FILES[$files]['size'][$multi];
	if(!$multi)$buf_tmp_name = $_FILES[$files]['tmp_name']; else $buf_tmp_name = $_FILES[$files]['tmp_name'][$multi];
	
	if($buf_size != 0 && $buf_size<=1024000*$size)
	{
		if(move_uploaded_file($buf_tmp_name, $filepath))
		{
			$size = getimagesize($filepath);
			if($rule == 0)
			{
				if($resize_path != "0"){
					$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
				if($resize_path_2 != "0"){
					$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
				return $filename;
			}
			if($rule == 1)
			{
				if($size[0] <= $max_w && $size[1] <= $max_h)
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					return $filename;
				}else
				{
					echo("<p class='fail'>Файл превышает допустимый размер: ".$max_w."x".$max_h." px.</p>");
					unlink($filepath);
					return false;
				}
			}
			if($rule == 2)
			{
				if($size[0] == $size[1])
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					return $filename;
				}else
				{
					echo("<p class='fail'>Файл не удовлетворяет правилу: ширина должна быть ровна высоте.</p>");
					unlink($filepath);
					return false;
				}
			}
			if($rule == 3)
			{
				if($size[0] == $max_w && $size[1] == $max_h)
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					return $filename;
				}else
				{
					echo("<p class='fail'>Файл не удовлетворяет заданым параметрам: ".$max_w."x".$max_h." px.</p>");
					unlink($filepath);
					return false;
				}
			}
			if($rule == 4)
			{
				if( ($size[0]/$max_w) == ($size[1]/$max_h) )
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $size[0], $size[1]);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $size[0], $size[1]);}
					return $filename;
				}elseif($resize_h_2 == 1)
				{
					if( ($size[1]/$max_w) == ($size[0]/$max_h) )
					{
						if($resize_path != "0"){
							$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $size[0], $size[1]);}
						if($resize_path_2 != "0"){
							$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $size[0], $size[1]);}
						return $filename;
					}
				}else
				{
					echo("<p class='fail'>Файл не удовлетворяет пропорции: ".$max_w.":".$max_h.".</p>");
					unlink($filepath);
					return false;
				}
			}
		}else
		{
			echo("<p class='fail'>Файл не может быть сохранён по пути: ".$filepath.". Укажите другой путь или проверьте права доступа директории на запись.</p>");
			return false;
		}
	}else
	{
		echo("<p class='fail'>Файл превышает допустимый размер: ".$size." Mb.</p>");
		return false;
	}
	}
	
	// Метод MULTI-приема картинки через массив $_FILES[multiple]
	public function mtvc_add_files_file_miltiple($arr)
	{
		$result_arr = array();
		foreach($_FILES[$arr['files']]['name'] as $multi_cnt => $multi_cur_name)
		{
		/* 1  */ $path			= $arr['path'];				// путь к каталогу
		/* 2  */ $name			= $arr['name'];				// имя картинки: ->
									// 1 - оставить
									// 2 - сгенерировать используя текущую дату и время + то что было
									// 3 - сгенерировать используя текущую дату и время
									// 4 - использовать приставку (пункт 4)
									// 5 - приставка из п.4 + сгенерированное имя из даты и времени
								
		/* 3  */ $pre			= $arr['pre'];				// приставка имени файла
		/* 4  */ $size			= $arr['size'];				// допустимый размер файла в Mb
		/* 5  */ $rule			= $arr['rule'];				// Тип правила проверки на правильность расзмерности файла: ->
									// 0 - без проверки
									// 1 - учитывать пункт 6 и 7
									// 2 - строго квадрат
									// 3 - строго учитывать равность пункта 6 и 7
								
		/* 6  */ $max_w				= $arr['max_w'];			// максимальная ширина
		/* 7  */ $max_h				= $arr['max_h'];			// максимальная высота
		/* 8  */ $files				= $arr['files'];			// имя $_FILES
		/* 9  */ $resize_path 		= (isset($arr['resize_path']) ? $arr['resize_path'] : "0");		// путь к папке превью mid | 0
		/* 10 */ $resize_w			= (isset($arr['resize_w']) ? $arr['resize_w'] : 0);			// ширина mid фалйа | 0
		/* 11 */ $resize_h			= (isset($arr['resize_h']) ? $arr['resize_h'] : 0);			// высота mid фалйа | 0
		/* 12 */ $resize_path_2		= (isset($arr['resize_path_2']) ? $arr['resize_path_2'] : "0");	// путь к папке превью min | 0
		/* 13 */ $resize_w_2		= (isset($arr['resize_w_2']) ? $arr['resize_w_2'] : 0);		// ширина min фалйа | 0
		/* 14 */ $resize_h_2		= (isset($arr['resize_h_2']) ? $arr['resize_h_2'] : 0);		// высота mid фалйа | 0
		
	if($name < 1 || $name > 5){$name = 1;}
	if($rule < 0 || $rule > 3){$rule = 0;}
	
	$filepath = $path;
	
	//echo '<pre>files == '; print_r($_FILES[$files]); echo '</pre>';
	
	$filename = $_FILES[$files]['name'][$multi_cnt];
	
	$file_extension = $this->mtvc_get_file_ext($filename);
	
	if($name == 1){$filename = $_FILES[$files]['name'][$multi_cnt];}
	if($name == 2){$filename = date('YmdHis').rand(100,1000)."_".$_FILES[$files]['name'][$multi_cnt];}
	if($name == 3){$filename = date('YmdHis').rand(100,1000).'.'.$file_extension;}
	if($name == 4){$filename = $pre.'-'.rand(1,1000).'.'.$file_extension;}
	if($name == 5){$filename = $pre.date('YmdHis').rand(100,1000).'.'.$file_extension;}
	
	$filepath =  $path.$filename;
	
	//echo '<br>MULTI PATH: '.$filepath.'<br>';
	
	if($resize_path != "0"){$resize_path .= $resize_w."x".$resize_h."_".$filename;}
	if($resize_path_2 != "0"){$resize_path_2 .= $resize_w_2."x".$resize_h_2."_".$filename;}
	
	if($_FILES[$files]['size'][$multi_cnt] != 0 && $_FILES[$files]['size'][$multi_cnt]<=1024000*$size)
	{
		if(move_uploaded_file($_FILES[$files]['tmp_name'][$multi_cnt], $filepath))
		{
			$size = getimagesize($filepath);
			if($rule == 0)
			{
				if($resize_path != "0"){
					$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
				if($resize_path_2 != "0"){
					$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
				array_push($result_arr,$filename);
			}
			if($rule == 1)
			{
				if($size[0] <= $max_w && $size[1] <= $max_h)
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					array_push($result_arr,$filename);
				}else
				{
					echo("<p class='fail'>Файл превышает допустимый размер: ".$max_w."x".$max_h." px.</p>");
					unlink($filepath);
					array_push($result_arr,'fail');
				}
			}
			if($rule == 2)
			{
				if($size[0] == $size[1])
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					array_push($result_arr,$filename);
				}else
				{
					echo("<p class='fail'>Файл не удовлетворяет правилу: ширина должна быть ровна высоте.</p>");
					unlink($filepath);
					array_push($result_arr,'fail');
				}
			}
			if($rule == 3)
			{
				if($size[0] == $max_w && $size[1] == $max_h)
				{
					if($resize_path != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path, $file_extension, $resize_w, $resize_h);}
					if($resize_path_2 != "0"){
						$this->mtvc_ChangeImageSize($filepath, $resize_path_2, $file_extension, $resize_w_2, $resize_h_2);}
					array_push($result_arr,$filename);
				}else
				{
					echo("<p class='fail'>Файл не удовлетворяет заданым параметрам: ".$max_w."x".$max_h." px.</p>");
					unlink($filepath);
					array_push($result_arr,'fail');
				}
			}
		}else
		{
			echo("<p class='fail'>Файл не может быть сохранён по пути: ".$filepath.". Укажите другой путь или проверьте права доступа директории на запись.</p>");
			array_push($result_arr,'fail');
		}
	}else
	{
		echo("<p class='fail'>Файл превышает допустимый размер: ".$size." Mb.</p>");
		array_push($result_arr,'fail');
	}
	
	} // end foreach multi name
	return $result_arr;
	}
	
	public function hr($header)
		{
			return "
			<div class='clear'></div><br>
                <h4 class='new-line'>$header</h4>
            <div class='clear'></div>
			";
		}
	
	// return input html 
	
	public function print_input($title,$name,$hold,$value,$size=25,$onchange="",$input_type="text")
		{
			return "
			
			<div class='zen-form-item'>
				<label for='save-$name'>$title</label><br>
				<div class='zif-wrap'>
                	<input	id='save-$name' class='my-field' type='$input_type' placeholder='$hold' onchange=\"$onchange\" onkeyup=\"$onchange\" 
                    		value='$value' name='$name' size='$size' />
                </div>
            </div>
			
            ";
		}
	
	// Return string of SELECT form type
	/*
	public function print_select($title,$currValue,$list,$fieldValue,$fieldTitle,$name,$change,$first=array(),$type=false)
		{
			$result = "";
			
			$result .= "
				<div class='zen-form-item'>
					<label for='save-$name'>$title</label><br>
						<div class='zif-wrap-select styled-select'>               	
							<select class='sampling_changed' id='save-$name' name='$name' onChange=\"$change\">";
							
			if($first)
			{
				$curr_selected = ($first[$fieldValue]==$currValue ? "selected" : "");
				$result .= "<option $curr_selected value='".$first[$fieldValue]."'>".$first[$fieldTitle]."</option>";
			}
			
			if($type)
			{
				switch($type)
				{
					case 'brandTree':
					{
						
						foreach($list as $item)
						{
							$result .= "<optgroup label='".$item[$fieldTitle]."' value='".$item[$fieldValue]."'></optgroup>";
							foreach($item['childs'] as $child)
							{
								$curr_selected = ($child[$fieldValue]==$currValue ? "selected" : "");
								$result .= "<option $curr_selected value='".$child[$fieldValue]."'> - ".$child[$fieldTitle]."</option>";
							}
						}
						
						break;
					}
					default:break;
				}
			}else
			{
				foreach($list as $item)
				{
					$curr_selected = ($item[$fieldValue]==$currValue ? "selected" : "");
					$result .= "<option $curr_selected value='".$item[$fieldValue]."'>".$item[$fieldTitle]."</option>";
				}
			}
			
            $result .=     "</select>
						</div>
				</div>
			";
			
			return $result;
		}
	*/
		
	// Return STRING of TABLE products list adding type
		
	public function print_adding_products_list_table($products,$orderId,$type=false)
	{
		if($type=='create') $orderId = 0;
		
		$str = "";
		
				$str .=  "
					<div class='r-z-c-table' style='border-left:3px solid #CCC;'>
            			<table class='maintable' id='main-table'>
                    		<tbody>
						";
				$icnt = 0;
				foreach($products as $prod)
				{
					$pid = $prod['id'];
					
					$icnt++;
					$iid = $prod['id'];
					$iclass = ($icnt%2==1 ? "trcolor" : "");
				
					$str .= "
							<tr class='$iclass' id='pi-$iid'>
						";
						
						$str .= "<td><img src='/split/files/shop/products/crop/320x240_".$prod['file']."' /></td>";
						
						$str .= "<td style='padding-left:10px;'>".$prod['name']."</td>";
						$str .= "
								<td class='inline-item-quant inn'>
            						<div class='numbers_nav nn_quantt' id='nn_quant_$pid' alt='nop'>
										<button type='button' class='minus' alt='$pid' pid='$pid' onclick=\"action_minus_quant($pid)\">-</button>
    										
											<input type='text' maxlength='3' value='1' name='prod_item_quant[]' 
											onkeyup=\"if(parseInt($(this).val()) &lt; 1) $(this).val(1); else if(parseInt($(this).val()) &gt; 999) $(this).val(999); $(this).val($(this).val().replace(/[^\d]/g,''));\" 
											onblur=\"if($(this).val() == '') $(this).val(1);\" class='valid'>
    									
										<button type='button' class='plus' alt='$pid' pid='$pid' onclick=\"action_plus_quant($pid)\">+</button>
									</div>
            					</td>
								";
						
						$str .= "<td>".$prod['price']." грн.</td>";
						
						$str .= "<td><a class='buy-prod' href='javascript:void(0);' onclick=\"add_product_to_admin_cart($orderId,$pid,'$type');\">Добавить</a></td>";
						
					$str .= "</tr>";
				}
				$str .= "
							</tbody>
                		</table>
            		</div>
					";
		return $str;
	}
	
	public function print_adding_products_for_banner($products,$id,$onclick="add_banner_prod_from_modal")
	{
		if($type=='create') $orderId = 0;
		
		$str = "";
		
				$str .=  "
					<div class='r-z-c-table' style='width:100%; overflow:hidden;'>
            			<table class='maintable' id='main-table'>
                    		<tbody>
						";
				$icnt = 0;
				foreach($products as $prod)
				{
					$pid = $prod['id'];
					
					$icnt++;
					$iid = $prod['id'];
					$iclass = ($icnt%2==1 ? "trcolor" : "");
				
					$str .= "
							<tr class='$iclass' id='pi-$iid'>
						";
						
						$str .= "<td><img src='/split/files/shop/products/crop/320x240_".$prod['file']."' /></td>";
						
						$str .= "<td style='padding-left:10px;'>".$prod['id']."</td>";
						
						$str .= "<td>".$prod['name']."</td>";
						
						$str .= "<td id='banner_prod_btn_$pid'><button class='r-z-h-s-create nssBut fRight' type='button' onclick=\"$onclick($id,$pid);\">Добавить &nbsp;&nbsp;&nbsp;<span>+</span></button></td>";
						
					$str .= "</tr>";
				}
				$str .= "
							</tbody>
                		</table>
            		</div>
					";
		return $str;
	}
	
	public function print_adding_products_for_accessuares($products,$id,$onclick="add_prod_accessuare_from_modal")
	{
		if($type=='create') $orderId = 0;
		
		$str = "";
		
				$str .=  "
					<div class='r-z-c-table' style='width:100%; overflow:hidden;'>
            			<table class='maintable' id='main-table'>
                    		<tbody>
						";
				$icnt = 0;
				foreach($products as $prod)
				{
					$pid = $prod['id'];
					
					$icnt++;
					$iid = $prod['id'];
					$iclass = ($icnt%2==1 ? "trcolor" : "");
				
					$str .= "
							<tr class='$iclass' id='pi-$iid'>
						";
						
						$str .= "<td><img src='/split/files/shop/products/crop/320x240_".$prod['file']."' /></td>";
						
						$str .= "<td style='padding-left:10px;'>".$prod['id']."</td>";
						
						$str .= "<td>".$prod['name']."</td>";
						
						$str .= "<td id='prod_acc_btn_$pid'><button class='r-z-h-s-create nssBut fRight' type='button' onclick=\"$onclick($id,$pid);\">Добавить &nbsp;&nbsp;&nbsp;<span>+</span></button></td>";
						
					$str .= "</tr>";
				}
				$str .= "
							</tbody>
                		</table>
            		</div>
					";
		return $str;
	}
	
	public function print_adding_products_for_complect($products,$id)
	{
		if($type=='create') $orderId = 0;
		
		$str = "";
		
				$str .=  "
					<div class='r-z-c-table' style='width:100%; overflow:hidden;'>
            			<table class='maintable' id='main-table'>
                    		<tbody>
						";
				$icnt = 0;
				foreach($products as $prod)
				{
					$pid = $prod['id'];
					
					$icnt++;
					$iid = $prod['id'];
					$iclass = ($icnt%2==1 ? "trcolor" : "");
				
					$str .= "
							<tr class='$iclass' id='pi-$iid'>
						";
						
						$str .= "<td><img src='/split/files/shop/products/crop/320x240_".$prod['file']."' /></td>";
						
						$str .= "<td style='padding-left:10px;'>".$prod['id']."</td>";
						
						$str .= "<td>".$prod['name']."</td>";
						
						$str .= "<td id='prod_comp_btn_$pid'><button class='r-z-h-s-create nssBut fRight' type='button' onclick=\"add_prod_complect_from_modal($id,$pid);\">Добавить &nbsp;&nbsp;&nbsp;<span>+</span></button></td>";
						
					$str .= "</tr>";
				}
				$str .= "
							</tbody>
                		</table>
            		</div>
					";
		return $str;
	}
	
	public function print_adding_products_for_present($products,$id)
	{
		if($type=='create') $orderId = 0;
		
		$str = "";
		
				$str .=  "
					<div class='r-z-c-table' style='width:100%; overflow:hidden;'>
            			<table class='maintable' id='main-table'>
                    		<tbody>
						";
				$icnt = 0;
				foreach($products as $prod)
				{
					$pid = $prod['id'];
					
					$icnt++;
					$iid = $prod['id'];
					$iclass = ($icnt%2==1 ? "trcolor" : "");
				
					$str .= "
							<tr class='$iclass' id='pi-$iid'>
						";
						
						$str .= "<td><img src='/split/files/shop/products/crop/320x240_".$prod['file']."' /></td>";
						
						$str .= "<td style='padding-left:10px;'>".$prod['id']."</td>";
						
						$str .= "<td>".$prod['name']."</td>";
						
						$str .= "<td id='prod_present_btn_$pid'><button class='r-z-h-s-create nssBut fRight' type='button' onclick=\"add_prod_present_from_modal($id,$pid);\">Добавить &nbsp;&nbsp;&nbsp;<span>+</span></button></td>";
						
					$str .= "</tr>";
				}
				$str .= "
							</tbody>
                		</table>
            		</div>
					";
		return $str;
	}
	
	public function getUserInfo($id)
		{
			$query = "SELECT * FROM [pre]users WHERE `id`=$id LIMIT 1";
			$resultMassive = $this->rs($query);
			
			$result = ($resultMassive ? $resultMassive[0] : array());
			
			return $result;
		}
	
	// Корректный вывод даты
		public function deformat_date($val)
		{
			$result = "";
			$monthes = array('','янв.','фев.','мар.','апр.','мая','июня','июля','авг.','сен.','окт.','нбр.','дек.');
			
			if(strtotime($val) > strtotime(date("d.m.Y",time())." 00:00:00"))
								{
									$result = "Сегодня, ".date("H:i",strtotime($val));
		
								}elseif(strtotime($val) < strtotime(date("d.m.Y",time())." 00:00:00") &&
										strtotime($val) > (strtotime(date("d.m.Y",time())." 00:00:00")-86400))
									{
										$result = "Вчера, ".date("H:i",strtotime($val));
									}
								else
									{
										$result = date("d",strtotime($val))." ".$monthes[(int)date("m",strtotime($val))]." ".
																	", ".
																	date("H:i",strtotime($val));
									}
			return $result;
		}
		
		public function deformat_long_date($val)
		{
			$result = "";
			$monthes = array('','января','февряля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
			
			if(strtotime($val) > strtotime(date("d.m.Y",time())." 00:00:00"))
								{
									$result = "Сегодня, ".date("H:i",strtotime($val));
		
								}elseif(strtotime($val) < strtotime(date("d.m.Y",time())." 00:00:00") &&
										strtotime($val) > (strtotime(date("d.m.Y",time())." 00:00:00")-86400))
									{
										$result = "Вчера, ".date("H:i",strtotime($data[$item_num]['dateCreate']));
									}
								else
									{
										$result = date("d",strtotime($val))." ".
																	$monthes[(int)date("m",strtotime($val))]." ".
																	date("Y",strtotime($val)).", ".
																	date("H:i",strtotime($val));
									}
			
			return $result;
		}
	
		// Recusrsive category tree generate
		
		public function rec_cat_tree($arr,$cat_id)
		{
			$query = "SELECT id,name,alias,parent FROM [pre]shop_catalog WHERE `id`=$cat_id LIMIT 1";
			$res = $this->rs($query);
			
			if($res)
			{
				array_push($arr, $res[0]);
				$arr = $this->rec_cat_tree($arr,$res[0]['parent']);
			}
			
			return array_reverse($arr);
		}
	
		// Get products by filter
		
		public function getAllShopProducts($params = array())
		{
			// Filter params
			
			$filter_and = "";
			
			if(isset($params['filtr']['massive']))
			{
				foreach($params['filtr']['massive'] as $f_name => $f_value)
				{
					if($f_value < 0) continue;
					$filter_and .= " AND ($f_name='$f_value') ";
				}
			}
			
			// Filter like
			
			if(isset($params['filtr']['filtr_search_key']) && isset($params['filtr']['filtr_search_field']) && trim($params['filtr']['filtr_search_key']) != "")
			{
				$search_field = $params['filtr']['filtr_search_field'];
				$search_key = $params['filtr']['filtr_search_key'];
				
				$filter_and .= " AND ($search_field LIKE '%$search_key%') ";
			}
			
			// Filter sort
			
			$sort_field		= (isset($params['filtr']['sort_filtr']) ? $params['filtr']['sort_filtr'] : "M.id");
			
			$sort_vector	= (isset($params['filtr']['order_filtr']) ? $params['filtr']['order_filtr'] : "");
			
			// Order limits
			
			$limit = (isset($_COOKIE['global_on_page']) ? (int)$_COOKIE['global_on_page'] : GLOBAL_ON_PAGE);
			
			if($limit <= 0) $limit = GLOBAL_ON_PAGE;
			
			$start = (isset($params['start']) ? ($params['start']-1)*$limit : 0);
			
			
			$query = "SELECT M.id, M.name, M.sku, M.code, M.price, M.usd_price, M.sale_price, M.alias, M.block, M.details, M.dateCreate, M.dateModify,  C.name as cat_name, C.alias as cat_alias, C.id as cat_id, 
			
						(SELECT name FROM [pre]shop_mf WHERE `id`=M.mf_id LIMIT 1) as mf_name,  
			 
			 			(SELECT file FROM [pre]files_ref WHERE `ref_table`='shop_products' AND `ref_id`=M.id ORDER BY id LIMIT 1) as filename 
			 
						FROM [pre]shop_products as M
						
						LEFT JOIN [pre]shop_cat_prod_ref AS R on R.prod_id = M.id 
						
						LEFT JOIN [pre]shop_catalog AS C on C.id = R.cat_id 
						
						WHERE 1 $filter_and 
						GROUP BY M.id ORDER BY $sort_field $sort_vector 
						LIMIT 100000"; // $start,$limit
			
			//echo "QUERY: ".$query;
			
			$result = $this->rs($query);
			
			foreach($result as $i => $item)
			{
				//$result[$i]['cat_tree'] = $this->rec_cat_tree(array(),$item['cat_id']);
			}
			
			return $result;
		}
	
		// Корректная подрезка строки
		public function next_sub_str($str,$len)
		{
			return implode(array_slice(explode('<br>',wordwrap($str,$len,'<br>',false)),0,1));
		}
		
		public function getExt($filename){
            
            // Redefine vars
            $filename = (string) $filename;
            
            // Return file extension
            return strtolower(substr(strrchr($filename, '.'), 1));
             
        }
		
		public function print_select($title,$currValue,$list,$fieldValue,$fieldTitle,$name,$change,$first=array(),$type=false,$style1="",$style2="")
		{
			$result = "";
			
			$result .= "
				<div class='zen-form-item' style='$style1'>
					<label for='save-$name'>$title</label><br>
						<div class='zif-wrap-select styled-select' style='width:300px; $style2'>               	
							<select style='width:100%;' class='sampling_changed' id='save-$name' name='$name' onChange=\"$change\">";
							
			if($first)
			{
				$curr_selected = ($first[$fieldValue]==$currValue ? "selected" : "");
				$result .= "<option $curr_selected value='".$first[$fieldValue]."'>".$first[$fieldTitle]."</option>";
			}
			
			if($type)
			{
				switch($type)
				{
					case 'brandTree':
					{
						
						foreach($list as $item)
						{
							$result .= "<optgroup label='".$item[$fieldTitle]."' value='".$item[$fieldValue]."'></optgroup>";
							foreach($item['childs'] as $child)
							{
								$curr_selected = ($child[$fieldValue]==$currValue ? "selected" : "");
								$result .= "<option $curr_selected value='".$child[$fieldValue]."'> - ".$child[$fieldTitle]."</option>";
							}
						}
						
						break;
					}
					case 'allCatalog':
					{
						$result .= $this->convTreeToSecelt($list,0,$currValue);
						
						break;
					}
					default:break;
				}
			}else
			{
				foreach($list as $item)
				{
					$curr_selected = ($item[$fieldValue]==$currValue ? "selected" : "");
					$result .= "<option $curr_selected value='".$item[$fieldValue]."'>".$item[$fieldTitle]."</option>";
				}
			}
			
            $result .=     "</select>
						</div>
				</div>
			";
			
			return $result;
		}
		
		public function convTreeToSecelt($tree,$lvl=0,$val=0)
		{
			if(!$tree) return "";
		
			$res = "";
		
			$lvl_padding = "";
		
			for($i=0; $i<$lvl; $i++) $lvl_padding .= "&nbsp;&nbsp;";
		
			foreach($tree as $child)
			{
				$childID = $child['id'];
				$childName = $child['name'];
				
				$selected = ($childID==$val ? "selected" : "");
				
				$styled = "";
				
				if($lvl==0) $styled = " style='padding:5px 0px; background:#00ffff;' ";
				
				$res .= "<option value='$childID' $styled $selected >$lvl_padding $childName</option>";
				
				$res .= $this->convTreeToSecelt($child['childs'],($lvl+2),$val);
			}
		
		return $res;
		}
		
	// SERTIFICATE START
	
	public function is_sertificate($prod_id, $quant=1)
	{
		$query = "
				SELECT B.id, B.nominal  
					FROM 
					[pre]banners as B 
					LEFT JOIN [pre]shop_banner_prod_ref as R on R.banner_id = B.id 
					WHERE R.prod_id = $prod_id 
					ORDER BY B.id DESC 
					LIMIT 1
				";
		$result = $this->rs($query);
		
		if($result) $result[0]['quant'] = $quant;
		
		return ($result ? $result[0] : array());
	}
	
	public function is_accessuare($prod_id)
	{
		$status = false;
		
		$query = "
				SELECT C.parent, C.id  
					FROM 
					[pre]shop_catalog as C 
					LEFT JOIN [pre]shop_cat_prod_ref as R on R.cat_id = C.id 
					WHERE R.prod_id = $prod_id 
					ORDER BY R.id DESC 
					LIMIT 1
				";
		$result = $this->rs($query);
		
		if($result)
		{
			$category = $result[0];
			
			$cnt = 0;
			
			while($category['parent'] > 0 && $cnt < 100)
			{
				$category = $this->getShopCatalogItem($category['parent']);
				
				$cnt++;
			}
			
			if($category['id']==5) // Accessuares
			{
				$status = true;
			}
		}
		
		return $status;
	}
	
	public function getShopCatalogItem($cat_id)
	{
		$query = "SELECT id,parent FROM [pre]shop_catalog WHERE `id`=$cat_id LIMIT 1";
		$result = $this->rs($query);
		
		return ($result ? $result[0] : array());
	}
	
	// SERTIFICATE END
	
	
	//==============================================================================================================================
	//
	// START OF CART TABLE HTML
	//
	//==============================================================================================================================
	
	public function getUserCartTableHtml($_order_id, $_path_to_cart_table_view="split/view_parts/inc/_cart_table.php", $is_ajax=true, $action="", $_fa="cart")
	{
		$cart_result = array(
							'cart_total_quant'	=> 0,
							'cart_total_summ'	=> 0,
							'cart_data'			=> array(),
							'currProducts'		=> array(),
							'cart_html'			=> ""
							);
		$_uid = 0;
		$_session_id = 0;
		
		if($is_ajax)
		{
			switch($action)
			{
				case "change_product_quant":
				{
					$item_id	= (int)$_POST['item_id'];
					$quant		= (int)$_POST['quant'];
					
					if($quant < 1) $quant = 1;
					
					if($item_id)
					{
						$query = "UPDATE [pre]shop_cart_orders SET `quant`=$quant WHERE `id`=$item_id LIMIT 1";
						$this->rs($query);
					}
					break;
				}
				case "delete_product":
				{
					$item_id = (int)$_POST['item_id'];
	
					if($item_id)
					{
						$query = "DELETE FROM [pre]shop_cart_orders WHERE `id`=$item_id LIMIT 1";
						$this->rs($query);
					}
					break;
				}
				case "add_product":
				{
					$curr_date = date("Y-m-d H:i:s");
	
					$cart_id = 0;
					
					if(isset($_POST['product_sku']) && $_POST['product_sku'])
					{
						$prod_sku = $_POST['product_sku'];
						$prod_id = 0;
						
						$product_data = $this->rs("SELECT id, price FROM [pre]shop_products WHERE `sku`='".$prod_sku."' AND `block`=0 LIMIT 1");
						
						$post_quant = ( (isset($_POST['quant']) && $_POST['quant']) ? (int)$_POST['quant'] : 1);
						
						if($product_data)
						{
							$prod_id = $product_data[0]['id'];
							
							$get_query = "SELECT * FROM [pre]shop_cart_orders WHERE `prod_id`='".$prod_id."' AND `order_id`='".$_order_id."' LIMIT 1";
							$cart_product_data = $this->rs($get_query);
							
							$query = "";
							
							if($cart_product_data)
							{
								$exist_product = $cart_product_data[0];
								
								$new_quant = $exist_product['quant']+$post_quant;
								
								$data['curr_quant'] = $new_quant;
								
								$query = "UPDATE [pre]shop_cart_orders SET `quant`='".$new_quant."',`dateModify`='".$curr_date."' WHERE `id`='".$exist_product['id']."' LIMIT 1";
								
								$cart_id = $exist_product['id'];
							}else
							{
								$query = "INSERT INTO [pre]shop_cart_orders (`order_id`,`uid`,`session_id`,`prod_id`,`quant`,`dateCreate`,`dateModify`)
										VALUES
										('".$_order_id."','".$_uid."','".$session_id."','".$prod_id."','".$post_quant."','".$curr_date."','".$curr_date."')";
							}
							
							$this->rs($query);
							
							if(!$cart_id) $cart_id = mysql_insert_id();
							
							$cart_result['last_item_id'] = $cart_id;
						}
					}
					break;
				}
				default: break;
			}
		}
		
		$discountSum = 0;
		$sale = 0;
		
		$cart_data = $this->rs("
								SELECT M.* , 
								
								(SELECT name FROM [pre]shop_products WHERE `id`=M.prod_id LIMIT 1) as name,
								(SELECT price FROM [pre]shop_products WHERE `id`=M.prod_id LIMIT 1) as price, 
								(SELECT file FROM [pre]files_ref WHERE `ref_table`='shop_products' AND `ref_id`=M.prod_id ORDER BY id LIMIT 1) as filename 
								
								FROM [pre]shop_cart_orders as M 
								
								WHERE `order_id`='".$_order_id."'
								ORDER BY dateCreate 
								LIMIT 1000
								");
		
		$currProducts = array();
		
		$need_refresh = false;
		
		//=================================================================================================================
		// SERTIFICATE
		
		$sertificates = array();
		
		$sertificate_nominal_total = 0;
		
		$sertificate_products_quant = 0;
		
		$sertificate_products_list = array();
		
		$sertificate_products = array();
		
		$sertificate_products_total = 0;
		
		$sertificate_total = 0;
		
		
		$cart_accessuares = array();
		
		//
		//=================================================================================================================
		
		foreach($cart_data as $i => $cart_item)
		{
			$curr_prod_id = $cart_item['prod_id'];
			$curr_prod_quant = $cart_item['quant'];
			
			$this_is_sertificate = $this->is_sertificate($curr_prod_id, $curr_prod_quant);
			
			$cart_data[$i]['sertificate'] = $this_is_sertificate;
			
			
			$this_is_accessuare = $this->is_accessuare($curr_prod_id);
			
			$cart_data[$i]['this_is_accessuare'] = $this_is_accessuare;
			
			
			if($this_is_sertificate)
			{
				$sertificates[] = $this_is_sertificate;
				
				$sertificate_nominal_total += $this_is_sertificate['nominal']*$this_is_sertificate['quant'];
			}
			
			if($this_is_accessuare)
			{
				$cart_accessuares[] = array('id'=>$curr_prod_id, 'price'=>$cart_item['price'], 'quant'=>$cart_item['quant'], 'filename'=>$cart_item['filename'], 'cart_id'=>$cart_item['id'], 'name'=>$cart_item['name']);
			}
		}
		
		if($sertificate_nominal_total > 0)
		{
			$sertificate_total = 1;
			
			foreach($cart_accessuares as $curr_acc)
			{
				$sertificate_products_quant += $curr_acc['quant'];
				
				$sertificate_products_list[] = $curr_acc['id'];
				
				$sertificate_products[] = $curr_acc;
				
				$sertificate_products_total += $curr_acc['price']*$curr_acc['quant'];
				
				if($sertificate_nominal_total < $sertificate_products_total)
				{
					$sertificate_total = $sertificate_products_total - $sertificate_nominal_total;
					
					break;
				}
			}	
		}
		
		//=========================================================================================
		//=========================================================================================
		//=========================================================================================
		//=========================================================================================
			
			foreach($cart_data as $i => $cart_item)
				{
					$curr_prod_id = $cart_item['prod_id'];
					
					$cart_product_data = $this->rs("SELECT M.id, M.name, M.alias, M.price, M.in_stock,  
													(SELECT file FROM [pre]files_ref WHERE `ref_table`='shop_products' AND `ref_id`=M.id ORDER BY id LIMIT 1) as filename 
													FROM [pre]shop_products as M 
													WHERE `id`='".$cart_item['prod_id']."' AND `block`=0 LIMIT 1");
					if($cart_product_data)
					{
						if(in_array($curr_prod_id, $sertificate_products_list)) continue;
						
						$curr_cart_product = $cart_product_data[0];
						$curr_cart_product['quant'] = $cart_item['quant'];
						$curr_cart_product['cart_id'] = $cart_item['id'];
						$curr_cart_product['sertificate'] = $cart_item['sertificate'];
						$currProducts[$cart_item['prod_id']] = $curr_cart_product;
						
						if($curr_cart_product['in_stock'] < $cart_item['quant'])
						{
							// УЧИТЫВАЕТСЯ ТОВАР НА СКЛАДЕ !!!
							
							//$need_refresh = true;
							
							//$query = "UPDATE [pre]shop_cart SET `quant`='".$curr_cart_product['in_stock']."' WHERE `id`='".$cart_item['id']."' LIMIT 1";
							//$obj->rs($query);
						}
					}
				}
			
			if($need_refresh)
			{
				$cart_data = $this->rs("SELECT * FROM [pre]shop_cart_orders WHERE `order_id`='".$_order_id."' ORDER BY dateCreate LIMIT 1000");
			}
			
			$cart_total_summ = 0;
			$cart_total_quant = 0;
			
			$cart_data_product = array();
			
			if($cart_data)
			{
				foreach($cart_data as $cart_item)
				{
					$curr_prod_id = $cart_item['prod_id'];
			
					if(in_array($curr_prod_id, $sertificate_products_list)) continue;
					
					if($cart_product_data)
					{
						$curr_cart_product = $currProducts[$cart_item['prod_id']];
						
						$cart_data_product[$cart_item['id']] = $curr_cart_product; // info for cart page
						
						$cart_total_quant += $cart_item['quant'];
						$cart_total_summ += ($curr_cart_product['price']*$cart_item['quant']);
					}
				}
			}
			
			$discountSum = ($cart_total_summ*$sale)/100;
			
			$cart_total_summ -= $discountSum;
			
			$cart_total_quant += $sertificate_products_quant;
			$cart_total_summ += $sertificate_total;
			
			$cart_result = array(
							'cart_total_quant'	=> $cart_total_quant,
							'cart_total_summ'	=> $cart_total_summ,
							'cart_data'			=> $cart_data,
							'currProducts'		=> $currProducts,
							'cart_html'			=> ""
							);
							
			//
			//
			//
			
			ob_start();
			
			include_once( $_path_to_cart_table_view );
			
			$cart_result['cart_html'] = ob_get_contents();
			
			ob_end_clean();
			
			//
			//
			//
							
			return $cart_result;
	}
	/*
	public function change_alias($str)
	{
		$str = strtolower($str);
		
		$str = str_replace('а','a');
		$str = str_replace('б/g,'b');
		$str = str_replace('в/g,'v');
		$str = str_replace('г/g,'g');
		$str = str_replace('д/g,'d');
		$str = str_replace('е/g,'e');
		$str = str_replace('ё/g,'yo');
		$str = str_replace('ж/g,'zh');
		$str = str_replace('з/g,'z');
		$str = str_replace('и/g,'i');
		$str = str_replace('й/g,'y');
		$str = str_replace('к/g,'k');
		$str = str_replace('л/g,'l');
		$str = str_replace('м/g,'m');
		$str = str_replace('н/g,'n');
		$str = str_replace('о/g,'o');
		$str = str_replace('п/g,'p');
		$str = str_replace('р/g,'r');
		$str = str_replace('с/g,'s');
		$str = str_replace('т/g,'t');
		$str = str_replace('у/g,'u');
		$str = str_replace('х/g,'h');
		$str = str_replace('ф/g,'f');
		$str = str_replace('ц/g,'c');
		$str = str_replace('ч/g,'ch');
		$str = str_replace('ш/g,'sh');
		$str = str_replace('щ/g,'shс');
		$str = str_replace('ъ/g,'');
		$str = str_replace('ы/g,'u');
		$str = str_replace('ь/g,'');
		$str = str_replace('э/g,'e');
		$str = str_replace('ю/g,'yu');
		$str = str_replace('я/g,'ya');
		
		str = str.replace(/[^a-z,\d,-]/g,'-');
		str = str.replace(/\,/g,'-');
		str = str.replace(/-+/g,'-');
		str = str.replace(/^-+/g,'');
		str = str.replace(/-+$/g,'');
		
		$('#save-alias').attr('value',str);
	}
	*/
	
	//==============================================================================================================================
	//
	// END OF CART TABLE HTML
	//
	//==============================================================================================================================
}

/*
  Транслитерация ссылок (приведение их в соответствие с форматом URL).
  Латинские буквы и цифры остаются, а русские + знаки препинания преобразуются
  одним из способов (способы нужны каждый для своей задачи)
 
  Подробнее: http://pixel-apes.com/translit
 
  ---------
 
  Методы этого класса можно использовать как статические,
  например, Krugozor_Translit::UrlTranslit("Свежая новость из цирка")
 
  ---------
 
  * UrlTranslit( $string, $allow_slashes = TR_NO_SLASHES )
    -- преобразовать строку в "красивый читаемый URL"
 
  * Supertag( $string, $allow_slashes = TR_NO_SLASHES )
    -- преобразовать строку в "супертаг" -- короткий простой
       идентификатор, состоящий из латинских букв и цифр.
 
  * BiDiTranslit( $string, $direction=TR_ENCODE, $allow_slashes = TR_NO_SLASHES )
    -- преобразовать строку в "формально правильный URL"
       с возможностью восстановления.
       Другое значение $direction позволяет восстановить
       строку обратно с незначительными потерями
 
  * Wikify( $string, $allow_slashes = TR_NO_SLASHES )
    -- преобразовать произвольную строку в вики-адрес
       например: "Привет мир" => "ПриветМир"
 
  * DeWikify( $string )
    -- попробовать восстановить примерный вид исходной строки по вики-адресу
       например: "ПриветМир" => "Привет Мир"
 
  * во всех функциях параметр $allow_slashes управляет тем, игнорировать ли символ "/",
    пропуская его неисправленным, либо удалять его из строки
 
=============================================================== (Kukutz)
 
*/
 
setlocale (LC_ALL, 'ru_RU');
 
setlocale(LC_ALL,'ru_RU.cp1251');
 
define("TR_ENCODE", 0);
define("TR_DECODE", 1);
define("TR_NO_SLASHES", 0);
define("TR_ALLOW_SLASHES", 1);
 
class Krugozor_Base_Translit
{
 
  //пустой конструктор, чтобы методы могли работать через ::
  private function Translit() {}
 
  //URL transliterating
  public static function UrlTranslit($string, $allow_slashes = TR_NO_SLASHES)
  {
   $string = strtolower($string);
 
   $slash = "";
   if ($allow_slashes) $slash = "\/";
 
   static $LettersFrom = "абвгдезиклмнопрстуфыэйхё";
   static $LettersTo   = "abvgdeziklmnoprstufyejxe";
   static $Consonant = "бвгджзйклмнпрстфхцчшщ";
   static $Vowel = "аеёиоуыэюя";
   static $BiLetters = array(
     "ж" => "zh", "ц"=>"ts", "ч" => "ch",
     "ш" => "sh", "щ" => "sch", "ю" => "ju", "я" => "ja",
   );
 
   $string = preg_replace("/[_\s\.,?!\[\](){}]+/", "_", $string);
   $string = preg_replace("/-{2,}/", "--", $string);
   $string = preg_replace("/_-+_/", "--", $string);
   $string = preg_replace("/[_\-]+$/", "", $string);
 
   $string = strtolower( $string );
   //here we replace ъ/ь
   $string = preg_replace("/(ь|ъ)([".$Vowel."])/", "j\\2", $string);
   $string = preg_replace("/(ь|ъ)/", "", $string);
   //transliterating
   $string = strtr($string, $LettersFrom, $LettersTo );
   $string = strtr($string, $BiLetters );
 
   $string = preg_replace("/j{2,}/", "j", $string);
 
   $string = preg_replace("/[^".$slash."0-9a-z_\-]+/", "", $string);
 
   return $string;
  }
 
  //Supertag cooking
  public static function Supertag($string, $allow_slashes = TR_NO_SLASHES)
  {
   $slash = "";
   if ($allow_slashes) $slash = "\/";
 
   $string = Krugozor_Base_Translit::UrlTranslit($string, $allow_slashes);
   $string = preg_replace("/[^".$slash."0-9a-zA-Z\-]+/", "", $string);
   $string = preg_replace("/[\-_]+/", "-", $string);
   $string = preg_replace("/-+$/", "", $string);
   return $string;
  }
 
 
  //Bidirectional translit
  public static function BiDiTranslit($string, $direction=TR_ENCODE, $allow_slashes = TR_NO_SLASHES)
  {
   $slash = "";
   if ($allow_slashes) $slash = "\/";
 
   static $Tran = array (
    "А" => "A",  "Б" => "B",  "В" => "V",  "Г" => "G",  "Д" => "D",  "Е" => "E",  "Ё" => "JO",  "Ж" => "ZH",  "З" => "Z",  "И" => "I",
    "Й" => "JJ", "К" => "K",  "Л" => "L",  "М" => "M",  "Н" => "N",  "О" => "O",  "П" => "P",   "Р" => "R",   "С" => "S",  "Т" => "T",
    "У" => "U",  "Ф" => "F",  "Х" => "KH",  "Ц" => "C",  "Ч" => "CH", "Ш" => "SH", "Щ" => "SHH", "Ъ" => "_~",   "Ы" => "Y",  "Ь" => "_'",
    "Э" => "EH", "Ю" => "JU", "Я" => "JA", "а" => "a",  "б" => "b",  "в" => "v",  "г" => "g",   "д" => "d",   "е" => "e",  "ё" => "jo",
    "ж" => "zh", "з" => "z",  "и" => "i",  "й" => "jj", "к" => "k",  "л" => "l",  "м" => "m",   "н" => "n",   "о" => "o",  "п" => "p",
    "р" => "r",  "с" => "s",  "т" => "t",  "у" => "u",  "ф" => "f",  "х" => "kh",  "ц" => "c",   "ч" => "ch",  "ш" => "sh", "щ" => "shh",
    "ъ" => "~",  "ы" => "y",  "ь" => "'",  "э" => "eh", "ю" => "ju", "я" => "ja", " " => "__", "_" => "__", );
   static $DeTran = array (
    "A"    => "А",   "B"    => "Б",  "V"    => "В",  "G"    => "Г",  "D"    => "Д",  "E"    => "Е",  "JO"   => "Ё",  "ZH"   => "Ж",
    "Z"    => "З",   "I"    => "И",  "JJ"   => "Й",  "K"    => "К",  "L"    => "Л",  "M"    => "М",  "N"    => "Н",  "O"    => "О",
    "P"    => "П",   "R"    => "Р",  "S"    => "С",  "T"    => "Т",  "U"    => "У",  "F"    => "Ф",  "KH"    => "Х",  "C"    => "Ц",
    "CH"   => "Ч",   "SHH"  => "Щ",  "SH"   => "Ш",  "Y"    => "Ы",  "EH"   => "Э",  "JU"   => "Ю",  "_'"=>"Ь", "_~"=>"Ъ",
    "JA"   => "Я",   "a"    => "а",  "b"    => "б",  "v"    => "в",  "g"    => "г",  "d"    => "д",  "e"    => "е",  "jo"   => "ё",
    "zh"   => "ж",   "z"    => "з",  "i"    => "и",  "jj"   => "й",  "k"    => "к",  "l"    => "л",  "m"    => "м",  "n"    => "н",
    "o"    => "о",   "p"    => "п",  "r"    => "р",  "s"    => "с",  "t"    => "т",  "u"    => "у",  "f"    => "ф",  "kh"    => "х",
    "c"    => "ц",   "ch"   => "ч",  "shh"  => "щ",  "sh"   => "ш",  "~"    => "ъ",  "y"    => "ы",  "'"    => "ь",  "eh"   => "э",
    "ju"   => "ю",   "ja"   => "я",  "__" => " ", );
 
   if ($direction==TR_ENCODE)
   {
     $string = preg_replace("/[^\- _0-9a-zA-Z\xC0-\xFFёЁ".$slash."]/", "", $string);
     $russians = preg_split("/[0-9A-Za-z\_\-\.\/\']+/", $string, -1, PREG_SPLIT_NO_EMPTY);//\xc0-\xff
 
     for ($i=0;$i<count($russians);$i++)
       $russians[$i] = strtr($russians[$i], $Tran);
 
     $others = preg_split('/[\xc0-\xff\xa8\xb8 ]+/', $string, -1, PREG_SPLIT_NO_EMPTY);
 
     if (preg_match('/[\xc0-\xff\xa8\xb8 ]/', $string[0]))
     {
       $fr="russians";
       $sr="others";
       $string = "+";
     }
     else
     {
       $fr="others";
       $sr="russians";
       $string = "";
     }
 
     for ($i=0;$i<min(count($$fr),count($$sr));$i++)
      $string.=${$fr}[$i]."+".${$sr}[$i]."+";
 
     if (count($$fr)>count($$sr))
       $string.=${$fr}[count($$fr)-1];
     else
       $string=substr($string,0,strlen($string)-1);
   }
   else
   {
     $pgs = explode("/", $string);
     for ($j=0;$j<count($pgs);$j++)
     {
       $strings = explode("+", $pgs[$j]);
       for ($i=1;$i<count($strings);$i=$i+2)
         $strings[$i] = strtr($strings[$i], $DeTran);
       $pgs[$j] = implode("", $strings);
     }
     $string = implode(($allow_slashes!=TR_NO_SLASHES)?"/":"", $pgs);
   }
   return rtrim($string, "/");
  }
 
 
 
  // Convert string to wiki address
  // "Привет мир" => "ПриветМир"
  public static  function Wikify( $string, $allow_slashes = TR_NO_SLASHES)
  {
    $slash = "";
    if ($allow_slashes) $slash = "\/";
    $string = preg_replace("/[^\- 0-9a-zA-Z\xC0-\xFFёЁ".$slash."]+/", " ", $string);
    // wordglue
    $strings = explode( " ", $string );
    foreach( $strings as $k=>$v )
      $strings[$k] = ucfirst($v);
    $string = implode("",$strings);
    return $string;
  }
 
  // Reconstruct string by given wiki address
  // "ПриветМир" => "Привет Мир"
  // "-"   -- nomatter "Аква-Парк"
  // "0-9" -- nomatter "R 3 Читать", "С 13 Мая" "С Дороги" "СССР Разрушили"
  public static function Dewikify( $string )
  {
    $string = preg_replace( "/([^\-\/])([A-ZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЪЫЭЮЯ]".
                                       "[a-zабвгдеёжзийклмнопрстуфхцчшщьъыэюя0-9])/", "$1 $2", $string );
    $string = preg_replace( "/([^0-9 \-\/])([0-9])/", "$1 $2", $string );
    return $string;
  }
 
}
?>