<?php
/**
 * Plugin Name: RB posts relacionados
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Exibe os posts relacionados com base na categoria da postagem atualmente exibida
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */

function rbRelated($qtd = 2){
	if (!is_single()) return false; // is_single() referencia quando está num post e não em uma lista de posts
	$idPost = get_the_id();
	$terms = get_the_terms($idPost,'category');
	$categories = array();
	if ($terms)
		foreach ($terms as $cat) {
			$categories[] = $cat->cat_ID;
		}
	else{
		$categories[] = 0;
	}

	$loop = new WP_Query(array(

		'posts_per_page' => $qtd,
		'category__in' => $categories,
		'orderby' => 'rand',
		'post__not_in' => array($idPost)

		));

	$output = '';

	if ($loop->have_posts()){
		$output .= "<h2> Posts relacionados</h2>";
		$output .= "<ul>";
		while ($loop->have_posts()) {
			$loop->the_post();
			$output .= '<li> <a href="'.get_permalink().'" title="'.get_the_title().'"> '.get_the_title().'</a></li>';
		}
		$output .= "</ul>";
	}else{
		$output .= "<h2> Nenhum post relacionado</h2>";
	}

	//var_dump($categories);
	//var_dump($terms);
	
	return $output;

}

function rbRelatedDisplay($content){
	return $content . rbRelated();
}

add_filter('the_content','rbRelatedDisplay');