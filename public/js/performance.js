/**
 * Performance Monitoring and Optimization Utilities
 * Tracks Core Web Vitals and optimizes page performance
 */

(function() {
    'use strict';

    class PerformanceMonitor {
        constructor() {
            this.metrics = {};
            this.init();
        }

        init() {
            // Wait for page load
            if (document.readyState === 'complete') {
                this.measure();
            } else {
                window.addEventListener('load', () => this.measure());
            }

            // Observe performance entries
            if ('PerformanceObserver' in window) {
                this.observeMetrics();
            }
        }

        observeMetrics() {
            // LCP (Largest Contentful Paint)
            try {
                const lcpObserver = new PerformanceObserver((list) => {
                    const entries = list.getEntries();
                    const lastEntry = entries[entries.length - 1];
                    this.metrics.lcp = lastEntry.renderTime || lastEntry.loadTime;
                    this.reportMetric('LCP', this.metrics.lcp);
                });
                lcpObserver.observe({ entryTypes: ['largest-contentful-paint'] });
            } catch (e) {
                console.warn('LCP observation not supported');
            }

            // FID (First Input Delay)
            try {
                const fidObserver = new PerformanceObserver((list) => {
                    const entries = list.getEntries();
                    entries.forEach(entry => {
                        this.metrics.fid = entry.processingStart - entry.startTime;
                        this.reportMetric('FID', this.metrics.fid);
                    });
                });
                fidObserver.observe({ entryTypes: ['first-input'] });
            } catch (e) {
                console.warn('FID observation not supported');
            }

            // CLS (Cumulative Layout Shift)
            try {
                let clsValue = 0;
                const clsObserver = new PerformanceObserver((list) => {
                    for (const entry of list.getEntries()) {
                        if (!entry.hadRecentInput) {
                            clsValue += entry.value;
                            this.metrics.cls = clsValue;
                        }
                    }
                    this.reportMetric('CLS', this.metrics.cls);
                });
                clsObserver.observe({ entryTypes: ['layout-shift'] });
            } catch (e) {
                console.warn('CLS observation not supported');
            }
        }

        measure() {
            if (!window.performance || !window.performance.timing) return;

            const timing = performance.timing;
            const navigation = performance.getEntriesByType('navigation')[0];

            // Calculate key metrics
            this.metrics.dns = timing.domainLookupEnd - timing.domainLookupStart;
            this.metrics.tcp = timing.connectEnd - timing.connectStart;
            this.metrics.ttfb = timing.responseStart - timing.requestStart;
            this.metrics.download = timing.responseEnd - timing.responseStart;
            this.metrics.domInteractive = timing.domInteractive - timing.navigationStart;
            this.metrics.domComplete = timing.domComplete - timing.navigationStart;
            this.metrics.loadComplete = timing.loadEventEnd - timing.navigationStart;

            // FCP (First Contentful Paint)
            const paintEntries = performance.getEntriesByType('paint');
            const fcpEntry = paintEntries.find(entry => entry.name === 'first-contentful-paint');
            if (fcpEntry) {
                this.metrics.fcp = fcpEntry.startTime;
            }

            // Log metrics in development
            if (window.location.hostname === 'localhost' || window.location.hostname.includes('local')) {
                console.table(this.metrics);
            }

            // Send to analytics (optional)
            this.sendToAnalytics();
        }

        reportMetric(name, value) {
            // Round to 2 decimal places
            const roundedValue = Math.round(value * 100) / 100;

            // Send to Google Analytics
            if (typeof gtag === 'function') {
                gtag('event', 'web_vitals', {
                    event_category: 'Web Vitals',
                    event_label: name,
                    value: roundedValue,
                    non_interaction: true
                });
            }
        }

        sendToAnalytics() {
            // Send navigation timing to analytics
            if (typeof gtag === 'function') {
                gtag('event', 'timing_complete', {
                    name: 'load',
                    value: this.metrics.loadComplete,
                    event_category: 'Performance'
                });

                if (this.metrics.fcp) {
                    gtag('event', 'timing_complete', {
                        name: 'first_contentful_paint',
                        value: Math.round(this.metrics.fcp),
                        event_category: 'Performance'
                    });
                }
            }
        }

        // Get performance grade
        getGrade() {
            const grades = {
                lcp: this.metrics.lcp < 2500 ? 'good' : this.metrics.lcp < 4000 ? 'needs-improvement' : 'poor',
                fid: this.metrics.fid < 100 ? 'good' : this.metrics.fid < 300 ? 'needs-improvement' : 'poor',
                cls: this.metrics.cls < 0.1 ? 'good' : this.metrics.cls < 0.25 ? 'needs-improvement' : 'poor'
            };

            return grades;
        }
    }

    // Resource Hints Manager
    class ResourceHints {
        static prefetch(url) {
            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = url;
            document.head.appendChild(link);
        }

        static preload(url, as) {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.href = url;
            link.as = as;
            document.head.appendChild(link);
        }

        static preconnect(url) {
            const link = document.createElement('link');
            link.rel = 'preconnect';
            link.href = url;
            link.crossOrigin = 'anonymous';
            document.head.appendChild(link);
        }
    }

    // Connection aware loading
    class AdaptiveLoading {
        static getConnectionType() {
            const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
            return connection ? connection.effectiveType : 'unknown';
        }

        static shouldLoadHeavyContent() {
            const connection = this.getConnectionType();
            const saveData = navigator.connection?.saveData;

            // Don't load heavy content on slow connections or save-data mode
            if (saveData || connection === 'slow-2g' || connection === '2g') {
                return false;
            }

            return true;
        }

        static isLowEndDevice() {
            // Check for low memory or slow CPU
            const memory = navigator.deviceMemory || 4;
            const cores = navigator.hardwareConcurrency || 2;

            return memory < 4 || cores < 4;
        }
    }

    // Initialize performance monitoring
    const monitor = new PerformanceMonitor();

    // Export utilities
    window.PerformanceMonitor = monitor;
    window.ResourceHints = ResourceHints;
    window.AdaptiveLoading = AdaptiveLoading;

    console.log('Performance monitoring initialized');
})();
