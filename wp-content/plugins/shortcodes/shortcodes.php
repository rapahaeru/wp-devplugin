<?php
/**
 * Plugin Name: RB Shortcodes
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Implementa alguns shortcodes uteis para suas postagens
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */

define('PATH_PLUGIN', WP_PLUGIN_URL.'/shortcodes/');

function loadcss(){
	wp_register_style('boxaviso',PATH_PLUGIN.'css/boxaviso.css'); // registra o restilo
	wp_enqueue_style('boxaviso'); //carrega o estilo efetivamente ( precisa que seja registrada antes)
}

add_action('wp_enqueue_scripts','loadcss'); // chama tanto scripts quanto estilos para ser carregado

function boxcss($atts, $content=NULL){
	extract(shortcode_atts(array(
		'tipo' => 'sucesso',
		'radius' => '1',
		'sombra'  => '1'
	), $atts));

	($radius == TRUE) ? $radius = 'radius10' : $radius = '';
	($sombra == TRUE) ? $sombra = 'sombra' : $sombra = '';

	return '<div class="'. $tipo.' '.$radius.' '.$sombra .'" >'. $content.'</div>';
}
add_shortcode('box', 'boxcss');