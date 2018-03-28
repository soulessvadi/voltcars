<div class="row slider">
	<!-- <img src="img/tree.png" alt="Tree" class="tree" /> -->
	<div class="owl-carousel primary_banner">

	<?php foreach ($main_banner as $key): ?>
		<div class="item mb" data-id="<?= $key->id; ?>">
			<div class="container">
				<div class="description">
					<?= $key->data; ?>

				</div>
			</div>
			<img src="<?= BANNER_PATH.$key->file; ?>" alt="<?= $key->name; ?>" class="slide" title="<?= $key->name; ?>" />
		</div>
	<?php endforeach ?>
	</div>
</div>

<div class="row slider_m">
	<div class="owl-carousel_m primary_banner">
	<?php foreach ($main_banner_m as $key): ?>
		<div class="item">
			<div class="container">
				<div class="description">
					<?= $key->data; ?>
				</div>
			</div>
			<img src="<?= BANNER_PATH.$key->file; ?>" alt="<?= $key->name; ?>" class="slide" title="<?= $key->name; ?>" />
		</div>
	<?php endforeach ?>
	</div>
</div>


<div class="row banner_secondary hidden-sm hidden-xs" id="banner_secondary">
	<div class="owl-carousel_1">
		<?php foreach ($main_banner_sec as $key): ?>
			<div class="item">
                <img src="<?php echo BANNER_PATH.$key['file']; ?>" alt="" title="" />
            </div>
		<?php endforeach ?>
	</div>
</div>

<div class="row low_b">
	<img src="<?= BANNER_PATH.$test_drive_desctop['file']; ?>" alt="Volt-car" class="desc" />
	<img src="<?= BANNER_PATH.$test_drive_mobile['file']; ?>" alt="Volt-car" class="mob" />
	<button type="button" class="open_td_mob" data-toggle="modal" data-target="#test_drive_modal">Заказать тест-драйв</button>
	<div class="clear"></div>



    <div class="desc_td_row">
        <form action="#" method="POST" id="td_query_form">
        	<h4>Заявка на <span>тест-драйв</span></h4>
            <input type="text" name="name" placeholder="Ваше Имя" />
            <input type="text" name="phone" placeholder="Ваш телефон" />
            <p class="response">Вместо 1000 слов - один тест-драйв!</p>
            <button type="button" onclick="ajax.submit_td();" class="submit">Записаться</button>
        </form>
    </div>
</div>
<div class="row preferences">
	<div class="container">
		<div class="col-lg-12 col-md-12 hidden-sm hidden-xs">
			<h3>Электромобили <span>- это...</span></h3>
			<table>
				<tbody>
					<tr>
						<td>
							<img src="<?= RS;?>img/ic_1.png" alt="Icon" />
							<p>Стиль</p>
						</td>
						<td>
							<img src="<?= RS;?>img/ic_2.png" alt="Icon" />
							<p>Экономичность</p>
						</td>
						<td>
							<img src="<?= RS;?>img/ic_3.png" alt="Icon" />
							<p>Экологичность</p>
						</td>
						<td>
							<img src="<?= RS;?>img/ic_4.png" alt="Icon" />
							<p>Безопасность</p>
						</td>
						<td>
							<img src="<?= RS;?>img/ic_5.png" alt="Icon" />
							<p>Прогресс</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="hidden-lg hidden-md col-sm-12 col-xs-12 pref_item">
			<h3>Электромобили <span>- это...</span></h3>
		</div>
		
		<div class="hidden-lg hidden-md col-sm-6 col-xs-6 pref_item">
			<img src="<?= RS;?>img/ic_1.png" alt="Icon" />
			<p>Стиль</p>
		</div>
		<div class="hidden-lg hidden-md col-sm-6 col-xs-6 pref_item">
			<img src="<?= RS;?>img/ic_2.png" alt="Icon" />
			<p>Экономичность</p>
		</div>

		<div class="hidden-lg hidden-md col-sm-6 col-xs-6 pref_item">
			<img src="<?= RS;?>img/ic_3.png" alt="Icon" />
			<p>Экологичность</p>
		</div>
		<div class="hidden-lg hidden-md col-sm-6 col-xs-6 pref_item">
			<img src="<?= RS;?>img/ic_4.png" alt="Icon" />
			<p>Безопасность</p>
		</div>
		<div class="hidden-lg hidden-md col-sm-12 col-xs-12 pref_item pref_item_l">
			<img src="<?= RS;?>img/ic_5.png" alt="Icon" />
			<p>Прогресс</p>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="row hidden-sm hidden-xs separator"></div>

