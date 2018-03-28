<?php
	/*	MIRACLE WEB TECHNOLOGIES	*/
	/*	***************************	*/
	/*	Author: Sivkovich Maxim		*/
	/*	***************************	*/
	/*	Developed: from 2013		*/
	/*	***************************	*/
	
	// Core system
	
class BasicPrinter
{
   		public function __construct()
		{
		} 
		
		public function pre($arr,$name="Массив")
		{
			return '<br><pre>'.$name.": ".print_r($arr).'</pre><br>';
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
		public function hr($header)
		{
			return "
			<div class='clear'></div><br>
                <h4 class='new-line'>$header</h4>
            <div class='clear'></div>
			";
		}
		public function clear()
		{
			return "<div class='clear'></div>";
		}
		
		public function print_hidden($name,$value)
		{
			if($name=='productsJsData')
			{
				$ser_arr = ($value ? $value : serialize(array()));
				return "
					<div class='zen-form-item hidden'>
						<textarea name='productsJsData' id='productsJsData'>".$ser_arr."</textarea>
					</div>
					";
				
			}else
			{
				return "
					<div class='zen-form-item hidden'>
            		    	<input	id='save-$name' class='my-field' type='hidden' value='$value' name='$name' />
            		</div>
					";
			}
		}
		public function print_input($title,$name,$hold,$value,$size=25,$onchange="",$input_type="text",$inputDisabled=false)
		{
			$disabledTxt = ($inputDisabled ? " disabled " : "");
			
			return "
			
			<div class='zen-form-item'>
				<label for='save-$name'>$title</label><br>
				<div class='zif-wrap'>
                	<input	id='save-$name' class='my-field' type='$input_type' placeholder='$hold' onchange=\"$onchange\" onkeyup=\"$onchange\" 
                    		value='$value' name='$name' size='$size' $disabledTxt />
                </div>
            </div>
			
            ";
		}		
		public function print_us_sale_input($title,$name,$hold,$value, $size=25, $uid, $onchange="",$input_type="text",$inputDisabled=false)
		{
			$disabledTxt = ($inputDisabled ? " disabled " : "");
			
			return "
			
			<div class='zen-form-item'>
				<label for='save-$name'>$title</label><br>
				<div class='zif-wrap'>
                	<input	id='save_$name' class='my-field' type='$input_type' placeholder='$hold' onchange=\"$onchange\" onkeyup=\"$onchange\" 
                    		value='$value' name='$name' size='$size' $disabledTxt />
					<input	id='user_$name'	class='my-field' type='hidden' placeholder='$hold' onchange=\"$onchange\" onkeyup=\"$onchange\" 
                    		value='$uid' name='uid' size='$size' $disabledTxt />
							
					<button class=\"r-z-h-s-create nssBut fLeft\" type=\"button\" onclick=\"update_user_sale(document.getElementById('save_$name').value, $uid);\">Применить скидку &nbsp;<span>!</span></button>
                	<span id='SaleResponse'></span>
				</div>
            </div>
			
            ";
		}
		public function print_chars_list($header,$list)
		{
			$result = "<table>";
			$result .= "	<tr>
								<th>Позиция</th>
								<th>Свойство</th>
							</tr>";
			foreach($list as $item)
			{
				$result .= "<tr>
								<td><div class='zif-wrap'>
                					<input	id='save-char_pos_".$item['id']."' class='my-field' type='number' placeholder='#' 
                    						value='".$item['pos']."' name='char_pos[".$item['id']."]' size='10'  />
                				</div></td>
								<td>".$item['name']."</td>
							</tr>";
			}
			$result .= "</table>";
			return $result;
		}
		public function print_autocomplete($title,$name,$hold,$id,$size=25,$value)
		{
			return "
			
			<div class='zen-form-item'>
				<label for='autocomplete-$name'>$title</label><br>
				<div class='zif-wrap'>
                	<input	id='autocomplete-$name' class='my-field autoselect' type='$input_type' placeholder='$hold'  
                    		value='$value' name='$name' size='$size' />
                </div>
            </div>
			
            ";
		}
		public function print_redactor($title,$name,$value)
		{
			return "
			<div class='clear'></div>
           		<div class='zen-form-item'>
					<label for='save-$name'>$title</label><br>
					<div class='zif-wrap'>
                		<textarea	id='save-$name' class='my-txtarea redactor' placeholder='HTML editor' 
                        			name='$name'>$value</textarea>
                	</div>
            	</div>
            <div class='clear'></div>
			";
		}
		public function print_code_html($title,$name,$value)
		{
			return "
			<div class='clear'></div>
           		<div class='zen-form-item'>
					<h3>$title</label><h3>
					<div class='zif-wrap'><code><pre>".htmlspecialchars($value)."</pre></code></div>
            	</div>
            <div class='clear'></div>
			";
		}
		public function print_area($title,$name,$hold,$value)
		{
			return 
			"
			<div class='clear'></div>
           		<div class='zen-form-item'>
					<label for='save-$name'>$title</label><br>
					<div class='zif-wrap'>
                		<textarea	id='save-$name' class='my-txtarea' placeholder='$hold' 
                        			name='$name'>$value</textarea>
                	</div>
            	</div>
            <div class='clear'></div>
			";
		}
		public function printStyleText($text)
		{
			return 
			"
			<div class='styleText'>$text</div>
			";
		}
		public function print_date($title,$name,$value)
		{
			$value = date("Y-m-d",strtotime($value));
			
			if($value == "1970-01-01") $value = "";
			
			return "
			<div class='zen-form-item'>
				<label for='save-$name'>$title</label><br>
				<div class='zif-wrap-date'>
                	<input id='save-$name' class='my-field dateJQ' type='text' 
                    	   value='".$value."' name='$name' />
                </div>
            </div>
			";
		}
		
		public function print_select($title,$currValue,$list,$fieldValue,$fieldTitle,$name,$change,$first=array(),$type=false)
		{
			$result = "";
			
			$result .= "
				<div class='zen-form-item'>
					<label for='save-$name'>$title</label><br>
						<div class='zif-wrap-select styled-select' style='width:300px;'>               	
							<select style='width:280px;' class='sampling_changed' id='save-$name' name='$name' onChange=\"$change\">";
							
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
		
		public function print_multiselect($title,$currValue,$list,$fieldValue,$fieldTitle,$name,$change,$first=array(),$type=false)
		{
			$result = "";
			
			$result .= "
			<div class='zen-form-item'>
				<label for='save-$name'>$title </label><br>
				<div class='zif-wrap-select styled-select' style='height:100px;'>               	
					<select style='height:100px;' class='sampling_changed' id='save-$name' name='".$name."[]' multiple size='7'>
						";
						foreach($list as $item)
						{
							$in_arr = false;
							foreach($currValue as $val){ if($val['id'] == $item['id']) { $in_arr = true; break; } }
							$result .= "<option value='".$item['id']."' ".($in_arr ? "selected" : "")." >".$item['name']."</option>";
						}
			$result .= "
					</select>
				</div>
			</div>
            ";
            
            return $result;
		}
		public function print_rotator($title,$name,$value,$reverse = false,$yes="Да",$no="Нет",$replace=false,$selfType=false,$selfValue=false,$selfId=false)
		{
			$zero = 0;
			$first = 1;
			
			if(!$selfType) $selfId = "";
			
			if($replace)
			{
				$zero = $replace[0];
				$first = $replace[1];
			}
			
			foreach($replace as $ri => $rep)
			{
				if($rep==$value)
				{
					$value = $ri;
					break;
				}
			}
			
			$ans = ($reverse ? !$value : $value);
			
			$ff_ans = ($reverse ? 'no' : 'yes');
			$fs_ans = ($reverse ? 'yes' : 'no');
			
			$sf_ans = ($reverse ? 'yes' : 'no');
			$ss_ans = ($reverse ? 'no' : 'yes');
			
			return "
			
			<div class='zen-form-item'>
				<label for='radio-$name-$selfIdyes'>$title</label><br>
                <div class='hidden'>
                	<input type='radio' name='".$name."[$selfId]' id='radio-$name-yes".$selfId."' value='$zero' ".(!$value ? " checked" : "")." >
                    <input type='radio' name='".$name."[$selfId]' id='radio-$name-no".$selfId."' value='$first' ".($value ? " checked" : "")." >
                </div>
				<div class='zif-wrap-rotator'>
                	<div class='check_yn'>
                    	<div class='item_yn  ".(!$ans ? " active" : "")."' id='$name-$ff_ans".$selfId."' onClick=\"change_rotator('$name"."','$ff_ans".$selfId."','$fs_ans".$selfId."');\">$no</div>
                        <div class='item_yn  ".($ans ? " active" : "")."' id='$name-$sf_ans".$selfId."' onClick=\"change_rotator('$name"."','$sf_ans".$selfId."','$ss_ans".$selfId."');\">$yes</div>
                    </div>
                </div>
            </div>
			
            ";
		}
		
		public function print_image_mono($header, $field, $value, $path, $appTable ,$id, $option_delete=true)
		{
			$result = "
			 <div class='clear'></div>
        	
            <input type='file' name='$field' class='hidden' id='editor-file-input' onChange=\"split_txt($(this).val());\">
                
                <div class='zen-form-item'>
					<label for='save-editor-input-file'>$header</label><br>
					<div class='zif-wrap'>
                		<input  id='save-editor-input-file'					class='my-field' 
                        		type='text' 								placeholder='../' 
                        		value=''									name='editor-input-file' 
                                size='25'									maxlength='255'
                                onchange='' 								disabled='disabled' />
                        <button class='my-field' type='button' title='Выбрать файл' onClick=\"check_file();\">Выбрать</button>
                        <button class='my-close' type='button' title='Сбросить выбор' onClick=\"uncheck_file();\">&nbsp;</button>
                	</div>
            	</div>
                
        	<div class='clear'></div>
            <div class='editor-files-wrapper' id='editor-files-wrapper-$field'>";
            if(file_exists("../../../../..".$path.$value) && trim($value) != "")
			{
						$file_ext = $this->pseudoext($value);
				
						$path_to_file = ($_SERVER['SERVER_NAME']=='localhost' ? "..".$path.$value : $path.$value);
				
						$target = "";
				
						if($file_ext=='pdf') 
						{
							$path_to_file = "split/img/pdf-icon.png";
							$target = " target='_blank' ";
						}
						if($file_ext=='doc' || $file_ext=='docx' || $file_ext=='ppt' || $file_ext=='pptx')
						{ 
							$path_to_file = "split/img/word-icon.png";
							$target = " target='_blank' ";
						}
						if($file_ext=='xls' || $file_ext=='xlsx' || $file_ext=='xltx')
						{
							$path_to_file = "split/img/excel-icon.png";
							$target = " target='_blank' ";
						}
						if($file_ext=='txt' || $file_ext=='xml' || $file_ext=='sql')
						{
							$path_to_file = "split/img/txt-icon.png";
							$target = " target='_blank' ";
						}
				
				$result .= "
				<div class='item' id='media-item-$field'>";
                if($option_delete)
                {
                	$result .= "	
                		<img class='close-file-item' alt='X' title='Удалить файл' src='".WP_FOLDER."img/close-icon.png' onClick=\"delete_media_item('$appTable','$id','$field','$path','$value');\">";
                }
              	$result .= "
					<div class='item-inside'>
                    	<a class='theater' $target href='".$path_to_file."' title='Modal view' rel='group'>
							<img alt='File not found' src='$path_to_file'>
						</a>
                    <div class='icode hidden' contenteditable='true' 
                    	onmouseover=\"$(this).stop().animate({'bottom':'0px'},400,'easeInOutExpo');\"
                        onmouseout=\"$(this).stop().animate({'bottom':'-80px'},400,'easeInOutExpo');\">
                    	<xmp>XMP_TEXT</xmp>
                    </div>
                    </div>
                </div>";
			}
			$result .= "
			</div>
            <div class='hidden' id='editor-files-buffer'></div>
            
            <div class='clear'></div>
			";
			
			return $result;
		}
		
		public function pseudoext($filename) {
   			return strtolower(substr( strstr(basename($filename), '.'), 1 ));
		}
		
		public function print_image_mult($header, $field, $value, $path, $appTable ,$id, $mas_field, $method='edit')
		{
			$result = "
			 <div class='clear'></div>
        	
            <input type='file' multiple name='".$field."[]' class='hidden' id='editor-files-input-$field' onChange=\"splits_txt($(this).val(),'$field');\">
                
                <div class='zen-form-item'>
					<label for='save-editor-input-files-$field'>$header</label><br>
					<div class='zif-wrap'>
                		<input  id='save-editor-input-files-$field'			class='my-field' 
                        		type='text' 								placeholder='../' 
                        		value=''									name='editor-input-file-$field' 
                                size='25'									maxlength='255'
                                onchange='' 								disabled='disabled' />
                        <button class='my-field' type='button' title='Выбрать файл' onClick=\"check_files('$field');\">Выбрать</button>
                        <button class='my-close' type='button' title='Сбросить выбор' onClick=\"uncheck_files('$field');\">&nbsp;</button>
                	</div>
            	</div>
                
        	<div class='clear'></div>
            <div class='editor-files-wrapper' id='editor-files-wrapper-$field'>";

            // $result .= "<p>".count($value)."</p>";
		foreach($value as $val_item)
		{
			if($method=='create') break;
			
            if(file_exists("../../../../..".$path.$val_item[$mas_field]) && trim($val_item[$mas_field]) != "")
			{
				
				$file_ext = $this->pseudoext($val_item[$mas_field]);
				
				$path_to_file = $path.$val_item[$mas_field];
				
				$target = "";
				
				if($file_ext=='pdf') 
						{
							$path_to_file = "split/img/pdf-icon.png";
							$target = " target='_blank' ";
						}
				if($file_ext=='doc' || $file_ext=='docx' || $file_ext=='ppt' || $file_ext=='pptx')
						{ 
							$path_to_file = "split/img/word-icon.png";
							$target = " target='_blank' ";
						}
				if($file_ext=='xls' || $file_ext=='xlsx' || $file_ext=='xltx')
						{
							$path_to_file = "split/img/excel-icon.png";
							$target = " target='_blank' ";
						}
				if($file_ext=='txt' || $file_ext=='xml' || $file_ext=='sql')
						{
							$path_to_file = "split/img/txt-icon.png";
							$target = " target='_blank' ";
						}
						
				$result .= "
				<div class='item' id='media-item-".$val_item['id']."'>
                	<img class='close-file-item' alt='X' title='Delete file' src='".WP_FOLDER."img/close-icon.png' onClick=\"delete_media_item_ref('".$val_item['id']."','$path');\">
					<div class='item-inside'>
                    	<a class='theater' href='".$path.$val_item[$mas_field]."' title='".$val_item[$mas_field]."' rel='group' $target >
							<img alt='File not found $file_ext' src='".$path_to_file."'>
						</a>
                    <div class='icode hidden' contenteditable='true' 
                    	onmouseover=\"$(this).stop().animate({'bottom':'0px'},400,'easeInOutExpo');\"
                        onmouseout=\"$(this).stop().animate({'bottom':'-80px'},400,'easeInOutExpo');\">
                    	<xmp>XMP_TEXT</xmp>
                    </div>
                    </div>
					<div class='file-manager-wrap'>
						 <label>Имя файла (до .$file_ext)</label>
						<input type='text' placegolder='FILE NAME' value=\"".str_replace(".$file_ext","",$val_item[$mas_field])."\" onchange=\"save_new_file_name(".$val_item['id'].",$(this).val(),'$field')\" />
						<label>ALT файла</label>
						<input type='text' placegolder='FILE ALT' value=\"".(isset($val_item['title']) ? $val_item['title'] : "Strateg file")."\" onchange=\"save_new_file_alt(".$val_item['id'].",$(this).val(),'$field')\" />
					</div>
                </div>";
			}else{
				// $result .= "<p>"."../../../../..".$path.$val_item[$mas_field]."</p>";
			}
		}
			$result .= "
			</div>
            <div class='hidden' id='editor-files-buffer'></div>
            <br><br>
            <div class='clear'></div>
			";
			
			return $result;
		}
		
		public function show_card_images()
		{
			?>
			 <div class="clear"></div>
        
            <form	name="editor-files-form" action="<?php echo WP_FOLDER ?>ajax/insert/editor-file-upload.php" 
            		enctype="multipart/form-data" target="_blank" method="POST">
            	
                <input type="hidden" name="table" value="files_ref">
                <input type="hidden" name="ref_table" value="shop_products">
                <input type="hidden" name="ref_id" value="<?php echo $this->id ?>">
                <input type="hidden" name="file_path" value="files/shop/products/">
                <input type="hidden" name="admin_id" value="<?php echo ADMIN_ID ?>">
                <input type="file" name="file" class="hidden" id="editor-file-input" onChange="split_txt($(this).val());">
                
                <div class="zen-form-item">
					<label for="save-editor-input-file">Изображение</label><br>
					<div class="zif-wrap">
                		<input  id="save-editor-input-file"					class="my-field" 
                        		type="text" 								placeholder="../" 
                        		value=""									name="editor-input-file" 
                                size="25"									maxlength="255"
                                onchange="" 								disabled="disabled" />
                        <button class="my-field" type="button" title="Выбрать файл" onClick="check_file();">Выбрать</button>
                        <button class="my-close" type="button" title="Сбросить выбор" onClick="uncheck_file();">&nbsp;</button>
                	</div>
            	</div>
                
                <div style="display:none;">
                <div class="zen-form-item hidden">
					<label for="save-file-link-yes">Ссылка?</label><br>
                	<div class="hidden">
                		<input  type="radio" name="is_link[]" id="radio-file-link-yes" value="1">
                	    <input  type="radio" name="is_link[]" id="radio-file-link-no" value="0" checked >
                	</div>
					<div class="zif-wrap-rotator">
                		<div class="check_yn">
                    		<div class="item_yn" 
                            	 id="file-link-yes" 
                                 onclick="change_rotator('file-link','yes','no');">Да</div>
                    	    <div class="item_yn active" 
                            	 id="file-link-no" 
                                 onclick="change_rotator('file-link','no','yes');">Нет</div>
                    	</div>
                	</div>
            	</div>
                
                <div class="zen-form-item hidden">
					<label for="save-file-link">Ссылка для перехода</label><br>
					<div class="zif-wrap">
                		<input  id="save-file-link"							class="my-field" 
                        		type="text" 								placeholder="#" 
                        		value=""									name="link" 
                                size="25"									maxlength="100"
                                onchange="" />
                	</div>
            	</div>
                
                <div class="zen-form-item hidden">
					<label for="save-file-target-yes">Новая вкладка</label><br>
                	<div class="hidden">
                		<input  type="radio" name="is_target[]" id="radio-file-target-yes" value="1">
                	    <input  type="radio" name="is_target[]" id="radio-file-target-no" value="0" checked >
                	</div>
					<div class="zif-wrap-rotator">
                		<div class="check_yn">
                    		<div class="item_yn" 
                            	 id="file-target-yes" 
                                 onclick="change_rotator('file-target','yes','no');">Да</div>
                    	    <div class="item_yn active" 
                            	 id="file-target-no" 
                                 onclick="change_rotator('file-target','no','yes');">Нет</div>
                    	</div>
                	</div>
            	</div>
                </div><!-- none -->
                
                <div class="zen-form-item">
                	<label for="save-submit"></label><br>
					<div class="zif-wrap">
                        <button class="my-field-submit" type="submit" title="Загрузить файл">Загрузить</button>
                	</div>
            	</div>
            </form>
        
        
        	<div class="clear"></div>
            
            <?php
            $query = "SELECT * FROM [pre]files_ref 
						WHERE `ref_table`='".$this->table."' 
						AND `ref_id`='".$this->id."' 
						LIMIT 100";
			$_res = $this->rs($query);
			?>
            
            <div class="editor-files-wrapper" id="editor-files-wrapper-1">
            <?php
            foreach($_res as $rf)
			{
				$rf_data = '';
				if($rf['is_link'])
				{
					$rf_data .= '<a href="'.$rf['href'].'" ';
					if($rf['target'])
					{
						$rf_data .= 'target="_blank" ';
					}
					$rf_data .= '>';
				}
				
				$rf_data .= '<img alt="Not found" src="/'.WP_FOLDER.$rf['path'].$rf['file'].'">'; 
				
				if($rf['is_link'])
				{
					$rf_data .= '</a>';
				}
			?>
            	<div class="item" id="rf-item-<?php echo $rf['id'] ?>">
                	<img class="close-file-item" alt="X" title="Удалить файл" src="<?php echo WP_FOLDER ?>img/close-icon.png" onClick="delete_rf(<?php echo $rf['id'] ?>);">
                	<div class="item-inside">
                    	<img alt="File not found" src="/split/<?php echo $rf['path'] ?>crop/<?php echo $rf['crop'] ?>">
                    <div class="icode hidden" contenteditable="true" 
                    	onmouseover="$(this).stop().animate({'bottom':'0px'},400,'easeInOutExpo');"
                        onmouseout="$(this).stop().animate({'bottom':'-80px'},400,'easeInOutExpo');">
                    	<xmp><?php echo $rf_data ?></xmp>
                    </div>
                    </div>
                </div>
            <?php
			}
			?>
            </div>
            <div class="hidden" id="editor-files-buffer"></div>
            
            <div class="clear"></div>
			<?php
		}
		
		// Shop Product Chars table
		
		public function print_shopProductChars($header,$field,$chars,$has_chars=0)
		{
			$result = "";
			$result .= "
			<div id='wp-form-extra-fields-wrap'>            	
			<br>
                <p title='Группа характеристик'>Группа свойств: <b>$header</b> </p>";

	            /* TEST
	            ob_start();
	            echo "<pre>"; print_r($chars); echo "</pre>";
	            $result .= ob_get_contents();
	            ob_end_clean();
	            */
            
            $result .="    
                <br>
				<table class='chars-table'>";
				if($has_chars)
				{
					foreach($chars as $char)
					{
						$result .= "
                		<tr>
                	    	<td>".$char['name']."".($char['measure']!="" ? ", ".$char['measure'] : "")."</td>
                	        <td>
                	        	<input id='char-".$char['char_id']."' class='my-field' type='text' placeholder='".$char['title']."' value='".$char['value']."' name='".$field."[".$char['char_id']."]' size='25' maxlength='100'>
							</td>
						";
						/*
						$result .= "<td> Полное значение: </td>
                	        <td>
                	        	<input id='char2-".$char['char_id']."' class='my-field' type='text' placeholder='".$char['title']."' value='".$char['value2']."' name='".$field."2[".$char['char_id']."]' size='25' maxlength='100'>
							</td>
						</tr>
						";
						*/
					}
				}else
				{
					$char_cnt = 0;
					foreach($chars as $char)
					{
						$char_cnt++;
						$result .= "
                		<tr>
                	    	<td>".$char['name']."".($char['measure']!="" ? ", ".$char['measure'] : "")."</td>
                	        <td>
                	        	<input id='char-".$char['id']."' class='my-field' type='text' placeholder='".$char['title']."' value='' name='".$field."[".$char['id']."]' size='25' maxlength='100'>
							</td>
						</tr>
						";
					}
				}
                $result .= "
				</table>
				</div>
			";
			return $result;
		}

	// Shop Product Dinamic Chars table

	public function print_shopProductDinamicChars($header,$field,$chars,$has_chars=0)
	{
		$result = "";
		$result .= "
			<div id='wp-form-extra-dinamic-fields-wrap'>
			<br>
                <p title='Группа характеристик'>Группа свойств: <b>$header</b>
					<button class=\"r-z-h-s-create nssBut fLeft\" type=\"button\" onclick=\"add_new_dinamic_char();\">Добавить свойство &nbsp;&nbsp;&nbsp;<span>+</span></button>
				</p>
                <br>
				<table class='chars-table' id=\"dinamic_chars_table\">
					<tbody>
					";
		if($has_chars)
		{
			foreach($chars as $char)
			{
				$result .= "
                		<tr id=\"dinamicChar-".$char['id']."\">
                	    	<td>".$char['name']."".($char['measure']!="" ? ", ".$char['measure'] : "")."</td>
                	        <td>
                	        	<input id='char-".$char['id']."' class='my-field' type='text' placeholder='".$char['title']."' value='".$char['value']."' name='".$field."[".$char['id']."]' size='25' maxlength='100'>
							</td>
							<td> Новая цена (грн): </td>
                	        <td>
                	        	<input id='char2-".$char['id']."' class='my-field' type='hidden' placeholder='".$char['title']."' value='".$char['value2']."' name='".$field."2[".$char['id']."]' size='25' maxlength='100'>

								<input id='char3-".$char['id']."' class='my-field' type='text' placeholder='".$char['title']."' value='".$char['price_dif']."' name='".$field."3[".$char['id']."]' size='15' maxlength='10'>
							</td>
							<td>
								<button class=\"close-option r-z-h-s-close\" type=\"button\" title=\"Удалить\" onclick=\"delete_dinamic_char(".$char['id'].");\"></button>
							</td>
						</tr>
						";
			}
		}else
		{
			/*
			$char_cnt = 0;
			foreach($chars as $char)
			{
				$char_cnt++;
				$result .= "
                		<tr>
                	    	<td>".$char['name']."".($char['measure']!="" ? ", ".$char['measure'] : "")."</td>
                	        <td>
                	        	<input id='char-".$char['id']."' class='my-field' type='text' placeholder='".$char['title']."' value='' name='".$field."[".$char['id']."]' size='25' maxlength='100'>
							</td>
						</tr>
						";
			}
			*/
		}
		$result .= "
					</tbody>
				</table>
				</div>
			";
		return $result;
	}
		
		// Print cart products table vs Delete option
		
		public function print_cart_products($orderId,$products,$nodeList=array(),$deliverySum=0,$type=false,$discount=0)
		{
			$str = "";
			
			if($type == "create") $orderId = 0;
			
			$orderSum = 0;
			
			$str .=  "
					<div class='r-z-c-table'>
            			<table class='maintable' id='main-table'>
                    		<div class='head-tr'>
						";
					
					$str .= "<th class='main-t-th'>Название товара</th>";
					$str .= "<th class='main-t-th'>Артикул</th>";
					$str .= "<th class='main-t-th'>Кол-во (шт)</th>";
					$str .= "<th class='main-t-th'>Цена (грн)</th>";
					$str .= "<th class='main-t-th'>Сумма (грн)</th>";
					$str .= "<th class='main-t-th'>Удалить</th>";
						
			$str .= "
							</div>
                			<tbody id='productsItemsJs'>
						";	
						
			$icnt = 0;
			foreach($products as $pi => $product)
			{
				$icnt++;
				$iid = $product['prod_id'];
				$iclass = ($icnt%2==1 ? "trcolor" : "");
		
				if(isset($product['prod_id']) && $product['prod_id'])
				{
		
					$prodMassive = $this->rs("SELECT id,name,sku,code,price FROM [pre]shop_products WHERE id=".$product['prod_id']." LIMIT 1");
				}else
				{
					continue;
				}
				
					$prod = ($prodMassive ? $prodMassive[0] : array('id'=>0,'name'=>'','sku'=>'','code'=>'','price'=>0));
						
					$curr_price = ($product['price_dif'] ? $product['price_dif'] : $prod['price']);
					$curr_name = ($product['price_dif'] ? $product['name']." (".$product['char_value'].")" : $prod['name']);
						
					$curr_sum = $curr_price*$product['quant'];
				
				$str .= "
						<tr class='$iclass' id='$iid'>
						";
						
						$str .= "<td style='padding-left:10px;'>".$curr_name."</td>";
						$str .= "<td>".$prod['sku']."</td>";
						$str .= "<td>".$product['quant']."</td>";
						$str .= "<td>".$curr_price."</td>";
						$str .= "<td>".$curr_sum."</td>";
						$str .= "<td>
									<button class='close-option r-z-h-s-close' type='button' title='Удалить из заказа' onclick=\"delete_create_cart_product_admin($pi);\"></button>
								</td>";
								
								// <button class='close-option r-z-h-s-close' type='button' title='Удалить из заказа' onclick=\"delete_cart_product_admin($orderId,$pi);\"></button>
						
				$str .= "</tr>";
				
				$orderSum += $curr_sum;
			}
					
			$str .= "
							</tbody>
                		</table>
            		</div>
					";
					
			// Show in total info
			
			$discount_diff = round(($orderSum * $discount)/100,2)*1;
			
			$str .= "
					<table class='intotal w100'>
						<tr>
							<th>Позиций:	<span id='createProductsQuant'>".count($products)."</span></th>
							<th>Сумма:		<span id='createOrderSum'>".$orderSum."</span> грн.</th>
							<th>Доставка:	<span id='createOrderDeliverySum'>".(float)$deliverySum."</span> грн.</th>
							<th>Всего:		<span id='createOrderTotalSum'>".(round($orderSum-$discount_diff+$deliverySum,2)*1)."</span> грн. ";
			
			if($discount)
			{
				$str .= " Скидка: $discount_diff грн ($discount%)";
			}
			
			$str .= "		</th>
							<th> <button class='r-z-h-s-create nssBut fRight' id='paf_but' type='button' onclick=\"slide_toggle_add_products_form();\">Добавить товар &nbsp;&nbsp;&nbsp;<span>+</span></button> </th>
						</tr>
					</table>
					
					<div id='products_adding_form' style='display:none;'>
						<table class='intotal'>
							<tr>
								<td id='uploadBrandsTd'>
									".( $this->print_select("Категория товаров",
															0,
															$nodeList,
															'id',
															'name',
															'challange_brand',
															"reload_adding_products_admin($(this).val(),$orderId,'$type');",
															$first=array('name'=>'Выбрать...','id'=>0),
															'allCatalog') 
															)."
								</td>
								<td id='reloadCategoriesTd'></td>
							</tr>
						</table>
						
						<div id='reloadAddingProductsAdmin'></div>
						
					</div>
					";
					
			return $str;
		}
		
