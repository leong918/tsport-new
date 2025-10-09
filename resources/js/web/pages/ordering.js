/**
 * Ordering Page JavaScript
 * Handles ordering page specific functionality including cart management
 */

export class OrderingService {
    constructor() {
        this.cart = [];
        this.cartTotal = 0;
        this.isCartOpen = false;
        this.init();
    }

    init() {
        this.bindEvents();
        this.updateCartDisplay();
    }

    bindEvents() {
        // Category selection
        $(document).on('click', '.category-card', (e) => {
            const categoryId = $(e.currentTarget).data('category');
            this.showCategoryItems(categoryId);
        });

        // Add to cart
        $(document).on('click', '.add-to-cart-btn', (e) => {
            e.preventDefault();
            const button = $(e.currentTarget);
            const itemData = {
                id: button.data('item-id'),
                name: button.data('item-name'),
                price: parseFloat(button.data('item-price'))
            };
            this.addToCart(itemData);
        });

        // Cart toggle
        $('#cart-toggle').on('click', () => {
            this.toggleCart();
        });

        // Cart close
        $('#cart-close').on('click', () => {
            this.closeCart();
        });

        // Remove from cart
        $(document).on('click', '.remove-item', (e) => {
            const itemId = $(e.currentTarget).data('item-id');
            this.removeFromCart(itemId);
        });

        // View all button
        $('#view-all-btn').on('click', () => {
            this.showAllItems();
        });

        // Checkout
        $('#checkout-btn').on('click', () => {
            this.checkout();
        });

        // Recommendation card clicks
        $(document).on('click', '.recommendation-card', (e) => {
            // Add visual feedback for recommendation selection
            $(e.currentTarget).addClass('selected');
            setTimeout(() => {
                $(e.currentTarget).removeClass('selected');
            }, 300);
        });
    }

    showCategoryItems(categoryId) {
        // Hide all category items
        $('.category-items').hide();
        
        // Show selected category items
        $(`.category-items[data-category="${categoryId}"]`).show();
        
        // Scroll to items section
        $('html, body').animate({
            scrollTop: $('#items-section').offset().top - 100
        }, 500);

        // Add visual feedback to category
        $('.category-card').removeClass('active');
        $(`.category-card[data-category="${categoryId}"]`).addClass('active');
    }

    showAllItems() {
        $('.category-items').show();
        
        // Scroll to items section
        $('html, body').animate({
            scrollTop: $('#items-section').offset().top - 100
        }, 500);

        // Remove active state from categories
        $('.category-card').removeClass('active');
    }

    addToCart(item) {
        // Check if item already exists in cart
        const existingItem = this.cart.find(cartItem => cartItem.id === item.id);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.cart.push({
                ...item,
                quantity: 1
            });
        }

        this.updateCartTotal();
        this.updateCartDisplay();
        this.showAddToCartFeedback(item.name);
    }

    removeFromCart(itemId) {
        this.cart = this.cart.filter(item => item.id !== itemId);
        this.updateCartTotal();
        this.updateCartDisplay();
    }

    updateCartTotal() {
        this.cartTotal = this.cart.reduce((total, item) => {
            return total + (item.price * item.quantity);
        }, 0);
    }

    updateCartDisplay() {
        const cartItemsContainer = $('#cart-items');
        const cartCount = $('#cart-count');
        const cartTotalDisplay = $('#cart-total');

        // Update cart count
        const totalItems = this.cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.text(totalItems);

        // Update cart total
        cartTotalDisplay.text(this.cartTotal.toFixed(2));

        // Update cart items display
        if (this.cart.length === 0) {
            cartItemsContainer.html('<p class="empty-cart">购物车为空</p>');
        } else {
            let cartHTML = '';
            this.cart.forEach(item => {
                cartHTML += `
                    <div class="cart-item" data-item-id="${item.id}">
                        <div class="item-info">
                            <div class="item-name">${item.name}</div>
                            <div class="item-price">¥${item.price.toFixed(2)} x ${item.quantity}</div>
                        </div>
                        <div class="item-actions">
                            <button class="btn btn-sm btn-danger remove-item" data-item-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });
            cartItemsContainer.html(cartHTML);
        }

        // Toggle cart count visibility
        if (totalItems > 0) {
            cartCount.show();
        } else {
            cartCount.hide();
        }
    }

    toggleCart() {
        if (this.isCartOpen) {
            this.closeCart();
        } else {
            this.openCart();
        }
    }

    openCart() {
        $('#cart-sidebar').addClass('open');
        this.isCartOpen = true;
    }

    closeCart() {
        $('#cart-sidebar').removeClass('open');
        this.isCartOpen = false;
    }

    showAddToCartFeedback(itemName) {
        // Create temporary notification
        const notification = $(`
            <div class="cart-notification">
                <i class="fas fa-check-circle"></i>
                "${itemName}" 已添加到购物车
            </div>
        `);

        $('body').append(notification);

        // Animate notification
        setTimeout(() => {
            notification.addClass('show');
        }, 100);

        // Remove notification after delay
        setTimeout(() => {
            notification.removeClass('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 2000);
    }

    checkout() {
        if (this.cart.length === 0) {
            alert('购物车为空');
            return;
        }

        // Simple checkout process - you can enhance this
        const orderSummary = this.cart.map(item => 
            `${item.name} x ${item.quantity} = ¥${(item.price * item.quantity).toFixed(2)}`
        ).join('\n');

        const totalAmount = this.cartTotal.toFixed(2);
        
        const confirmOrder = confirm(`订单详情:\n\n${orderSummary}\n\n总计: ¥${totalAmount}\n\n确认下单？`);
        
        if (confirmOrder) {
            // Clear cart
            this.cart = [];
            this.updateCartTotal();
            this.updateCartDisplay();
            this.closeCart();

            // Show success message
            alert('订单已提交！我们会尽快为您处理。');
        }
    }
}

export function initOrderingPage() {
    // Only run if we're on the ordering page
    if (document.body.id !== 'ordering' && !window.location.pathname.includes('/ordering')) {
        return;
    }

    // Set body id for specific styling
    document.body.id = 'ordering';
    document.body.classList.add('ordering-page');

    // Initialize ordering service
    const orderingService = new OrderingService();

    // Make ordering service globally available
    window.orderingService = orderingService;

    // Add scroll-triggered animations
    initScrollAnimations();
}

function initScrollAnimations() {
    // Intersection Observer for category cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe category cards and recommendation cards
    document.querySelectorAll('.category-card, .recommendation-card, .item-card').forEach(card => {
        observer.observe(card);
    });
}

// Auto-initialize when DOM is ready
$(document).ready(function() {
    initOrderingPage();
});

// Export for global access
window.initOrderingPage = initOrderingPage;
