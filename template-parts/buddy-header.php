<?php
if ( in_array( 'messages', array_keys( buddypress()->loaded_components ) ) ) {
	$message_link = trailingslashit( bp_loggedin_user_domain() . bp_get_messages_slug() );
	$unread_message_count = messages_get_unread_count();
	$messages_component = 'active';
} else {
	$messages_component = 'false';
}

if ( in_array( 'notifications', array_keys( buddypress()->loaded_components ) ) ) {
	$notification_link = trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() );
	$notifications = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
	$unread_notification_count = ! empty( $notifications ) ? $notifications : 0;
	$notifications_component = 'active';
} else {
	$notifications_component = 'false';
}
?>


    <div class="buddypress-header">
        <div class="buddy-header-search"><?php get_search_form(); ?></div>
        <div id="buddy-search" class="buddy-head-popouts">
            <a href="#" class="buddy-search">
				<?php echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/svg/buddyboss/search.svg' . '" class="bbnavmenu header-notifications"></a>'; ?>
            </a>
        </div>
		<?php if ( 'active' === $messages_component ) { ?>
            <div id="buddy-messages" class="buddy-head-popouts">
				<?php
				echo '<a href="' . $message_link . '" class="buddy-messages"><img src="' . get_stylesheet_directory_uri() . '/assets/images/svg/buddyboss/messages.svg' . '" class="bbnavmenu header-messages" alt="messages"></a>';
				?>

				<?php if ( $unread_message_count > 0 ) { ?>
                    <span class="count"><?php echo $unread_message_count; ?></span>
				<?php } ?>
            </div>
			<?php
		}
		if ( 'active' === $notifications_component ) {
			?>
            <div id="buddy-notifications" class="buddy-head-popouts">
				<?php
				echo '<a href="' . $notification_link . '" class="buddy-notifications">
			<img src="' . get_stylesheet_directory_uri() . '/assets/images/svg/buddyboss/notifications.svg' . '" class="bbnavmenu header-notifications"></a>';
				if ( $unread_notification_count > 0 ) {
					?>
                    <span class="count"><?php echo $unread_notification_count; ?></span>
				<?php } ?>
            </div>
		<?php } ?>
    </div>
<?php
