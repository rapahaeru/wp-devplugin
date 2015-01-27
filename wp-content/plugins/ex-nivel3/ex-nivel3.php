<?php
/**
 * Plugin Name: Exemplos nivel 3
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Este plugin é apenas um exemplo do nivel 3 do curso de criação de plugins
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */


// função extendida nativa para widgets
class Exemplo extends WP_Widget{

	function __construct(){
		$params = array(
			'description' 	=> 'Apenas um exemplo de criação de widgets',
			'name'			=> 'Exemplo nível 3'
		);

		parent::__construct('Exemplo','',$params);

	}

	// responsável por montar os formularios dos widgets
	// aparece no Admin
	function form(){

		echo "exemplo de exibição do form()";

	}

	// output do widget
	// onde será mostrado no blog seu widget
	// aparece no blog
	function widget(){

		echo "exemplo de exibição do widget()";

	}

}

// informa o WP que foi criado um widget e quero utilizar no blog
function exRegister(){
	register_widget('Exemplo');

}

add_action('widgets_init','exRegister');