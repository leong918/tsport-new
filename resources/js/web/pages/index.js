/**
 * Home Page JavaScript
 * Handles horizontal scroll sections and animations
 */

import BasePage from '../base-page.js';
import { createHorizontalScroll, createHorizontalScrollGallery } from '../utils/horizontal-scroll.js';

class HomePage extends BasePage {
  constructor() {
    super();
    this.horizontalScrolls = [];
  }

  init() {
    super.init();
    this.initHorizontalScrolls();
  }

  /**
   * Initialize horizontal scroll sections
   */
  initHorizontalScrolls() {
    // Example 1: Simple horizontal scroll section
    const simpleScroll = document.querySelector('.horizontal-section');
    if (simpleScroll) {
      const scrollInstance = createHorizontalScroll('.horizontal-section', {
        scrollingElement: '.horizontal-scroll-wrapper',
        scrub: 1,
        markers: false, // Set to true for debugging
      });
      this.horizontalScrolls.push(scrollInstance);
    }

    // Example 2: Image gallery with snap
    const gallery = document.querySelector('.gallery-section');
    if (gallery) {
      const galleryInstance = createHorizontalScrollGallery('.gallery-section', {
        itemsSelector: '.gallery-item',
        scrollingElement: '.gallery-wrapper',
        speed: 1,
        snap: true,
        snapSpeed: 0.5,
      });
      this.horizontalScrolls.push(galleryInstance);
    }

    // Example 3: Multiple sections
    const sections = document.querySelectorAll('.horizontal-scroll-section');
    sections.forEach((section, index) => {
      const instance = createHorizontalScroll(section, {
        scrollingElement: '.scroll-content',
        scrub: 1.5,
        onEnter: () => console.log(`Entering section ${index + 1}`),
        onLeave: () => console.log(`Leaving section ${index + 1}`),
      });
      this.horizontalScrolls.push(instance);
    });
  }

  /**
   * Clean up when leaving page
   */
  destroy() {
    // Kill all horizontal scroll instances
    this.horizontalScrolls.forEach(instance => {
      if (instance && instance.kill) {
        instance.kill();
      }
    });
    this.horizontalScrolls = [];
    
    super.destroy();
  }
}

// Initialize page when DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    window.homePage = new HomePage();
  });
} else {
  window.homePage = new HomePage();
}

export default HomePage;
