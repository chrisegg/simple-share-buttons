<?php
/**
 * Share buttons template
 *
 * Variables: $visible_networks, $hidden_networks, $links, $has_more, $color
 *
 * @package Simple_Share_Buttons
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="share-menu-container simple-share-wrapper" style="--simple-share-color: <?php echo esc_attr($color); ?>">
    <div class="share-menu">
        <?php foreach ($visible_networks as $network): ?>
            <?php if (isset($links[$network])): ?>
                <a href="<?php echo esc_url($links[$network]); ?>"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="share-icon share-icon-<?php echo esc_attr($network); ?>"
                   title="<?php echo esc_attr(sprintf(__('Share on %s', 'simple-share-buttons'), simple_share_get_network_name($network))); ?>"
                   aria-label="<?php echo esc_attr(sprintf(__('Share on %s', 'simple-share-buttons'), simple_share_get_network_name($network))); ?>">
                    <?php echo wp_kses(simple_share_get_icon($network), simple_share_allowed_svg_tags()); ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($has_more): ?>
            <?php foreach ($hidden_networks as $network): ?>
                <?php if (isset($links[$network])): ?>
                    <a href="<?php echo esc_url($links[$network]); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="share-icon share-icon-<?php echo esc_attr($network); ?> share-icon-hidden"
                       title="<?php echo esc_attr(sprintf(__('Share on %s', 'simple-share-buttons'), simple_share_get_network_name($network))); ?>"
                       aria-label="<?php echo esc_attr(sprintf(__('Share on %s', 'simple-share-buttons'), simple_share_get_network_name($network))); ?>">
                    <?php echo wp_kses(simple_share_get_icon($network), simple_share_allowed_svg_tags()); ?>
                </a>
                <?php endif; ?>
            <?php endforeach; ?>

            <button type="button"
                    class="share-icon expand-toggle"
                    aria-label="<?php esc_attr_e('Show more sharing options', 'simple-share-buttons'); ?>"
                    aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
                    <circle cx="12" cy="5" r="2"/>
                    <circle cx="12" cy="12" r="2"/>
                    <circle cx="12" cy="19" r="2"/>
                </svg>
            </button>
        <?php endif; ?>
    </div>
</div>
