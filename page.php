<?php get_header(); ?>

<?php 
    if(have_posts() ):
        while(have_posts() ): the_post(); 
?>

<div class="container">
    
    <div class="title_page_wrap">
        <h1 class="title_page"><?php the_title(); ?></h1>
    </div>

    <div class="page_content">
        <?php the_content(); ?>
    </div>
    
</div>

<?php endwhile; ?>
<?php else: ?>
<?php endif; ?>

<?php get_footer(); ?>