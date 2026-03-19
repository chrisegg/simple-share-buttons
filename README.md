# Simple Share Buttons - WordPress Plugin

A lightweight, customizable social sharing buttons plugin for WordPress. Features collapsible design, multiple network support, and zero bloat.

## Features

- 🎯 **Lightweight** - No third-party tracking scripts, pure vanilla JavaScript
- 🎨 **Customizable** - Control which networks appear and how many are visible
- 📱 **Responsive** - Works beautifully on desktop, tablet, and mobile
- ♿ **Accessible** - ARIA labels, keyboard navigation, and focus management
- 🚀 **Fast** - Assets only load when shortcode is used
- 🎭 **Collapsible** - Shows first N icons by default, expands to show all on click

## Installation

1. Upload the `simple-share-buttons` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the `[simple_share]` shortcode in your posts, pages, or widgets

## Usage

### Basic Usage

```
[simple_share]
```

This will display Facebook, Twitter, Pinterest, Tumblr, and Email buttons (first 2 visible, rest in dropdown).

### Customize Networks

```
[simple_share networks="facebook,twitter,linkedin,email"]
```

Available networks:
- `facebook`
- `twitter`
- `pinterest`
- `tumblr`
- `linkedin`
- `reddit`
- `whatsapp`
- `telegram`
- `email`

### Control Visible Icons

```
[simple_share collapsed="3"]
```

Shows first 3 icons, rest in dropdown.

### Customize Button Color

```
[simple_share button_color="#059669"]
```

Use a hex color (e.g. `#2563eb`, `#059669`, `#7c3aed`) to match your theme. Invalid values fall back to the default blue.

### Combine Parameters

```
[simple_share networks="facebook,twitter,linkedin,reddit,email" collapsed="2"]
```

## Parameters

| Parameter | Default | Description |
|-----------|---------|-------------|
| `networks` | `facebook,twitter,pinterest,tumblr,email` | Comma-separated list of networks |
| `collapsed` | `0` | Number of icons to show before expanding (`0` = show all) |
| `button_color` | `#2563eb` | Hex color for the button background (e.g. `#059669`, `#7c3aed`) |

## Examples

### In Post/Page Editor

Add the shortcode anywhere in your content:

```
Check out this amazing article! [simple_share]
```

### In Theme Template

```php
<?php echo do_shortcode('[simple_share networks="facebook,twitter" collapsed="1"]'); ?>
```

### In Widget/Block Editor

Simply add a Shortcode block and paste: `[simple_share]`

## Styling

The plugin includes default styling that matches modern design standards. Icons are circular with brand colors. You can override styles in your theme's CSS:

```css
.share-menu-container {
    /* Your custom styles */
}

.share-icon {
    /* Custom icon styles */
}
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance

- Assets only load when shortcode is present on the page
- Uses inline SVG icons (no external dependencies)
- Minimal JavaScript footprint (~1KB)
- CSS optimized for fast rendering

## Accessibility

- ARIA labels on all interactive elements
- Keyboard navigation support (Escape to close)
- Focus management
- Screen reader friendly
- Respects `prefers-reduced-motion` media query

## Development

### File Structure

```
simple-share-buttons/
├── simple-share-buttons.php   # Main plugin file
├── includes/
│   └── networks.php           # Share URLs, icons, display names
├── templates/
│   └── share-buttons.php     # Shortcode output markup
├── style.css                  # Stylesheet
├── script.js                  # JavaScript (event delegation)
└── README.md                  # This file
```

### Adding Custom Networks

Edit `includes/networks.php`:

1. Add share URL to `simple_share_get_links()` function
2. Add icon to `simple_share_get_icon()` function
3. Add display name to `simple_share_get_network_name()` function
4. Add CSS styling for the new network

## License

GPL v2 or later

## Support

For issues, feature requests, or contributions, please visit the [GitHub repository](https://github.com/chrisegg/simple-share-buttons).

## Changelog

### 1.0.0
- Initial release
- Support for 9 social networks
- Collapsible design
- Responsive layout
- Accessibility features

