# GSAP Horizontal Scroll Utility

A powerful and flexible horizontal scrolling system using GSAP ScrollTrigger.

## Installation

GSAP is already installed in the project. The horizontal scroll utility is ready to use.

## Basic Usage

### 1. Simple Horizontal Scroll

```javascript
import { createHorizontalScroll } from '../utils/horizontal-scroll.js';

const scrollInstance = createHorizontalScroll('.horizontal-section', {
  scrollingElement: '.horizontal-scroll-wrapper',
  scrub: 1,
});
```

**HTML Structure:**
```html
<section class="horizontal-section">
  <div class="horizontal-scroll-wrapper">
    <div class="item">Item 1</div>
    <div class="item">Item 2</div>
    <div class="item">Item 3</div>
    <!-- More items -->
  </div>
</section>
```

### 2. Gallery with Snap Scrolling

```javascript
import { createHorizontalScrollGallery } from '../utils/horizontal-scroll.js';

const gallery = createHorizontalScrollGallery('.gallery-section', {
  itemsSelector: '.gallery-item',
  scrollingElement: '.gallery-wrapper',
  speed: 1,
  snap: true,
  snapSpeed: 0.5,
});
```

**HTML Structure:**
```html
<section class="gallery-section">
  <div class="gallery-wrapper">
    <div class="gallery-item">
      <img src="image1.jpg" alt="Image 1">
    </div>
    <div class="gallery-item">
      <img src="image2.jpg" alt="Image 2">
    </div>
    <!-- More items -->
  </div>
</section>
```

### 3. Multiple Sections

```javascript
import { createMultipleHorizontalScrolls } from '../utils/horizontal-scroll.js';

const instances = createMultipleHorizontalScrolls('.horizontal-scroll-section', {
  scrollingElement: '.scroll-content',
  scrub: 1.5,
});
```

## Configuration Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `scrollingElement` | string\|HTMLElement | '.horizontal-scroll-wrapper' | Element that scrolls horizontally |
| `start` | string | 'top top' | When the animation starts |
| `end` | string\|function | Calculated | When the animation ends |
| `pin` | boolean | true | Pin the container during scroll |
| `scrub` | number\|boolean | 1 | Smooth scrub amount (0-3 recommended) |
| `ease` | string | 'none' | GSAP easing function |
| `markers` | boolean | false | Show debug markers |
| `snap` | boolean\|object | false | Enable snap scrolling |
| `onEnter` | function | null | Callback when entering section |
| `onLeave` | function | null | Callback when leaving section |
| `onUpdate` | function | null | Callback on scroll update |

## Advanced Examples

### With Callbacks

```javascript
createHorizontalScroll('.section', {
  onEnter: () => {
    console.log('Entering horizontal section');
    // Start animations, load content, etc.
  },
  onLeave: () => {
    console.log('Leaving horizontal section');
    // Clean up, pause animations, etc.
  },
  onUpdate: (self) => {
    console.log('Progress:', self.progress);
    // Update progress bar, parallax effects, etc.
  }
});
```

### Custom Speed and Easing

```javascript
createHorizontalScroll('.section', {
  scrub: 2, // Slower, smoother scroll
  ease: 'power2.inOut',
  anticipatePin: 1,
});
```

### Debug Mode

```javascript
createHorizontalScroll('.section', {
  markers: true, // Show ScrollTrigger markers
});
```

## Page Integration Example

```javascript
// In your page class (e.g., HomePage)
class HomePage extends BasePage {
  constructor() {
    super();
    this.horizontalScrolls = [];
  }

  init() {
    super.init();
    this.initHorizontalScrolls();
  }

  initHorizontalScrolls() {
    // Create horizontal scroll
    const scroll = createHorizontalScroll('.horizontal-section');
    this.horizontalScrolls.push(scroll);
  }

  destroy() {
    // Clean up on page leave
    this.horizontalScrolls.forEach(instance => {
      if (instance && instance.kill) {
        instance.kill();
      }
    });
    super.destroy();
  }
}
```

## CSS Requirements

```scss
.horizontal-section {
  overflow: hidden;
  width: 100%;

  .horizontal-scroll-wrapper {
    display: flex;
    gap: 2rem;
    will-change: transform;

    > * {
      flex-shrink: 0; // Important: prevent items from shrinking
    }
  }
}
```

## Tips & Best Practices

1. **Item Width**: Set explicit widths on scrolling items
2. **Flex Shrink**: Use `flex-shrink: 0` to prevent item compression
3. **Will Change**: Add `will-change: transform` for better performance
4. **Gap**: Use CSS `gap` property for spacing instead of margins
5. **Cleanup**: Always kill ScrollTrigger instances when leaving the page
6. **Refresh**: Call `ScrollTrigger.refresh()` after DOM changes

## Troubleshooting

**Items not scrolling:**
- Check that items have explicit widths
- Ensure `flex-shrink: 0` is set
- Verify container has `overflow: hidden`

**Jumpy animations:**
- Increase `scrub` value (1-3 recommended)
- Add `anticipatePin: 1`

**Performance issues:**
- Add `will-change: transform` to scrolling element
- Reduce number of items or use lazy loading
- Lower `scrub` value

## Browser Support

Works on all modern browsers that support GSAP and ScrollTrigger.
