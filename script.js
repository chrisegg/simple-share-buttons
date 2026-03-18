/**
 * Simple Share Buttons - JavaScript
 * Handles toggle functionality for inline expansion
 */

(function() {
    'use strict';

    /**
     * Initialize share button functionality
     */
    function initShareButtons() {
        const containers = document.querySelectorAll('.share-menu-container');

        containers.forEach(function(container) {
            const toggle = container.querySelector('.expand-toggle');
            const hiddenIcons = container.querySelectorAll('.share-icon-hidden');

            if (!toggle || hiddenIcons.length === 0) {
                return; // Skip if toggle or hidden icons don't exist
            }

            // Toggle expanded state on button click
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isExpanded = container.classList.contains('expanded');
                
                if (isExpanded) {
                    container.classList.remove('expanded');
                    toggle.setAttribute('aria-expanded', 'false');
                } else {
                    container.classList.add('expanded');
                    toggle.setAttribute('aria-expanded', 'true');
                }
            });

            // Close when clicking outside
            document.addEventListener('click', function(e) {
                if (!container.contains(e.target)) {
                    container.classList.remove('expanded');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && container.classList.contains('expanded')) {
                    container.classList.remove('expanded');
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.focus();
                }
            });
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initShareButtons);
    } else {
        // DOM is already ready
        initShareButtons();
    }
})();

