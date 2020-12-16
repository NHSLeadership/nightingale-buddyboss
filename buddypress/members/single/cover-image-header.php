<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @since   3.0.0
 * @version 3.0.0
 */

$profile_cover_width  = nightingale_buddyboss_theme_get_option( 'buddyboss_profile_cover_width' );
$profile_cover_height = nightingale_buddyboss_theme_get_option( 'buddyboss_profile_cover_height' );
$displayed_user       = bp_get_displayed_user();
$cover_image_url      = bp_attachments_get_attachment( 'url', array( 'object_dir' => 'members', 'item_id' => $displayed_user->id, ) );
if ( ! $cover_image_url ) {
	$cover_image_url = get_theme_mod( 'buddyboss_group_cover_default', get_theme_file_uri( 'assets/images/svg/newsletter-bg.svg' ) );
}
remove_filter( 'bp_get_add_follow_button', 'buddyboss_theme_bp_get_add_follow_button' );
?>
    <div class="wp-block-nhsblocks-heroblock nhsuk-hero nhsuk-hero--image nhsuk-hero--image-description" style="background-image: url(<?php echo $cover_image_url; ?>); background-size: cover; background-position: center center;">
        <div class="nhsuk-hero__overlay">
            <div class="nhsuk-width-container">
                <div class="nhsuk-grid-row">
					<?php if ( bp_is_item_admin() && bp_group_use_cover_image_header() ) { ?>
                        <a href="<?php echo bp_get_members_component_link( 'profile', 'change-cover-image' ); ?>" class="link-change-cover-image" data-balloon-pos="right" data-balloon="<?php _e( 'Change Cover Image', 'nightingale' ); ?>">
                            <span class="dashicons dashicons-edit"></span>
                        </a>
					<?php } ?>
                    <div class="nhsuk-grid-column-two-thirds">
                        <div class="wp-block-nhsblocks-heroinner nhsuk-hero-content">
							<?php bp_displayed_user_avatar( 'type=full' ); ?>
                            <h1 class="nhsuk-u-margin-bottom-3">
								<?php echo bp_core_get_user_displayname( bp_displayed_user_id() ); ?>
                            </h1>
                            <div class="item-meta">
								<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
                                    <span class="mention-name">@<?php bp_displayed_user_mentionname(); ?></span>
								<?php endif; ?>

								<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() && bp_nouveau_member_has_meta() ) : ?>
                                    <span class="separator">&bull;</span>
								<?php endif; ?>

								<?php bp_nouveau_member_hook( 'before', 'in_header_meta' ); ?>

								<?php if ( bp_nouveau_member_has_meta() ) : ?>
									<?php bp_nouveau_member_meta(); ?>
								<?php endif; ?>
                            </div>
							<?php
							if ( function_exists( 'bp_member_type_enable_disable' ) && function_exists( 'bp_member_type_display_on_profile' ) && true === bp_member_type_enable_disable() && true === bp_member_type_display_on_profile() ) {
								echo bp_get_user_member_type( bp_displayed_user_id() );
							}
							?>
							<?php if ( function_exists( 'bp_is_activity_follow_active' ) && bp_is_active( 'activity' ) && bp_is_activity_follow_active() ) { ?>
                                <div class="flex align-items-top member-social">
                                    <div class="flex align-items-center">
										<?php nightingale_theme_followers_count(); ?> <?php nightingale_theme_following_count(); ?>
                                    </div>
									<?php
									if ( function_exists( 'bp_get_user_social_networks_urls' ) ) {
										echo bp_get_user_social_networks_urls();
									}
									?>
                                </div>
							<?php } else { ?>
                                <div class="flex align-items-center">
									<?php
									if ( function_exists( 'bp_get_user_social_networks_urls' ) ) {
										echo bp_get_user_social_networks_urls();
									}
									?>
                                </div>
							<?php } ?>
                            <span class="nhsuk-hero__arrow" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="nhsuk-grid-column-one-third right">
	                    <?php
	                    bp_nouveau_member_header_buttons(
		                    array(
			                    'container'         => 'div',
			                    'button_element'    => 'button',
			                    'container_classes' => array( 'member-header-actions' ),
		                    )
	                    );
	                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
add_filter( 'bp_get_add_follow_button', 'buddyboss_theme_bp_get_add_follow_button' );