<div class="row perfect">
	<?= $statistics_block[0]['html'];?>
</div>

<div class="row reasons">
	<div class="container">
		<div class="col-lg-12"><h3><span>5 причин</span> <br /> купить электромобиль</h3></div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 tac fst">
			
			<ul>
				<?php foreach ($reasons as $key => $value): ?>
					<?php if ($key <=2): ?>
						<li><?= $value->content ?></li>
					<?php endif ?>
				<?php endforeach ?>
			</ul>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 tac">
			<ul>
				<?php foreach ($reasons as $key => $value): ?>
					<?php if ($key > 2 && $key <=4): ?>
						<li><?= $value->content ?></li>
					<?php endif ?>
				<?php endforeach ?>
				<?php //<li>Заряжается за ночь даже от обычной бытовой розетки</li> ?>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="row gallery tac">
	<h3>Больше фото!</h3>
	<p>Чтобы ты выбрал именно - <span>электромобиль...</span></p>
	<span class="alig">	
		<ul>
			<?php foreach ($gallery_list as $key): ?>
				<li><button type="button" onclick="ajax.load_gallery(this, <?= $key['id']; ?>)"><?= $key['name']; ?></button></li>
			<?php endforeach ?>
		</ul>
	</span>
	<div class="clear"></div>
	<div class="container gal_wr">
		<div class="gal_det_cap">
			<h4 class="capt"><?= $gal_data['caption']; ?></h4>
			<span class="det_target"><?= $gal_data['data']; ?></span>
		</div>
		<div id="img_wrap">

			<?php if ($gallery): ?>

					<?php foreach ($gallery as $item): ?>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 item">
			                <a href="<?php echo GALLERY_PATH.$item['file']; ?>" class="fancyimage" data-fancybox-group="group">
			                	<div class="hover"></div>
			                    <img src="<?php echo GALLERY_PATH."crop/335x193_".$item['file']; ?>" alt="Volt-Car" class="img-responsive" />
			                </a>
			            </div>

					<?php endforeach ?>

			<?php else: ?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 item"></div>
			<?php endif ?>
			
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="row about">
	<?= $about_block[0]['html'];?>
</div> 
<div class="row contacts hidden-sm hidden-xs">
	<div class="col-lg-12 col-md-12">
		<h3>Связаться с нами</h3>
	</div>
	<div class="col-lg-6 col-md-6 lz por">
		<div class="ph_box">
			<p><?php echo (isset($site_phone1) && $site_phone1 != "" ? $site_phone1 : ""); ?></p>
			<p><?php echo (isset($site_phone2) && $site_phone2 != "" ? $site_phone2 : ""); ?></p>
			<p><?php echo (isset($site_phone3) && $site_phone3 != "" ? $site_phone3 : ""); ?></p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 hidden-sm hidden-xs rz">
		<p>Мы будет рады видеть Вас в нашем салоне</p>
		<?php echo (isset($site_address) && $site_address != "" ? "<div class='address'>".$site_address."</div>" : ""); ?>
		
		<?php echo (isset($site_email) && $site_email != "" ? "<div class='email'>".$site_email."</div>" : ""); ?>
		<div class="clear"></div>
		<form action="#" method="POST" id="contact_form" class="contact_form">
			<input type="text" name="name" placeholder="Ваше Имя"  required="required" />
			<input type="email" name="email" placeholder="Ваш Email"  required="required" />
			<textarea name="message" placeholder="Ваше Сообщение" required="required" ></textarea>
			<button type="button" class="submit" onclick="ajax.contact_form();">Отправить</button>
			<p class="response"></p>
		</form>
	</div>
</div> 