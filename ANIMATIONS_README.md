# 🎨 Advanced Web Animations & Interactions

This project now includes cutting-edge web animation technologies and smooth scrolling experiences. Here's what's been implemented:

## ✨ Features Implemented

### 1. **View Timeline Based Scroll Animations**
- **CSS-only scroll animations** using the modern `view()` timeline
- **Performance optimized** - no JavaScript required for basic animations
- **Smooth entrance effects** as elements come into view

#### Available Animation Classes:
- `.fade-in-section` - Fade in from bottom
- `.slide-in-left` - Slide in from left
- `.slide-in-right` - Slide in from right  
- `.scale-in` - Scale up from 80%
- `.rotate-in` - Rotate and scale in
- `.parallax` - Subtle parallax movement

### 2. **View Transitions API**
- **Smooth page transitions** between internal navigation
- **Native browser support** for seamless UX
- **Fallback support** for older browsers

### 3. **React Lenis Smooth Scrolling**
- **Buttery smooth scrolling** with custom easing
- **Touch device optimized** scrolling
- **Performance optimized** with RAF (RequestAnimationFrame)

### 4. **Scroll-Triggered Animations**
- **Intersection Observer** based animations
- **Staggered animations** for multiple elements
- **Custom animation triggers** via data attributes

## 🚀 How to Use

### Basic Animation Classes
Simply add these classes to any HTML element:

```html
<!-- Fade in animation -->
<div class="fade-in-section">
    This will fade in when scrolled into view
</div>

<!-- Slide in from left -->
<div class="slide-in-left">
    This will slide in from the left
</div>

<!-- Scale in animation -->
<div class="scale-in">
    This will scale up when visible
</div>
```

### Staggered Animations
Use the `.stagger-animation` container for multiple elements:

```html
<div class="stagger-animation">
    <div>First item (0ms delay)</div>
    <div>Second item (100ms delay)</div>
    <div>Third item (200ms delay)</div>
</div>
```

### Enhanced Button Effects
Add `.btn-animate` and `.hover-lift` for interactive buttons:

```html
<button class="btn-animate hover-lift">
    Interactive Button
</button>
```

### Parallax Effects
Add `.parallax` class for background parallax:

```html
<div class="parallax" data-speed="0.5">
    Background with parallax effect
</div>
```

## 🎯 Advanced Usage

### Custom Animation Triggers
Use data attributes for custom animations:

```html
<div data-animation="custom-fade">
    Custom animation trigger
</div>
```

### JavaScript API
Access the animation system via JavaScript:

```javascript
// Trigger animations programmatically
ScrollAnimations.triggerAnimation(element, 'pulse');

// Add animation classes
ScrollAnimations.addAnimationClass(element, 'fade-in-section');

// Scroll to element with Lenis
const lenis = new EnhancedLenis();
lenis.scrollTo('#section', { duration: 2, offset: 100 });
```

## 🔧 Configuration

### Lenis Smooth Scrolling
Customize the scrolling behavior:

```javascript
const lenis = new Lenis({
    duration: 1.2,           // Animation duration
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // Custom easing
    smooth: true,            // Enable smooth scrolling
    smoothTouch: false,      // Disable on touch devices
    touchMultiplier: 2,      // Touch sensitivity
});
```

### View Timeline Animations
Customize animation timing:

```css
.fade-in-section {
    animation: fade-in-keyframes linear;
    animation-timeline: view(800px 0px); /* 800px from top, 0px from bottom */
}
```

## 🌟 Performance Features

- **Hardware accelerated** animations using CSS transforms
- **Intersection Observer** for efficient scroll detection
- **RequestAnimationFrame** for smooth 60fps animations
- **Reduced motion support** for accessibility
- **Touch device optimization**

## 📱 Browser Support

- **Modern browsers**: Full support for all features
- **View Timeline**: Chrome 115+, Firefox 113+
- **View Transitions**: Chrome 111+, Firefox 103+
- **Fallbacks**: Graceful degradation for older browsers

## 🎨 Customization

### Adding New Animations
Create custom keyframes in `style.css`:

```css
@keyframes custom-animation {
    from {
        opacity: 0;
        transform: translateX(-100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.custom-animation {
    animation: custom-animation linear;
    animation-timeline: view(600px 0px);
}
```

### Custom Easing Functions
Modify Lenis easing for different scroll feels:

```javascript
// Bounce effect
easing: (t) => 1 - Math.pow(2, -10 * t) * Math.cos(t * Math.PI * 2)

// Elastic effect  
easing: (t) => 1 + Math.pow(2, -10 * t) * Math.sin((t - 0.075) * Math.PI * 2) / 0.3
```

## 🚨 Troubleshooting

### Animations Not Working?
1. Check if the element has the correct CSS class
2. Ensure the element is visible in the viewport
3. Verify CSS is properly loaded
4. Check browser console for JavaScript errors

### Smooth Scrolling Issues?
1. Verify Lenis is loaded before initialization
2. Check if there are conflicting scroll behaviors
3. Ensure proper CSS positioning

### Performance Issues?
1. Reduce animation complexity
2. Use `will-change` CSS property sparingly
3. Limit parallax elements
4. Enable reduced motion in browser settings

## 📚 Resources

- [View Timeline API](https://developer.mozilla.org/en-US/docs/Web/API/View_Timeline_API)
- [View Transitions API](https://developer.mozilla.org/en-US/docs/Web/API/View_Transitions_API)
- [React Lenis](https://github.com/studio-freight/lenis)
- [CSS Animations](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Animations)

---

**Note**: These features use modern web APIs. For production use, consider adding polyfills for older browser support.
