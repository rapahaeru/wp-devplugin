<?php
/**
 * Plugin Name: Exemplos nivel 1
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Este plugin é apenas um exemplo do nivel 1 do curso de criação de plugins
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */

// FILTERS ///////////////////////////////////////

function exTitle($content) {

	return ucwords($content);
}

//add_filter(NOME_DO_FILTER, NOME_DA_FUNCAO);
add_filter('the_title','exTitle');

function exContent($content) {

	return $content . "<p> Este post expressa a opiniao do autor sobre o assunto </p>";
}

//add_filter(NOME_DO_FILTER, NOME_DA_FUNCAO);
add_filter('the_content','exContent');



// ACTIONS ///////////////////////////////////////

function exAddFooter(){
	echo "Texto inserido no rodapé do WP";
}

add_action ('wp_footer', 'exAddFooter');


function exNotifyAdm(){
	$email_adm = get_bloginfo('admin_email');
	wp_mail($email_adm,'Novo comentario no blog','Um novo comentário foi postado no blog, verifique o painel administrativo');
}

add_action('comment_post','exNotifyAdm');