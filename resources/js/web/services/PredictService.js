/**
 * Predict Service
 * 處理專家預測過濾和AJAX調用
 */

export class PredictService {
    /**
     * 獲取CSRF token
     */
    static getCSRFToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }

    /**
     * 根據專家過濾預測
     * @param {string} expert - 專家名稱 (Expert 1, Expert 2, Expert 3)
     */
    static async filterByExpert(expert) {
        try {
            const response = await fetch(`/predict/expert/${encodeURIComponent(expert)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': PredictService.getCSRFToken()
                }
            });

            const data = await response.json();
            
            if (response.ok) {
                return { success: true, data };
            } else {
                return { success: false, error: data.message || '請求失敗' };
            }
        } catch (error) {
            console.error('專家過濾錯誤:', error);
            return { success: false, error: '網絡錯誤，請稍後重試' };
        }
    }

    /**
     * 獲取所有預測（重置過濾）
     */
    static async getAllPredictions() {
        try {
            const response = await fetch('/predict', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': PredictService.getCSRFToken()
                }
            });

            const data = await response.json();
            
            if (response.ok) {
                return { success: true, data };
            } else {
                return { success: false, error: data.message || '請求失敗' };
            }
        } catch (error) {
            console.error('獲取預測錯誤:', error);
            return { success: false, error: '網絡錯誤，請稍後重試' };
        }
    }

    /**
     * 更新預測容器內容
     * @param {Array} predictions 
     * @param {string} activeExpert 
     */
    static updatePredictionsContainer(predictions, activeExpert = null) {
        const container = document.querySelector('.predictions-container');
        if (!container) return;

        // 顯示加載狀態
        container.innerHTML = '<div class="loading-predictions"><i class="fas fa-spinner fa-spin"></i> 加載中...</div>';

        // 生成預測卡片HTML
        let predictionsHTML = '';
        
        if (predictions.length === 0) {
            predictionsHTML = `
                <div class="no-predictions">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>暫無預測</h3>
                        <p>${activeExpert ? `${activeExpert} 暫無預測內容` : '專家們正在分析比賽，請稍後再來查看最新預測'}</p>
                    </div>
                </div>
            `;
        } else {
            predictions.forEach(prediction => {
                predictionsHTML += PredictService.generatePredictionHTML(prediction);
            });
        }

        // 更新容器內容
        setTimeout(() => {
            container.innerHTML = predictionsHTML;
        }, 500);
    }

    /**
     * 生成單個預測卡片HTML
     * @param {object} prediction 
     */
    static generatePredictionHTML(prediction) {
        console.log('Generating HTML for prediction:', prediction);
        console.log('Image URL being used:', prediction.image);
        console.log('Full prediction object keys:', Object.keys(prediction));

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
     * 更新專家選擇狀態
     * @param {string} selectedExpert 
     */
    static updateExpertSelection(selectedExpert) {
        // 移除所有專家的active類
        document.querySelectorAll('.character-expert').forEach(expert => {
            expert.classList.remove('active');
        });

        // 為選中的專家添加active類
        if (selectedExpert) {
            const expertIndex = selectedExpert.replace('Expert ', '');
            const expertElement = document.querySelector(`.character-expert[data-expert="${selectedExpert}"]`) ||
                                 document.querySelector(`.character-expert:nth-child(${expertIndex})`);
            
            if (expertElement) {
                expertElement.classList.add('active');
            }
        } else {
            // 如果沒有選擇專家，默認選擇第一個
            document.querySelector('.character-expert:first-child')?.classList.add('active');
        }
    }

    /**
     * 設置專家過濾功能
     */
    static setupExpertFilters() {
        const expertElements = document.querySelectorAll('.character-expert');
        
        expertElements.forEach((expertElement, index) => {
            const expertName = `Expert ${index + 1}`;
            expertElement.setAttribute('data-expert', expertName);
            
            // 添加點擊事件處理程序
            expertElement.addEventListener('click', async (e) => {
                e.preventDefault();
                
                // 更新視覺狀態
                PredictService.updateExpertSelection(expertName);
                
                // 更新對話氣泡文本
                const bubbleText = document.getElementById('bubbleText');
                if (bubbleText) {
                    const expertTexts = {
                        'Expert 1': '酷然君為您帶來最新預測分析！',
                        'Expert 2': '國哥君的專業預測來了！', 
                        'Expert 3': '摩洛Special為您解析賽事！'
                    };
                    bubbleText.textContent = expertTexts[expertName] || '球停停車，實時停球時，預測他一樣，實收早場才能靠大錢！';
                }
                
                // 過濾預測
                const result = await PredictService.filterByExpert(expertName);
                
                if (result.success) {
                    PredictService.updatePredictionsContainer(result.data.predictions, expertName);
                } else {
                    console.error('過濾預測失敗:', result.error);
                }
            });
            
            // 添加鼠標懸停效果（不修改CSS，只設置cursor）
            expertElement.style.cursor = 'pointer';
        });
    }

    /**
     * 初始化預測頁面功能
     */
    static init() {
        // 等待DOM就緒
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                PredictService.setupExpertFilters();
            });
        } else {
            PredictService.setupExpertFilters();
        }
    }
}

// 如果在預測頁面，自動初始化
if (window.location.pathname.includes('/predict')) {
    PredictService.init();
}
