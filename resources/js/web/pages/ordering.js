/**
 * Ordering Page JavaScript
 * Handles ordering page functionality including cart management
 */

import $ from 'jquery';
import BasePage from './BasePage.js';

class OrderingPage extends BasePage {
    constructor() {
        super();
        this.pageName = 'ordering';
        this.pageSelector = '#ordering, [body-id="ordering"]';
        this.cart = [];
        this.cartTotal = 0;
        this.isCartOpen = false;
        
        // Auto-initialize if page elements are present
        if (this.shouldInitialize() || this.isOrderingPage()) {
            this.init();
        }
    }

    /**
     * Check if we're on the ordering page
     */
    isOrderingPage() {
        return document.body.id === 'ordering' || 
               window.location.pathname.includes('/ordering');
    }

    /**
     * Initialize page
     */
    init() {
        // Set body id and class for specific styling
        document.body.id = 'ordering';
        document.body.classList.add('ordering-page');

        // Call parent init
        super.init();

        // Initialize cart display
        this.updateCartDisplay();

        // Make ordering service globally available
        window.orderingService = this;
    }

    /**
     * Bind event listeners
     */
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
            $(e.currentTarget).addClass('selected');
            setTimeout(() => {
                $(e.currentTarget).removeClass('selected');
            }, 300);
        });
    }

    /**
     * Setup visual effects and animations
     */
    setupEffects() {
        this.initScrollAnimations();
    }

    /**
     * Initialize scroll-triggered animations
     */
    initScrollAnimations() {
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

    /**
     * Show items for specific category
     */
    showCategoryItems(categoryId) {
        $('.category-items').hide();
        $(`.category-items[data-category="${categoryId}"]`).show();
        
        $('html, body').animate({
            scrollTop: $('#items-section').offset().top - 100
        }, 500);

        $('.category-card').removeClass('active');
        $(`.category-card[data-category="${categoryId}"]`).addClass('active');
    }

    /**
     * Show all items
     */
    showAllItems() {
        $('.category-items').show();
        
        $('html, body').animate({
            scrollTop: $('#items-section').offset().top - 100
        }, 500);

        $('.category-card').removeClass('active');
    }

    /**
     * Add item to cart
     */
    addToCart(item) {
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

    /**
     * Remove item from cart
     */
    removeFromCart(itemId) {
        this.cart = this.cart.filter(item => item.id !== itemId);
        this.updateCartTotal();
        this.updateCartDisplay();
    }

    /**
     * Update cart total
     */
    updateCartTotal() {
        this.cartTotal = this.cart.reduce((total, item) => {
            return total + (item.price * item.quantity);
        }, 0);
    }

    /**
     * Update cart display
     */
    updateCartDisplay() {
        const cartItemsContainer = $('#cart-items');
        const cartCount = $('#cart-count');
        const cartTotalDisplay = $('#cart-total');

        const totalItems = this.cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.text(totalItems);
        cartTotalDisplay.text(this.cartTotal.toFixed(2));

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

        if (totalItems > 0) {
            cartCount.show();
        } else {
            cartCount.hide();
        }
    }

    /**
     * Toggle cart sidebar
     */
    toggleCart() {
        if (this.isCartOpen) {
            this.closeCart();
        } else {
            this.openCart();
        }
    }

    /**
     * Open cart sidebar
     */
    openCart() {
        $('#cart-sidebar').addClass('open');
        this.isCartOpen = true;
    }

    /**
     * Close cart sidebar
     */
    closeCart() {
        $('#cart-sidebar').removeClass('open');
        this.isCartOpen = false;
    }

    /**
     * Show add to cart feedback
     */
    showAddToCartFeedback(itemName) {
        const notification = $(`
            <div class="cart-notification">
                <i class="fas fa-check-circle"></i>
                "${itemName}" 已添加到购物车
            </div>
        `);

        $('body').append(notification);

        setTimeout(() => {
            notification.addClass('show');
        }, 100);

        setTimeout(() => {
            notification.removeClass('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 2000);
    }

    /**
     * Process checkout
     */
    checkout() {
        if (this.cart.length === 0) {
            alert('购物车为空');
            return;
        }

        const orderSummary = this.cart.map(item => 
            `${item.name} x ${item.quantity} = ¥${(item.price * item.quantity).toFixed(2)}`
        ).join('\n');

        const totalAmount = this.cartTotal.toFixed(2);
        
        const confirmOrder = confirm(`订单详情:\n\n${orderSummary}\n\n总计: ¥${totalAmount}\n\n确认下单？`);
        
        if (confirmOrder) {
            this.cart = [];
            this.updateCartTotal();
            this.updateCartDisplay();
            this.closeCart();
            alert('订单已提交！我们会尽快为您处理。');
        }
    }
}

// Auto-initialize if on ordering page
$(document).ready(() => {
    new OrderingPage();
});

export default OrderingPage;
