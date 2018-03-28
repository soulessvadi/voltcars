<div class="row site_m">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1>Карта сайта</h1>
				<hr />
				<ul class="sitemap">
					
					<li><a href="<?= RS; ?>">Главная</a></li>
					<li><hr /></li>
					<li><a href="<?php echo RS . "catalog/" ?>">Каталог</a></li>
					<li class="secondary">
						<ul>
							<?php
							foreach($catalogMap as $cat)
							{
								$curr_cat_url = RS ."catalog/". $cat['alias']."/";
								?>
								<li>
									<a href="<?php echo $curr_cat_url ?>"><?php echo $cat['name'] ?></a>
									<ul class="ground">
									<?php
										foreach($cat['prodItems'] as $prod)
										{
											$curr_prod_url = $curr_cat_url . $prod['alias'] . "/";
											?>
											<li class="low">
												<a href="<?php echo $curr_prod_url ?>"><?php echo $prod['name'] ?></a>
											</li>
											<?php
										}
									?>
									</ul>
									<!-- END OF CATEGORY PRODUCTS -->
								</li>
								<?php
							}
							?>
						</ul>
						<!-- END OF CATALOG CATEGORIES -->

					</li>
					<!-- END OF CATALOG MENU ITEM -->
					<li><hr /></li>
					<li><a href="<?php echo RS . "electrocars/" ?>">Электромобили</a></li>
					<li class="secondary">
						<ul>
							<?php foreach ($electrocars_links as $key => $value): ?>
								<li><a href="<?= RS."electrocars/".$value; ?>"><?= $key; ?></a></li>
							<?php endforeach ?>
						</ul>
					</li>
					<li><hr /></li>
					<li><a href="<?php echo RS . "charge/" ?>">Электрозаправки</a></li>
					
					<?php
						if (isset($menu_links['Блог'])) {
						 	?>
						 		<li><hr /></li>
						 		<li><a href="<?php echo RS . "blog/" ?>">Блог</a></li>
						 	<?php
						 } 
					?>
					
					<li class="secondary">
						<ul>
							<?php foreach ($blog_links as $key => $value): ?>
								<li><a href="<?= RS."blog/".$value; ?>"><?= $key; ?></a></li>
							<?php endforeach ?>
						</ul>
					</li>
					<li><hr /></li>
					<li><a href="<?php echo RS . "blog/" ?>">Контакты</a></li>
					<li><hr /></li>
					<li><a href="https://kaminskiy-design.com.ua">Разработка сайтов | KAM STUDIO</a></li>
				</ul>
				<!-- END OF SITEMAP -->
				<hr />

		</div>
	</div>
</div>
		