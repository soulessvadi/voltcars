<div class="row blog_post">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tac">
			<span class="alig2">
				<ul class="breadcrumbs">
					<li><a href="<?= RS; ?>">Главная </a>/ </li>
					<li><a href="<?= RS."blog/"; ?>">Блог</a>/ </li>
					<li><?php 
							if (strlen($post_item['name']) > 100) {
								echo implode(array_slice(explode('<br>',wordwrap(strip_tags($post_item['name']),100,'<br>',false)),0,1))."...";
							}else{
								echo $post_item['name'];
							}
					?></li>

				</ul>
			</span>
			<div class="clear"></div>
			<h3 class="car_item_header">Блог</h3>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 article">
			<?php if ($post_item['is_video'] != 1): ?>
				<img src="<?= BANNER_PATH.$post_item['filename'];?>" alt="Post Image" />
			<?php endif ?>
			
			<h4><?= $post_item['name']; ?></h4>
			<hr>
			<?php echo $post_date; ?>

				<?= $post_item['content']; ?>
			
			<div class="clear"></div>
			<div class="gal">
				<div class="gal_det_cap tac">
					<h4 class="capt"><?= $gal_cap[0]['caption']; ?></h4>
					<span class="det_target"><?= $gal_cap[0]['data']; ?></span>
					<div class="space20"></div>
				</div>
				<div class="clear"></div>
				<?php if (isset($item_gallery) && $item_gallery): ?>
					<?php foreach ($item_gallery as $item): ?>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 item">
			                <a href="<?php echo GALLERY_PATH.$item['file']; ?>" class="fancyimage" data-fancybox-group="group">
			                	<div class="hover"></div>
			                    <img src="<?php echo GALLERY_PATH."crop/335x193_".$item['file']; ?>" alt="Volt-Car"  class="img-responsive" />
			                </a>
			            </div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
			

			<hr class="clear" />
			<div class="tac mt40">
				<span>
					<div class="ya-share2" data-services="facebook,odnoklassniki,gplus" data-counter=""></div>
				</span>
			</div>
			
		</div>
	</div>
</div>