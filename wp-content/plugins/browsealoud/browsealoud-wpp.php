<?php

/*
Plugin Name: Browsealoud
Plugin URI:  https://www.texthelp.com
Description: Websites made more accessible with easy speech, reading and translation tools. This plugin takes care of the Browsealoud installation process for all Wordpress blogs and websites. If you hold a licence for Browsealoud simply activate this plugin and you will see that Browsealoud automatically appears. If you don't have a licence you might be interested in our <a href="https://trybrowsealoud.texthelp.com/">30 day free trial</a>.
Version:     1.5.3
Author:      Texthelp
Author URI:  https://www.texthelp.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define('BROWSEALOUD_PLUGIN_VERSION', '2.5.2');
define('BROWSEALOUD_PLUGIN_URL', 'https://www.browsealoud.com/plus/scripts');
define('BROWSEALOUD_PLUGIN_INTEGRITY_STRING', 'sha256-pZUlaM0VaGsi0/tgIHnex2p/USKA0aujxOss+LCcUcU= sha384-SDqKNeiB6jmEcesjpzTEZzJG4Us+zZR2Oimur94XFciwMm7ixVAgd/6D7K4O8BEf sha512-u/Qw2M8T2H7AV8TIvPDTDAnMZ5ouIEF1PB2Prqe34FeaUSyJpd1HBEwE0xFQlIm/B3HuOnRQykVtP7IS+Mm0TQ==');

function browsealoudScript() {

    $script_str = sprintf('<script type="text/javascript" src="%s/%s/ba.js" integrity="%s" crossorigin="anonymous"></script>', BROWSEALOUD_PLUGIN_URL, BROWSEALOUD_PLUGIN_VERSION, BROWSEALOUD_PLUGIN_INTEGRITY_STRING);

    echo($script_str);
}

add_action('wp_footer', 'browsealoudScript');
