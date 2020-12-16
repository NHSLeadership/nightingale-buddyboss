<?php
/**
 * BuddyPress - Groups Request Membership
 *
 * @since 3.0.0
 * @version 3.1.0
 */

bp_nouveau_group_hook( 'before', 'request_membership_content' ); ?>

<?php if ( ! bp_group_has_requested_membership() ) : ?>
	<p>
		<?php
		echo esc_html(
			sprintf(
				/* translators: %s: group name */
				__( 'To request to join the group "%s" please tell us about: 
<ul>
<li>Your role</li>
<li>What geographical area you work in</li>
<li>Why you wish to join this group. Reflect on what you hope to gain and contribute back to the group</li></ul>. "%s".', 'nightingale' ),
				bp_get_group_name()
			)
		);
		?>
	</p>

	<form action="<?php bp_group_form_action( 'request-membership' ); ?>" method="post" name="request-membership-form" id="request-membership-form" class="standard-form">
		<label for="group-request-membership-comments"><?php esc_html_e( 'Comments (optional)', 'buddypress' ); ?></label>
		<textarea name="group-request-membership-comments" id="group-request-membership-comments"></textarea>

		<?php bp_nouveau_group_hook( '', 'request_membership_content' ); ?>

		<p><input type="submit" name="group-request-send" id="group-request-send" value="<?php echo esc_attr_x( 'Send Request', 'button', 'buddypress' ); ?>" />

		<?php wp_nonce_field( 'groups_request_membership' ); ?>
	</form><!-- #request-membership-form -->
<?php endif; ?>

<?php
bp_nouveau_group_hook( 'after', 'request_membership_content' );
