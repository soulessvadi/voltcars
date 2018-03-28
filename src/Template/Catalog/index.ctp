<div class="row catalog">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tac">
			<h1><?= $page_content['header']; ?></h1>
			<h3><?= $page_content['sub_header']; ?></h3>

			<div class="cont_db">
				<?= $page_content['details']; ?>
			</div>


			<span class="alig">
				<ul class="categories_sel">
					<?php foreach ($categories as $key): ?>
						<li><button class="<?= ($key->alias == $first_category_alias)? 'active' : '' ?>" type="button" onclick="ajax.load_category(this, '<?= $key->alias; ?>')"><?= $key->name; ?></button></li>
					<?php endforeach ?>		
				</ul>
			</span>

			<div class="clear"></div>
			<div id="catalog_scope">
				<?php if ($products): ?>
					
				
					<?php foreach ($products as $key): ?>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 prod_item">
							<a href="<?= $key['alias']; ?>">
								<div class="img_wr">
									<div class="hover">
										<p><span>Узнать больше</span></p>
									</div>
									<img src="<?= PRODUCT_PATH."crop/330x270_".$key['file']; ?>" alt="Item" class="catalog_image"/>
								</div>
								<div class="wrap">
									<p><?= $key['name']; ?> <span><?= $key['dop_text']; ?></span></p>
									<p class="price"><?= $key['price']; ?> <span class="bold">$</span></p>
								</div>
							</a>
						</div>
					<?php endforeach ?>
				<?php else: ?>
					<span class='cat_response'>Раздел пуст</span>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
