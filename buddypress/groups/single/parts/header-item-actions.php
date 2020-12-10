<?php
/**
 * BuddyBoss - Groups Header item-actions.
 *
 * @since BuddyPress 3.0.0
 * @version 3.1.0
 */
?>
<div id="item-actions" class="group-item-actions">
	<?php if ( bp_current_user_can( 'groups_access_group' ) ) : ?>

		<div class="moderators-lists">
			<div class="moderators-title"><?php esc_html_e( 'Organized by', 'nightingale'); ?></div>
			<div class="user-list admins"><?php bp_group_list_admins(); ?>
				<?php bp_nouveau_group_hook( 'after', 'menu_admins' ); ?>
			</div>
		</div>

	<?php endif; ?>

</div><!-- .item-actions -->
