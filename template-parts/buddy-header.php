<?php
$notification_link = trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() );
$message_link      = trailingslashit( bp_loggedin_user_domain() . bp_get_messages_slug() );
$notifications     = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
//$unread_notification_count = ! empty( $notifications ) ? $notifications : 0;
//$unread_message_count = messages_get_unread_count();
$unread_notification_count = 3;
$unread_message_count      = 2;
?>


    <div class="buddypress-header">
        <div id="buddy-search" class="buddy-head-popouts">
            <a href="#" class="buddy-search">
                <svg class="nhsuk-icon nhsuk-icon-buddy-search header-search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
                </svg>
            </a>
            <div class="buddy-header-search"><?php get_search_form(); ?></div>
        </div>
        <div id="buddy-messages" class="buddy-head-popouts">
			<?php
			echo '<a href="#" class="buddy-messages"><img src="' . get_template_directory_uri() . '/assets/images/svg/buddyboss/messages.svg' . '" class="bbnavmenu header-messages" alt="messages"></a>';
			?>

			<?php if ( $unread_message_count > 0 ): ?>
                <span class="header-count"><?php echo $unread_message_count; ?></span>
			<?php endif; ?>
            <div class="bottom">
                <a href="<?php echo $message_link ?>" class="delete-all">
					<?php _e( 'View Inbox', 'nightingale' ); ?>
                    <i class="bb-icon-angle-right"></i>
                </a>
                <i></i>
            </div>
        </div>
        <div id="buddy-notifications" class="buddy-head-popouts">
			<?php
			echo '<a href="#" class="buddy-notifications">
			<img src="' . get_template_directory_uri() . '/assets/images/svg/buddyboss/notifications.svg' . '" class="bbnavmenu header-notifications"></a>';
			if ( $unread_notification_count > 0 ):
				?>
                <span class="header-count"><?php echo $unread_notification_count; ?></span>
			<?php endif; ?>
            <div class="bottom">
                <a href="<?php echo $notification_link ?>" class="delete-all">
					<?php _e( 'View Notifications', 'nightingale' ); ?>
                    <i class="bb-icon-angle-right"></i>
                </a>
                <i></i>
            </div>
        </div>
    </div>
<?php
