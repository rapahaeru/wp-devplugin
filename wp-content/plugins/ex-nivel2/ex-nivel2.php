<?php
/**
 * Plugin Name: Exemplos nivel 2
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Este plugin é apenas um exemplo do nivel 2 do curso de criação de plugins
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */

// sempre utilize em um shortcode o item "return" ao inves de "echo".
function exTwitter($atributes, $content){
	if (!isset($atributes['user']) || $atributes['user'] == "") $atributes['user'] = 'contapadrao';
	if (!isset($content) || $content == "") $content = 'Siga-me no Twitter';
	// if (!isset($atributes['txt']) || $atributes['txt'] == "") $atributes['txt'] = 'Siga-me no Twitter';

	// $atributes = shortcode_atts(array(
	// 		'user' => 'contapadrao',
	// 		'content' => !empty($content) ? $content : 'Siga-me no Twitter',
	// 	),$atributes);

	//var_dump($atributes);

	//extract($atributes);// exporta as variáveis do array

	
	return "<p> <a href='http://twitter.com/".$atributes['user']."'> ".$content." </a> </p>";
}


// Primeiro parametro é o texto do post a ser substituido
// segundo parametro é a função que fará o efeito de substituição
add_shortcode('twitter','exTwitter');

