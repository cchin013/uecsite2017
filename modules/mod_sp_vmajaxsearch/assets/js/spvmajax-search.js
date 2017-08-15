/**
 * @package     mod_sp_vmajaxsearch
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

jQuery(function($) {

    var searchSpVmPreviousValue,
        liveSpVmSearchTimer
    $('.sp-vmajax-search-input').on('keyup', function(event) {

        event.preventDefault();

        //Return on escape
        if(event.keyCode==27) {
            $('.sp-vmajax-search-results').fadeOut(400);
            return;
        }

        if($(this).val() != '') {
            $('.sp-vmajaxsearch-clear').show()
        } else {
            $('.sp-vmajaxsearch-clear').hide()
        }

        var icon = $('.mod-sp-vmajaxsearch').find('.fa-search');

        if ($(this).val() != searchSpVmPreviousValue) {

        var query = $(this).val().trim();

        // Remove Special Charecter
        var re = /[`~!@#$%^&*_|+\=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(query);
        if(isSplChar){
            var query = query.replace(/[`~!@#$%^&*_|+\=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(this).val(query);
        }

        if (liveSpVmSearchTimer) {
            clearTimeout(liveSpVmSearchTimer);
        }

        if(query=='') {
            $('.sp-vmajaxsearch-results').fadeOut(400);
        } else {
            $('.sp-vmajaxsearch-results').fadeIn(400);
        }

        query = query.trim();

        if(query !='' && !isSplChar) {
            liveSearchTimer = setTimeout(function () {

              $.ajax({
                type: 'POST',
                url: 'index.php?option=com_ajax&module=sp_vmajaxsearch&format=json',
                data: {catid: $('.mod-sp-vmajaxsearch #virtuemart_category_id').val(), query: query},
                beforeSend: function() {
                    icon.removeClass('fa-search').addClass('fa-spinner fa-spin');
                },
                success: function (response) {
                    icon.removeClass('fa-spinner fa-spin').addClass('fa-search');
                    var data = $.parseJSON(response);
                    $('.sp-vmajaxsearch-results').html(data.content);
                }
            });
          }, 300);
        }

        searchSpVmPreviousValue = $(this).val()
    }

        return false;
    });


    // Clear search
    $('.sp-vmajaxsearch-clear').on('click', function(event) {
        event.preventDefault()
        $('.sp-vmajax-search-input').val('').focus().keyup()
    });
});
