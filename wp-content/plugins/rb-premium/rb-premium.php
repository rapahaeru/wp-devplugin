<?php
/**
 * Plugin Name: IMPORTANTE : Rb Premium
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Possibilita a venda de posts via pagseguro ou paypal
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */


// Inclusao dos arquivos do plugin

date_default_timezone_set('America/Sao_Paulo');

include_once('rb-functions.php');


if ( is_admin() ) include_once('rb-admin.php');	

// Definicao das constantes do sistema

define('PASTA_PLUGIN', WP_PLUGIN_URL.'/rb-premium/');
define('PREFIXO_CONFIG','rbpremium_'); //utilizado para encontrar os dados inseridos, todo conteudo a ser inserido, será com esse prefixo a frente


// Hook de ativacao e desativacao
register_activation_hook(__FILE__,array('rb_funcoes','ativar'));



// Chamada da funcoa de inicializacao do plugin