		public function prod_access_script($id,$list)
		{
			$result = "<br><button class='r-z-h-s-create nssBut fLeft' type='button' onclick=\"prod_access_script($id);\">Выбрать аксессуары &nbsp;&nbsp;&nbsp;<span>+</span></button>";
			
			$result .= "<br><div id='prod_access_list'><br>";
			
			if(!$list)
			{
				$result .= "<p>Список аксессуаров пуст.</p>";
			}else
			{
				$result .= "<p>Список аксессуаров:</p>";
			}
			
			$result .= "<table>
							<tbody>";
							
			foreach($list as $acc)
			{
				$ref_id = $acc['id'];
				$acc_id = $acc['acc_id'];
				$acc_name = $acc['acc_name'];
				$acc_photo = $acc['acc_filename'];
				
				$result .= "
							<tr id='prod_acc_ref_$ref_id'>
								<td>ID: $acc_id</td>
								<td class='img'><a class='theater' href='/split/files/shop/products/$acc_photo' title='Аксессуар: ".str_replace("'","",$acc_name)."'><img alt='NO PHOTO' src='/split/files/shop/products/$acc_photo' /></a></td>
								<td>$acc_name</td>
								<td class='last'> <button class='close-option r-z-h-s-close' type='button' title='Удалить' onclick='delete_prod_acc_ref($ref_id);'></button> </td>
							</tr>
							";
			}
								
			$result .= "	</tbody>
						</table>";
			
			$result .= "</div> <!-- prod_access_list END -->";
			
			return $result;
		}
		
