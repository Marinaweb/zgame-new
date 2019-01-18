<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>> 

	<header id="header">
		<div class="header_first">
			<div class="header_top container">
				<?php wp_nav_menu(array('theme_location'=>'header_menu_top', 'menu_class'=>'header_menu_top')); ?>
			</div>
			<div class="header_middle container">
				<div class="logo_h">
					<a href="/"><img src="<?php bloginfo('template_url') ?>/build/images/logo.png"></a>
				</div>
				<div class="tel_h">
					<a class="tel_1" href="tel:+380974239753"><i></i>(097) 423-97-53</a>
					<a class="tel_2" href="viber://chat?number=+380632961946"><i></i>(063) 296-19-46</a>
				</div>
				<div class="call_h">
					<a href="#modal_call" class="modalbox">Обратный звонок</a>
					<p>Ежедневно с 10.00 до 20.00</p>
					<div id="modal_call" class="modal_custom" style="display: none;">
						<?php echo do_shortcode('[contact-form-7 id="60" title="Обратный звонок"]'); ?>
					</div>
				</div>
				<div class="search_h">
					<?php dynamic_sidebar( 'search-sidebar' ); ?>
				</div>
				<div class="basket_h">
					<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>">
						<img src="<?php bloginfo('template_url') ?>/build/images/basket.png">
					</a>
				</div>
			</div>
		</div>
		<div class="header_bottom">
			<div class="container">
				<?php wp_nav_menu(array('theme_location'=>'header_menu', 'menu_class'=>'header_menu')); ?>
				<div class="product_categories">
					<?php echo do_shortcode('[product_categories columns="4"]'); ?>
				</div>
			</div>			
		</div>

	</header><!-- #header -->

    



	