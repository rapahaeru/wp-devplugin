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
	// recebe 1 paremetro
	function form($instance){
		//var_dump($instance);
		extract($instance); ?>

		<p>
			<label for="">Titulo :</label>
			<input type="text" class="widefat" id="<?=$this->get_field_id('title')?>" name="<?=$this->get_field_name('title')?>" value="<? if( isset($title)) echo esc_attr($title)?>">
		</p>

		<p>
			<label for="">Descrição :</label>
			<textarea type="text" class="widefat" id="<?=$this->get_field_id('desc')?>" name="<?=$this->get_field_name('desc')?>"><? if( isset($desc)) echo esc_attr($desc)?></textarea>	
		</p>		

		<?php

		//echo "exemplo de exibição do form()";

	}

	// output do widget
	// onde será mostrado no blog seu widget
	// aparece no blog
	// recebe 2 parametros
	function widget($args, $instance){
		//var_dump($args);
		//var_dump($instance);
		//echo "exemplo de exibição do widget()";
		extract($args);
		extract($instance);
		if (empty($title)) $title = "Título padrão";
		echo $before_widget;
			echo $before_title . $title . $after_title;
			echo "<p>" . $desc . "</p>";
		echo $after_widget;


	}

}

// informa o WP que foi criado um widget e quero utilizar no blog
function exRegister(){
	register_widget('Exemplo');

}

add_action('widgets_init','exRegister');