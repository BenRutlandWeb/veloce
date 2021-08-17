<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>

<head>
    <meta charset="<?php echo get_bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('flex flex-col min-h-screen'); ?>>
    <?php wp_body_open(); ?>

    <header class="py-8 shadow bg-white sticky top-0">
        <nav class="container mx-auto flex justify-between">

            <span>Veloce</span>

            <?php
            wp_nav_menu([
                'menu'       => 'primary_menu',
                'container'  => 'ul',
                'menu_class' => 'flex gap-8',
            ]);
            ?>

        </nav>
    </header>