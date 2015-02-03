<?php
/**
 * Plugin Name: Exemplos nivel 4
 * Plugin URI: http://link.onde.seu.plugin.esta.hospedado
 * Description: Este plugin (cron) é apenas um exemplo do nivel 4 do curso de criação de plugins
 * Version: 1.0
 * Author: rapahaeru
 * Author URI: http://github.com/rapahaeru
 */


// como boas praticas, apagar os agendamentos na desinstalação do plugin.
// pode-se tb usar o hook de ativacao e desativacao, porém toda vez que o plugin ativar ou for desativado,
// rodará essa rotina.


// verifica agendamento
function ex_verify_cron(){


	// recebe o time do hook ('rb_cron_hook') registrado anteriormente
	$next_exec = wp_next_scheduled('rb_cron_hook');
	//desagendar, remover um agendamento
	wp_unschedule_event($next_exec,'rb_cron_hook');

	// se nao ha evento agendado no rb_cron_hook
	if (!wp_next_scheduled('rb_cron_hook')):
		// agendar agora com recorrencia de hora e chamando o rb_cron_hook
		//wp_schedule_event(time(),'two-minutes','rb_cron_hook');
		
		// dispara uma unica vez
		//wp_schedule_single_event(time()+3600,'rb_cron_hook'); // deṕois de 1 minuto 
	endif;
}

add_action('init','ex_verify_cron');

function ex_notifyAdm(){

	$email_adm = get_bloginfo('admin_email');
	wp_mail($email_adm,'Execução de evento agendado','Um agendamento simples foi executado agora');
}

add_action('rb_cron_hook','ex_notifyAdm');

function ex_intervals($schedules){

	$schedules['two-minutes'] = array(
			'interval' => 120, //(segundos)
			'display' => 'A cada dois minutos', //nome do agendamento
		);

	return $schedules;

}


add_filter('cron_schedules','ex_intervals');

function ex_menuAdm(){
	add_options_page( 'RB_cron', 'RB Cron', 'administrator', 'rb-cron', 'ex_EventList');
}
add_action('admin_menu','ex_menuAdm');

function ex_EventList(){
	$cron = _get_cron_array(); // funcao nativa do WP que trás todos os agendamentos
	?>
	<div class="wrap">
		<h2>Eventos agendados no blog</h2>
		<?php 
			foreach ($cron as $time => $hook) {
				echo "<h3>".date('d/m/Y H:i') ."</h3>";
				var_dump($hook);
			}

		?>
	
	</div>
	<?
}