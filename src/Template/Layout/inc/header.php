<div class="row header">
	<div class="container">
		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 mb_head pad0">
			<a href="<?= $this->url->build(RS) ?>" class="logo">
				<img src="<?= $this->url->build(BANNER_PATH.$header_logo['file']) ?>" alt="Logo" class="logo_img"/>
				<img src="<?= $this->url->build(BANNER_PATH.$mobile_logo['file']) ?>" alt="Logo" class="logo_img_wh"/>
			</a>
		</div>
		<div class="col-lg-8 col-md-8 hidden-sm hidden-xs tac">
			<span class="alig">
				<ul class="nav">
					<?php foreach ($nav_menu as $key): ?>
						<li class="<?= (FA == $key->alias)? 'active' : '' ?>">
							<a href="<?= $this->url->build(RS.$key->alias) ?>" <?= ($key->target == 1) ? "target='_blank'" : "" ?>>
								<?= $key->name; ?>
							</a>
						</li>
					<?php endforeach ?>
				</ul>
			</span>
		</div>
		<div class="col-lg-2 col-md-2 rz hidden-sm hidden-xs">
			<p class="tar"><?= (isset($header_phone) && $header_phone != "" ? $header_phone : ""); ?></p>
			<button type="button" data-toggle="modal" data-target="#test_drive_modal" class="flr">Заказать <span>тест-драйв</span></button>
		</div>
	</div>
</div>


