/**
 * Trigger the dropdown for reply and edit actions on comments.
 */
jQuery(document).on('click', '.bs-dropdown-link.bb-reply-actions-button', function (e) {
  e.preventDefault();
  jQuery(this).siblings('.bb-reply-actions-dropdown').toggle(); //show/hide the actions trigger and the close trigger.
  jQuery(this).toggleClass('active button-close'); // change button class.
  if (jQuery(this).hasClass('active')) { // if the element is active, show the word "Close".
    jQuery(this).text('Close');
  } else { // otherwise show normal button wording.
    jQuery(this).text('Reply / Manage');
  }
});

/**
 * "Reply to" Link Actions.
 */
jQuery(document).on('click', '.bbp-reply-to-link', function (e) {
  e.preventDefault(); // ditch the default behaviour in favour of this.
  const queryString = jQuery(this).attr('href'); // find the link.
  const replyTo = getURLParameter( queryString, 'bbp_reply_to' ); // extract the ID of the comment we are replying to.
  jQuery('.bb-modal-box').show(500); // show the modal with a 0.5s transition.
  jQuery('#bbp_reply_to').val(replyTo); // modify the id in the form to reference the id of the comment we are
  const originalComment = document.querySelector( '#post-'+replyTo ); // select the wrapper div for the source comment.
  const replyNameDiv = originalComment.querySelector('.bbp-author-name'); // target the author name div inside that div.
  const replyName = jQuery(replyNameDiv).text(); // extract the author name from the author div.
  const commentDiv = originalComment.querySelector('.comment_body_comment'); // target the comment div inside the
  // relevant wrapper.
  const actualComment = jQuery(commentDiv).text(); // extract the comment text.
  jQuery('#bbp-reply-to-user').text(replyName); // replace the author name in the reply form.
  jQuery('#bbp-reply-exerpt').text(actualComment); // replace the original comment text in the reply form.

});

/**
 * Extract values from a URL
 * @param url - source url / link to work through.
 * @param name - target variable to extract.
 * @returns {string} - the value for the variable in the link selected.
 */
function getURLParameter(url, name) {
  return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
}

/**
 * Duplication of "reply to link" function, but to work with "topic reply" link
 * Modification - to add "Original Topic" and name of topic instead of Author name.
 */
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

/**
 * On clicking new topic, open modal.
 */
jQuery(document).on('click', '.btn-new-topic', function (e) {
  e.preventDefault();
  jQuery('.bbp-topic-form').show(500);
});

/**
 * On clicking close link, close modal.
 */
jQuery(document).on('click', '.js-modal-close', function (e) {
  e.preventDefault();
  jQuery('.bb-modal-box').hide(500);
});

/**
 *  submit modal forms
 */
const modalRegion = document.querySelector( '.bb-modal-box' );
if (modalRegion) {
  const modalForm = modalRegion.querySelector('form');
  const submitModal = modalForm.querySelector('.submit');
  jQuery(submitModal).click(function () {
    jQuery(modalForm).submit();
  });
}

/* buddy header animations */
jQuery(document).on('click', '.buddy-search', function (e) {
  e.preventDefault();
  jQuery('.buddy-search').toggle();
  jQuery('.buddy-header-search').show('slide', {direction: 'left'}, 500);
});

/**
 * Buddy nav show/hide for mobile
 */
jQuery(document).on('click', '.label-navigation-buddynav', function (e) {
  jQuery(this).parent().siblings('.buddynav-menu').show();
  jQuery(this).siblings('.close-menu-buddynav').show();
  jQuery(this).hide();
});
jQuery(document).on('click', '.close-menu-buddynav', function (e) {
  jQuery(this).parent().siblings('.buddynav-menu').hide();
  jQuery(this).siblings('.label-navigation-buddynav').show();
  jQuery(this).hide();
});
jQuery(document).on('click', '.group-button', function (e) {
  e.preventDefault();
  var link = jQuery(this).attr("data-bp-nonce");
  window.location.href = link;
})
