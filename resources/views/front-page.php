<?php get_template_part('resources/views/header'); ?>

<main class="container mx-auto my-16 flex-1">
    <div class="prose mx-auto">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>
</main>

<?php get_template_part('resources/views/footer'); ?>