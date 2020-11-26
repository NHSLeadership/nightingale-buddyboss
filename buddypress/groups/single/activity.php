<?php
/**
 * BuddyBoss - Groups Activity
 *
 * @since BuddyPress 3.0.0
 * @version 3.1.0
 */

?>

<h2 class="bp-screen-title<?php echo ( ! bp_is_group_home() ) ? ' bp-screen-reader-text' : ''; ?>">
	<?php esc_html_e( 'Group Feed', 'buddyboss' ); ?>
</h2>

<?php bp_nouveau_groups_activity_post_form(); ?>

<div class="subnav-filters filters clearfix">

	<ul>

		<li class="group-act-search"><?php bp_nouveau_search_form(); ?></li>

	</ul>

		<?php bp_get_template_part( 'common/filters/groups-screens-filters' ); ?>
</div><!-- // .subnav-filters -->

<?php bp_nouveau_group_hook( 'before', 'activity_content' ); ?>

<div id="comments" class="nhsuk-list-panel comments-area" data-bp-list="activity">

		<li id="bp-activity-ajax-loader"><?php bp_nouveau_user_feedback( 'group-activity-loading' ); ?></li>

</div><!-- .activity -->

<?php
bp_nouveau_group_hook( 'after', 'activity_content' );

bp_get_template_part( 'common/js-templates/activity/comments' );
