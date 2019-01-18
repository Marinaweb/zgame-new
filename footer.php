
<footer id="footer">
	<div class="container">
		<div class="contacts_foo">
			<h3>Контакты</h3>
			<div class="tel_f">
				<a class="tel" href="tel:+380974239753"><i></i>(097) 423-97-53</a>
				<a class="viber" href="viber://chat?number=+380632961946"><i></i>(063) 296-19-46</a>
				<a class="email" href="mailto:mansurov.zhenya@gmail.com"><i></i>mansurov.zhenya@gmail.com</a>
				<p class="address">Харьков, ул. Улица 55</p>
				<p class="time">Пн.-Вс.:10:00 - 20:00</p>
			</div>
		</div>
		<div class="information_foo">
			<h3>Информация</h3>
			<?php wp_nav_menu(array('theme_location'=>'footer_menu', 'menu_class'=>'footer_menu')); ?>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
