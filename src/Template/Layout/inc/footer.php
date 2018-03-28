<div class="row footer">
	<div class="container">
		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
			<a href="<?= $this->url->build(RS) ?>" class="logo">
				<img src="<?= $this->url->build(BANNER_PATH.$footer_logo['file']) ?>" alt="Logo" />
			</a>
			<button type="button" class="open_td_mob" data-toggle="modal" data-target="#test_drive_modal">Заказать тест-драйв</button>
		</div>
		<div class="col-lg-7 col-xs-7 hidden-sm hidden-xs">
				<ul class="f_nav">
					<?php foreach ($nav_menu as $key): ?>
						<li class="<?= (FA == $key->alias)? 'active' : '' ?>">
							<a href="<?= $this->url->build(RS.$key->alias) ?>" <?= ($key->target == 1) ? "target='_blank'" : "" ?>><?= $key->name; ?></a>
						</li>
					<?php endforeach ?>
					<li class="<?= (FA == "sitemap")? 'active' : '' ?>"><a href="<?= $this->url->build('/sitemap') ?>">Карта сайта</a></li>
				</ul>
				<hr class="cop_hr hidden-sm hidden-xs" />
				<div class="copy hidden-sm hidden-xs">2015 © Copyright VOLT Cars | <a href="https://kaminskiy-design.com.ua" title="Создание адаптивных сайтов" target="_blank">Сайт создан в KAM-Studio</a></div>
		</div>
		<div class="col-lg-2 col-xs-2 hidden-sm hidden-xs">
			<div class="social">
				<ul>
					<?php echo (isset($fb_link) && $fb_link != "" ? "<li><a href='".$fb_link."' target='_blank' >
						<img src='".$this->Url->build('/img/f1.png')."' alt='Facebook' />
					</a></li>" : ""); ?>
					<?php echo (isset($vk_link) && $vk_link != "" ? "<li><a href='".$vk_link."' target='_blank' >
						<img src='".$this->Url->build('/img/f2.png')."' alt='VK' />
					</a></li>" : ""); ?>
					<?php echo (isset($gp_link) && $gp_link != "" ? "<li><a href='".$gp_link."' target='_blank' >
						<img src='".$this->Url->build('/img/f3.png')."' alt='Google +' />
					</a></li>" : ""); ?>
					<?php echo (isset($yt_link) && $yt_link != "" ? "<li><a href='".$yt_link."' target='_blank' >
						<img src='".$this->Url->build('/img/f4.png')."' alt='Youtube' />
					</a></li>" : ""); ?>
				</ul>
			</div>
		</div>
		<div class="hidden-lg hidden-md col-sm-12 col-xs-12 cp">
			<div class="container">
				<table>
			        <tbody>
			            <tr>
			            	<?= (isset($fb_link) && $fb_link != "" ? "<td><a href='".$fb_link."' target='_blank' ><img src='".$this->Url->build('/img/fb_y.png')."' alt='Facebook' /></a></td>" : ""); ?>
			            	<?= (isset($vk_link) && $vk_link != "" ? "<td><a href='".$vk_link."' target='_blank' ><img src='".$this->Url->build('/img/vk_y.png')."' alt='VK' /></a></td>" : ""); ?>
			            	<?= (isset($gp_link) && $gp_link != "" ? "<td><a href='".$gp_link."' target='_blank' ><img src='".$this->Url->build('/img/g_y.png')."' alt='Google +' /></a></td>" : ""); ?>
			            	<?= (isset($yt_link) && $yt_link != "" ? "<td><a href='".$yt_link."' target='_blank' ><img src='".$this->Url->build('/img/yt_y.png')."' alt='Youtube' /></a></td>" : ""); ?>
			            </tr>
			        </tbody>
			    </table>
			    <hr class="cop_hr_m" />
				<div class="copy_m">2015 © Copyright VOLT Cars</div>
				<div class="author"><a href="https://kaminskiy-design.com.ua" title="Создание адаптивных сайтов" target="_blank">Сайт создан в KAM-Studio</a></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>