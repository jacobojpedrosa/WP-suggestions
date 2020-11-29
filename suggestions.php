<?php 
/*
Plugin Name: WP suggestions
Plugin URI: https://noituk.com
Description: Simply suggestions plugin
Version: 0.0
Author:Jacobo Pedrosa
Author URI:https://jacobopedrosa.com
License:GPL2
Text Domain: suggestions
*/


/*
El primer Shortcode/bloque consiste en un formulario (no usar ningún plugin para esto) que recoja los siguientes datos:
Nombre, Apellido, email, y sugerencias y un botón de submit.
Si el usuario está logueado, el nombre, apellidos e email serán autorellenados.
Submit se hará a través de una llamada AJAX.
Una vez enviado, si todo ha ido bien, será reemplazado por un "Gracias por su sugerencia"
La información será guardada en la BBDD, y queda a elección si como CPT o una tabla custom.

*/
defined('ABSPATH') or die('Error');


/*
On Activate: Se crea la tabla en db
*/
function suggestions_activate(){
	global $wpdb;
	$table_name = $wpdb->prefix . "suggestions";
	$suggestions_db_version = '0.0.0';
	$charset_collate = $wpdb->get_charset_collate();

	if ( $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name ) {

		$sql = 'CREATE TABLE '.$table_name.' (
	    	ID mediumint(9) NOT NULL AUTO_INCREMENT ,
	        `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	        `name` VARCHAR(256) NULL,
	        `lastname` VARCHAR(256) NULL,
	        `mail` VARCHAR(256) NOT NULL,
	        `suggestion` text NOT NULL,
	        PRIMARY KEY (id) 
	    );';

	    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	    dbDelta($sql);
	    add_option('my_db_version', $suggestions_db_version);
	}



}
register_activation_hook(__FILE__,'suggestions_activate');


/** SHORTCODES **/

/** Shortcode1: [render_suggestions_form] **/
function render_suggestions_form(){
	$user = wp_get_current_user(); 
	$user_data = get_userdata($user->id);
	include( plugin_dir_path( __FILE__ ) . 'public/form.php');
}
add_shortcode('suggestion_form' , 'render_suggestions_form');

/** Shortcode2: [render_suggestions_list] **/
function render_suggestions_list(){
	global $wpdb; 
	if(current_user_can('administrator')){
		$sql = 'SELECT * FROM '.$wpdb->prefix . 'suggestions'.' ORDER BY created DESC';
		$results = $wpdb->get_results($sql);
		include( plugin_dir_path( __FILE__ ) . 'public/list.php');
	}else{
		?> <p>No autorizado</p> <?php
	}
}
add_shortcode('suggestions_list' , 'render_suggestions_list');




/** Añadir sugerencia en db **/
function add_suggestion_func($req){
	global $wpdb; 

	$response['name'] = $_POST['name'];
	$response['lastname'] = $_POST['lastname'];
	$response['mail'] = $_POST['mail'];
	$response['suggestion'] = $_POST['suggestion'];

    $res = new WP_REST_Response($response);


    $i = $wpdb->insert($wpdb->prefix . 'suggestions', $response); 
    if($i){
    	$res->set_status(200);
    }else{
    	$res->set_status(418);
    }
    print_r(['req' => $res, 'inset' => $i]);
	
}


wp_enqueue_script( 'ajax-script', plugins_url( '/public/js/suggestions.js', __FILE__ ), array('jquery') );
wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
// add_action( 'wp_ajax_my_action', 'my_action' );

add_action( 'wp_ajax_nopriv_add_suggestion_func', 'add_suggestion_func' );
add_action( 'wp_ajax_add_suggestion_func', 'add_suggestion_func' );


?>