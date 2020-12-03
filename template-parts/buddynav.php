<?php
/**
 * Template part for displaying BuddyBoss Navigation components
 *
 * @link      https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 */

$buddy_menu_item = array(); // create empty array of menu links.
$current_url = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if ( ! is_user_logged_in() ) { // if user is not logged in, lets add some basic links for them.
	$buddy_menu_item[0] = array( 'url' => '/wp-login.php', 'title' => 'Login' ); // login page.
	$buddy_menu_item[1] = array( 'url' => '/register', 'title' => 'Register' ); // registration page.
	$buddy_menu_item[2] = array( 'url' => '/wp-login.php?action=lostpassword', 'title' => 'Lost your password?' ); // forgot password page.
	$url_prefix        = '';
} else { // this user is logged in. Lets figure out what links to show them.

	$current_url = $actual_link = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // grab the current url.
	foreach ( array_keys( buddypress()->loaded_components ) as $component_id ) { // get array of active BuddyBoss components, work through one at a time.
		if ( 'profile' === $component_id ) { // if the profile component is active...
			$buddy_menu_item[0] = array( 'url' => 'profile/', 'title' => 'Profile' ); // add profile link.
		} elseif ( 'settings' === $component_id ) { // if settings component is active...
			$buddy_menu_item[1] = array( 'url' => 'settings/', 'title' => 'Account' ); // add settings link.
		} elseif ( 'activity' === $component_id ) { // lather rinse repeat through the array...
			$buddy_menu_item[2] = array( 'url' => 'activity', 'title' => 'Timeline' );
		} elseif ( 'notifications' === $component_id ) {
			$buddy_menu_item[3] = array( 'url' => 'notifications/', 'title' => 'Notifications' );
		} elseif ( 'messages' === $component_id ) {
			$buddy_menu_item[4] = array( 'url' => 'messages/', 'title' => 'Messages' );
		} elseif ( 'friends' === $component_id ) {
			$buddy_menu_item[5] = array( 'url' => 'friends/', 'title' => 'Connections' );
		} elseif ( 'groups' === $component_id ) {
			$buddy_menu_item[6] = array( 'url' => 'groups/', 'title' => 'Groups' );
		} elseif ( 'forums' === $component_id ) {
			$buddy_menu_item[7] = array( 'url' => 'forums/', 'title' => 'Forums' );
		} elseif ( 'photos' === $component_id ) {
			$buddy_menu_item[8] = array( 'url' => 'photos/', 'title' => 'Photos' );
		} elseif ( 'invites' === $component_id ) {
			$buddy_menu_item[9] = array( 'url' => 'invites/', 'title' => 'Email Invites' );
		}
	}
	if ( in_array( 'sfwd-lms/sfwd_lms.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { // if LearnDash installed and active?
		$buddy_menu_item[10] = array( 'url' => 'guides/', 'title' => 'Courses' ); // add in the link to courses. This is not an active BuddyBoss module, so we need to check the LD plugin status.
	}
	$url_prefix = '/members/' . wp_get_current_user()->user_login . '/'; // build the prefix for all urls so the user gets a unique set of links based on their username.
}
?>
<div class="nhsuk-full-width-container">
    <div class="nhsuk-bordered-tabs-container-footer">
        <div class="nhsuk-width-container">
            <p class="nhsuk-header__navigation-title"><a class="label-navigation-buddynav">This Section</a>
                <button class="nhsuk-header__navigation-close close-menu-buddynav">
                    <svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
                    </svg>
                    <span class="nhsuk-u-visually-hidden">Close Menu</span>
                </button>
            </p>
            <ul class="nhsuk-bordered-tabs buddynav-menu">
				<?php

				foreach ( $buddy_menu_item as $nav_item ) { // setp through the array of links we built in lines 10-45
					if ( strpos( $current_url, $nav_item[ 'url' ] ) !== false ) { // if the current link is the current url
						$activelink = ' nhsuk-bordered-tabs-item-active'; // add the active class to the tab.
					} else {
						$activelink = ''; // otherwise, dont.
					}
					echo '<li class="nhsuk-bordered-tabs-item' . $activelink . '"><a class="nhsuk-bordered-tabs-link" href="' . esc_url( $url_prefix . $nav_item[ 'url' ] ) . '">' . esc_html( $nav_item[ 'title' ] ) . '</a></li>';

				}
				?>
            </ul>
        </div>
    </div>
</div>
