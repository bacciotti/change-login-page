<?php

/*
Plugin Name:  LB Login Page
Version:  1.0
Description:  Customizing the WordPress login page.
Author:  Lucas Bacciotti
Author URI:
Text Domain:  lb-change-login-page
*/

if (!defined('ABSPATH')) {
    die;
}

// enqueueing the custom style sheet on WordPress login page
add_action('login_enqueue_scripts', 'lb_login_stylesheet');

function lb_login_stylesheet()
{
    // Load the style sheet from the plugin folder
    wp_enqueue_style('lb-login-styles', plugin_dir_url(__FILE__) . '/css/lb-login-styles.css');
}

// Custom login ERROR message to keep the site more secure
add_filter('login_errors', 'lb_login_errors', 10);
function lb_login_errors()
{
    return 'Algo deu ruim, tente de novo, parça!';
}

// Remove the login form box shake animation for incorrect credentials
add_action('login_head', 'lb_login_remove_loginshake');
function lb_login_remove_loginshake()
{
    remove_action('login_footer', 'wp_shake_js', 12);
}

// Change the logo link above the login form
add_filter('login_headerurl', 'lb_login_headerurl');
function lb_login_headerurl($url)
{
    $url = 'https://bacciotti.com';
    return $url;
}

// Change login labels
add_filter('gettext', 'lb_login_gettext_filter', 10, 3);
function lb_login_gettext_filter($translation, $orig, $domain) {
    switch($orig) {
        case 'Username or Email Address':
            $translation = "Usuário da horinha ou e-mail da horinha";
            break;
        case 'Username':
            $translation = "Usuário da horinha";
            break;
        case 'Password':
            $translation = 'Contra seña!';
            break;
        case 'Log In':
            $translation = 'Abre-te, Césamo!';
            break;
        case 'Remember Me':
            $translation = 'Mim lembre';
    }
    return $translation;
}
