<?php

/**
 * Get BuddyBoss related theme options
 *
 * @param string $id Option ID.
 * @param string $param Option type.
 * @param bool   $default default value.
 *
 * @return $output False on failure, Option.
 */
if ( !function_exists( 'nightingale_buddyboss_theme_get_option' ) ) {

	function nightingale_buddyboss_theme_get_option( $id, $param = null, $default = false ) {

		global $nightingale_buddyboss_theme_options;

		/* Check if options are set */
		if ( !isset( $nightingale_buddyboss_theme_options ) ) {
			$nightingale_buddyboss_theme_options = get_option( 'theme_mods_nightingale', array() );
		}

		/* Check if array subscript exist in options */
		if ( empty( $nightingale_buddyboss_theme_options[ $id ] ) ) {
			if ( array_key_exists( $id, $nightingale_buddyboss_theme_options ) ) {
				return false;
			} else {
				// Return true if default passed to true and key not exists into the buddyboss_theme_options array.
				return ( $default ) ? true : false;
			}
		}

		/**
		 * If $param exists,  then
		 * 1. It should be 'string'.
		 * 2. '$nightingale_buddyboss_theme_options[ $id ]' should be array.
		 * 3. '$param' array key exists.
		 */
		if ( !empty( $param ) && is_string( $param ) && (!is_array( $nightingale_buddyboss_theme_options[ $id ] ) || !array_key_exists( $param, $nightingale_buddyboss_theme_options[ $id ] ) ) ) {
			return false;
		}

		return empty( $param ) ? $nightingale_buddyboss_theme_options[ $id ] : $nightingale_buddyboss_theme_options[ $id ][ $param ];
	}
}

/**
 * Queue up buddyboss js include
 */
function nightingale_buddyboss_js() {
    wp_enqueue_script('nightingale-buddyboss', get_template_directory_uri() . '/js/buddypress.js', '', '20201123', true );
}

add_action( 'wp_enqueue_scripts', 'nightingale_buddyboss_js' );
///////////////////////////////////////////////////////////////////////////////
// Check if BuddyPress is installed
//////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'bp_is_active' ) ) {
	global $blog_id, $current_blog;
	if ( is_multisite() ) {
//check if multiblog
		if ( defined( 'BP_ENABLE_MULTIBLOG' ) && BP_ENABLE_MULTIBLOG ) {
			$bp_active = 'true';
		} elseif ( defined( 'BP_ROOT_BLOG' ) && BP_ROOT_BLOG == $current_blog->blog_id ) {
			$bp_active = 'true';
		} elseif ( defined( 'BP_ROOT_BLOG' ) && ( $blog_id != 1 ) ) {
			$bp_active = 'false';
		}
	} else {
		$bp_active = 'true';
	}
} else {
	$bp_active = 'false';
}
/**
 * Group Admins Count
 */
if ( ! function_exists( 'nightingale_theme_bp_get_group_admins_count' ) ) {

	function nightingale_theme_bp_get_group_admins_count() {
		global $groups_template;
		$group = $groups_template->group;

		if ( ! empty( $group->admins ) ) {
			return sizeof( $group->admins );
		}
	}
}

/**
 * Output an HTML-formatted link for the current group in the loop.
 *
 * @since BuddyPress 2.9.0
 *
 * @param BP_Groups_Group|null $group Optional. Group object.
 *                                    Default: current group in loop.
 */
function nightingale_bp_group_link( $group = null ) {
	echo nightingale_bp_get_group_link( $group );
}
/**
 * Return an HTML-formatted link for the current group in the loop.
 *
 * @since BuddyPress 2.9.0
 *
 * @param BP_Groups_Group|null $group Optional. Group object.
 *                                    Default: current group in loop.
 * @return string
 */
function nightingale_bp_get_group_link( $group = null ) {
	global $groups_template;

	if ( empty( $group ) ) {
		$group =& $groups_template->group;
	}

	$link = sprintf(
		'<a href="%s" class="bp-group-home-link %s-home-link">%s</a>',
		esc_url( bp_get_group_permalink( $group ) ),
		esc_attr( bp_get_group_slug( $group ) ),
		esc_html( bp_get_group_name( $group ) )
	);

	/**
	 * Filters the HTML-formatted link for the current group in the loop.
	 *
	 * @since BuddyPress 2.9.0
	 *
	 * @param string          $value HTML-formatted link for the
	 *                               current group in the loop.
	 * @param BP_Groups_Group $group The current group object.
	 */
	return apply_filters( 'nightingale_bp_get_group_link', $link, $group );
}

function nightingale_bp_group_member_section_title() {
	echo nightingale_bp_get_group_member_section_title();
}

