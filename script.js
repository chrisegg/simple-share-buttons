/**
 * Simple Share Buttons - JavaScript
 * Handles toggle functionality via event delegation (single set of document listeners)
 */

(function() {
    'use strict';

    /**
     * Setup event delegation for share button expand/collapse
     */
    function initShareButtons() {
        // Single document click handler - handles toggle clicks and outside clicks
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('.expand-toggle');
            if (toggle) {
                const container = toggle.closest('.share-menu-container');
                if (container && container.querySelectorAll('.share-icon-hidden').length > 0) {
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
                }
                return;
            }

            // Click outside any share container - close all expanded
            const clickedInside = e.target.closest('.share-menu-container');
            if (!clickedInside) {
                document.querySelectorAll('.share-menu-container.expanded').forEach(function(container) {
                    container.classList.remove('expanded');
                    const t = container.querySelector('.expand-toggle');
                    if (t) t.setAttribute('aria-expanded', 'false');
                });
            }
        });

        // Single document keydown handler - Escape closes expanded
        document.addEventListener('keydown', function(e) {
            if (e.key !== 'Escape') return;

            const expandedList = document.querySelectorAll('.share-menu-container.expanded');
            if (expandedList.length > 0) {
                const first = expandedList[0];
                const toggle = first.querySelector('.expand-toggle');
                expandedList.forEach(function(container) {
                    container.classList.remove('expanded');
                    const t = container.querySelector('.expand-toggle');
                    if (t) t.setAttribute('aria-expanded', 'false');
                });
                if (toggle) toggle.focus();
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initShareButtons);
    } else {
        initShareButtons();
    }
})();
