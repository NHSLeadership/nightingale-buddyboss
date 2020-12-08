<?php
/**
 * BuddyPress Single Members item Sub Navigation
 *
 * @since BuddyPress 3.0.0
 * @version 3.0.0
 */

	$bp_nouveau = bp_nouveau();
	$has_nav    = bp_nouveau_has_nav( array( 'type' => 'secondary' ) );
	$nav_count  = count( $bp_nouveau->sorted_nav );

	if ( ! $has_nav || $nav_count <= 1 ) {
		unset( $bp_nouveau->sorted_nav, $bp_nouveau->displayed_nav, $bp_nouveau->object_nav );
		return;
	}
?>
<div class="nhsuk-grid-full-width">
    <nav class="nhsuk-bordered-tabs-container secondary" id="subnav" role="navigation" aria-label="<?php esc_attr_e( 'User administration menu', 'nightingale' ); ?>">
        <ul class="nhsuk-bordered-tabs">
		<?php
        $ticker = 0;
		while ( bp_nouveau_nav_items() ) :
			bp_nouveau_nav_item();
		$ticker ++;
			$link        = '';
			$current_url = $actual_link = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			if ( $current_url === bp_nouveau_get_nav_link() ) {
				$link = ' nhsuk-bordered-tabs-item-active-alt';
			} else {
				$admin_links = array(
					'/read/',
					'/edit/',
					'/change-avatar/',
					'/change-cover-image/',
					'/settings/notifications/',
					'/settings/profile/',
					'/settings/invites/',
					'/export/',
					'/notifications/read/',
					'/friends/requests/',
					'/groups/invites/',
					'/photos/albums',
					'/forums/replies/',
					'/forums/favorites/',
					'/forums/subscriptions/',
					'/sent-invites',
				);

				foreach ( $admin_links as $links ) {
					if ( strpos( $current_url, $links ) !== false ) {
						if ( strpos( bp_nouveau_get_nav_link(), $links ) !== false ) {
							$link = ' nhsuk-bordered-tabs-item-active-alt';
						}
					}
				}
			}

		?>

			<li id="<?php bp_nouveau_nav_id(); ?>" class="nhsuk-bordered-tabs-item <?php echo $link; ?>" <?php bp_nouveau_nav_scope(); ?>>
				<a href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>" class="nhsuk-bordered-tabs-link">
					<?php bp_nouveau_nav_link_text(); ?>

					<?php if ( bp_nouveau_nav_has_count() ) : ?>
						<span class="count"><?php bp_nouveau_nav_count(); ?></span>
					<?php endif; ?>
				</a>
			</li>

		<?php endwhile; ?>

        </ul>
    </nav><!-- .item-list-tabs#subnav -->
</div>
