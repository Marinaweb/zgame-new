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

</div>


<?php endwhile;	?>
<?php else: ?>
<?php endif; ?>

<?php get_footer(); ?>