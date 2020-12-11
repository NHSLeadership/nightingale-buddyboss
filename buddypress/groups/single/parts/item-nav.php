<?php
/**
 * BuddyPress Single Groups item Navigation
 *
 * @since   BuddyPress 3.0.0
 * @version 3.0.0
 */
?>
<?php if ( bp_nouveau_has_nav( array( 'object' => 'groups' ) ) ) : ?>
    <div class="nhsuk-full-width-container">
        <div class="nhsuk-bordered-tabs-container">
            <div class="nhsuk-width-container">
                <nav class="" id="object-nav" role="navigation" aria-label="<?php esc_attr_e( 'Group menu', 'buddyboss' ); ?>">
                    <p class="nhsuk-header__navigation-title"><a class="label-navigation-buddynav">This Section</a>
                        <button class="nhsuk-header__navigation-close close-menu-buddynav">
                            <svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
                            </svg>
                            <span class="nhsuk-u-visually-hidden">Close Menu</span>
                        </button>
                    </p>

                    <ul class="nhsuk-bordered-tabs  buddynav-menu">

						<?php
						while ( bp_nouveau_nav_items() ) :
							bp_nouveau_nav_item();
							$link        = '';
							$current_url = $actual_link = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							if ( strpos( $current_url, '/messages/' ) !== false ) {
								$current_url = substr( $current_url, 0, ( strpos( $current_url, "/messages/" ) +10 ) ); // remove all-members from url so active tab works properly
							} else if (  strpos( $current_url, '/invite/' ) !== false ) {
								$current_url = substr( $current_url, 0, ( strpos( $current_url, "/invite/" ) +8 ) ); // remove send-invites from url so active tab works properly
							} else if (  strpos( $current_url, '/admin/' ) !== false ) {
								$current_url = substr( $current_url, 0, ( strpos( $current_url, "/admin/" ) +7 ) ); // remove everything after admin link
							} else if (  strpos( $current_url, '/members/' ) !== false ) {
								$current_url = substr( $current_url, 0, ( strpos( $current_url, "/members/" ) +9 ) ); // remove everything after admin link
							}
							if ( bp_nouveau_get_nav_link() === $current_url ) {
								$link = ' nhsuk-bordered-tabs-item-active';
							} else {
								$admin_links = array(
									'/' . bp_get_displayed_user_mentionname() . '/profile/',
									'/' . bp_get_displayed_user_mentionname() . '/settings/',
									'/' . bp_get_displayed_user_mentionname() . '/activity/',
									'/' . bp_get_displayed_user_mentionname() . '/notifications/',
									'/' . bp_get_displayed_user_mentionname() . '/messages/',
									'/' . bp_get_displayed_user_mentionname() . '/friends/',
									'/' . bp_get_displayed_user_mentionname() . '/groups/',
									'/' . bp_get_displayed_user_mentionname() . '/guides/',
									'/' . bp_get_displayed_user_mentionname() . '/photos/',
									'/' . bp_get_displayed_user_mentionname() . '/forums/',
									'/' . bp_get_displayed_user_mentionname() . '/invites/',
								);
								foreach ($admin_links as $links) {
									if ( strpos( $current_url, $links ) !== false ) {
										if ( strpos( bp_nouveau_get_nav_link(), $links ) !== false ) {
											$link = ' nhsuk-bordered-tabs-item-active';
										}
									}
								}
                            }

							?>

                            <li  class="nhsuk-bordered-tabs-item <?php echo $link; ?>">
                                <a href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>" class="nhsuk-bordered-tabs-link">
									<?php bp_nouveau_nav_link_text(); ?>

									<?php if ( bp_nouveau_nav_has_count() ) : ?>
                                        <span class="count"><?php bp_nouveau_nav_count(); ?></span>
									<?php endif; ?>
                                </a>
                            </li>

						<?php endwhile; ?>

						<?php bp_nouveau_group_hook( '', 'options_nav' ); ?>

                    </ul>

                </nav>
            </div>
        </div>
    </div>
<?php endif; ?>
