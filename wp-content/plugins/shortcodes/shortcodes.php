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


function seriePosts($atts,$content=NULL){

	extract(shortcode_atts(array(
		'titulo' => NULL,
	), $atts));	

	if ($titulo==NULL || !is_single() || is_feed()) return;

	global $wpdb; // declarar essa variavel sempre que for utilizar o banco de dados

	//post_status = publish => somente os posts publicados
	//post_type = post => somente posts, não sendo páginas e etc.
	$sql = "SELECT ID, post_title, post_name FROM $wpdb->posts WHERE post_status='publish' 
			AND post_type='post' AND post_title LIKE '%$titulo%' 
			ORDER BY post_date ASC";
	//$teste = CONSTANTE_NAO_EXISTENTE; // teste para analizar log criado /wp-content/debug
	$resultado = $wpdb->get_results($sql);
	if (sizeof($resultado) > 0){
		$urlBlog = get_bloginfo('url') . '/'; // função nativa do WP

		$output = '<h2> Mais posts desta série (Mesmo titulo) </h2>';
		$output .= '<ul>';
		//var_dump($resultado);
		foreach ($resultado as $post) {
			if (get_the_ID() == $post->ID){ //função nativa do WP
				$output .= '<li><em>'.$post->post_title.'</em></li>';
			}else{
				$output .= '<li><a href="'.$urlBlog.$post->post_name.'" title="'.$post->post_title.'">'.$post->post_title.'</a></li>';
			}
		}
		$output .= '</ul>';
		return $output;
	}
}

add_shortcode('serie', 'seriePosts');