<?php
/**
 * BuddyPress - Members Notifications Loop
 *
 * @since   3.0.0
 * @version 3.1.0
 */

if ( bp_has_notifications( bp_ajax_querystring( 'notifications' ) ) ) :

	bp_nouveau_pagination( 'top' ); ?>

    <form action="" method="post" id="notifications-bulk-management" class="standard-form" style="display: inline-block;">
        <ul class="nhsuk-card-group">

            <li class="nhsuk-grid-column-full nhsuk-card-group__item controls">
                <div class="nhsuk-card">
                    <div class="nhsuk-card__content">
                        <div class="bulk-select-all nhsuk-checkboxes">
                            <span class="nhsuk-checkboxes__item">
                            <input id="select-all-notifications" type="checkbox" class="nhsuk-checkboxes__input"/>
                            <label class="nhsuk-checkboxes__label" for="select-all-notifications">Select All</label>
                            </span>
                        </div>
                        <div class="notifications-options-nav flex-1">
							<?php bp_nouveau_notifications_bulk_management_dropdown(); ?>
                        </div><!-- .notifications-options-nav -->

						<?php wp_nonce_field( 'notifications_bulk_nonce', 'notifications_bulk_nonce' ); ?>

                        <div class="push-right bb-sort-by-date">
							<?php esc_html_e( 'Sort by date', 'nightingale' ); ?>
							<?php bp_nouveau_notifications_sort_order_links(); ?>
                        </div>
                    </div>
                </div>
            </li>

			<?php

			while ( bp_the_notifications() ) : bp_the_notification();
				$bp           = buddypress();
				$notification = $bp->notifications->query_loop->notification;
				$component    = $notification->component_name;

				switch ( $component ) {
					case 'groups':
						if ( ! empty( $notification->item_id ) ) {
							$item_id = $notification->item_id;
							$object  = 'group';
						}
						break;
					case 'follow':
					case 'friends':
						if ( ! empty( $notification->item_id ) ) {
							$item_id = $notification->item_id;
							$object  = 'user';
						}
						break;
					default:
						if ( ! empty( $notification->secondary_item_id ) ) {
							$item_id = $notification->secondary_item_id;
							$object  = 'user';
						} else {
							$item_id = $notification->item_id;
							$object  = 'user';
						}
						break;
				}
				?>
                <li class="nhsuk-grid-column-full nhsuk-card-group__item">
                    <div class="nhsuk-card">
                        <div class="nhsuk-card__content">
                            <div class="bulk-select-check nhsuk-checkboxes">
							<span class="bb-input-wrap nhsuk-checkboxes__item">
								<input id="<?php bp_the_notification_id(); ?>" type="checkbox" name="notifications[]" value="<?php bp_the_notification_id(); ?>" class="notification-check nhsuk-checkboxes__input"/>
								<label class="nhsuk-checkboxes__label" for="<?php bp_the_notification_id(); ?>"></label>
							</span>
                            </div>

                            <div class="notification-avatar">
								<?php echo bp_core_fetch_avatar( [ 'item_id' => $item_id, 'object' => $object ] ); ?>
                            </div>

                            <div class="notification-content">
                                <span><?php bp_the_notification_description(); ?></span>
                                <span class="posted"><?php bp_the_notification_time_since(); ?></span>
                            </div>
                            <div class="actions">
								<?php bp_the_notification_action_links(); ?>
                            </div>
                        </div>
                    </div>
                </li>
			<?php endwhile; ?>
        </ul>
    </form>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

<?php else : ?>

	<?php bp_nouveau_user_feedback( 'member-notifications-none' ); ?>

<?php endif;
