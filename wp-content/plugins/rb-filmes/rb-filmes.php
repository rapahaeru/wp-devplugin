<?php
/**
 * Plugin Name: IMPORTANTE : Rb Filmes
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Habilita seu blog para publicação de filmes
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */

define('PATH_PLUGIN', WP_PLUGIN_URL.'/rb-filmes/');

function loadcss(){
	wp_register_style('filmes',PATH_PLUGIN.'css/filmes.css'); // registra o restilo
	wp_enqueue_style('filmes'); //carrega o estilo efetivamente ( precisa que seja registrada antes)
}

add_action('wp_enqueue_scripts','loadcss'); // chama tanto scripts quanto estilos para ser carregado

//funcao criada para automatizar a atualização dos links permanentes
// explicacao : sempre que ativar o plugin, o usuario tem a necessidade de ir em configuracoes >> links permanentes
// e salvar novamente, para que o WP se adapte as novas querys customizadas.
// Esta função automatiza o processo para que o usuário não tenha essa necessidade
function rb_ativacao(){

	rb_custom_filmes();
	rb_custom_estudios();
	rb_custom_generos();
	flush_rewrite_rules();

}

register_activation_hook(__FILE__,'rb_ativacao');

function rb_custom_filmes(){
	
	//labels padrão disponivel no codex do register_post_types
	$labels = array(
					'name' 					=> 'Filmes',
					'singular_name' 		=> 'Filme',
					'add_new_item' 			=> 'Adicionar filme',
					'edit_item' 			=> 'Editar filme',
					'new_item' 				=> 'Adicionar filme',
					'all_items' 			=> 'Todos os filmes',
					'view_item' 			=> 'Ver filmes',
					'search_items' 			=> 'Procurar filmes',
					'not_found' 			=> 'Nenhum filme encontrado',
					'not_found_in_trash' 	=> 'Nenhum filme encontrado na lixeira',
					'menu_name' 			=> 'Filmes'
		);

	$args = array(
					'labels' => $labels,
					'public'	=> true,
					//'menu_position' => 5,
					//'menu_icon' => get_admin_url(). '/images/media-button-other.gif',
					'supports' => array('title','editor','thumbnail','excerpt','custom-fields'),
					'has_archive' => true // importante utilizar  : através do item do t emplate chamado archive.php voce vai conseguir mostrar seu custom post type
		);

	register_post_type('filme', $args);

}



add_action('init','rb_custom_filmes');


function rb_custom_estudios(){
	
	//labels padrão disponivel no codex do register_post_types
	$labels = array(
					'name' 					=> 'Estudio',
					'singular_name' 		=> 'Estudio',
					'add_new_item' 			=> 'Adicionar estudio',
					'edit_item' 			=> 'Editar estudio',
					'new_item_name'			=> 'Adicionar estudio',
					'all_items' 			=> 'Todos os estudios',
					'update_item' 			=> 'Atualizar estudio',
					'menu_name' 			=> 'Estudios'
		);

	$args = array(
					'labels' => $labels,
					//'public'	=> true,
					'hierarchical' => true,
					'rewrite'  => array('slug' => 'filmes/estudio')
		);

	//pode adicionar em que posts as categorias serão disponibilizadas, caso sejam os posts
	// de blogs normais, basta adicionar "post", porém como é do exemplo,
	// adicionaremos 'portfolio' (register post type registrada acima)
	register_taxonomy('estudio',array('filme'), $args); 
	//register_taxonomy('setor',array('post'), $args); 

}

add_action('init','rb_custom_estudios');

function rb_custom_generos(){
	
	//labels padrão disponivel no codex do register_post_types
	$labels = array(
					'name' 					=> 'Gênero',
					'singular_name' 		=> 'Gênero',
					'add_new_item' 			=> 'Adicionar gênero',
					'edit_item' 			=> 'Editar gênero',
					'new_item_name'			=> 'Adicionar gênero',
					'all_items' 			=> 'Todos os gêneros',
					'update_item' 			=> 'Atualizar gênero',
					'menu_name' 			=> 'Gêneros'
		);

	$args = array(
					'labels' => $labels,
					//'public'	=> true,
					'hierarchical' => true,
					'rewrite'  => array('slug' => 'filmes/genero')
		);

	//pode adicionar em que posts as categorias serão disponibilizadas, caso sejam os posts
	// de blogs normais, basta adicionar "post", porém como é do exemplo,
	// adicionaremos 'portfolio' (register post type registrada acima)
	register_taxonomy('genero',array('filme'), $args); 
	//register_taxonomy('setor',array('post'), $args); 

}


add_action('init','rb_custom_generos');



function rb_custom_to_query($query){

	if (is_admin()) return $query;

	if ($query->is_main_query()): 
	//if ($query->is_main_query() && !$query->is_home()): 	// não mostra na home
		$query->set('post_type',array('post','page','filme')); // portfolio registrado acima.
	endif;

	return $query;

}

add_action('pre_get_posts','rb_custom_to_query');