		public function prod_complect_script($id,$list)
		{
			$result = "<br><button class='r-z-h-s-create nssBut fLeft' type='button' onclick=\"prod_complect_script($id);\">Выбрать комплектующие товары &nbsp;&nbsp;&nbsp;<span>+</span></button>";
			
			$result .= "<br><div id='prod_complect_list'><br>";
			
			if(!$list)
			{
				$result .= "<p>Список комплектующих товаров пуст.</p>";
			}else
			{
				$result .= "<p>Список комплектующих товаров:</p>";
			}
			
			$result .= "<table>
							<tbody>";
							
			foreach($list as $acc)
			{
				$ref_id = $acc['id'];
				$acc_id = $acc['acc_id'];
				$acc_name = $acc['acc_name'];
				$acc_price = $acc['acc_price'];
				$c_price = $acc['c_price'];
				$acc_photo = $acc['acc_filename'];
				
				$result .= "
							<tr id='prod_comp_ref_$ref_id'>
								<td>ID: $acc_id</td>
								<td>Цена: <b>$acc_price</b> грн</td>
								<td>В комплекте: <input class='my-field' type='number' placeholder='Цена в комплекте' onchange=\"change_c_price($(this).val(),$ref_id)\" value='$c_price' name='c_prices[$ref_id]' size='25'> грн<br>
									<span id='c_price_saved_$ref_id'></span>
								</td>
								<td class='img'><a class='theater' href='/split/files/shop/products/$acc_photo' title='Товар в комплекте: ".str_replace("'","",$acc_name)."'><img alt='NO PHOTO' src='/split/files/shop/products/$acc_photo' /></a></td>
								<td>$acc_name</td>
								<td class='last'> <button class='close-option r-z-h-s-close' type='button' title='Удалить' onclick='delete_prod_comp_ref($ref_id);'></button> </td>
							</tr>
							";
			}
								
			$result .= "	</tbody>
						</table>";
			
			$result .= "</div> <!-- prod_complect_list END -->";
			
			return $result;
		}
		
