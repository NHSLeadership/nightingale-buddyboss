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
  jQuery('.bb-modal-box').show(500);
});

jQuery(document).on('click', '.bbp-topic-reply-link', function (e) {
  e.preventDefault();
  jQuery('.bb-modal-box').show(500);
});

jQuery(document).on('click', '.js-modal-close', function (e) {
  e.preventDefault();
  jQuery('.bb-modal-box').hide(500);
});

/* buddy panel slide in / out */
jQuery(document).on('click', '.bb-toggle-panel', function (e) {
  e.preventDefault();
  jQuery('body').addClass('buddypanel-open');
  jQuery(this).addClass('toggle-open');
  jQuery('.bbnavmenu').addClass('close');
});
jQuery(document).on('click', '.toggle-open', function (e) {
  e.preventDefault();
  jQuery('body').removeClass('buddypanel-open');
  jQuery(this).removeClass('toggle-open');
  jQuery('.bbnavmenu').removeClass('close');
});

/* buddy header animations */

jQuery(document).on('click', '.buddy-search', function (e) {
  e.preventDefault();
  jQuery('.buddy-search').toggle();
  jQuery('.buddy-header-search').show('slide', {direction: 'left'}, 500);
});
