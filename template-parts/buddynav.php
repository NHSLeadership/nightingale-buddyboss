<?php
/**
 * Template part for displaying BuddyBoss Navigation components
 *
 * @link      https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.1 21st August 2019
 */
$buddy_menu_item   = array();
if ( !is_user_logged_in() ) {
	$buddy_menu_item[] = array( 'url' => '/wp-login.php', 'title' => 'Login' );
	$buddy_menu_item[] = array( 'url' => '/register', 'title' => 'Register' );
	$buddy_menu_item[] = array( 'url' => '/wp-login.php?action=lostpassword', 'title' => 'Lost your password?' );
	$url_prefix = '';
} else {

	$current_url = $actual_link = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$buddy_menu_item[] = array( 'url' => 'profile/', 'title' => 'Profile' );
	$buddy_menu_item[] = array( 'url' => 'settings/', 'title' => 'Account' );
	$buddy_menu_item[] = array( 'url' => 'activity', 'title' => 'Timeline' );
	$buddy_menu_item[] = array( 'url' => 'notifications/', 'title' => 'Notifications' );
	$buddy_menu_item[] = array( 'url' => 'messages/', 'title' => 'Messages' );
	$buddy_menu_item[] = array( 'url' => 'friends/', 'title' => 'Connections' );
	$buddy_menu_item[] = array( 'url' => 'groups/', 'title' => 'Groups' );
	$buddy_menu_item[] = array( 'url' => 'guides/', 'title' => 'Courses' );
	$buddy_menu_item[] = array( 'url' => 'forums/', 'title' => 'Forums' );
	$buddy_menu_item[] = array( 'url' => 'photos/', 'title' => 'Photos' );
	$buddy_menu_item[] = array( 'url' => 'invites/', 'title' => 'Email Invites' );
	$url_prefix = '/members/' . wp_get_current_user()->user_login . '/';
}
?>
<div class="nhsuk-full-width-container">
	<div class="nhsuk-bordered-tabs-container-footer">
		<div class="nhsuk-width-container">
			<ul class="nhsuk-bordered-tabs">
	<?php

	foreach ( $buddy_menu_item as $nav_item ) {
	if ( strpos( $current_url, $nav_item['url'] ) !== false ) {
		$activelink = ' nhsuk-bordered-tabs-item-active';
	} else {
		$activelink = '';
	}
		echo '<li class="nhsuk-bordered-tabs-item' . $activelink . '"><a class="nhsuk-bordered-tabs-link" href="' . esc_url( $url_prefix . $nav_item['url'] ) . '">' . esc_html( $nav_item['title'] ) . '</a></li>';

	}
	// below div is a horrible hacky workaround to stop safari from jumping links all over the show on hover. As and when upstream library gets fixed, this div can come out.
	?>
			</ul>
		</div>
	</div>
</div>
