<?php
/**
 * BuddyPress Single Members item Navigation
 *
 * @since BuddyPress 3.0.0
 * @version 3.1.0
 */
?>

	<?php if ( bp_nouveau_has_nav( array( 'type' => 'primary' ) ) ) : ?>

    <div class="nhsuk-full-width-container">
        <div class="nhsuk-bordered-tabs-container">
            <div class="nhsuk-width-container">
                <nav class="" id="object-nav" role="navigation" aria-label="<?php esc_attr_e( 'Group menu', 'buddyboss' ); ?>">


                    <ul class="nhsuk-bordered-tabs">

			<?php
			while ( bp_nouveau_nav_items() ) :
				bp_nouveau_nav_item();

				$hidden_tabs = bp_nouveau_get_appearance_settings( 'user_nav_hide' );
				$bp_nouveau  = bp_nouveau();
				$nav_item    = $bp_nouveau->current_nav_item;

				if ( ! is_admin() && is_array( $hidden_tabs ) && ! empty( $hidden_tabs ) && in_array( $nav_item->slug, $hidden_tabs, true ) ) {
					continue;
				}
				$link        = '';
				$current_url = $actual_link = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

				$admin_links = array(
					'/profile/',
					'/settings/',
					'/activity/',
					'/notifications/',
					'/messages/',
					'/friends/',
					'/groups/',
					'/guides/',
					'/photos/',
					'/forums/',
					'/invites/',
				);
				foreach ($admin_links as $links) {
					if ( strpos( $current_url, $links ) !== false ) {
						if ( strpos( bp_nouveau_get_nav_link(), $links ) !== false ) {
							$link = ' nhsuk-bordered-tabs-item-active';
						}
					}
				}
				?>

			?>

				<li class="nhsuk-bordered-tabs-item <?php echo $link; ?>">
					<a href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>"  class="nhsuk-bordered-tabs-link">
						<?php bp_nouveau_nav_link_text(); ?>

						<?php if ( bp_nouveau_nav_has_count() ) : ?>
							<span class="count"><?php bp_nouveau_nav_count(); ?></span>
						<?php endif; ?>
					</a>
				</li>

			<?php endwhile; ?>

			<?php bp_nouveau_member_hook( '', 'options_nav' ); ?>
                    </ul>

                </nav>
            </div>
        </div>
    </div>
		<br />

	<?php endif; ?>

