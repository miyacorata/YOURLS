<?php

/*
 * This is an example file for a public interface and a bookmarklet. It
 * is provided so you can build from it and customize to suit your needs.
 * It's not really part of the project. Don't submit feature requests
 * about this file. It's _your_ job to make it what you need it to be :)
 *
 * Rename to .php
 *
 */

// Start YOURLS engine
require_once( dirname(__FILE__).'/includes/load-yourls.php' );

// Change this to match the URL of your public interface. Something like: http://your-own-domain-here.com/index.php
$page = YOURLS_SITE . '/sample-public-front-page.php' ;

// Part to be executed if FORM has been submitted
if ( false && isset( $_REQUEST['url'] ) && $_REQUEST['url'] != 'http://' ) {

	// Get parameters -- they will all be sanitized in yourls_add_new_link()
	$url     = $_REQUEST['url'];
	$keyword = isset( $_REQUEST['keyword'] ) ? $_REQUEST['keyword'] : '' ;
	$title   = isset( $_REQUEST['title'] ) ?  $_REQUEST['title'] : '' ;
	$text    = isset( $_REQUEST['text'] ) ?  $_REQUEST['text'] : '' ;

	// Create short URL, receive array $return with various information
	$return  = yourls_add_new_link( $url, $keyword, $title );

	$shorturl = isset( $return['shorturl'] ) ? $return['shorturl'] : '';
	$message  = isset( $return['message'] ) ? $return['message'] : '';
	$title    = isset( $return['title'] ) ? $return['title'] : '';
	$status   = isset( $return['status'] ) ? $return['status'] : '';

	// Stop here if bookmarklet with a JSON callback function ("instant" bookmarklets)
	if( isset( $_GET['jsonp'] ) && $_GET['jsonp'] == 'yourls' ) {
		$short = $return['shorturl'] ? $return['shorturl'] : '';
		$message = "Short URL (Ctrl+C to copy)";
		header('Content-type: application/json');
		echo yourls_apply_filter( 'bookmarklet_jsonp', "yourls_callback({'short_url':'$short','message':'$message'});" );

		die();
	}
}

// Insert <head> markup and all CSS & JS files
yourls_html_head();

// Display title
//echo "<h1>MiyanojiRapid YOURLS</h1>\n";

// Display left hand menu
//yourls_html_menu() ;

?>
<div style="text-align: center;">
    <img src="/images/yourls-logo.svg" style="width: 300px;height:auto;" alt="YOURLS">
    <h2>MiyanojiRapid - YOURLS</h2>
</div>
<?php



// Display page footer
yourls_html_footer();
