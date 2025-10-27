import BasePage from './BasePage.js';
import { 
  createHorizontalScroll, 
  createHorizontalScrollGallery,
  createHorizontalScrollPanels 
} from '../utils/horizontal-scroll.js';

class HomePage extends BasePage {
  constructor() {
    super();
    this.pageName = 'home';
    this.pageSelector = '#page-home, .home-page, body'; // Match the actual page ID
    this.horizontalScrolls = [];
  }
}

// Auto-initialize pattern
const homePage = new HomePage();

export default HomePage;
