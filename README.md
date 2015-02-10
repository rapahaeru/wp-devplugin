[INTRODUCAO]

Leitura obrigatoria - Documentação do wordpress
doc wp => codex.worpdress.org >> write a plugin ( 3 itens )
instalar wordpress ( limpa em localhost )


<h4>[AULA 01]</h4>

=> Criação da pasta onde será desenvolvido o plugin 

<code>wp-content/plugins/ex-nivel1</code>

=> Inserção do cabeçalho do plugin, sem ele o Wordpress não o reconhece

<code>
/**
 * Plugin Name: Nome do plugin
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Este plugin é apenas um exemplo do nivel 1 do curso de criação de plugins
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */	
</code>

<h4>[AULA 02]</h4>

<p>Criados exemplos de Filtros e Ações</p>
<p>Links para estudo e pesquisa :</p>
<p>http://codex.wordpress.org/Plugin_API/Filter_Reference</p>
<p>http://codex.wordpress.org/Plugin_API/Action_Reference</p>


<h4>[AULA 03]</h4>

<p>Ativação, desativação e desinstalação</p>
<p>Links para estudo e pesquisa :</p>
<p>http://codex.wordpress.org/Plugin_API#Activation.2FDeactivation.2FUninstall</p>

<h4>[AULA 04]</h4>

<p>Desenvolvimento do plugin de posts relacionados</p>
<p>Links para estudo e pesquisa :</p>
<p>http://codex.wordpress.org/Class_Reference/WP_Query</p>

<h4>[AULA 05]</h4>

<p>Shortcodes - atributos</p>
<p>Links para estudo e pesquisa :</p>
<p>http://codex.wordpress.org/Shortcode_API</p>

<h4>[AULA 06]</h4>

<p>Shortcodes - conteudo</p>
<p>Links para estudo e pesquisa :</p>
<p>http://codex.wordpress.org/Shortcode_API</p>

<h4>[AULA 07]</h4>

<p>Shortcodes - Final</p>
<p>Links para estudo e pesquisa :</p>
<p>http://codex.wordpress.org/Function_Reference/wp_register_style</p>
<p>http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts</p>


<h4>[AULA 09]</h4>

<p>Shortcodes - Mais exemplos e uso do banco de dados ($wpdb)</p>
<p>Utilizando também a constante WP_DEBUG (wp-config) com criação de log (WP_DEBUG_LOG)</p>
<p>Debug para ser utilizado em produção</p>
<p>Links para estudo e pesquisa :</p>
<p>http://codex.wordpress.org/Function_Reference/wp_register_style</p>
<p>http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts</p>

<h4>[AULA 10]</h4>

<p>Widgets - introdução as classes</p>
<p>Nessa aula foi introduzido como desenvolver um widget.</p>
<p>Fora criada uma classe que extende a autonomia a classe mãe WP_Widget(),</p>
<p>Nela há uma estrutura básica de métodos contrução do widget</p>
<code>__construct()</code>
<p>Responsável por declarar os conteúdos do widget</p>
<code>form()</code>
<p>Responsável pela esturtura que será exibida no admin, como por ex os inputs que serão adicionados</p>
<code>widget()</code>
<p>Responsável pela parte que será exibida no template ( front do blog)</p>

<h4>[AULA 11]</h4>
<p>Widgets - Form() e widget()</p>

<h4>[AULA 12]</h4>
<p>Widgets - Desenvolvimento</p>
<p>Inicio da implementação de novas áreas no config. Onde serão criados novos itens de menu e campos</p>
<p>Área onde o usuário pode adicionar banners publicitarios globais ( para todo o blog ) ou específico para cada autor</p>
<ul>
	<li>Criação de itens dos menus na área de configuração</li>
	<li>Criação de itens dos menus na área de usuários</li>
</ul>
<p>Links para estudo e pesquisa :</p>
<p>http://codex.wordpress.org/Roles_and_Capabilities</p>
<p>http://codex.wordpress.org/Function_Reference/add_options_page</p>
<p>http://codex.wordpress.org/Function_Reference/add_users_page</p>

<h4>[AULA 13]</h4>
<p>Widgets - Desenvolvimento (Banco de dados)</p>
<ul>
	<li>Inserção no banco de dados dos novos campos</li>
	<li>exibicao no tema do conteudo inserido ( através de widget também )</li>
</ul>
<p>Funções para a área de configurações (option) do painel </p>
<p>http://codex.wordpress.org/Function_Reference/update_option</p>
<p>http://codex.wordpress.org/Function_Reference/get_option</p>
<p>Funções para a área de usuários (user) do painel </p>
<p>http://codex.wordpress.org/Function_Reference/get_user_meta</p>
<p>http://codex.wordpress.org/Function_Reference/update_user_meta</p>

<h4>[AULA 14]</h4>
<p>Programando uma Cron</p>
<p>http://codex.wordpress.org/Function_Reference/wp_cron</p>
<p>http://codex.wordpress.org/Function_Reference/wp_schedule_event</p>
<p>http://codex.wordpress.org/Category:Functions</p>


<h4>[AULA 15]</h4>
<p>Programando uma Cron</p>
<p>
	<ul>
		<li>Agendamento de disparo de emails a cada 2 minutos</li>
		<li>Lista todos os agendamentos ativos (_get_cron_array)</li>
	</ul>
</p>
<p>http://codex.wordpress.org/Function_Reference/wp_schedule_single_event</p>
<p>http://codex.wordpress.org/Function_Reference/add_options_page</p>

<h4>[AULA 16]</h4>
<p>Limpando e otimizando o BD</p>
<p>Será criada uma option para prenchimento das necessidades de otimização do banco</p>


<h4>[AULA 17]</h4>
<p>Limpando e otimizando o BD - construindo queries</p>
<ul>
	<li>wpbd</li>
	<li>$wpdb->get_results()</li>
</ul>
<p>Referências utilizadas na aula</p>
<p>http://codex.wordpress.org/Class_Reference/wpdb</p>
<p>https://wordpress.org/support/topic/filtering-information-with-get_results</p>
