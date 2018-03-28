<div class="row electrocars">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1><?= $page_content['header']; ?></h1>
			<h3><?= $page_content['sub_header']; ?></h3>

			<div class="cont_db">
				<?= $page_content['details']; ?>
			</div>
		</div>
		<?php foreach ($electrocars as $car): ?>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 car_item">
				<a href="<?= $car['alias']; ?>">
					<div class="img_wr">
                        <div class="hover">
                            <p><span>Узнать больше</span></p>
                        </div>
                        <img src="<?= BANNER_PATH."crop/330x272_".$car['filename']; ?>" alt="Item" />
                    </div>
					<p><?= $car['name']; ?></p>
				</a>
			</div>
		<?php endforeach ?>
		<div class="clear"></div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tac">
			<span class="alig mb60">
				<ul class="pag">
					<?php if ($num_pages > 1): ?>
						<?php 
							for ($i=1; $i < $num_pages+1; $i++) { 
								?>
									<li><a href="?page=<?php echo $i; ?>" class="<?php echo ($cur_page == $i  ? 'active' : ''); ?>"><?php echo $i; ?></a></li>
								<?php
							}
						?>
					<?php endif ?> 
				</ul>
			</span>
			<div class="clear"></div>
		</div>


	</div>

</div>
	