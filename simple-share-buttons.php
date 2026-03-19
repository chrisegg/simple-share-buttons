<?php
/**
 * Plugin Name: Simple Share Buttons
 * Plugin URI: https://chriseggleston.com/plugins/simple-share-buttons
 * Description: Lightweight collapsible social share buttons via shortcode. Supports Facebook, Twitter, Pinterest, Tumblr, Email, and more.
 * Version: 1.0.0
 * Author: Chris Eggleston
 * Author URI: https://chriseggleston.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-share-buttons
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SIMPLE_SHARE_VERSION', '1.0.0');
define('SIMPLE_SHARE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SIMPLE_SHARE_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once SIMPLE_SHARE_PLUGIN_DIR . 'includes/networks.php';

/**
 * Enqueue plugin assets (CSS and JS)
 */
function simple_share_enqueue_assets() {
    // Enqueue plugin CSS
    wp_enqueue_style(
        'simple-share-css',
        SIMPLE_SHARE_PLUGIN_URL . 'style.css',
        array(),
        SIMPLE_SHARE_VERSION
    );

    // Enqueue plugin JS
    wp_enqueue_script(
        'simple-share-js',
        SIMPLE_SHARE_PLUGIN_URL . 'script.js',
        array(),
        SIMPLE_SHARE_VERSION,
        true
    );
}

/**
 * Enqueue assets early if shortcode might be used
 * This is a fallback - the shortcode function also enqueues directly
 */
function simple_share_maybe_enqueue() {
    global $post;
    
    // Always enqueue on singular posts/pages (most common use case)
    if (is_singular() && $post) {
        // Check if shortcode exists in content
        if (has_shortcode($post->post_content, 'simple_share')) {
            simple_share_enqueue_assets();
        }
    }
}
add_action('wp_enqueue_scripts', 'simple_share_maybe_enqueue');

/**
 * Render share buttons shortcode
 *
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function simple_share_render_buttons($atts) {
    // Set global flag to enqueue assets
    global $simple_share_used;
    $simple_share_used = true;
    
    // Enqueue assets directly (WordPress handles duplicates)
    simple_share_enqueue_assets();

    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'networks' => 'facebook,twitter,pinterest,tumblr,email',
        'collapsed' => 0, // 0 means show all by default
        'size' => 'medium',
        'button_color' => '',
    ), $atts, 'simple_share');

    // Get current post/page URL and title
    $url = get_permalink();
    $title = get_the_title();

    // If no post context, use site URL and name
    if (empty($url)) {
        $url = home_url($_SERVER['REQUEST_URI']);
    }
    if (empty($title)) {
        $title = get_bloginfo('name');
    }

    // Parse networks
    $networks = array_map('trim', explode(',', strtolower($atts['networks'])));
    $networks = array_filter($networks); // Remove empty values

    // Get share links
    $links = simple_share_get_links($url, $title);

    // Filter networks to only include supported ones
    $networks = array_intersect($networks, array_keys($links));

    if (empty($networks)) {
        return ''; // No valid networks
    }

    $collapsed_num = intval($atts['collapsed']);

    $color = !empty($atts['button_color']) ? sanitize_hex_color($atts['button_color']) : '';
    if (empty($color)) {
        $color = '#2563eb';
    }

    // Only collapse if collapsed parameter is set and > 0
    $should_collapse = $collapsed_num > 0;
    
    // Start output buffering
    ob_start();

    if ($should_collapse) {
        $collapsed_num = max(1, $collapsed_num);
        $has_more = count($networks) > $collapsed_num;
        $visible_networks = array_slice($networks, 0, $collapsed_num);
        $hidden_networks = $has_more ? array_slice($networks, $collapsed_num) : array();
    } else {
        // Show all networks
        $has_more = false;
        $visible_networks = $networks;
        $hidden_networks = array();
    }
    
    // Add inline fallback styles if CSS hasn't loaded
    static $inline_styles_added = false;
    if (!$inline_styles_added) {
        echo '<style>
        .simple-share-wrapper.share-menu-container{position:relative;display:inline-block;margin:10px 0}
        .simple-share-wrapper .share-menu{display:inline-flex;align-items:center;gap:12px;flex-wrap:wrap}
        .simple-share-wrapper .share-icon{display:inline-flex!important;align-items:center;justify-content:center;width:40px!important;height:40px!important;border-radius:50%!important;background:var(--simple-share-color,#2563eb)!important;color:#fff!important;text-decoration:none!important;cursor:pointer;transition:opacity 0.2s;padding:0!important;border:none!important;font-size:1.5em;line-height:1.6;box-sizing:border-box}
        .simple-share-wrapper .share-icon:hover{color:#fff!important;background:var(--simple-share-color,#2563eb)!important;opacity:0.8}
        .simple-share-wrapper .share-icon svg{width:1em!important;height:1em!important;fill:#fff!important;color:#fff!important}
        .simple-share-wrapper .share-icon:hover svg{fill:#fff!important;color:#fff!important}
        .simple-share-wrapper .share-icon-hidden{display:none!important}
        .simple-share-wrapper.expanded .share-icon-hidden{display:inline-flex!important}
        </style>';
        $inline_styles_added = true;
    }

    include SIMPLE_SHARE_PLUGIN_DIR . 'templates/share-buttons.php';

    return ob_get_clean();
}
add_shortcode('simple_share', 'simple_share_render_buttons');

