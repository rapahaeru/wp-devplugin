<?php
/**
 * Plugin Name: Publicidade
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Exibe anúncios nos posts e na sidebar conforme configuração previamente denifinida
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */

define('PATH_PLUGIN', WP_PLUGIN_URL.'/publicidade/');

//add_action('widgets_init','exRegister'); procedural
add_action('widgets_init', array('Publicidade', 'register')); // orientado ('nome da classe', 'nome do metodo')
// chama tanto scripts quanto estilos para ser carregado
//add_action('wp_enqueue_scripts','loadcss'); 

// chama tanto scripts quanto estilos para ser carregado
add_action('wp_enqueue_scripts', array('Publicidade','loadcss')); // orientado ('nome da classe', 'nome do metodo')
add_action('admin_menu',array('Publicidade','makeMenu')); // orientado ('nome da classe', 'nome do metodo')
add_filter('the_content', array('Publicidade','adPost'));

// função extendida nativa para widgets
class Publicidade extends WP_Widget{

	function __construct(){
		$params = array(
			'description' 	=> 'Exibe a anuncios dos autores ou administradores do site',
			'name'			=> 'Publicidade'
		);

		parent::__construct('Publicidade','',$params);

	}

	// responsável por montar os formularios dos widgets
	// form de configuracao do widget
	// recebe 1 paremetro
	function form($instance){
		//var_dump($instance);
		extract($instance); ?>

		<p>
			<label for="">Titulo :</label>
			<input type="text" class="widefat" id="<?=$this->get_field_id('title')?>" name="<?=$this->get_field_name('title')?>" value="<? if( isset($title)) echo esc_attr($title)?>">
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

		if(rb_printAds('rb_ad_sidebar')!=false):

			if (empty($title)) $title = "Publicidade";
			echo $before_widget;
				echo $before_title . $title . $after_title;
				echo "<div class='ad-sidebar'> ".rb_printAds('rb_ad_sidebar')." </div>";
			echo $after_widget;

			endif;


	}

	//exibe o anuncio antes do conteudo do post
	function adPost($content){

		if (!is_single() || rb_printAds('rb_ad_posts')==false) return $content;

		return '<div class="ad-posts">' . rb_printAds('rb_ad_posts') . '</div>' . $content ;
	}

	// informa o WP que foi criado um widget e quero utilizar no blog
	function register(){	
		register_widget('Publicidade');

	}

	//Carrega o estilo
	function loadcss(){
		wp_register_style('publicidade',PATH_PLUGIN.'css/publicidade.css'); // registra o restilo
		wp_enqueue_style('publicidade'); //carrega o estilo efetivamente ( precisa que seja registrada antes)
	}

	// gera os menus no painel WP
	function makeMenu(){
		// adicionando uma página de opções
		//add_options_page('Titulo', 'nome do item nosubmenu', 'permissao de usuario','slug (seo name pra url)','funcao')
		add_options_page('Publicidade Global', 'Publicidade','manage_options','publicidade', array('Publicidade','configAdm')); 
		add_users_page('minha publicidade', 'Meus anúncios','publish_posts','anuncios', array('Publicidade','configUser')); 


	}

	// funcoa que gera tela de config para o adm do site
	function configAdm(){

		if ( isset($_POST['save_config']) && $_POST['save_config']=='confirm' ):
			// utilizar um prefixo aqui para nao haver problema de conflito com outros plugins ativos
			// no caso, fora utilizado o prefixo rb_ mais o name do campo ad_posts
			update_option('rb_ad_posts',$_POST['ad_posts']);
			update_option('rb_ad_sidebar',$_POST['ad_sidebar']);
			$warning = '<div class="updated"><p><strong>Suas configurações foram salvas com sucesso!</strong></p></div>';
		endif;

		?>


		<div class="wrap">
			<?php if ( isset($warning) ) echo $warning; ?>

			<h2>Configuração global de publicidade</h2>
			<form method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
				<h3>Configure seus anúncios abaixo</h3>
				<table class="form-table" >
					<tr valign="top">
						<th scope="row"><label for="">Anúncio de 300x250 exibido nos posts</label></th>
						<td>
							<textarea name="ad_posts" id="" cols="100" rows="5"><?=get_option('rb_ad_posts')?></textarea>
							<p class="description">Insira o código de um banner de 300x250 pixels que será exibido junto ao conteúdo de cada post</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="">Anúncio de 250x250 exibido na sidebar</label></th>
						<td>
							<textarea name="ad_sidebar" id="" cols="100" rows="5"><?=get_option('rb_ad_sidebar')?></textarea>
							<p class="description">Insira o código de um banner de 300x250 pixels que será exibido na sidebar do blog</p>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="submit" value="Salvar configurações" class="button-primary" name="salvar">
					<input type="hidden" value="confirm" name="save_config" >
				</p>
			</form>
		</div>

		<?php
	}

	// funcoa que gera tela de config para os autores
	function configUser(){

		$userId = get_current_user_id(); // pega o id do usuario logado no painel
		if ( isset($_POST['save_config']) && $_POST['save_config']=='confirm' ):
			// utilizar um prefixo aqui para nao haver problema de conflito com outros plugins ativos
			// no caso, fora utilizado o prefixo rb_ mais o name do campo ad_posts
			update_user_meta($userId, 'rb_ad_posts',$_POST['ad_posts']);
			update_user_meta($userId, 'rb_ad_sidebar',$_POST['ad_sidebar']);


			$warning = '<div class="updated"><p><strong>Suas configurações foram salvas com sucesso!</strong></p></div>';
		endif;

		?>


		<div class="wrap">
			<?php if ( isset($warning) ) echo $warning; ?>
			<h2>Configuração de publicidade</h2>
			<form method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
				<h3>Configure seus anúncios abaixo</h3>
				<table class="form-table" >
					<tr valign="top">
						<th scope="row"><label for="">Anúncio de 300x250 exibido nos posts</label></th>
						<td>
							<textarea name="ad_posts" id="" cols="100" rows="5"><?=get_user_meta($userId,'rb_ad_posts',TRUE)?></textarea>
							<p class="description">Insira o código de um banner de 300x250 pixels que será exibido junto ao conteúdo de cada post</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="">Anúncio de 250x250 exibido na sidebar</label></th>
						<td>
							<textarea name="ad_sidebar" id="" cols="100" rows="5"><?=get_user_meta($userId,'rb_ad_sidebar',TRUE)?></textarea>
							<p class="description">Insira o código de um banner de 300x250 pixels que será exibido na sidebar do blog</p>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="submit" value="Salvar configurações" class="button-primary" name="salvar">
					<input type="hidden" value="confirm" name="save_config" >
				</p>
			</form>
		</div>

		<?php
	}	

}

function rb_printAds($name='rb_ad_posts'){

	$adAuthor = get_the_author_meta($name);
	$adAdmin = get_option($name);

	if(is_single()): // post

		if ($adAuthor):
			return stripslashes($adAuthor);
		else:
			if($adAdmin):
				return stripslashes($adAdmin);
			else:
				return false;
			endif;

		endif;	
	
	else:

		if($adAdmin):
			return stripslashes($adAdmin);
		else:
			return false;
		endif;

	endif;

}