		// Return STRING about NOTES table
		
		public function print_notes($notes_header,$notes=array())
		{
			$str = "";
			
			$str .= $this->hr($notes_header);
			
			$str .= "
					<table class='intotal'>";
			foreach($notes as $header => $value)
			{
				$str .= "
						
						<tr>
							<td>$header</td>
							<td>$value</td>
						</tr>";
			}
			$str .= "
					</table>
					";
			
			return $str;
		}
		
		// Функция правильной урезки строки по количеству символов
		public function cropStr($str, $size)
		{ 
  			return mb_substr($str,0,mb_strrpos(mb_substr($str,0,$size,'utf-8'),' ','utf-8'),'utf-8');
		}
		
		// Корректный вывод даты
		public function deformat_date($val)
		{
			$result = "";
			$monthes = array('','янв','фев','мар','апр','мая','июня','июля','авг','сен','окт','нбр','дек');
			
			if(strtotime($val) > strtotime(date("d.m.Y",time())." 00:00:00") && strtotime($val) <= strtotime(date("d.m.Y",time()+86000)." 00:00:00"))
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
									if(strtotime($val) > strtotime(date("d.m.Y",time()+86000)." 00:00:00"))
									{
										if(strtotime($val) < strtotime(date("d.m.Y",time()+(2*86000))." 00:00:00"))
										{
											$result = "Завтра, ".date("H:i",strtotime($val));
										}else{
																	$result = date("d",strtotime($val))." ".
																	$monthes[(int)date("m",strtotime($val))]." ".
																	date("Y",strtotime($val)).", ".
																	date("H:i",strtotime($val));
											}
									}else
									{
										$result = "Сегодня, ".date("H:i",strtotime($val));
									}
		
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
	
		// Корректная подрезка строки
		function next_sub_str($str,$len)
		{
			return implode(array_slice(explode('<br>',wordwrap($str,$len,'<br>',false)),0,1));
		}
		
		public function __destruct()
		{
		}
}