<?php

class rb_funcoes {
	public static $wpdb;

	//inicializa o plugin fazendo as verificacoes necessarias
	public static function inicializar(){
		global $wpdb;
		rb_funcoes::$wpdb = $wpdb; 

		// verificar se o plugin foi instalado corretamente

		// receber notificacoes do pagseguro e do paypal

		// adicionar menus de administração

		// adicionar estilos e scripts

		// chamdas pros shortcodes
	}


	// instala o plugin faznedo a criacao da  tabela no banco de dados
	public static function instalar (){

		if (get_option(PREFIXO_CONFIG . 'instalado') != 1):

			if (is_null(rb_funcoes::$wpdb)) rb_funcoes::inicializar();

			//criar tabela no bd
			$sql = "
			CREATE  TABLE `db_curso`.`". rb_funcoes::$wpdb->prefix ."rbpremium` (
			  `id` INT(4) NOT NULL AUTO_INCREMENT ,
			  `id_usuario` INT(4) NULL ,
			  `id_post` INT(4) NULL ,
			  `data_pedido` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
			  `aprovado` TINYINT NULL DEFAULT 0 ,
			  `excluido` TINYINT NULL DEFAULT 0 ,
			  `data_alteracao` TIMESTAMP NULL ,
			  PRIMARY KEY (`id`) ); ";
			
			$executado = rb_funcoes::$wpdb->query($sql);
			if ($executado !== FALSE):
				update_option(PREFIXO_CONFIG. 'instalado', 1);
			endif;

		endif;	

		//salvar uma config informando que o plugin foi instalado
	}

	// executada a ativacao do plugin
	public static function ativar(){
		rb_funcoes::instalar();
		//adicionar agendamentos no wp_cron
	}

}
