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
		add_shortcode('premium', array('rb_funcoes','restrito_sc'));
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


	// cria o shortcode para gerenciar o acesso ao conteudo premium

	public static function restrito_sc($atts, $content){
		extract(shortcode_atts(array(
			'valor' => VALOR_PADRAO,
			'desconto'  => DESCONTO_PADRAO
		), $atts));

		if(is_feed()) return MSG_FEED;
		if(!is_single()) return MSG_SINGLE;
		if(is_user_logged_in()):
			//está logado
			$idusuario = get_current_user_id();
			$idautor = get_the_author_meta('ID');

			if ($idusuario == $idautor || current_user_can('administrator') ) {
				return do_shortcode($content);
				# code...
			}else{
				// regras de restricao
				$pedido = rb_funcoes::consulta_ped();
				if ($pedido != NULL) {
					var_dump($pedido);
				}else{
					echo "Tela compra";

				}
				
				// se nao existir mostrar tela de compra do post
				// se existir verificar se esta pago
				// Se estiver, liberar o conteudo, senao mostrar tela de pagto

			}

		else:
			//nao esta logado
			return MSG_DESLOGADO;
		endif;


	}

	//consulta um pedido no banco com base no usuario e post atuais
	public static function consulta_ped(){
		if (!is_single()) return NULL;
		if (!is_user_logged_in()) return NULL;
		global $post;

		$idusuario = get_current_user_id();
		$idpost = $post->ID;

		//$wpdb->get_row() :: pega apenas UMA linha no banco
		//$wpdb->prepare() :: prepara e formata o banco contra invasoes, como o PDO
		//%d :: Campo numerico, no caso inteiro - consultar s_printf do php
		//%s :: string, textos
		$resultado = rb_funcoes::$wpdb->get_row(rb_funcoes::$wpdb->prepare("SELECT * FROM ".rb_funcoes::$wpdb->prefix."rbpremium WHERE id_usuario=%d AND id_post=%d", $idusuario, $idpost));

		return $resultado;
	}

}
