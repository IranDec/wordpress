<?php
/*
Plugin Name: Force Language Selection
Description: A plugin to force users to select a language before viewing the website. Supports WPML and Divi.
 * Version: 1.2
 * Author: Mohammad Babaei
 * website: adschi.com
*/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue scripts and styles securely
add_action('wp_enqueue_scripts', 'fls_enqueue_scripts');
add_action('wp_footer', 'fls_display_language_overlay');

function fls_enqueue_scripts() {
    wp_enqueue_style('fls-style', plugin_dir_url(__FILE__) . 'style.css', [], '1.0.0', 'all');
    wp_enqueue_script('fls-script', plugin_dir_url(__FILE__) . 'script.js', ['jquery'], '1.0.0', true);

    // Securely pass AJAX URL
    wp_localize_script('fls-script', 'fls_ajax', [
        'ajax_url' => esc_url(admin_url('admin-ajax.php')),
        'nonce' => wp_create_nonce('fls_nonce'), // Add a nonce for security
    ]);
}

function fls_display_language_overlay() {
    if (isset($_COOKIE['language_selected']) && sanitize_text_field($_COOKIE['language_selected']) === '1') {
        return; // Skip overlay if cookie exists
    }

    $languages = apply_filters('wpml_active_languages', null, 'skip_missing=0'); 
    if (!empty($languages)) {
        echo '<div id="language-overlay">';
        echo '<div class="language-selection">';
        echo '<h2>' . esc_html__('Select Your Language', 'force-language-selection') . '</h2>';
        foreach ($languages as $lang) {
            $flag = esc_url($lang['country_flag_url']);
            $name = esc_html($lang['translated_name']);
            $url = esc_url($lang['url']);
            echo "<a href='{$url}' class='language-item'>";
            echo "<div class='flag-circle' style='background-image: url({$flag});'></div>";
            echo "<span>{$name}</span>";
            echo "</a>";
        }
        echo '<div class="remember-choice">';
        echo '<input type="checkbox" id="remember-choice">';
        echo '<label for="remember-choice">' . esc_html__('Remember my choice for 30 days', 'force-language-selection') . '</label>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

// Secure AJAX handler for setting cookies
add_action('wp_ajax_set_language_cookie', 'fls_set_language_cookie');
add_action('wp_ajax_nopriv_set_language_cookie', 'fls_set_language_cookie');

function fls_set_language_cookie() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'fls_nonce')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    if (!isset($_POST['remember']) || $_POST['remember'] !== 'true') {
        wp_send_json_error(['message' => 'Invalid input']);
    }

    setcookie('language_selected', '1', time() + 2592000, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), true); // Secure cookie
    wp_send_json_success(['message' => 'Cookie set']);
}
