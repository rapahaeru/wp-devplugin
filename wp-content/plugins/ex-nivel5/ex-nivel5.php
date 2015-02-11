<?php
/**
 * Plugin Name: IMPORTANTE : Exemplos nivel 5 (Portfolio)
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Este plugin é apenas um exemplo do nivel 5 do curso de criação de plugins - custom post types
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */


function ex_custom_portfolio(){
	
	//labels padrão disponivel no codex do register_post_types
	$labels = array(
					'name' 					=> 'Portfolio',
					'singular_name' 		=> 'Portfolios',
					'add_new_item' 			=> 'Adicionar trabalho',
					'edit_item' 			=> 'Editar trabalho',
					'new_item' 				=> 'Adicionar trabalho',
					'all_items' 			=> 'Todos os trabalhos',
					'view_item' 			=> 'Ver trabalhos',
					'search_items' 			=> 'Procurar trabalhos',
					'not_found' 			=> 'Nenhum trabalho encontrado',
					'not_found_in_trash' 	=> 'Nenhum trabalho encontrado na lixeira',
					'menu_name' 			=> 'Portfolio'
		);

	$args = array(
					'labels' => $labels,
					'public'	=> true,
					'menu_position' => 5,
					'menu_icon' => get_admin_url(). '/images/media-button-other.gif',
					'supports' => array('title','editor','thumbnail','excerpt','custom-fields'),
					'has_archive' => true // importante utilizar  : através do item do t emplate chamado archive.php voce vai conseguir mostrar seu custom post type
		);

	register_post_type('portfolio', $args);

}



add_action('init','ex_custom_portfolio');

