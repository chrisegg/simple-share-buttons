<?php
/**
 * Network definitions: share URLs, icons, display names
 *
 * @package Simple_Share_Buttons
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get share links for all supported networks
 *
 * @param string $url   The URL to share
 * @param string $title The title/text to share
 * @return array Associative array of network => share URL
 */
function simple_share_get_links($url, $title) {
    $encoded_url  = urlencode($url);
    $encoded_title = urlencode($title);
    $encoded_text  = urlencode($title . ' ' . $url);

    return array(
        'facebook'  => 'https://www.facebook.com/sharer/sharer.php?u=' . $encoded_url,
        'twitter'   => 'https://twitter.com/intent/tweet?url=' . $encoded_url . '&text=' . $encoded_title,
        'pinterest' => 'https://pinterest.com/pin/create/button/?url=' . $encoded_url . '&description=' . $encoded_title,
        'tumblr'    => 'https://www.tumblr.com/widgets/share/tool?posttype=link&title=' . $encoded_title . '&caption=' . $encoded_title . '&content=' . $encoded_url . '&canonicalUrl=' . $encoded_url . '&shareSource=publisher_162',
        'linkedin'  => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $encoded_url,
        'reddit'    => 'https://www.reddit.com/submit?url=' . $encoded_url . '&title=' . $encoded_title,
        'whatsapp'  => 'https://wa.me/?text=' . $encoded_text,
        'telegram'  => 'https://t.me/share/url?url=' . $encoded_url . '&text=' . $encoded_title,
        'email'     => 'mailto:?subject=' . $encoded_title . '&body=' . $encoded_text,
    );
}

/**
 * Get icon HTML for a network (SVG icons)
 *
 * @param string $network Network name
 * @return string Icon HTML
 */
function simple_share_get_icon($network) {
    $icons = array(
        'facebook'  => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>',
        'twitter'   => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path></svg>',
        'pinterest' => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"></path></svg>',
        'tumblr'    => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M309.8 480.3c-13.6 14.5-50 31.7-97.4 31.7-120.8 0-147-88.8-147-140.6v-144H17.9c-5.5 0-10-4.5-10-10v-68c0-7.2 4.5-13.6 11-16 62-21.8 81.5-76 84.3-117.1.8-11 6.5-16.3 16.1-16.3h70.9c5.5 0 10 4.5 10 10v115.2h83c5.5 0 10 4.4 10 9.9v81.7c0 5.5-4.5 10-10 10h-83.4V360c0 34.2 23.7 45.5 58 45.5 17.9 0 35.4-4.6 46.1-7.4 4.2-1.1 8.7-1.1 13.1 0 5.5 1.8 11.1 3.9 16.7 3.9 10.2 0 15.3-6.1 15.3-15.1v-68.9c-.1-5.6-4.6-10-10.1-10z"></path></svg>',
        'linkedin'  => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.29 87.88-48.29 94 0 111.28 61.9 111.28 142.3V448z"></path></svg>',
        'reddit'    => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M6.167 8a.83.83 0 0 0-.83.83c0 .459.372.84.83.831a.831.831 0 0 0 0-1.661m1.843 3.647c.315 0 1.403-.038 1.976-.611a.23.23 0 0 0 0-.306.213.213 0 0 0-.306 0c-.353.363-1.126.487-1.67.487-.545 0-1.308-.124-1.671-.487a.213.213 0 0 0-.306 0 .213.213 0 0 0 0 .306c.564.563 1.652.61 1.977.61zm.992-2.807c0 .458.373.83.831.83s.83-.381.83-.83a.831.831 0 0 0-1.66 0z"/><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.828-1.165c-.315 0-.602.124-.812.325-.801-.573-1.9-.945-3.121-.993l.534-2.501 1.738.372a.83.83 0 1 0 .83-.869.83.83 0 0 0-.744.468l-1.938-.41a.2.2 0 0 0-.153.028.2.2 0 0 0-.086.134l-.592 2.788c-1.24.038-2.358.41-3.17.992-.21-.2-.496-.324-.81-.324a1.163 1.163 0 0 0-.478 2.224q-.03.17-.029.353c0 1.795 2.091 3.256 4.669 3.256s4.668-1.451 4.668-3.256c0-.114-.01-.238-.029-.353.401-.181.688-.592.688-1.069 0-.65-.525-1.165-1.165-1.165"/></svg>',
        'whatsapp'  => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>',
        'telegram'  => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.2 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.2 28.5 32.7z"></path></svg>',
        'email'     => '<svg aria-hidden="true" role="img" height="1em" width="1em" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"></path></svg>',
    );

    return isset($icons[$network]) ? $icons[$network] : '';
}

/**
 * Get network display name
 *
 * @param string $network Network name
 * @return string Display name
 */
function simple_share_get_network_name($network) {
    $names = array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter',
        'pinterest' => 'Pinterest',
        'tumblr'    => 'Tumblr',
        'linkedin'  => 'LinkedIn',
        'reddit'    => 'Reddit',
        'whatsapp'  => 'WhatsApp',
        'telegram'  => 'Telegram',
        'email'     => 'Email',
    );

    return isset($names[$network]) ? $names[$network] : ucfirst($network);
}
