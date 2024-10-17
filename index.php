<?php get_header(); ?>

<div id="content">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div><?php the_excerpt(); ?></div>
        <?php endwhile; ?>
    <?php else : ?>
        <h2><?php _e('No Posts Found', 'starter-theme'); ?></h2>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
