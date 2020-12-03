<?php
/**
 * BP Nouveau Search & filters bar
 *
 * @since   BuddyPress 3.0.0
 * @version 3.1.0
 */
?>
<div class="subnav-filters filters no-ajax nhsuk-grid-column-full" id="subnav-filters">

	<?php if ( 'friends' !== bp_current_component() ) : ?>

		<?php if ( 'members' !== bp_current_component() || bp_disable_advanced_profile_search() ) : ?>
            <div class="nhsuk-buddy__search subnav-search">
				<?php bp_nouveau_search_form(); ?>

            </div>
		<?php endif; ?>

	<?php endif; ?>
    <div class="nhsuk-grid-one-half">
		<?php if ( bp_is_user() && ( ! bp_is_current_action( 'requests' ) && ! bp_is_current_action( 'mutual' ) ) ): ?>
			<?php bp_get_template_part( 'common/filters/directory-filters' ); ?>
		<?php endif; ?>

		<?php if ( 'members' === bp_current_component() || ( 'friends' === bp_current_component() && 'my-friends' === bp_current_action() ) ): ?>
			<?php bp_get_template_part( 'common/filters/member-filters' ); ?>
		<?php endif; ?>

		<?php if ( 'groups' === bp_current_component() ): ?>
			<?php bp_get_template_part( 'common/filters/group-filters' ); ?>
		<?php endif; ?>
    </div>
</div><!-- search & filters -->
