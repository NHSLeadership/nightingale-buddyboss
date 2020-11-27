jQuery(document).on('click', '.bs-dropdown-link.bb-reply-actions-button', function (e) {
  e.preventDefault();
  jQuery(this).siblings('.bb-reply-actions-dropdown').toggle();
  jQuery(this).toggleClass('active button-close');
  if (jQuery(this).hasClass('active')) {
    jQuery(this).text('Close');
  } else {
    jQuery(this).text('Reply / Manage');
  }
});


jQuery(document).on('click', '.bbp-reply-to-link', function (e) {
  e.preventDefault();
  const queryString = jQuery(this).attr('href');
  const replyTo = getURLParameter( queryString, 'bbp_reply_to' );
  jQuery('.bb-modal-box').show(500);
  jQuery('#bbp_reply_to').val(replyTo);
  //find the original li element
  const originalComment = document.querySelector( '#post-'+replyTo );
  const replyNameDiv = originalComment.querySelector('.bbp-author-name');
  const replyName = jQuery(replyNameDiv).text();
  const commentDiv = originalComment.querySelector('.comment_body_comment');
  const actualComment = jQuery(commentDiv).text();
  jQuery('#bbp-reply-to-user').text(replyName);
  jQuery('#bbp-reply-exerpt').text(actualComment);

});
function getURLParameter(url, name) {
  return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
}

jQuery(document).on('click', '.bbp-topic-reply-link', function (e) {
  e.preventDefault();
  jQuery('.bb-modal-box').show(500);
  const topicID = jQuery('.bs-single-forum-list').attr('id').replace('topic-', '').replace('-replies', '');
  jQuery('#bbp_reply_to').val('');
  const replyNameDiv = document.querySelector('.bb-reply-topic-title');
  const replyName = jQuery(replyNameDiv).text();
  const topicDiv = document.querySelector('#post-'+topicID);
  const commentDiv = topicDiv.querySelector('.comment_body_comment');
  const actualComment = jQuery(commentDiv).text();
  jQuery('#bbp-reply-to-user').text('Original Topic - '+ replyName);
  jQuery('#bbp-reply-exerpt').text(actualComment);
});
jQuery(document).on('click', '.btn-new-topic', function (e) {
  e.preventDefault();
  jQuery('.bbp-topic-form').show(500);
});

jQuery(document).on('click', '.js-modal-close', function (e) {
  e.preventDefault();
  jQuery('.bb-modal-box').hide(500);
});

/* submit modal forms */
const modalRegion = document.querySelector( '.bb-modal-box' );
const modalForm = modalRegion.querySelector( 'form' );
const submitModal = modalForm.querySelector( '.submit' );
jQuery( submitModal ).click(function() {
  jQuery(modalForm).submit();
});

/* buddy header animations */
jQuery(document).on('click', '.buddy-search', function (e) {
  e.preventDefault();
  jQuery('.buddy-search').toggle();
  jQuery('.buddy-header-search').show('slide', {direction: 'left'}, 500);
});
