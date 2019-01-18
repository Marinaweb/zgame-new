
<?php get_header(); ?>

<?php the_post(); ?>
<div class="container container_custom ">

<div class="common_breadcrumbs">
	<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(''); ?>
</div>
    
<h1 style="line-height: 50px"><?php the_title(); ?></h1>

<div>
	<?php the_content(); ?>
</div>

</div>
<?php get_footer(); ?>