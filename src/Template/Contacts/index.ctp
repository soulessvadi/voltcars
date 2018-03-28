<div class="row contact_row pb30">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1><?= $page_content['header']; ?></h1>
			<h3 class="mb25"><?= $page_content['sub_header']; ?></h3>
			<div class="cont_db">
				<?= $page_content['details']; ?>
			</div>
		</div>
		<h3>Где и как нас найти</h3>
		<div class="clear"></div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<?php echo (isset($site_address) && $site_address != "" ? "<div class='address'>".$site_address."</div>" : ""); ?>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<?php echo (isset($site_email) && $site_email != "" ? "<div class='email'>".$site_email."</div>" : ""); ?>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="ph_box">
				<p><?php echo (isset($site_phone1) && $site_phone1 != "" ? $site_phone1 : ""); ?></p>
				<p><?php echo (isset($site_phone2) && $site_phone2 != "" ? $site_phone2 : ""); ?></p>
				<p><?php echo (isset($site_phone3) && $site_phone3 != "" ? $site_phone3 : ""); ?></p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div id="g_map"></div>
	<script>
	var map;
	function initMap() {

	  var location = {lat: 50.460642, lng: 30.354626}

	  map = new google.maps.Map(document.getElementById('g_map'), {
	    center: location,
	    zoom: 17
	  });

	  var marker = new google.maps.Marker({
	    position: location,
	    map: map,
	    title: 'Volt-Car'
	  });
	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiC0dnhF7uCtck2AL5_DHKa-cU_VnRbWc&callback=initMap"
	async defer></script>
</div>

<div class="row contact_row">
	<div class="container">
		
		<div class="clear"></div>
		<h3 class="mb40 mt25">Оцени достоинства своего будущего автомобиля</h3>

		<div class="cont_db">
			<p class="sub_h">Уже хотите попасть к нам на тест-драйв?</p>

			<p>Тогда заполните заявку на тест-драйв или свяжитесь с нами. После того, как заявка будет отправлена, наши менеджеры свяжутся с Вами и согласуют процедуру предоставления Вам авто для тест-драйва.</p>
		</div>

		<form action="#" method="POST" class="td_query_form_2 mt25" id="td_query_form_2">
            <input type="text" name="name" placeholder="Ваше Имя" />
            <input type="text" name="phone" placeholder="Ваш телефон" />
            
            <button type="button" onclick="ajax.submit_td2();" class="submit">Отправить</button>
            <div class="clear"></div>
        </form>
        <p class="td_response"></p>
		<div class="clear"></div>

		<h4>У вас есть вопросы, задайте их нам!</h4>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form action="#" method="POST" id="contact_form" class="contact_form">
				<input type="text" name="name" placeholder="Ваше Имя"  required="required" class="inp" />
				<input type="email" name="email" placeholder="Ваш Email"  required="required" class="inp2" />
				<textarea name="message" placeholder="Ваше Сообщение" required="required" class="txt_ar"></textarea>
				<button type="button" class="submit" onclick="ajax.contact_form();">Отправить</button>
				<p class="response"></p>
			</form>
		</div>
	</div>
</div>
	