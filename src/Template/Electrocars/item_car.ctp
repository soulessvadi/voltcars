<?php
	if (isset($car_item) || $car_item != "" || count($car_item) > 0) {
	 	?>
	 		<div class="row el_car_item">
				<div class="container">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tac">
						<span class="alig2">

							<ul class="breadcrumbs">
								<li><a href="<?= RS; ?>">Главная </a>/ </li>
								<li><a href="<?= RS.'electrocars/' ;?>">Электромобили </a> /</li>
								<li><?= $car_item['name'] ;?></li>
							</ul>
						</span>
						<div class="clear"></div>
						<h2 class="car_item_header"><?= $car_item['name'] ; ?></h2>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content">
						<?= $car_item['content']; ?>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="gallery container">
				<?php
					if (isset($gal_cap[0]['caption']) || $gal_cap[0]['det']) {
					 	?>
					 		<div class="gal_det_cap tac" style="margin-top: -40px;">
								<h4 class="capt"><?= $gal_cap[0]['caption']; ?></h4>
								<span class="det_target"><?= $gal_cap[0]['data']; ?></span>
								<div class="space20"></div>
							</div>
					 	<?php
					} 
				?>
				
				<div class="clear"></div>
				<?php if (isset($gallery) && $gallery): ?>
					<?php foreach ($gallery as $item): ?>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 item">
			                <a href="<?php echo GALLERY_PATH.$item['file']; ?>" class="fancyimage" data-fancybox-group="group">
			                	<div class="hover"></div>
			                    <img src="<?php echo GALLERY_PATH."crop/335x193_".$item['file']; ?>" alt="Volt-Car"  class="img-responsive" />
			                </a>
			            </div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
			<div class="clear"></div>
	 	<?php
	 }else{
	 	?>
	 		<div class="row el_car_item">
				<div class="container">
					<h2 class="car_item_header">Материал пуст</h2>
				</div>
			</div>
	 	<?php
	 }
?>

	