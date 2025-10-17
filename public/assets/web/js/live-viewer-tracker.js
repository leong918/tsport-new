/**
 * Live Viewer Count Tracking
 * 
 * This script provides real-time viewer count tracking for live streams
 * including automatic join/leave tracking and heartbeat mechanism
 */

class LiveViewerTracker {
    constructor(matchId) {
        this.matchId = matchId;
        this.heartbeatInterval = null;
        this.updateInterval = null;
        this.hasJoined = false;
        
        this.init();
    }
    
    /**
     * Initialize the tracker
     */
    init() {
        if (!this.matchId) {
            console.warn('No match ID provided for viewer tracking');
            return;
        }
        
        // Join the live stream
        this.join();
        
        // Start heartbeat (every 2 minutes)
        this.startHeartbeat();
        
        // Start viewer count updates (every 15 seconds)
        this.startViewerCountUpdates();
        
        // Handle page unload
        window.addEventListener('beforeunload', () => this.leave());
        
        // Handle page visibility changes
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.stopHeartbeat();
            } else {
                this.startHeartbeat();
            }
        });
    }
    
    /**
     * User joins the live stream
     */
    async join() {
        try {
            const response = await fetch(`/api/live/${this.matchId}/join`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.hasJoined = true;
                this.updateViewerCountDisplay(data.viewer_count);
                console.log('✅ Joined live stream, viewers:', data.viewer_count);
            }
        } catch (error) {
            console.error('❌ Error joining live stream:', error);
        }
    }
    
    /**
     * User leaves the live stream
     */
    leave() {
        if (!this.hasJoined) return;
        
        try {
            // Use sendBeacon to ensure request is sent even when page is closing
            const url = `/api/live/${this.matchId}/leave`;
            const data = new FormData();
            
            if (navigator.sendBeacon) {
                navigator.sendBeacon(url, data);
            } else {
                // Fallback for browsers that don't support sendBeacon
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    keepalive: true
                });
            }
            
            console.log('👋 Left live stream');
        } catch (error) {
            console.error('❌ Error leaving live stream:', error);
        }
    }
    
    /**
     * Send heartbeat to keep viewer session alive
     */
    async sendHeartbeat() {
        if (!this.hasJoined) return;
        
        try {
            await fetch(`/api/live/${this.matchId}/heartbeat`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        } catch (error) {
            console.error('❌ Heartbeat error:', error);
        }
    }
    
    /**
     * Start sending heartbeats
     */
    startHeartbeat() {
        if (this.heartbeatInterval) {
            clearInterval(this.heartbeatInterval);
        }
        
        // Send heartbeat every 2 minutes
        this.heartbeatInterval = setInterval(() => {
            this.sendHeartbeat();
        }, 120000); // 2 minutes
    }
    
    /**
     * Stop sending heartbeats
     */
    stopHeartbeat() {
        if (this.heartbeatInterval) {
            clearInterval(this.heartbeatInterval);
            this.heartbeatInterval = null;
        }
    }
    
    /**
     * Update viewer count from server
     */
    async updateViewerCount() {
        try {
            const response = await fetch(`/api/live/${this.matchId}/viewers`);
            const data = await response.json();
            
            if (data.success) {
                this.updateViewerCountDisplay(data.viewer_count, true);
            }
        } catch (error) {
            console.error('❌ Error updating viewer count:', error);
        }
    }
    
    /**
     * Start periodic viewer count updates
     */
    startViewerCountUpdates() {
        if (this.updateInterval) {
            clearInterval(this.updateInterval);
        }
        
        // Update every 15 seconds
        this.updateInterval = setInterval(() => {
            this.updateViewerCount();
        }, 15000);
    }
    
    /**
     * Stop viewer count updates
     */
    stopViewerCountUpdates() {
        if (this.updateInterval) {
            clearInterval(this.updateInterval);
            this.updateInterval = null;
        }
    }
    
    /**
     * Update viewer count display on page
     * @param {number} count - New viewer count
     * @param {boolean} animate - Whether to animate the change
     */
    updateViewerCountDisplay(count, animate = false) {
        const element = document.getElementById('live-viewer-count');
        
        if (!element) return;
        
        const oldCount = parseInt(element.textContent.replace(/,/g, '')) || 0;
        const newCount = parseInt(count);
        
        // Add animation classes if count changed
        if (animate && newCount !== oldCount) {
            if (newCount > oldCount) {
                element.classList.add('viewer-increase');
                setTimeout(() => element.classList.remove('viewer-increase'), 1000);
            } else if (newCount < oldCount) {
                element.classList.add('viewer-decrease');
                setTimeout(() => element.classList.remove('viewer-decrease'), 1000);
            }
        }
        
        // Update display with formatted number
        element.textContent = newCount.toLocaleString();
    }
    
    /**
     * Cleanup on destroy
     */
    destroy() {
        this.stopHeartbeat();
        this.stopViewerCountUpdates();
        this.leave();
    }
}

// Auto-initialize if match ID is available
document.addEventListener('DOMContentLoaded', () => {
    const pageElement = document.getElementById('page-live');
    const matchId = pageElement?.dataset.matchId;
    
    if (matchId && matchId !== '0' && matchId !== '') {
        window.liveViewerTracker = new LiveViewerTracker(matchId);
        console.log('🎬 Live Viewer Tracker initialized for match:', matchId);
    }
});
