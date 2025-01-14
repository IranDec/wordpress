<?php
/*
Plugin Name: Force Language Selection
Description: A plugin to force users to select a language before viewing the website. Supports WPML and Divi.
 * Version: 1.2
 * Author: Mohammad Babaei
 * website: adschi.com
*/
add_action('wp_footer', function () {
    if (!isset($_COOKIE['selected_language'])) {
        ?>
        <div id="language-modal" style="display: flex;">
            <div class="language-modal-content">
                <button class="modal-close">&times;</button>
                <h2>Select Your Language</h2>
                <div class="language-options">
                    <button data-lang="en" class="language-button">
                        <img src="https://flagcdn.com/w80/us.png" alt="English"> English
                    </button>
                    <button data-lang="fa" class="language-button">
                        <img src="https://flagcdn.com/w80/ir.png" alt="فارسی"> فارسی
                    </button>
                    <button data-lang="ar" class="language-button">
                        <img src="https://flagcdn.com/w80/sa.png" alt="العربية"> العربية
                    </button>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember-choice" checked>
                    <label for="remember-choice">Remember my choice for 30 days</label>
                </div>
            </div>
        </div>
        <div id="loading-overlay" style="display: none;">
            <div class="loading-spinner"></div>
        </div>
        <style>
            /* Modal styling */
            #language-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }
            .language-modal-content {
                background: white;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                position: relative;
            }
            .modal-close {
                position: absolute;
                top: 10px;
                right: 10px;
                background: none;
                border: none;
                font-size: 20px;
                cursor: pointer;
            }
            .language-options {
                display: flex;
                justify-content: center;
                gap: 15px;
            }
            .language-button {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                border: none;
                cursor: pointer;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background: #f0f0f0;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .language-button img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
            }
            .language-button:hover {
                background: #e0e0e0;
            }
            .remember-me {
                margin-top: 20px;
                font-size: 14px;
            }
            /* Loading overlay styling */
            #loading-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 10000;
            }
            .loading-spinner {
                width: 50px;
                height: 50px;
                border: 5px solid #f3f3f3;
                border-top: 5px solid #3498db;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }
            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('language-modal');
                const closeButton = document.querySelector('.modal-close');
                const languageButtons = document.querySelectorAll('.language-button');
                const rememberChoice = document.getElementById('remember-choice');
                const loadingOverlay = document.getElementById('loading-overlay');

                // زبان پیش‌فرض سایت
                const defaultLanguage = document.documentElement.lang || 'en'; // زبان فعلی سایت

                // Close modal on clicking the close button
                closeButton.addEventListener('click', () => {
                    modal.style.display = 'none';
                });

                // Handle language selection
                languageButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const lang = button.getAttribute('data-lang');
                        
                        if (lang === defaultLanguage) {
                            // اگر زبان فعلی انتخاب شده باشد، مودال بسته شود
                            modal.style.display = 'none';
                            return;
                        }

                        if (rememberChoice.checked) {
                            document.cookie = `selected_language=${lang}; path=/; max-age=${30 * 24 * 60 * 60}`;
                        }

                        // Show loading overlay before redirect
                        loadingOverlay.style.display = 'flex';

                        // Simulate a small delay before redirect (optional)
                        setTimeout(() => {
                            // Redirect to the selected language page
                            window.location.href = lang === 'en' ? '/' : `/${lang}`;
                        }, 500);
                    });
                });
            });
        </script>
        <?php
    }
});
?>
