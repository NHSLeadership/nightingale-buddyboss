<?php
/**
 * BuddyPress - Groups Request Membership
 *
 * @since 3.0.0
 * @version 3.1.0
 */

bp_nouveau_group_hook( 'before', 'request_membership_content' ); ?>

<?php if ( ! bp_group_has_requested_membership() ) : ?>

    <p>To request to join the group <b><?php echo bp_get_group_name(); ?></b> please tell us about: </p>
    <ul>
        <li>Your role</li>
        <li>What geographical area you work in</li>
        <li>Why you wish to join this group. Reflect on what you hope to gain and contribute back to the group</li>
    </ul>


	<form action="<?php bp_group_form_action( 'request-membership' ); ?>" method="post" name="request-membership-form" id="request-membership-form" class="standard-form">
		<label for="group-request-membership-comments"><?php esc_html_e( 'Request Details', 'nightingale' ); ?></label>
		<textarea name="group-request-membership-comments" id="group-request-membership-comments"></textarea>

		<?php bp_nouveau_group_hook( '', 'request_membership_content' ); ?>

		<p><input type="submit" name="group-request-send" id="group-request-send" value="<?php echo esc_attr_x( 'Send Request', 'button', 'nightingale' ); ?>" />

		<?php wp_nonce_field( 'groups_request_membership' ); ?>
	</form><!-- #request-membership-form -->
<?php endif; ?>

<?php
bp_nouveau_group_hook( 'after', 'request_membership_content' );