/**
 * Return the group member section header while in the groups members loop.
 *
 * @since BuddyPress 1.0.0
 *
 * @return string
 */
function nightingale_bp_get_group_member_section_title() {
	$last_user_group_role_title = null;

	$user_id               = bp_get_group_member_id();
	$group_id              = bp_get_current_group_id();
	$user_group_role_title = bp_get_user_group_role_title( $user_id, $group_id );

	ob_start();

	if ( $last_user_group_role_title != $user_group_role_title ) {
		$last_user_group_role_title = $user_group_role_title;
		?>
		<li class="item-entry item-entry-header">

			<?php bp_nouveau_group_hook( 'before', 'member_section_title' ); ?>

			<?php
			if ( groups_is_user_admin( $user_id, $group_id ) ) {
				esc_html_e( get_group_role_label( $group_id, 'organizer_plural_label_name' ), 'buddyboss' );
			} elseif ( groups_is_user_mod( $user_id, $group_id ) ) {
				esc_html_e( get_group_role_label( $group_id, 'moderator_plural_label_name' ), 'buddyboss' );
			} elseif ( groups_is_user_member( $user_id, $group_id ) ) {
				esc_html_e( get_group_role_label( $group_id, 'member_plural_label_name' ), 'buddyboss' );
			}
			?>

			<?php bp_nouveau_group_hook( 'after', 'member_section_title' ); ?>

		</li>
		<?php
	}

	return ob_get_clean();
}

if ( ! function_exists( 'nightingale_unique_id' ) ) {
	/**
	 * Get unique ID.
	 *
	 * This is a PHP implementation of Underscore's uniqueId method. A static variable
	 * contains an integer that is incremented with each call. This number is returned
	 * with the optional prefix. As such the returned value is not universally unique,
	 * but it is unique across the life of the PHP process.
	 *
	 * @param string $prefix Prefix for the returned ID.
	 *
	 * @return string Unique ID.
	 *
	 * @staticvar int $id_counter
	 *
	 */
	function nightingale_unique_id( $prefix = '' ) {
		static $id_counter = 0;

		return $prefix . (string) ++ $id_counter;
	}
}

/**
 * List threaded replies
 *
 * @since 2.4.0 bbPress (r4944)
 */
function nightingale_bbp_list_replies( $args = array() ) {

	// Get bbPress
	$bbp = bbpress();

	// Reset the reply depth
	$bbp->reply_query->reply_depth = 0;

	// In reply loop
	$bbp->reply_query->in_the_loop = true;

	// Parse arguments
	$r = bbp_parse_args( $args, array(
		'walker'       => new BBP_Walker_Reply(),
		'max_depth'    => bbp_thread_replies_depth(),
		'style'        => 'ul',
		'callback'     => null,
		'end_callback' => null,
		'page'         => 1,
		'per_page'     => -1
	), 'list_replies' );

	// Get replies to loop through in $_replies
	echo '<ul>' . $r['walker']->paged_walk( $bbp->reply_query->posts, $r['max_depth'], $r['page'], $r['per_page'], $r ) . '</ul>';

	$bbp->max_num_pages            = $r['walker']->max_pages;
	$bbp->reply_query->in_the_loop = false;
}


/* BuddyPanel setup */
function nightingale_underscore($str, array $noStrip = [])
{
	// non-alpha and non-numeric characters become spaces
	$str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
	$str = trim($str);
	$str = str_replace(" ", "_", $str);
	$str = strtolower($str);

	return $str;
}
class Nightingale_BuddyBoss_BuddyPanel_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @since BuddyBossTheme 1.0.0
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Stick to bottom of the menu
		if ( isset( $item->stick_to_bottom ) && '1' == $item->stick_to_bottom ) {
			$classes[] = 'bp-menu-item-at-bottom';
		}

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		$iconname = nightingale_underscore($item->title);
		$iconlocation = get_template_directory_uri() . '/assets/images/svg/buddyboss/' . $iconname . '.svg';
		$item->title = "<img class='bb-icon-file {$iconname}' src='{$iconlocation}' alt='{$item->title}'></img><span class='link-text'>{$item->title}</span>";



		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/*
class Nightingale_BuddyBoss_SubMenuWrap extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class='wrapper ab-submenu'><ul class='bb-sub-menu'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div>\n";
	}
}
*/

$bblocations = array(
	'buddypanel-loggedin'  => __( 'Buddy Panel logged in menu', 'nightingale' ),
	'buddypanel-loggedout' => __( 'Buddy Panel logged out menu', 'nightingale' ),
);
register_nav_menus( $bblocations );

function nightingale_add_buddypanel() {
	get_template_part( 'template-parts/buddypanel' );
}
add_action( 'nightingale_after_body', 'nightingale_add_buddypanel', 10 );
