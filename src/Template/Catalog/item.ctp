<div class="row catalog_item">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tac">
			<span class="alig2">
				<ul class="breadcrumbs">
					<li><a href="<?= RS; ?>">Главная </a>/ </li>
					<li><a href="<?= RS."catalog/"; ?>">Каталог</a>/ </li>
					<li><?= $product_item['name']?></li>

				</ul>
			</span>
			<div class="clear"></div>
			<h3 class="car_item_header"><?= $product_item['name'] ; ?></h3>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 main">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 big_img">
					<a href="<?php echo PRODUCT_PATH.$product_item['file']; ?>" class="fancyimage" data-fancybox-group="group">
						<div class="hover"></div>
	                    <img src="<?php echo PRODUCT_PATH.$product_item['file']; ?>" alt="Volt-Car" class="img-responsive" />
	                </a>
			</div>

			<?php if (count($item_gallery) > 1): ?>
				<?php foreach ($item_gallery as $key =>$value): ?>
					<?php //if ($key < 3): ?>
						<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs low_img">
							<a href="<?= GALLERY_PATH.$value['file']; ?>" class="fancyimage" data-fancybox-group="group">
								<div class="hover"></div>
			                    <img src="<?= GALLERY_PATH."crop/335x193_".$value['file']; ?>" alt="Volt-Car" class="img-responsive" />
			                </a>
						</div>
					<?php //endif ?>
				<?php endforeach ?>
			<?php else: ?>
				<?php echo ""; ?>
			<?php endif ?>
			
		</div>


		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 description">
			<p class="head"><?= $product_item['name']; ?> <span><?= $product_item['dop_text']; ?></span></p>
			<p class="price"><?= $product_item['price']; ?> <span>$</span></p>
			<hr class="mb50" />
			<?php 
			foreach($product_chars as $char_item)
			{
				if(trim($char_item['value'])=="") continue;
				?>
				<p class="charRow"><?php echo $char_item['char_name'] ?>: <span><?php echo $char_item['value']." ".$char_item['measure'] ?></span></p>
				<?php
			}
			?>
			<?php /* 
			($product_item['model']) ? '<p class="model">Модель: <span>'. $product_item['model'] .'</span></p>' : "" ?>
			<?= ($product_item['equipment']) ? '<p class="equipment">Комплектация: <span>'. $product_item['equipment'] .'</span></p>' : "" ?>
			<?= ($product_item['year']) ? '<p class="year">Год: <span>'. $product_item['year'] .'</span></p>' : "" ?>
			<?= ($product_item['col']) ? '<p class="color">Цвет: <span>'. $product_item['col'] .'</span></p>' : "" ?>
			<?= ($product_item['mileage']) ? '<p class="mileage">Пробег: <span>'. $product_item['mileage'] .' км</span></p>' : "" ?>
			<?= ($product_item['ad_options']) ? '<p class="options">Дополнительные опции: <span>'. $product_item['ad_options'] .'</span></p>' : "" ?>
			<?= ($product_item['details']) ? '<p class="options">Описание товара: <span>'. $product_item['details'] .'</span></p>' : "" 
			*/
			?>
			<?php if (isset($product_item['details']) && $product_item['details'] != ""): ?>
				<div class="details">
					<hr />
					<p class="charRow">Описание товара:</p>
					<?= $product_item['details']; ?>
				</div>
			<?php endif ?>
			
			

			<hr class="mt50" />

			<div class="contact_box">
				<h5>Отдел продаж:</h5>
				<ul>
					<?php echo (isset($site_address) && $site_address != "" ? "<li>".$site_address."</li>" : ""); ?></li>
					<?php echo (isset($site_email) && $site_email != "" ? "<li>".$site_email."</li>" : ""); ?></li>
					<?php echo (isset($site_phone1) && $site_phone1 != "" ? "<li>".$site_phone1."</li>" : ""); ?></li>
					<?php echo (isset($site_phone2) && $site_phone2 != "" ? "<li>".$site_phone2."</li>" : ""); ?></li>
					<?php echo (isset($site_phone3) && $site_phone3 != "" ? "<li>".$site_phone3."</li>" : ""); ?></li>
				</ul>
			</div>

		</div>


	</div>
</div>
	