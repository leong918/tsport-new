/**
 * GSAP Horizontal Scroll Utility
 * Creates smooth horizontal scrolling sections using GSAP ScrollTrigger
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

/**
 * Initialize horizontal scroll on a container
 * @param {string|HTMLElement} container - Container element or selector
 * @param {Object} options - Configuration options
 * @returns {ScrollTrigger} The created ScrollTrigger instance
 */
export function createHorizontalScroll(container, options = {}) {
  const defaults = {
    // The element that will scroll horizontally
    scrollingElement: '.horizontal-scroll-wrapper',
    
    // ScrollTrigger options
    trigger: container,
    start: 'top top',
    end: () => `+=${getScrollDistance(container, options)}`,
    pin: true,
    scrub: 1,
    anticipatePin: 1,
    invalidateOnRefresh: true,
    
    // Animation options
    ease: 'none',
    
    // Callbacks
    onEnter: null,
    onLeave: null,
    onUpdate: null,
    
    // Debug
    markers: false,
  };

  const config = { ...defaults, ...options };

  // Get the container element
  const containerEl = typeof container === 'string' 
    ? document.querySelector(container) 
    : container;

  if (!containerEl) {
    console.error('Horizontal scroll container not found:', container);
    return null;
  }

  // Get the scrolling element
  const scrollingEl = typeof config.scrollingElement === 'string'
    ? containerEl.querySelector(config.scrollingElement)
    : config.scrollingElement;

  if (!scrollingEl) {
    console.error('Scrolling element not found:', config.scrollingElement);
    return null;
  }

  // Create the horizontal scroll animation
  const scrollTween = gsap.to(scrollingEl, {
    x: () => -(scrollingEl.scrollWidth - containerEl.offsetWidth),
    ease: config.ease,
    scrollTrigger: {
      trigger: config.trigger,
      start: config.start,
      end: config.end,
      pin: config.pin,
      scrub: config.scrub,
      anticipatePin: config.anticipatePin,
      invalidateOnRefresh: config.invalidateOnRefresh,
      markers: config.markers,
      onEnter: config.onEnter,
      onLeave: config.onLeave,
      onUpdate: config.onUpdate,
    }
  });

  return scrollTween.scrollTrigger;
}

/**
 * Calculate the scroll distance needed for horizontal scroll
 * @param {string|HTMLElement} container - Container element
 * @param {Object} options - Configuration options
 * @returns {number} Scroll distance in pixels
 */
function getScrollDistance(container, options = {}) {
  const containerEl = typeof container === 'string' 
    ? document.querySelector(container) 
    : container;

  if (!containerEl) return 0;

  const scrollingEl = typeof options.scrollingElement === 'string'
    ? containerEl.querySelector(options.scrollingElement)
    : options.scrollingElement;

  if (!scrollingEl) return 0;

  return scrollingEl.scrollWidth - containerEl.offsetWidth;
}

/**
 * Create a horizontal scroll section with items
 * Perfect for image galleries, card carousels, etc.
 * @param {string|HTMLElement} container - Container element or selector
 * @param {Object} options - Configuration options
 */
export function createHorizontalScrollGallery(container, options = {}) {
  const defaults = {
    itemsSelector: '.scroll-item',
    gap: 20, // Gap between items in pixels
    speed: 1, // Scroll speed multiplier
    snap: false, // Enable snap scrolling
    snapSpeed: 0.5, // Snap animation speed
  };

  const config = { ...defaults, ...options };

  return createHorizontalScroll(container, {
    ...config,
    scrub: config.speed,
    snap: config.snap ? {
      snapTo: 1 / (document.querySelectorAll(config.itemsSelector).length - 1),
      duration: config.snapSpeed,
      ease: 'power1.inOut'
    } : false,
  });
}

/**
 * Create multiple horizontal scroll sections
 * @param {string} selector - CSS selector for all containers
 * @param {Object} options - Configuration options
 * @returns {Array<ScrollTrigger>} Array of ScrollTrigger instances
 */
export function createMultipleHorizontalScrolls(selector, options = {}) {
  const containers = document.querySelectorAll(selector);
  const instances = [];

  containers.forEach(container => {
    const instance = createHorizontalScroll(container, options);
    if (instance) {
      instances.push(instance);
    }
  });

  return instances;
}

/**
 * Destroy horizontal scroll instance
 * @param {ScrollTrigger} scrollTrigger - The ScrollTrigger instance to destroy
 */
export function destroyHorizontalScroll(scrollTrigger) {
  if (scrollTrigger && scrollTrigger.kill) {
    scrollTrigger.kill();
  }
}

/**
 * Refresh all horizontal scroll instances
 * Call this after DOM changes or window resize
 */
export function refreshHorizontalScrolls() {
  ScrollTrigger.refresh();
}

// Export default object with all functions
export default {
  createHorizontalScroll,
  createHorizontalScrollGallery,
  createMultipleHorizontalScrolls,
  destroyHorizontalScroll,
  refreshHorizontalScrolls,
};
