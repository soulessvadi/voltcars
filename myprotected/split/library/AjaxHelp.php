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
		
		public function rs($query)
		{
			try
			{
				$_stmt	= $this->dbh->prepare($query);
				//echo '<p>'.$query.'</p>';
				$_res	= $_stmt->execute();
				$_arr 	= $_res->fetchallAssoc();
				
				return $_arr;
			}catch(Exception $e)
			{
				echo 'WP WARNING: '.$e;
				return array();
			}
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
	public function wp_send_letter($to_mail,$from,$subject_mail,$message_mail,$system="STRATEG")
	{
		try
		{
			$date = date("d.m.y H:i");
			$message_date = "<p> </p><p>Date of send: ".$date."</p>";
			
			$to  = $to_mail." <".$to_mail.">" ;

      		$subject = "=?UTF-8?B?".base64_encode($subject_mail)."?=";

			$message_attach = "<br> <p>Best regards, <a href=\"http://www.strateg.com.ua\">Strateg.com.ua</a></p>".$message_date;

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
					
					$query = "SELECT M.* , 
								(SELECT `name` FROM [pre]shop_chars WHERE `id`=M.char_id LIMIT 1) as char_name, 
								(SELECT `measure` FROM [pre]shop_chars WHERE `id`=M.char_id LIMIT 1) as char_meas 
								FROM [pre]shop_chars_prod_ref as M 
								WHERE `prod_id`=$pid AND `price_dif`>0 
								ORDER BY ID LIMIT 1000";
					$dinamic_chars = $this->rs($query);
					
					$icnt++;
					$iid = $prod['id'];
					$iclass = ($icnt%2==1 ? "trcolor" : "");
				
					$str .= "
							<tr class='$iclass' id='pi-$iid'>
						";
						
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
						
						if($dinamic_chars)
						{
							$str .= "<td><select name='char_ref_id' id='char_ref_id_$pid' class='styled-select' style='width:280px;'>";
							foreach($dinamic_chars as $dc)
							{
								$str .= "<option value='".$dc['id']."'>".$dc['char_name'].": ".$dc['value']." ".$dc['char_meas']." ( ".$dc['price_dif']." грн.)</option>";
							}
							$str .= "</select></td>";
						}else
						{
							$str .= "<td><input type='hidden' id='char_ref_id_$pid' value='0' /> ".$prod['price']." грн.</td>";
						}
						
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
	
	public function print_adding_products_for_accessuares($products,$id)
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
						
						$str .= "<td style='padding-left:10px;'>".$prod['id']."</td>";
						
						$str .= "<td>".$prod['name']."</td>";
						
						$str .= "<td id='prod_acc_btn_$pid'><button class='r-z-h-s-create nssBut fRight' type='button' onclick=\"add_prod_accessuare_from_modal($id,$pid);\">Добавить &nbsp;&nbsp;&nbsp;<span>+</span></button></td>";
						
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
			
			
			$query = "SELECT M.id, M.name, M.sku, M.code, M.quant, M.price, M.alias, M.block, M.dateCreate, M.dateModify,  C.name as cat_name, C.alias as cat_alias, C.id as cat_id,
						
						(SELECT name FROM [pre]shop_mf WHERE `id`=M.mf_id LIMIT 1) as mf_name,
						(SELECT name FROM [pre]shop_deliver WHERE `id`=M.deliver_id LIMIT 1) as deliver_name
			 
						FROM [pre]shop_products as M
						
						LEFT JOIN [pre]shop_cat_prod_ref AS R on R.prod_id = M.id 
						
						LEFT JOIN [pre]shop_catalog AS C on C.id = R.cat_id 
						
						WHERE 1 $filter_and 
						GROUP BY M.id ORDER BY $sort_field $sort_vector 
						LIMIT 100000"; // $start,$limit
			
			//echo "QUERY: ".$query;
			
			return $this->rs($query);
		}
		
		public function get_prod_dinamic_chars($_prod_id)
		{
			$query = "
					SELECT 
						M.id, M.char_id, M.prod_id, M.value, M.price_dif, C.name as char_name 
					FROM 
						[pre]shop_chars_prod_ref as M 
					LEFT JOIN 
						[pre]shop_chars as C on C.id=M.char_id 
					WHERE 
						M.prod_id=$_prod_id AND C.is_dinamic=1 AND M.price_dif > 0 
					ORDER
						BY M.price_dif
					LIMIT 100 
					"; 
			
			return $this->rs($query);
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
}