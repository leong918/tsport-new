/**
 * Predict Page JavaScript
 * Handles character selection, speech bubble changes, and prediction filtering
 */

class PredictPage {
    constructor() {
        this.characters = [];
        this.speechBubbles = [
            {
                image: 'chatbox-1.png',
                text: '球停停车，实时停球时，预测他一样，实收早场才能靠大钱！'
            },
            {
                image: 'chatbox-2.png', 
                text: '巨球比赛管做得生意，顾客多少看生意预期'
            },
            {
                image: 'chatbox-3.png',
                text: '数据不会说谎，只要你足够细心，想赢就赢在细节！'
            }
        ];
        this.currentBubbleIndex = 0;
        this.activeCharacter = null;
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.initializeCharacters();
    }

    /**
     * Initialize character data and set first character as active
     */
    initializeCharacters() {
        const characterElements = document.querySelectorAll('.character-expert');
        
        characterElements.forEach((element, index) => {
            const characterData = {
                element: element,
                index: index,
                name: `character-${index + 1}`,
                avatar: element.querySelector('.character-avatar img'),
                isActive: element.classList.contains('active')
            };
            
            this.characters.push(characterData);
            
            // Set first active character
            if (characterData.isActive) {
                this.activeCharacter = characterData;
            }
        });

        // If no character is active, set first one as active
        if (!this.activeCharacter && this.characters.length > 0) {
            this.setActiveCharacter(this.characters[0]);
        }
    }

    /**
     * Bind all event listeners
     */
    bindEvents() {
        // Character selection events
        document.addEventListener('click', (e) => {
            const characterExpert = e.target.closest('.character-expert');
            if (characterExpert) {
                this.handleCharacterClick(characterExpert);
            }
        });

        // Speech bubble click to manually change
        const speechBubble = document.querySelector('.speech-bubble');
        if (speechBubble) {
            speechBubble.addEventListener('click', () => {
                this.changeSpeechBubble();
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                this.selectPreviousCharacter();
            } else if (e.key === 'ArrowRight') {
                this.selectNextCharacter();
            }
        });
    }

    /**
     * Handle character expert click
     */
    handleCharacterClick(characterElement) {
        const character = this.characters.find(char => char.element === characterElement);
        if (character) {
            this.setActiveCharacter(character);
            this.filterPredictions(character.name);
        }
    }

    /**
     * Set active character and update UI
     */
    setActiveCharacter(character) {
        // Remove active class from all characters
        this.characters.forEach(char => {
            char.element.classList.remove('active');
            char.isActive = false;
        });

        // Add active class to selected character
        character.element.classList.add('active');
        character.isActive = true;
        this.activeCharacter = character;

        // Update speech bubble based on character selection
        this.updateSpeechBubbleForCharacter(character);
    }

    /**
     * Select previous character
     */
    selectPreviousCharacter() {
        if (!this.activeCharacter) return;
        
        const currentIndex = this.activeCharacter.index;
        const previousIndex = currentIndex > 0 ? currentIndex - 1 : this.characters.length - 1;
        this.setActiveCharacter(this.characters[previousIndex]);
        this.filterPredictions(this.characters[previousIndex].name);
    }

    /**
     * Select next character
     */
    selectNextCharacter() {
        if (!this.activeCharacter) return;
        
        const currentIndex = this.activeCharacter.index;
        const nextIndex = currentIndex < this.characters.length - 1 ? currentIndex + 1 : 0;
        this.setActiveCharacter(this.characters[nextIndex]);
        this.filterPredictions(this.characters[nextIndex].name);
    }

    /**
     * Update speech bubble content based on character selection
     */
    updateSpeechBubbleForCharacter(character) {
        // Map character to corresponding speech bubble
        const characterIndex = character.index; // 0, 1, 2
        const bubbleData = this.speechBubbles[characterIndex];
        
        if (bubbleData) {
            console.log('Updating speech bubble for character:', character.name, 'to:', bubbleData.text);
            this.updateSpeechBubbleImage(bubbleData.image);
            this.updateSpeechBubbleText(bubbleData.text);
            // Update current bubble index to match character
            this.currentBubbleIndex = characterIndex;
        }
    }

    /**
     * Change speech bubble to next one (manual click)
     */
    changeSpeechBubble() {
        this.currentBubbleIndex = (this.currentBubbleIndex + 1) % this.speechBubbles.length;
        const currentBubble = this.speechBubbles[this.currentBubbleIndex];
        
        console.log('Manually changing to bubble index:', this.currentBubbleIndex, 'Image:', currentBubble.image);
        
        this.updateSpeechBubbleImage(currentBubble.image);
        this.updateSpeechBubbleText(currentBubble.text);
    }

    /**
     * Update speech bubble image
     */
    updateSpeechBubbleImage(imageName) {
        const bubbleImage = document.querySelector('.speech-bubble-image');
        if (bubbleImage) {
            const basePath = bubbleImage.src.substring(0, bubbleImage.src.lastIndexOf('/') + 1);
            const newSrc = basePath + imageName;
            
            // Debug log to check if image is changing
            console.log('Changing bubble image from:', bubbleImage.src, 'to:', newSrc);
            
            bubbleImage.src = newSrc;
            
            // Add error handling
            bubbleImage.onerror = function() {
                console.warn('Failed to load bubble image:', newSrc);
                // Fallback to first image if current fails
                this.src = basePath + 'chatbox-1.png';
            };
        } else {
            console.warn('Speech bubble image element not found');
        }
    }

    /**
     * Update speech bubble text with animation
     */
    updateSpeechBubbleText(text) {
        const bubbleText = document.getElementById('bubbleText');
        if (bubbleText) {
            // Fade out
            bubbleText.style.opacity = '0';
            
            setTimeout(() => {
                bubbleText.textContent = text;
                // Fade in
                bubbleText.style.opacity = '1';
            }, 300);
        }
    }

    /**
     * Filter prediction cards based on character
     */
    filterPredictions(characterName) {
        const predictionCards = document.querySelectorAll('.prediction-match-card');
        
        predictionCards.forEach(card => {
            const cardCharacter = card.getAttribute('data-character');
            
            if (!cardCharacter || cardCharacter.includes(characterName) || characterName === 'all') {
                card.style.display = 'block';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            } else {
                card.style.opacity = '0.3';
                card.style.transform = 'translateY(10px)';
            }
        });
    }

    /**
     * Show all predictions
     */
    showAllPredictions() {
        this.filterPredictions('all');
    }

    /**
     * Add hover effects to prediction cards
     */
    addCardHoverEffects() {
        const predictionCards = document.querySelectorAll('.prediction-match-card');
        
        predictionCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(-5px)';
            });
        });
    }

    /**
     * Initialize all animations and effects
     */
    initializeEffects() {
        this.addCardHoverEffects();
        
        // Add CSS animation keyframes if not present
        this.addCustomStyles();
    }

    /**
     * Add custom styles for interactions
     */
    addCustomStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .character-expert {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .speech-bubble {
                transition: all 0.3s ease;
            }
            
            #bubbleText {
                transition: opacity 0.3s ease;
            }
            
            .prediction-match-card {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
        `;
        document.head.appendChild(style);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const predictPage = new PredictPage();
    predictPage.initializeEffects();
    
    // Make it globally accessible for debugging
    window.PredictPage = predictPage;
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PredictPage;
}
