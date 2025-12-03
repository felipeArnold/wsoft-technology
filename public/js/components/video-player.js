/**
 * Video Player Component - Lazy loaded video functionality
 * Loads YouTube/Vimeo videos only when needed
 */

(function() {
    'use strict';

    class VideoPlayer {
        constructor(element) {
            this.container = element;
            this.videoId = element.dataset.videoId;
            this.provider = element.dataset.videoProvider || 'youtube';
            this.init();
        }

        init() {
            this.createThumbnail();
            this.setupClickHandler();
        }

        createThumbnail() {
            const thumbnail = document.createElement('div');
            thumbnail.className = 'video-thumbnail relative cursor-pointer';
            thumbnail.innerHTML = `
                <img
                    src="${this.getThumbnailUrl()}"
                    alt="Video thumbnail"
                    class="w-full h-auto rounded-lg"
                    loading="lazy"
                    decoding="async"
                >
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-20 h-20 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition shadow-lg">
                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                    </div>
                </div>
            `;

            this.container.appendChild(thumbnail);
        }

        getThumbnailUrl() {
            if (this.provider === 'youtube') {
                return `https://img.youtube.com/vi/${this.videoId}/maxresdefault.jpg`;
            } else if (this.provider === 'vimeo') {
                return `https://vumbnail.com/${this.videoId}.jpg`;
            }
            return '';
        }

        setupClickHandler() {
            this.container.addEventListener('click', () => this.loadVideo());
        }

        loadVideo() {
            const iframe = document.createElement('iframe');
            iframe.className = 'w-full h-full rounded-lg';
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.setAttribute('allowfullscreen', '');

            if (this.provider === 'youtube') {
                iframe.src = `https://www.youtube.com/embed/${this.videoId}?autoplay=1&rel=0`;
            } else if (this.provider === 'vimeo') {
                iframe.src = `https://player.vimeo.com/video/${this.videoId}?autoplay=1`;
            }

            // Replace thumbnail with iframe
            this.container.innerHTML = '';
            this.container.appendChild(iframe);

            // Track video play
            if (typeof gtag === 'function') {
                gtag('event', 'video_play', {
                    'event_category': 'Video',
                    'event_label': `${this.provider}:${this.videoId}`
                });
            }
        }
    }

    // Initialize all video players
    document.querySelectorAll('[data-video-id]').forEach(element => {
        new VideoPlayer(element);
    });

    console.log('Video player component loaded');
})();
