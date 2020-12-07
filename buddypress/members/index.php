<?php
/**
 * BuddyPress Members Directory
 *
 * @version 3.0.0
 */

?>

<?php
	/**
	 * Fires at the begining of the templates BP injected content.
	 *
	 * @since BuddyPress 2.3.0
	 */
	do_action( 'bp_before_directory_members_page' );
?>

<div class="members-directory-wrapper">

	<?php
		/**
		 * Fires before the display of the members.
		 *
		 * @since BuddyPress 1.1.0
		 */
		do_action( 'bp_before_directory_members' );
	?>

	<div class="members-directory-container">

		<?php
			/**
			 * Fires before the display of the members list tabs.
			 *
			 * @since BuddyPress 1.8.0
			 */
			do_action( 'bp_before_directory_members_tabs' );
		?>

		<?php
			/**
			 * Fires before the display of the members content.
			 *
			 * @since BuddyPress 1.1.0
			 */
			do_action( 'bp_before_directory_members_content' );
		?>

		<div class="flex bp-secondary-header align-items-center">
			<?php if ( function_exists( 'bp_disable_advanced_profile_search' ) && bp_disable_advanced_profile_search() ) { ?>
                <div class="subnav-search members-search  nhsuk-buddy__search">
					<?php bp_nouveau_search_form(); ?>
                </div>
			<?php } ?>
            <div class="push-right">
				<div class="bp-profile-filter-wrap subnav-filters filters no-ajax">
					<?php bp_get_template_part( 'common/filters/member-filters' ); ?>
				</div>
				<div class="bp-members-filter-wrap subnav-filters filters no-ajax">
					<?php bp_get_template_part( 'common/filters/directory-filters' ); ?>
				</div>

			</div>
		</div>

		<div class="screen-content members-directory-content">

			<div id="members-dir-list" class="members dir-list" data-bp-list="members">
				<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'directory-members-loading' ); ?></div>
			</div><!-- #members-dir-list -->

			<?php
			/**
			* Fires and displays the members content.
			*
			* @since BuddyPress 1.1.0
			*/
			do_action( 'bp_directory_members_content' );
			?>
		</div><!-- // .screen-content -->

		<?php
			/**
			* Fires after the display of the members content.
			*
			* @since BuddyPress 1.1.0
			*/
			do_action( 'bp_after_directory_members_content' );
		?>

	</div>

	<?php
		/**
		* Fires after the display of the members.
		*
		* @since BuddyPress 1.1.0
		*/
		do_action( 'bp_after_directory_members' );
	?>

</div>

<?php
/**
* Fires at the bottom of the members directory template file.
*
* @since BuddyPress 1.5.0
*/
do_action( 'bp_after_directory_members_page' );
?>
