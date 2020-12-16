<?php
/**
 * BuddyBoss - Member Courses
 *
 * @since   BuddyBoss 1.2.0
 * @version 1.0.0
 */

$filepath = locate_template(
	array(
		'learndash/learndash_template_script.min.js',
		'learndash/learndash_template_script.js',
		'learndash_template_script.min.js',
		'learndash_template_script.js',
	)
);

if ( ! empty( $filepath ) ) {
	wp_enqueue_script( 'learndash_template_script_js', str_replace( ABSPATH, '/', $filepath ), array( 'jquery' ), LEARNDASH_VERSION, true );
	$learndash_assets_loaded[ 'scripts' ][ 'learndash_template_script_js' ] = __FUNCTION__;
} elseif ( file_exists( LEARNDASH_LMS_PLUGIN_DIR . '/templates/learndash_template_script' . ( ( defined( 'LEARNDASH_SCRIPT_DEBUG' ) && ( LEARNDASH_SCRIPT_DEBUG === true ) ) ? '' : '.min' ) . '.js' ) ) {
	wp_enqueue_script( 'learndash_template_script_js', LEARNDASH_LMS_PLUGIN_URL . 'templates/learndash_template_script' . ( ( defined( 'LEARNDASH_SCRIPT_DEBUG' ) && ( LEARNDASH_SCRIPT_DEBUG === true ) ) ? '' : '.min' ) . '.js', array( 'jquery' ), LEARNDASH_VERSION, true );
	$learndash_assets_loaded[ 'scripts' ][ 'learndash_template_script_js' ] = __FUNCTION__;

	$data              = array();
	$data[ 'ajaxurl' ] = admin_url( 'admin-ajax.php' );
	$data              = array( 'json' => json_encode( $data ) );
	wp_localize_script( 'learndash_template_script_js', 'sfwd_data', $data );

}
wp_enqueue_style( 'learndash-grid','/wp-content/plugins/learndash-course-grid/assets/css/style.css', '', '1.1');

//LD_QuizPro::showModalWindow();
add_action( 'wp_footer', array( 'LD_QuizPro', 'showModalWindow' ), 20 );

$user_id            = bp_displayed_user_id();
$atts               = apply_filters( 'bp_learndash_user_courses_atts', array() );
$user_courses       = apply_filters( 'bp_learndash_user_courses', ld_get_mycourses( $user_id, $atts ) );
$usermeta           = get_user_meta( $user_id, '_sfwd-quizzes', true );
$quiz_attempts_meta = empty( $usermeta ) ? false : $usermeta;
$quiz_attempts      = array();

if ( ! empty( $quiz_attempts_meta ) ) {
	foreach ( $quiz_attempts_meta as $quiz_attempt ) {
		$c                            = learndash_certificate_details( $quiz_attempt[ 'quiz' ], $user_id );
		$quiz_attempt[ 'post' ]       = get_post( $quiz_attempt[ 'quiz' ] );
		$quiz_attempt[ 'percentage' ] = ! empty( $quiz_attempt[ 'percentage' ] ) ? $quiz_attempt[ 'percentage' ] : ( ! empty( $quiz_attempt[ 'count' ] ) ? $quiz_attempt[ 'score' ] * 100 / $quiz_attempt[ 'count' ] : 0 );

		if ( $user_id == get_current_user_id() && ! empty( $c[ 'certificateLink' ] ) && ( ( isset( $quiz_attempt[ 'percentage' ] ) && $quiz_attempt[ 'percentage' ] >= $c[ 'certificate_threshold' ] * 100 ) ) ) {
			$quiz_attempt[ 'certificate' ] = $c;
		}
		$quiz_attempts[ learndash_get_course_id( $quiz_attempt[ 'quiz' ] ) ][] = $quiz_attempt;
	}
}
?>
<header class="entry-header notifications-header flex">
    <h1 class="entry-title flex-1">My Learning</h1>
</header>
<?php bp_get_template_part( 'members/single/parts/item-subnav' ); ?>
<div class="learndash-course-items">
    <div class="ld-course-list-items">
[ld_course_list mycourses="true" progress_bar="true" col="3" course_categoryselector="true"]
    </div>
</div>
