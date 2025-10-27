// Import Bootstrap via safe wrapper first
import * as Bootstrap from 'bootstrap';

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

// Import component utilities
import { initInputComponents } from './components/input-components.js';
import './components/comment-list.js';

// Import layout components
import { HeaderController } from './layout/header.js';

// Import Flatpickr datepicker
import flatpickr from 'flatpickr';

// Services
import { ValidationService } from './services/ValidationService.js';
import { FormService } from './services/FormService.js';
import { AuthService } from './services/AuthService.js';
import { ProfileService } from './services/ProfileService.js';

// Pages - all pages now auto-initialize via BasePage pattern
import './pages/home.js';
import './pages/matches.js';
import './pages/events.js';
import './pages/ordering.js';
import './pages/predict.js';
import './pages/predict-detail.js';
import './pages/live.js';
import './pages/login.js';
import './pages/register.js';
import './pages/profile.js';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

// Initialize when DOM is ready with safe Bootstrap wrapper
document.addEventListener('DOMContentLoaded', () => {  
  // Initialize smooth scroll navigation FIRST
  const smoothScroll = new SmoothScrollNavigation();
  smoothScroll.init();
  
  // Then initialize Header Controller (needs smoothScrollControl to be available)
  const headerController = new HeaderController();
  
  // Initialize GSAP sticky header
  const stickyHeader = new StickyHeader('#header');
  stickyHeader.init();
  
  // Make utilities available globally for debugging/customization
  window.smoothScroll = smoothScroll;
  window.stickyHeader = stickyHeader;
  window.headerController = headerController;
  
  // Make services globally available
  window.ValidationService = ValidationService;
  window.FormService = FormService;
  window.AuthService = AuthService;
  window.ProfileService = ProfileService;
  
  // Make logout function globally available
  window.logout = function(logoutUrl) {
    const url = logoutUrl || window.logoutRoute || '/logout';
    AuthService.logout(url);
  };
  window.initializeProfileData = ProfileService.initializeProfileData;
  
  // Initialize input component utilities
  initInputComponents();
  
  // Initialize Flatpickr datepickers
  initializeDatepickers();
});

// Function to initialize datepickers
function initializeDatepickers() {
  // Initialize all date inputs
  const dateInputs = document.querySelectorAll('input[type="date"], .datepicker');
  
  dateInputs.forEach(input => {
    // Check if this is a birthdate/DOB field
    const isBirthdate = input.name === 'birthdate' || 
                       input.name === 'dob' || 
                       input.classList.contains('dob') ||
                       input.classList.contains('birthdate');
    
    // Configure options based on field type
    const options = {
      dateFormat: "Y/m/d", // Malaysian format: YYYY/MM/DD
      allowInput: true,
      locale: {
        firstDayOfWeek: 1 // Monday (Malaysia standard)
      },
      disableMobile: true, // Force custom datepicker on mobile
      clickOpens: true,
      onClose: function(selectedDates, dateStr, instance) {
        // Trigger change event for validation
        input.dispatchEvent(new Event('change'));
      }
    };
    
    // Add specific options for birthdate fields
    if (isBirthdate) {
      const today = new Date();
      const maxDate = new Date(today.getFullYear() - 13, today.getMonth(), today.getDate()); // Minimum age 13
      const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate()); // Maximum age 100
      
      options.maxDate = maxDate;
      options.minDate = minDate;
      options.defaultDate = "1997/10/01"; // Default birthdate in YYYY/MM/DD format
      options.yearDropdown = true; // Enable year dropdown for easier navigation
      
      // Set placeholder if not already set
      if (!input.placeholder || input.placeholder === 'DD/MM/YYYY' || input.placeholder === 'Select Date of Birth') {
        input.placeholder = 'YYYY/MM/DD';
      }
    }
    
    flatpickr(input, options);
  });
}
