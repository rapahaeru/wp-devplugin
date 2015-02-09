<?php
/**
 * Plugin Name: Otimizador
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Remove lixo e otimiza banco de dados  do WP
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */


add_action('admin_menu','makeMenu'); // orientado ('nome da classe', 'nome do metodo')


// gera os menus no painel WP
function makeMenu(){
	// adicionando uma página de opções
	//add_options_page('Titulo', 'nome do item nosubmenu', 'permissao de usuario','slug (seo name pra url)','funcao')
	add_options_page('Otimizar banco de dados', 'Otimizar BD','administrator','rb-otimizador', 'telaAdm'); 


}

// funcoa que gera tela de config para o adm do site
function telaAdm(){

	if ( isset($_POST['save_config']) && $_POST['save_config']=='confirm' ):
		// utilizar um prefixo aqui para nao haver problema de conflito com outros plugins ativos
		// no caso, fora utilizado o prefixo rb_ mais o name do campo 
		update_option('rb_post_revisao',(isset($_POST['post_revisao']) ? 1 : 0) );
		update_option('rb_post_autodraft',(isset($_POST['post_autodraft']) ? 1 : 0) );
		update_option('rb_com_agent',(isset($_POST['com_agent']) ? 1 : 0) );
		update_option('rb_com_akismet',(isset($_POST['com_akismet']) ? 1 : 0) );
		update_option('rb_com_metamorfo',(isset($_POST['com_metamorfo']) ? 1 : 0) );
		update_option('rb_com_lixo',(isset($_POST['com_lixo']) ? 1 : 0) );
		update_option('rb_geral_cache',(isset($_POST['geral_cache']) ? 1 : 0) );
		update_option('rb_geral_otimizar',(isset($_POST['geral_otimizar']) ? 1 : 0) );
		$warning = '<div class="updated"><p><strong>Suas configurações foram salvas com sucesso!</strong></p></div>';

	endif;

	?>


	<div class="wrap">
		<?php if ( isset($warning) ) echo $warning; ?>

		<form method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
			<h2>Limpeza do BD</h2>
			<table class="form-table" >
				<tr valign="top">
					<th scope="row"><label for="">Posts</label></th>
					<td>
						<input type="checkbox" <?php if (get_option('rb_post_revisao')==1) echo "checked=checked"; ?> name="post_revisao" value="1">
						Exlcuir revisão de posts
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"></th>
					<td>
						<input type="checkbox" <?php if (get_option('rb_post_autodraft')==1) echo "checked=checked"; ?> name="post_autodraft" value="1"> <!-- Rascunhos automatico do WP (sao criados de tempos em tempos e deixa pesado o BD) -->
						Exlcuir rascunhos criados automaticamente
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="">Comentários</label></th>
					<td>
						<input type="checkbox" <?php if (get_option('rb_com_agent')==1) echo "checked=checked"; ?> name="com_agent" value="1"> <!-- Sistema operacional da pessoa (que comenta), browser da pessoa e etc... -->
						Exlcuir o agent dos comentarios
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"></th>
					<td>
						<input type="checkbox" <?php if (get_option('rb_com_akismet')==1) echo "checked=checked"; ?> name="com_akismet" value="1"> <!-- plugin antispam - excluir alguns dados que o akistmet gera pra cada comentario -->
						Exlcuir o comment meta do akismet
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"></th>
					<td>
						<input type="checkbox" <?php if (get_option('rb_com_metamorfo')==1) echo "checked=checked"; ?> name="com_metamorfo" value="1"> <!-- o comentario tem algumas informaações que são linkadas, que tem a tabela : comments e a comments_meta, esses dados sao linkados uns com os outros e as vezes quando voce deleta um comentario, os metadados permanecem -->
						Exlcuir metadados órfãos de comentários
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"></th>
					<td>
						<input type="checkbox" <?php if (get_option('rb_com_lixo')==1) echo "checked=checked"; ?> name="com_lixo" value="1"> 
						Deletar comentários da lixeira
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="">Cache</label></th>
					<td>
						<input type="checkbox" <?php if (get_option('rb_geral_cache')==1) echo "checked=checked"; ?> name="geral_cache" value="1">
						Exlcuir caches do WP e plugins/ temas
					</td>
				</tr>				
			</table>

			<h2>Otimização do banco de dados</h2>
			<table class="form-table" >
				<tr valign="top">
					<th scope="row"><label for="">Geral</label></th>
					<td>
						<input type="checkbox" <?php if (get_option('rb_geral_otimizar')==1) echo "checked=checked"; ?> name="geral_otimizar" value="1">
						Otimizar todas as tabelas do banco de dados
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




