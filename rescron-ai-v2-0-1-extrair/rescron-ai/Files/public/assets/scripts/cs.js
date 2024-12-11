//hide preloader
$(document).ready(function () {
    $('#preloader').fadeOut(100);
});



// image preview 
$(document).on('change', "input[type='file']", function (e) {
    var target = $(this).data('preview');
    if (typeof target !== 'undefined') {
        var target_id = '#' + target;
        var bg_url = 'url(' + URL.createObjectURL(e.target.files[0]) + ')';
        $(target_id).css({
            'background-image': bg_url,
        });
    }
});

//show preloader on link click
$(document).on('click', 'a', function (e) {
    var url = $(this).attr('href');
    var role = $(this).attr('role');
    if (url === 'undefined' || url === '#' || role === 'button') {
        // Do nothing
    } else {
        $('#preloader').show();
    }
});





//////// ===> Add click event for toggling sidebar <=== ///////////////////
$(document).on('click', '.sidebar-toggle-btn', function () {
    if ($(window).width() > 739) {
        var status = $('.sidenav-content').eq(0).data('status');
        if (status == 'full') {
            var new_status = 'minized';
        } else {
            var new_status = 'full';
        }
        $(".sidenav-content").delay('slow').toggleClass('w-64').toggleClass('w-20').data('status', new_status);
        $("#general-content-section").delay('slow').toggleClass("md:ml-64").toggleClass("2xl:ml-1/5").toggleClass("md:ml-10").toggleClass("px-5").toggleClass("w-full").toggleClass("md:w-10/12").toggleClass("md:w-12/12");
        $("#general-content").delay('slow').toggleClass("md:w-4/5");
        $(".nav-text").toggleClass("hidden");
    } else {
        $(".sidebar-toggle-btn").click(function () {
            $(".sidenav-content").toggleClass("-translate-x-full");
        });
    }
});


$(document).on('mouseenter', '.sidenav-content', function () {
    var status = $(this).data('status');
    if (status == 'minized' && $(window).width() > 739) {
        $(".sidenav-content").toggleClass('w-64').toggleClass('w-20');
        $("#general-content-section").toggleClass("md:ml-64").toggleClass("2xl:ml-1/5").toggleClass("md:ml-10");
        $("#general-content").toggleClass("md:w-4/5");
        $(".nav-text").toggleClass("hidden");
    }
});
///////////////////////////////////////////////////////////////////////////


// ===> Add click event for toggling dropdown menus (without caret) <=== //
$(document).on('click', '.dropdown', function () {
    $(this).siblings(".dropdown-menu").toggleClass("hidden");
});
///////////////////////////////////////////////////////////////////////////


//// ===> Add click event for toggling dropdown menus (with caret) <=== ///
$(document).on('click', '.dropdown-with-caret', function () {
    // Get the menu id
    let menuId = $(this).data("menu-id");
    // Toggle the menu caret 
    $(`svg.the-caret[data-menu-id='${menuId}']`).toggleClass("rotate-90");
    // Toggle the menu
    $(`.the-menu[data-menu-id='${menuId}']`).toggleClass("hidden");
});

///////////////////////////////////////////////////////////////////////////


//// ===> Google translate function                   <=== ////////////////
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en'
    }, 'google_translate_element');
}
///////////////////////////////////////////////////////////////////////////

