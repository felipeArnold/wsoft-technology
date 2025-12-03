/**
 * Analytics Component - Lazy loaded analytics tracking
 * Only loads when user interacts or scrolls
 */

(function() {
    'use strict';

    // Track page interactions
    function trackEvent(category, action, label) {
        if (typeof gtag === 'function') {
            gtag('event', action, {
                'event_category': category,
                'event_label': label
            });
        }
    }

    // Track scroll depth
    let maxScroll = 0;
    const scrollMilestones = [25, 50, 75, 100];
    const trackedMilestones = new Set();

    function trackScrollDepth() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;
        const scrollTop = window.scrollY;
        const scrollPercent = Math.round((scrollTop / (documentHeight - windowHeight)) * 100);

        if (scrollPercent > maxScroll) {
            maxScroll = scrollPercent;

            scrollMilestones.forEach(milestone => {
                if (scrollPercent >= milestone && !trackedMilestones.has(milestone)) {
                    trackedMilestones.add(milestone);
                    trackEvent('Engagement', 'Scroll', `${milestone}%`);
                }
            });
        }
    }

    // Track CTA clicks
    function setupCTATracking() {
        document.querySelectorAll('a[href*="register"], a[href*="login"], button[type="submit"]').forEach(element => {
            element.addEventListener('click', function(e) {
                const text = this.textContent.trim();
                const href = this.getAttribute('href') || 'button';
                trackEvent('CTA', 'Click', `${text} - ${href}`);
            });
        });
    }

    // Track outbound links
    function setupOutboundTracking() {
        document.querySelectorAll('a[href^="http"]').forEach(link => {
            if (!link.href.includes(window.location.hostname)) {
                link.addEventListener('click', function(e) {
                    trackEvent('Outbound', 'Click', this.href);
                });
            }
        });
    }

    // Track time on page
    let startTime = Date.now();
    window.addEventListener('beforeunload', function() {
        const timeSpent = Math.round((Date.now() - startTime) / 1000);
        if (timeSpent > 10) { // Only track if spent more than 10 seconds
            trackEvent('Engagement', 'Time on Page', `${timeSpent}s`);
        }
    });

    // Initialize
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(trackScrollDepth, 100);
    }, { passive: true });

    setupCTATracking();
    setupOutboundTracking();

    console.log('Analytics component loaded');
})();
