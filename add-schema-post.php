<?php
// Add schema to single post 
add_action('wp_head', 'schema_single_post');
function schema_single_post() {
    if ( ! is_single() ) return;

    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Article',
        'headline' => get_the_title(),
        'author'   => ['@type' => 'Person', 'name' => get_the_author()],
        'datePublished' => get_the_date('c'),
        'publisher' => ['@type' => 'Organization', 'name' => get_bloginfo('name')],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
}   