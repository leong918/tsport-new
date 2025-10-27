import BasePage from './BasePage.js';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollSmoother } from 'gsap/ScrollSmoother';

// Ensure ScrollTrigger is registered before using scrollTrigger property
gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

class HomePage extends BasePage {
  constructor() {
    super();
    this.pageName = 'home';
    this.pageSelector = '#page-home, .home-page, body'; // Match the actual page ID
    this.horizontalScrolls = [];
    this.containerEl = null;

    if (this.shouldInitialize()) {
      this.setupHorizontalScrolls();
    }
  }

  setupHorizontalScrolls() {
    const $container = $('.horizontal-scroll-wrapper');
    if (!$container.length) return;

    const container = $container[0];
    this.containerEl = container;

    // Kill any existing tween/trigger for this container only
    gsap.killTweensOf(container);
    ScrollTrigger.getAll().forEach((t) => {
      if (t && t.vars && t.vars.trigger === container) t.kill();
    });

    // Compute required horizontal distance using scrollWidth for accuracy
    const computeDistance = () => Math.max(0, (container.scrollWidth || 0) - window.innerWidth);

    // Reset x so refresh computes from 0
    gsap.set(container, { x: 0 });

    // Build ScrollTrigger config and only set scroller if element exists
    const scrollerEl = document.querySelector('#smooth-wrapper');
    const st = {
      trigger: container,
      start: 'top top',
      end: () => `+=${computeDistance()}`,
      pin: true,
      pinSpacing: true,
      scrub: 0.8,
      invalidateOnRefresh: true,
      anticipatePin: 1,
    };
    if (scrollerEl) st.scroller = scrollerEl;

    this.horizontalTween = gsap.to(container, {
      x: () => -computeDistance(),
      ease: 'none',
      scrollTrigger: st,
    });

    // Refresh on resize so distances stay correct
    window.addEventListener('resize', () => ScrollTrigger.refresh(), { passive: true });
  }
}

// Auto-initialize pattern
const homePage = new HomePage();

export default HomePage;
