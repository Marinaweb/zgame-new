<?php 
/**
 * The template for displaying the front page
 */
 get_header(); ?>

<?php 
    if(have_posts() ):
        while(have_posts() ): the_post(); 
?>

<div class="container">
	<div class="front_sliders">
		<div class="manufacturers">
			<h2 class="h2_title">Производители настольных игр</h2>
			<div class="man_slide">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_1.png">	
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_2.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_3.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_4.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_5.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_6.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_7.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_8.png">	
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_9.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_10.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_11.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_12.png">
			</div>
			<div class="man_slide">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_1.png">	
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_2.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_3.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_4.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_5.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_6.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_7.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_8.png">	
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_9.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_10.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_11.png">
				<img src="<?php bloginfo('template_url') ?>/build/images/manufacturer_12.png">
			</div>
		</div><!-- .manufacturers -->

		<div class="slider_banner">
			<img src="<?php bloginfo('template_url') ?>/build/images/slide.jpg">
			<img src="<?php bloginfo('template_url') ?>/build/images/slide.jpg">
			<img src="<?php bloginfo('template_url') ?>/build/images/slide.jpg">
		</div><!-- 	.slider_banner -->

	</div><!-- .front_sliders -->

	<div class="popular_cat">
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_easy_games.png">Простые игры</a>
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_for_children.png">Для детей</a>
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_for_family.png">Для всей семьи</a>
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_for_two.png">Для двоих</a>
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_for_company.png">Для компании</a>
	</div><!-- .popular_cat -->

	<div class="front_products_wrap">
		<h2 class="h2_title">Хиты продаж</h2>
		<aside class="sidebar">
			<h3>Подбор игры</h3>
			<?php dynamic_sidebar( 'filter-woocommerce' ); ?>
		</aside>
		<div class="front_products">

		     <?php 
		        $args = array(
		          'post_type' => 'product', 
		          'posts_per_page' => 8,
		        );
		        $loop = new WP_Query($args);

		        if( $loop->have_posts() ):
		          while( $loop->have_posts() ): $loop->the_post(); 
		     ?>
		      	<div class="product_item">
		      	    <div class="game_img"><?php echo get_the_post_thumbnail( $post->ID, 'middle' ); ?></div>
		      	    <a class="game_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		      	    <div class="price_stock"> 
		                <div class="price">
		                    <p class="from">
			                    <?php if ( $product->is_type( 'variable' ) ) {
			                        echo "от ";
			                    } ?>                  
			                </p>
			                <?php echo $product->get_price_html(); ?>               
			            </div>
			            <div class="in_stock">
			                <?php if (get_post_meta(get_the_ID(), '_stock_status', true) == 'outofstock') {
			                    echo '<div class="outofstock">Нет в наличии</div>';
			                    } else {
			                      echo '<div class="stock">В наличии</div>';
			                    } 
			                ?>
		                </div> 
		            </div>
		            <div class="buttons">
		            	<?php echo do_shortcode('[viewBuyButton]'); ?>		                
						<form class="cart" method="post" enctype='multipart/form-data'>
						   <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
						   <button type="submit" class="single_add_to_cart_button button alt">Добавить в корзину</button>
						</form>
		            </div>
		        </div>

            <?php endwhile; ?>      
		    <?php else: ?>
		    <?php endif;
		        wp_reset_postdata(); 
		    ?>





		</div><!-- .front_products -->
	</div><!-- .front_products_wrap -->

	<?php the_content(); ?>

	<div class="video_games">
	  	<div class="container">
		    <h2 class="h2_title">Наш канал на YouTube</h2>
			<?php echo do_shortcode('[yourchannel user="Магазин Zshop"]'); ?>	    
		</div><!-- .container -->
	</div><!-- .video_games -->

	<div class="instagram_front">
	  	<div class="container">
		    <h2 class="h2_title">Мы в Instagram</h2>
			<?php echo do_shortcode('[instagram-feed]'); ?>	    
		</div><!-- .container -->
	</div><!-- .instagram_front -->



</div><!-- .container -->


<?php endwhile;	?>
<?php else: ?>
<?php endif; ?>

<?php get_footer(); ?>