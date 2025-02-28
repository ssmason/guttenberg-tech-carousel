<?php
/**
 * Plugin Name: Guttenbert Tech Carousel
 * Description: A custom Gutenberg block plugin for creating a tech carousel.
 * Author: Steve
 * Version: 1.0.0
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: guttenbert-tech-carousel
 * Domain Path: /languages
 */

use WP_Query;

/**
 * Enqueue carousel and swiper scripts. 
 *
 * @return void Just registering the CPT.
 * 
 */
function enqueue_tech_carousel_assets(): void {
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    wp_enqueue_script('tech-carousel-js', plugin_dir_url(__FILE__) . 'block/tech-carousel.js', array('swiper-js'), null, true);
    wp_enqueue_style('tech-carousel-css', plugin_dir_url(__FILE__) . 'block/tech-carousel.css');
}
add_action('wp_enqueue_scripts', 'enqueue_tech_carousel_assets');


/**
 * Register icons CPT. 
 *
 * @return void Just registering the CPT.
 * 
 */
function register_tech_icons_cpt(): void {
    $args = array(
        'label' => 'Tech Icons',
        'public' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-site',
    );
    register_post_type('tech_icons', $args);
}
add_action('init', 'register_tech_icons_cpt');

/**
 * Register block. 
 *
 * @return void Registering the block.
 * 
 */
function register_tech_carousel_block(): void {

    wp_register_script(
        'tech-carousel-block',
        plugin_dir_url(__FILE__) . 'build/index.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(plugin_dir_path(__FILE__) . 'build/index.js'),
        true
    );
    
    register_block_type(__DIR__ . '/block', array(
        'editor_script' => 'tech-carousel-block',
        'render_callback' => 'render_tech_icons_carousel'
    ));
}
add_action('init', 'register_tech_carousel_block');

/**
 * Rester endpoint for use in block/tech-carousel.js.
 *
 * @return void Rgistering the endpoint.
 * 
 */
function register_tech_icons_rest() {
    register_rest_route('tech-carousel/v1', '/icons/', array(
        'methods' => 'GET',
        'callback' => 'get_tech_icons',
    ));
}
add_action('rest_api_init', 'register_tech_icons_rest');


/**
 * Render call back function to replace save. 
 *
 * @return string The HTML for the block.
 * 
 */
function render_tech_icons_carousel(): string {
    $icons = get_tech_icons(); // Fetch icons from the CPT
    if (empty($icons)) return '<p>No icons found.</p>';

    ob_start(); ?>
    <div class="swiper-container tech-icons-carousel">
        <div class="swiper-wrapper">
            <?php foreach ($icons as $icon): ?>
                <div class="swiper-slide">
                    <div class="tech-icon">
                        <img src="<?php echo esc_url($icon['image']); ?>" alt="<?php echo esc_attr($icon['title']); ?>" />
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php return ob_get_clean();
}
 
/**
 * WP Query on CPT tech icons to return array of icons added icons.
 *
 * @return array Array of icons from CPT tech_icons .
 * 
 */
function get_tech_icons(): array {
    $query = new WP_Query(array(
        'post_type' => 'tech_icons',
        'posts_per_page' => -1
    ));
    $icons = [];
    while ($query->have_posts()) {
        $query->the_post();
        $icons[] = array(
            'title' => get_the_title(),
            'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium')
        );
    }
    wp_reset_postdata();
    return $icons;
}