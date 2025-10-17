/**
 * Predict Page JavaScript
 * Handles character selection, speech bubble changes, and prediction filtering
 */

import $ from 'jquery';

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
        this.expertNames = ['Expert 1', 'Expert 2', 'Expert 3'];
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.initializeCharacters();
    }

    /**
     * Get CSRF token for AJAX requests
     */
    getCSRFToken() {
        return $('meta[name="csrf-token"]').attr('content') || '';
    }

    /**
     * Initialize character data and set first character as active
     */
    initializeCharacters() {
        const characterElements = document.querySelectorAll('.character-expert');
        
        if (characterElements.length === 0) {
            return;
        }
        
        characterElements.forEach((element, index) => {
            // 优先使用HTML中的data-expert属性，如果不存在则使用默认值
            let expertName = element.getAttribute('data-expert') || element.dataset.expert;
            
            // 如果HTML中没有设置，则使用数组中的值
            if (!expertName) {
                expertName = this.expertNames[index] || `Expert ${index + 1}`;
            }
            
            // 验证专家名称不为空
            if (!expertName || expertName.trim() === '') {
                return;
            }
            
            const characterData = {
                element: element,
                index: index,
                name: expertName,
                expertName: expertName,
                avatar: element.querySelector('.character-avatar img'),
                isActive: element.classList.contains('active')
            };
            
            // 确保data attribute设置正确
            element.setAttribute('data-expert', characterData.expertName);
            element.style.cursor = 'pointer';
            
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

        // 设置初始的语音气泡文案（对应当前活跃专家）
        this.setInitialSpeechBubble();
    }

    /**
     * 设置初始的语音气泡文案
     */
    setInitialSpeechBubble() {
        const bubbleText = document.getElementById('bubbleText');
        if (bubbleText && this.activeCharacter) {
            const expertTexts = {
                'Expert 1': '球停停车，实时停球时，预测他一样，实收早场才能靠大钱！',
                'Expert 2': '巨球比赛管做得生意，顾客多少看生意预期',
                'Expert 3': '数据不会说谎，只要你足够细心，想赢就赢在细节！'
            };
            const initialText = expertTexts[this.activeCharacter.expertName] || expertTexts['Expert 1'];
            bubbleText.textContent = initialText;
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
    async handleCharacterClick(characterElement) {
        const character = this.characters.find(char => char.element === characterElement);
        if (!character) {
            return;
        }
        
        // 多重验证专家名称
        if (!character.expertName || 
            character.expertName.trim() === '' || 
            character.expertName === 'null' || 
            character.expertName === 'undefined') {
            
            // 尝试从element重新获取
            const fallbackName = characterElement.getAttribute('data-expert') || 
                                characterElement.dataset.expert ||
                                this.expertNames[character.index];
            
            if (fallbackName && fallbackName.trim() !== '' && fallbackName !== 'null') {
                character.expertName = fallbackName;
                character.name = fallbackName;
            } else {
                return;
            }
        }
        
        // Add visual feedback
        characterElement.style.opacity = '0.7';
        setTimeout(() => {
            characterElement.style.opacity = '1';
        }, 200);
        
        this.setActiveCharacter(character);
        await this.filterPredictionsByExpert(character.expertName);
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
    async selectPreviousCharacter() {
        if (!this.activeCharacter) return;
        
        const currentIndex = this.activeCharacter.index;
        const previousIndex = currentIndex > 0 ? currentIndex - 1 : this.characters.length - 1;
        this.setActiveCharacter(this.characters[previousIndex]);
        await this.filterPredictionsByExpert(this.characters[previousIndex].expertName);
    }

    /**
     * Select next character
     */
    async selectNextCharacter() {
        if (!this.activeCharacter) return;
        
        const currentIndex = this.activeCharacter.index;
        const nextIndex = currentIndex < this.characters.length - 1 ? currentIndex + 1 : 0;
        this.setActiveCharacter(this.characters[nextIndex]);
        await this.filterPredictionsByExpert(this.characters[nextIndex].expertName);
    }

    /**
     * Update speech bubble content based on character selection
     */
    updateSpeechBubbleForCharacter(character) {
        // Map character to corresponding speech bubble
        const characterIndex = character.index; // 0, 1, 2
        const bubbleData = this.speechBubbles[characterIndex];
        
        if (bubbleData) {
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
            
            bubbleImage.src = newSrc;
            
            // Add error handling
            bubbleImage.onerror = function() {
                // Fallback to first image if current fails
                this.src = basePath + 'chatbox-1.png';
            };
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
     * Filter prediction cards based on character (local filtering)
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
     * Filter predictions by expert using AJAX
     */
    async filterPredictionsByExpert(expertName) {
        try {
            // 严格验证专家名称
            if (!expertName || 
                typeof expertName !== 'string' ||
                expertName.trim() === '' || 
                expertName === 'null' || 
                expertName === 'undefined' ||
                expertName.toLowerCase() === 'null' ||
                expertName.toLowerCase() === 'undefined') {
                    
                this.showErrorState('专家名称无效 - 请刷新页面重试');
                return;
            }
            
            // 确保专家名称在有效列表中
            const validExperts = ['Expert 1', 'Expert 2', 'Expert 3'];
            if (!validExperts.includes(expertName)) {
                this.showErrorState(`无效的专家名称: ${expertName}`);
                return;
            }
            
            // Show loading state
            this.showLoadingState(expertName);
            
            // 构建安全的URL
            const encodedExpert = encodeURIComponent(expertName);
            const url = `/predict/expert/${encodedExpert}`;
            
            // Make AJAX request
            const response = await $.ajax({
                url: url,
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.getCSRFToken()
                }
            });
            
            if (response.success) {
                // 注意：后端直接返回 predictions，不是在 data 对象内
                this.updatePredictionsContainer(response.predictions, expertName);
            } else {
                throw new Error(response.message || 'Request failed');
            }
            
        } catch (error) {
            // 提供更详细的错误信息
            let errorMessage = 'Network error occurred';
            if (error.status === 404) {
                errorMessage = '请求的专家预测不存在';
            } else if (error.status === 400) {
                errorMessage = '无效的专家参数';
            } else if (error.responseJSON && error.responseJSON.message) {
                errorMessage = error.responseJSON.message;
            } else if (error.message) {
                errorMessage = error.message;
            }
            
            this.showErrorState(errorMessage);
        }
    }

    /**
     * Show loading state in predictions container
     */
    showLoadingState(expertName) {
        const container = $('.predictions-container');
        if (container.length) {
            container.html(`
                <div class="loading-state">
                    <p class="p1 text-center text-white">正在加载 ${expertName} 的预测...</p>
                </div>
            `);
        }
    }

    /**
     * Show error state in predictions container
     */
    showErrorState(errorMessage) {
        const container = $('.predictions-container');
        if (container.length) {
            container.html(`
                <div class="error-state" style="text-align: center; padding: 60px 20px; color: #e74c3c;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 24px; margin-bottom: 15px; display: block;"></i>
                    <p style="font-size: 16px; margin: 0 0 15px 0; font-weight: 500;">加载失败</p>
                    <p style="font-size: 14px; margin: 0; opacity: 0.8;">${errorMessage}</p>
                    <button onclick="location.reload()" style="
                        margin-top: 20px; 
                        padding: 8px 16px; 
                        background: #e74c3c; 
                        color: white; 
                        border: none; 
                        border-radius: 4px; 
                        cursor: pointer;
                        font-size: 14px;
                    ">重新加载</button>
                </div>
            `);
        }
    }

    /**
     * Update predictions container with new data
     */
    updatePredictionsContainer(predictions, expertName) {
        const container = $('.predictions-container');
        if (!container.length) return;

        if (predictions.length === 0) {
            container.html(`
                <div class="no-predictions">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>暂无预测</h3>
                        <p>${expertName} 暂无预测内容</p>
                    </div>
                </div>
            `);
            return;
        }

        // Generate predictions HTML
        let predictionsHTML = '';
        predictions.forEach(prediction => {
            predictionsHTML += this.generatePredictionHTML(prediction);
        });

        // Update container with fade effect
        container.fadeOut(300, () => {
            container.html(predictionsHTML);
            container.fadeIn(300);
        });
    }

    /**
     * Generate HTML for a single prediction
     */
    generatePredictionHTML(prediction) {        
        return `
            <div class="prediction-match-card" data-character="${prediction.character_name}">
                <div class="prediction-image-container">
                    <a href="/predict/${prediction.id}" class="prediction-image-link">
                        <img src="${prediction.image}" 
                             alt="Prediction by ${prediction.character_name}" 
                             class="img-fluid">
                    </a>
                </div>
            </div>
        `;
    }

    /**
     * Show all predictions
     */
    showAllPredictions() {
        this.filterPredictions('all');
    }
}

// Initialize when DOM is loaded and we're on the predict page
if ($('section#section-characters-hero').length || $('#page-predict').length) {
    $(document).ready(() => {
        try {
            const predictPage = new PredictPage();
            
            // Make it globally accessible for debugging
            window.PredictPage = predictPage;
        } catch (error) {
            // Show user-friendly error message
            const errorContainer = document.querySelector('.predictions-container') || document.body;
            if (errorContainer) {
                const errorDiv = document.createElement('div');
                errorDiv.style.cssText = 'text-align: center; padding: 40px 20px; color: #e74c3c; background: #fff; margin: 20px; border-radius: 8px;';
                errorDiv.innerHTML = `
                    <h3>预测功能初始化失败</h3>
                    <p>请刷新页面重试，如果问题持续存在，请联系技术支持。</p>
                    <button onclick="location.reload()" style="
                        padding: 10px 20px; 
                        background: #007bff; 
                        color: white; 
                        border: none; 
                        border-radius: 4px; 
                        cursor: pointer;
                        margin-top: 10px;
                    ">刷新页面</button>
                `;
                
                if (errorContainer.querySelector) {
                    errorContainer.appendChild(errorDiv);
                } else {
                    document.body.appendChild(errorDiv);
                }
            }
        }
    });
}

// Export for module usage
export default PredictPage;
