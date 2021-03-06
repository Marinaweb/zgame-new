<?php 
/**
 * The template for displaying the front page
 */
 get_header(); ?>

<?php 
    if(have_posts() ):
        while(have_posts() ): the_post(); 
?>

	<div class="front_sliders container clearfix">
		<div class="manufacturers_wrap">
			<h2 class="h2">Производители настольных игр</h2>
			<div class="manufacturers">			
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
		</div>

		<div class="slider_banner_wrap">
			<div class="slider_banner">
				<img src="<?php bloginfo('template_url') ?>/build/images/slide.jpg">
				<img src="<?php bloginfo('template_url') ?>/build/images/slide.jpg">
				<img src="<?php bloginfo('template_url') ?>/build/images/slide.jpg">
			</div><!-- 	.slider_banner -->
		</div>

	</div><!-- .front_sliders -->

	<div class="popular_cat container">
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_easy_games.png"><h3>Простые игры</h3></a>
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_for_children.png"><h3>Для детей</h3></a>
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_for_family.png"><h3>Для всей семьи</h3></a>
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_for_two.png"><h3>Для двоих</h3></a>
		<a href="/product-category/prostye/"><img src="<?php bloginfo('template_url') ?>/build/images/cat_for_company.png"><h3>Для компании</h3></a>
	</div><!-- .popular_cat -->

	<div class="front_products_wrap container">
		<h2 class="h2_title"><span class="filter_icon"></span>Хиты продаж</h2>
		<div class="front_products_inner">
			<aside class="sidebar sidebar_cat">
				<h3>Подбор игры</h3>
				<?php dynamic_sidebar( 'filter-category' ); ?>
			</aside>
			<div class="front_products main_part">

				<div class="main_part_inner">
				     <?php 
				        $tax_query[] = array(
					        'taxonomy' => 'product_visibility',
					        'field'    => 'name',
					        'terms'    => 'featured',
					        'operator' => 'IN',
					    );
				        $args = array(
				          'post_type' => 'product', 
				          'posts_per_page' => 8,
				          'tax_query'  => $tax_query,
				        );
				        $loop = new WP_Query($args);

				        if( $loop->have_posts() ):
				          while( $loop->have_posts() ): $loop->the_post(); 
				     ?>
				      	<div class="product_item">
				      	    <div class="game_img"><?php echo get_the_post_thumbnail( $post->ID, 'middle' ); ?></div>
				      	    <a class="game_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

				      	    <div class="price_stock"> 

 								<?php if ( $product->is_type( 'variable' ) ): ?>
					                <div class="price_variable">
					                    <p class="from">от</p>
						                <?php echo $product->get_price_html(); ?>               
						            </div>
					        	<?php endif; ?>

					        	<?php if ( $product->is_type( 'simple' ) ): ?>
					                <div class="price">
						                <?php echo $product->get_price_html(); ?>               
						            </div>
					        	<?php endif; ?>
					        

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
								   <?php if ( $product->is_type( 'variable' ) ): ?>
								   		<a class="single_add_to_cart_button button alt" href="<?php the_permalink(); ?>">Выбрать игру</a>
								   <?php endif; ?>
								   <?php if ( $product->is_type( 'simple' ) ): ?>
								   		<button type="submit" class="single_add_to_cart_button button alt">Добавить в корзину</button>
								   <?php endif; ?>
								</form>
				            </div>
				        
					        <div class="attr_product">

					          <div class="atribute_wrap type">
					          	  <p class="atribute_item">
			                          <?php echo $product->get_attribute('tip-igr'); ?>,
			                      </p>
					          </div>
					            
			                  <div class='atribute_wrap vremya-igry'>
			                      <span class='atribute_img'></span>
			                      <p class="atribute_item">
			                          <?php echo $product->get_attribute('vremya-igry'); ?>
			                      </p>
			                  </div>

			                  <div class='atribute_wrap kolichestvo-igrokov'>
			                      <span class='atribute_img'></span>
			                      <p class="atribute_item">Ко-во игроков: 
			                        <?php echo $product->get_attribute('kolichestvo-igrokov'); ?>
			                      </p>
			                  </div>

			                  <div class='atribute_wrap vozrast'>
			                      <span class='atribute_img'></span>
			                      <p class="atribute_item">Возраст: 
			                          <?php echo $product->get_attribute('vozrast'); ?>
			                      </p>
			                  </div>

			                  <div class='atribute_wrap yazyk'>
			                      <span class='atribute_img'></span>
			                      <p class="atribute_item">Язык: 
			                          <?php echo $product->get_attribute('yazyk'); ?>
			                      </p>
			                  </div>            
					            
							</div><!-- .attr_product -->

						</div><!-- .product_item -->

		            <?php endwhile; ?>      
				    <?php else: ?>
				    <?php endif;
				        wp_reset_postdata(); 
				    ?>
					
				</div>

			</div><!-- .front_products -->			
		</div><!-- .front_products_inner -->

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


<?php endwhile;	?>
<?php else: ?>
<?php endif; ?>

<?php get_footer(); ?>


