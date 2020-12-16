<?php
/**
 * BuddyBoss - Groups Requests Loop
 *
 * @since   BuddyPress 3.0.0
 * @version 3.0.0
 */
?>

<?php if ( bp_group_has_membership_requests( bp_ajax_querystring( 'membership_requests' ) ) ) : ?>

    <h2 class="bp-screen-title">
		<?php esc_html_e( 'Manage Membership Requests', 'buddyboss' ); ?>
    </h2>

	<?php bp_nouveau_pagination( 'top' ); ?>

    <div id="request-list" class="nhsuk-grid-row nhsuk-card-group">
		<?php
		while ( bp_group_membership_requests() ) :
		bp_group_the_membership_request();
		?>

        <li class="nhsuk-grid-column-full nhsuk-card-group__item request-card">
            <div class="nhsuk-card">
                <div class="nhsuk-card__content single-request">
                    <h2 class="nhsuk-card__heading nhsuk-heading-m request-title">
						<?php bp_group_request_user_avatar_thumb(); ?>
						<?php bp_group_request_user_link(); ?>
                    </h2>
	                <?php bp_nouveau_group_hook( '', 'membership_requests_admin_item' ); ?>
	                <?php bp_nouveau_groups_request_buttons(); ?>
                    <div class="nhsuk-card__description request-content">


                        <div class="item-meta">
                            <div class="request-body">

                                <div class="comments"><?php bp_group_request_comment(); ?></div>
                                <div class="activity"><?php bp_group_request_time_since_requested(); ?></div>
                                <?php bp_nouveau_group_hook( '', 'membership_requests_admin_item' ); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

			<?php endwhile; ?>
    </div>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

<?php else : ?>

	<?php bp_nouveau_user_feedback( 'group-requests-none' ); ?>

<?php
endif;
