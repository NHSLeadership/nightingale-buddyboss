<?php
/**
 * BuddyBoss - Users Groups
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */
?>
    <header class="entry-header notifications-header flex">
        <h1 class="entry-title flex-1"><?php esc_html_e( 'Groups', 'nightingale'); ?></h1>

		<?php bp_get_template_part( 'common/search-and-filters-bar' ); ?>
    </header>

<?php if ( ! bp_is_current_action( 'invites' ) ) : ?>

<?php endif; ?>

<?php

switch ( bp_current_action() ) :

	// Home/My Groups
	case 'my-groups':
		bp_nouveau_member_hook( 'before', 'groups_content' );
		?>

		<div class="groups mygroups" data-bp-list="groups">

			<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'member-groups-loading' ); ?></div>

		</div>

		<?php
		bp_nouveau_member_hook( 'after', 'groups_content' );
		break;

	// Group Invitations
	case 'invites':
		bp_get_template_part( 'members/single/groups/invites' );
		break;

	// Any other
	default:
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
