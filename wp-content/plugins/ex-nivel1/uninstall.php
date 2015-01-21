<?php
//se nao foi uma chamada do WP, sai da execução
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();


// AREA ONDE SERAO INSERIDOS AS FUNCOES QUE ACHAR //////////////////
// NECESSARIO NO MOMENTO DA DESINSTALACAO///////////////////////////

// $option_name = 'plugin_option_name';

// delete_option( $option_name );

// // For site options in multisite
// delete_site_option( $option_name );  

// //drop a custom db table
// global $wpdb;
// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );

//note in multisite looping through blogs to delete options on each blog does not scale. You'll just have to leave them.