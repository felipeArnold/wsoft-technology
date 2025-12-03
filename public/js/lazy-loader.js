/**
 * Lazy Loader - Load JavaScript components on demand
 * Reduces initial bundle size and improves page load performance
 */

class LazyLoader {
    constructor() {
        this.loadedScripts = new Set();
        this.loadingScripts = new Map();
        this.observers = new Map();
        this.init();
    }

    init() {
        // Setup intersection observer for lazy components
        if ('IntersectionObserver' in window) {
            this.setupIntersectionObserver();
        } else {
            // Fallback: load all components immediately
            this.loadAllComponents();
        }
    }

    setupIntersectionObserver() {
        const options = {
            root: null,
            rootMargin: '50px',
            threshold: 0.01
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const componentName = element.dataset.lazyComponent;

                    if (componentName) {
                        this.loadComponent(componentName, element);
                        observer.unobserve(element);
                    }
                }
            });
        }, options);

        // Observe all lazy components
        document.querySelectorAll('[data-lazy-component]').forEach(el => {
            observer.observe(el);
        });

        this.observers.set('main', observer);
    }

    async loadComponent(name, element) {
        if (this.loadedScripts.has(name)) {
            this.initComponent(name, element);
            return;
        }

        if (this.loadingScripts.has(name)) {
            return this.loadingScripts.get(name);
        }

        const loadPromise = this.loadScript(`/js/components/${name}.js`)
            .then(() => {
                this.loadedScripts.add(name);
                this.loadingScripts.delete(name);
                this.initComponent(name, element);
            })
            .catch(error => {
                console.error(`Failed to load component: ${name}`, error);
                this.loadingScripts.delete(name);
            });

        this.loadingScripts.set(name, loadPromise);
        return loadPromise;
    }

    loadScript(src) {
        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = src;
            script.async = true;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }

    initComponent(name, element) {
        // Trigger custom event for component initialization
        const event = new CustomEvent('componentLoaded', {
            detail: { name, element }
        });
        element.dispatchEvent(event);
    }

    loadAllComponents() {
        document.querySelectorAll('[data-lazy-component]').forEach(el => {
            const componentName = el.dataset.lazyComponent;
            if (componentName) {
                this.loadComponent(componentName, el);
            }
        });
    }

    // Preload component (for predictive loading)
    preload(name) {
        if (!this.loadedScripts.has(name) && !this.loadingScripts.has(name)) {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'script';
            link.href = `/js/components/${name}.js`;
            document.head.appendChild(link);
        }
    }
}

// Initialize lazy loader
const lazyLoader = new LazyLoader();

// Export for use in other scripts
window.LazyLoader = lazyLoader;

// Expose API for manual loading
window.loadComponent = (name) => {
    const element = document.querySelector(`[data-lazy-component="${name}"]`);
    if (element) {
        return lazyLoader.loadComponent(name, element);
    }
    return Promise.reject(`Component ${name} not found`);
};
