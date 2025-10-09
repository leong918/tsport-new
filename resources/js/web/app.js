// Import Bootstrap via safe wrapper first
import Bootstrap, { initializeAllModals, setupModalTriggers } from './utils/bootstrap-wrapper.js';

// Import bootstrap configuration
import './bootstrap.js';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Import GSAP
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollSmoother } from 'gsap/ScrollSmoother';

// Import GSAP utilities
import { SmoothScrollNavigation } from './utils/smooth-scroll.js';
import StickyHeader from './utils/sticky-header.js';

// Import layout components
import { HeaderController } from './layout/header.js';
import headerHeight from './layout/header-height.js';

// Import component utilities
import { initInputComponents } from './components/input-components.js';

// Services
import { ValidationService } from './services/ValidationService.js';
import { FormService } from './services/FormService.js';
import { AuthService } from './services/AuthService.js';
import { ProfileService } from './services/ProfileService.js';

// Pages
import './pages/live-matches.js';
import './pages/events.js';
import './pages/ordering.js';

// Auth pages - import for global availability
import { initLoginPage } from './pages/login.js';
import { initRegisterPage } from './pages/register.js';
import { initProfilePage } from './pages/profile.js';
import { initOrderingPage } from './pages/ordering.js';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

// Ensure Bootstrap is properly available globally via the wrapper
window.bootstrap = Bootstrap;
window.Bootstrap = Bootstrap;

// Initialize when DOM is ready with safe Bootstrap wrapper
document.addEventListener('DOMContentLoaded', () => {
  // Initialize safe Bootstrap modals
  initializeAllModals();
  
  // Setup safe modal triggers
  setupModalTriggers();
  
  console.log('Safe Bootstrap modal system initialized');

  // Initialize header controller (offcanvas sidebar)
  const headerController = new HeaderController();
  
  // Initialize smooth scroll navigation
  const smoothScroll = new SmoothScrollNavigation();
  smoothScroll.init();
  
  // Initialize GSAP sticky header
  const stickyHeader = new StickyHeader('#header');
  stickyHeader.init();
  
  // Make utilities available globally for debugging/customization
  window.smoothScroll = smoothScroll;
  window.stickyHeader = stickyHeader;
  window.headerController = headerController;
  window.headerHeight = headerHeight;
  
  // Make services globally available
  window.ValidationService = ValidationService;
  window.FormService = FormService;
  window.AuthService = AuthService;
  window.ProfileService = ProfileService;
  
  // Make auth page functions globally available
  window.initLoginPage = initLoginPage;
  window.initRegisterPage = initRegisterPage;
  window.initProfilePage = initProfilePage;
  window.initOrderingPage = initOrderingPage;
  
  // Make logout and profile functions globally available
  window.logout = function(logoutUrl) {
    const url = logoutUrl || window.logoutRoute || '/logout';
    AuthService.logout(url);
  };
  window.initializeProfileData = ProfileService.initializeProfileData;
  
  // Initialize input component utilities
  initInputComponents();
});
