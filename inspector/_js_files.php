		<!-- JavaScript files placed at the end of the document so the pages load faster
		================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="/design/plugins/jquery.min.js"></script>
        
        <script type="text/javascript" src="/design/bootstrap/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="/js/jquery.cookie.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="/design/plugins/modernizr.js"></script>

		<!-- jQuery REVOLUTION Slider  -->
		<script type="text/javascript" src="/design/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="/design/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

		<!-- Isotope javascript -->
		<script type="text/javascript" src="/design/plugins/isotope/isotope.pkgd.min.js"></script>

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="/design/plugins/owl-carousel/owl.carousel.js"></script>

		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="/design/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

		<!-- Appear javascript -->
		<script type="text/javascript" src="/design/plugins/jquery.appear.js"></script>

		<!-- Count To javascript -->
		<script type="text/javascript" src="/design/plugins/jquery.countTo.js"></script>

		<!-- Parallax javascript -->
		<script src="/design/plugins/jquery.parallax-1.1.3.js"></script>

		<!-- Contact form -->
		<script src="/design/plugins/jquery.validate.js"></script>

		<!-- jQuery Autocompleete -->
		<script type="text/javascript" src="/js/jquery.autocomplete.js"></script>
		
        <!-- jQuery UI -->
		<script type="text/javascript" src="/js/jquery-ui-1.8.17.js"></script>
        
		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="/design/js/template.js"></script>

		<!-- FIRMA Scripts -->
		<script type="text/javascript" src="/js/js.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="/design/js/custom.js"></script>
        
        <script>
		function sendFeedBack()
		{
			$('#feedBackForm .response').html('Отправка данных...');
			$.post("/ajax/action.json.SendMessage.php",$('#feedBackForm').serialize(),function(data,status){
					if(status=='success')
					{
						if(data.status=='success')
						{
							$('#feedBackForm .modal-content').html('<p>'+data.message+'</p>');
						}else
						{
							$('#feedBackForm .response').html(data.message);
						}
					}else{
						$('#feedBackForm .response').html('Ошибка сервера, пожалуйста повторите попытку позже.');
						}
				},"json");
		}
		</script>