<?php
/**
 * BuddyPress - Users Settings
 *
 * @version 3.0.0
 */

$profile_link = trailingslashit( bp_displayed_user_domain() . bp_get_profile_slug() );
?>


<div class="bp-settings-container">

	<div class="bb-bp-settings-content">
		<?php
		switch ( bp_current_action() ) :
			case 'notifications':
				bp_get_template_part( 'members/single/settings/notifications' );
				break;
			case 'capabilities':
				bp_get_template_part( 'members/single/settings/capabilities' );
				break;
			case 'delete-account':
				bp_get_template_part( 'members/single/settings/delete-account' );
				break;
			case 'general':
				bp_get_template_part( 'members/single/settings/general' );
				break;
			case 'profile':
				bp_get_template_part( 'members/single/settings/profile' );
				break;
			case 'invites':
				bp_get_template_part( 'members/single/settings/group-invites' );
				break;
			case 'export':
				bp_get_template_part( 'members/single/settings/export-data' );
				break;
			default:
				bp_get_template_part( 'members/single/plugins' );
				break;
		endswitch;
		?>
	</div>
</div>
