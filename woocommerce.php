<?php get_header(); ?>

<div class="container container_woo">
	<?php
	if ( is_tax( 'product_cat' ) || is_shop() || is_search() ) { ?>
		<aside class="sidebar sidebar_woo">
			<div class="sidebar_inner">
				<h3>Подбор игры</h3>
				<?php dynamic_sidebar( 'filter-woocommerce' ); ?>				
			</div>			
		</aside>
	<?php
		}
	?>

	<?php
	if ( is_product() ) { ?>
		<aside class="sidebar sidebar_cat">
			<div class="sidebar_inner">
				<h3>Подбор игры</h3>
				<?php dynamic_sidebar( 'filter-category' ); ?>				
			</div>			
		</aside>
	<?php
		}
	?>

	<div class="woo_products main_part">
		<span class="filter_icon"></span>
	    <?php woocommerce_breadcrumb(); ?>
	    <div class="page_content">
	        <?php woocommerce_content(); ?>
	    </div>	
	    <?php
			if ( is_product() ) { ?>
			<div class="product_contact"><?php echo do_shortcode('[contact-form-7 id="60" title="Обратный звонок"]'); ?></div>
		<?php
			}
		?>	
	</div>
    
</div>

<?php get_footer(); ?>

