<?php get_template_part('resources/views/header'); ?>

<main class="container mx-auto flex-1">
    <div class="prose mx-auto">
        <h1><?php echo single_post_title('', false) ?: post_type_archive_title('', false); ?></h1>
    </div>
    <?php if (have_posts()) : ?>
        <ul class="divide-y prose mx-auto">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <article>
                        <h2><?php the_title(); ?></h2>
                        <?php the_excerpt(); ?>
                    </article>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <div class="prose mx-auto">
            <p><?php _e('No results found.', 'veloce'); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_template_part('resources/views/footer'); ?>