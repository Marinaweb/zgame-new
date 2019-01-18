<?php get_header(); ?>

<div class="container container_woo">
    
    <div class="title_page_wrap">
    	<?php woocommerce_breadcrumb(); ?>
        <h1 class="title_page"><?php the_title(); ?></h1>
    </div>

    <div class="page_content">
        <?php woocommerce_content(); ?>
    </div>
    
</div>

<?php get_footer(); ?>

