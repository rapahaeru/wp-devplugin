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
function exTwitter($atributes){
	if (!isset($atributes['user']) || $atributes['user'] == "")
		$atributes['user'] = 'contapadrao';
	
	return "<p> <a href='http://twitter.com/".$atributes['user']."'> Siga-me no Twitter </a> </p>";
}


// Primeiro parametro é o texto do post a ser substituido
// segundo parametro é a função que fará o efeito de substituição
add_shortcode('twitter','exTwitter');

