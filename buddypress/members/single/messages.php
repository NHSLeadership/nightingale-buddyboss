<?php
/**
 * BuddyBoss - Users Messages
 *
 * @version 3.0.0
 */
?>
<header class="entry-header notifications-header flex">
    <h1 class="entry-title flex-1"><?php esc_html_e( 'Messages', 'nightingale'); ?></h1>
	<?php bp_get_template_part( 'common/search-and-filters-bar' ); ?>
</header>

<div class="messages-wrapper">
	<div class="messages-screen">
		<?php
		if ( ! in_array( bp_current_action(), array( 'inbox', 'starred', 'view', 'compose', 'notices' ), true ) ) :
			bp_get_template_part( 'members/single/plugins' );
		else :
			bp_nouveau_messages_member_interface();
		endif;
		?>
	</div>
</div>
