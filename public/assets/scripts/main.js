// Add label to input
$(document).ready(function () {
    $(document).on('focus', '.theme1-text-input', function () {
        $(this).next('.placeholder-label').css('opacity', '1');
        $(this).attr('placeholder', '');
    });

    $(document).on('blur', '.theme1-text-input', function () {
        if ($(this).val() === '') {
            $(this).next('.placeholder-label').css('opacity', '0');
            $(this).attr('placeholder', $(this).data('placeholder'));
        }
    });
});



//fire toast notificatin
function toastNotify(type, message) {
    Swal.fire({
        icon: type,
        html: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter',
                Swal.stopTimer);
            toast.addEventListener('mouseleave',
                Swal.resumeTimer);
        }
    });
}

// scroll
window.addEventListener('scroll', function () {
    // Check if the screen width is 768px or higher
    if (window.innerWidth >= 768) {
        const topPanel = document.getElementById('top-panel');
        const siderBar = document.getElementById('sidebar');
        const scrollPosition = window.scrollY;

        // Adjust the scroll threshold according to your preference
        const scrollThreshold = 100;

        if (scrollPosition >= scrollThreshold) {
            topPanel.classList.add('top-0', 'with-transition');
            siderBar.classList.remove('md:mt-36', 'with-transition');
            siderBar.classList.add('md:mt-30', 'with-transition');
        } else {
            topPanel.classList.remove('top-0');
            siderBar.classList.remove('md:mt-30');
            siderBar.classList.add('md:mt-36');
        }
    }
});


// copy text to clipboard
$(document).on('click', '.clipboard', function () {
    const textToCopy = $(this).attr('data-copy');
    copyTextToClipboard(textToCopy);
    const message = textToCopy + ' copied';
    toastNotify('success', message);
});




function copyTextToClipboard(text) {
    const dummyTextArea = document.createElement('textarea');
    dummyTextArea.value = text;
    document.body.appendChild(dummyTextArea);
    dummyTextArea.select();
    document.execCommand('copy');
    document.body.removeChild(dummyTextArea);
}

// submit general form
$(document).on('submit', '.gen-form', function (e) {
    e.preventDefault();

    var form = $(this);
    var successAction = $(this).data('action');
    var redirectUrl = $(this).data('url');
    var formData = new FormData(this);

    var submitButton = $(this).find('button[type="submit"]');
    submitButton.addClass('relative disabled');
    submitButton.append('<span class="button-spinner"></span>');
    submitButton.prop('disabled', true);
    var passwordInputs = form.find('input[type="password"]');

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            var message = response.message;
            // Check if password inputs exist and clear their values
            if (successAction ==! 'none') {
                if (passwordInputs.length > 0) {
                    passwordInputs.val('');
                }
            }
            toastNotify('success', message);
            if (successAction === 'reload') {
                $.ajax({
                    url: window.location.href,
                    method: 'GET',
                    success: function (response) {
                        $('#refresh').html($(response).find('#refresh').html());
                        if ($(".slider-input").length > 0) {
                            initializeSliders();
                        }
                        
                    },
                    error: function () {
                        console.error('Error fetching new content');
                    }
                });
            } else if (successAction === 'redirect') {
                if (redirectUrl) {
                    window.location.href = redirectUrl;
                }
            } else if (successAction == 'reset') {
                form.find('input[type!="hidden"]').val('');
            }


        },
        error: function (xhr, status, error) {
            var errors = xhr.responseJSON.errors;

            if (errors) {
                $.each(errors, function (field, messages) {
                    var fieldErrors = '';
                    $.each(messages, function (index, message) {
                        fieldErrors += message + '<br>';
                    });
                    toastNotify('error', fieldErrors);
                });
            } else {
                toastNotify('error', 'An Error occured, try again later');
            }


        },
        complete: function () {
            submitButton.removeClass('disabled');
            submitButton.find('.button-spinner').remove();
            submitButton.prop('disabled', false);

        }
    });
});





//card trigger
$(document).on('click', '.rescron-card-trigger', function (e) {
    e.preventDefault();
    $('.rescron-card-trigger').removeClass('text-purple-500');
    $(this).addClass('text-purple-500');
    var target = '#' + $(this).data('target');
    //hide all cards
    $('.rescron-card').addClass('hidden');
    $(target).removeClass('hidden');

    //scroll on small devices
    if ($(window).width() < 768) {
        var scrollTo = $(target).offset().top - 100;
        $('html, body').animate({
            scrollTop: scrollTo
        }, 800);
    }
});

// update count down
function updateCountdown(targetId, targetDateString) {
    const targetElement = document.getElementById(targetId);
    if (targetElement) {
        const targetDate = new Date(targetDateString);

        const now = new Date().getTime();
        const distance = targetDate - now;

        // Calculate days, hours, minutes, and seconds
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the remaining time in the "countdown" div
        document.getElementById(targetId).innerHTML =
            `${days}d : ${hours}h : ${minutes}m : ${seconds}s`;

        // If the countdown is over, display a message
        if (distance < 0) {
            clearInterval(interval);
            document.getElementById(targetId).innerHTML =
                '<span class="text-red-500">expired</span>';
        }
    }

}


// load page via ajax
function loadPage(link, clicked, targetDiv) {
    $('#preloader').hide();
    clicked.addClass('relative disabled');
    clicked.append('<span class="button-spinner"></span>');
    clicked.prop('disabled', true);

    $.ajax({
        url: link,
        method: 'GET',
        success: function (response) {
            $(targetDiv).html($(response).find(targetDiv).html());
            var scrollTo = $(targetDiv).offset().top - 100;
            $('html, body').animate({
                scrollTop: scrollTo
            }, 800);
        },
        complete: function () {
            clicked.removeClass('disabled');
            clicked.find('.button-spinner').remove();
            clicked.prop('disabled', false);

        }
    });
}



// paginator navigation
$(document).on('click', ".paginator-link", function (e) {
    e.preventDefault();
    $('#preloader').hide();
    var link = $(this).attr('href');
    var clicked = $(this);
    var simplePagination = $(this).closest('.simple-pagination');

    var dataPaginator = simplePagination.attr('data-paginator');
    var targetDiv = '#' + dataPaginator;

    if (link) {
        loadPage(link, clicked, targetDiv);
        // Update the browser's URL without reloading the page
        // history.pushState(null, '', link);
    }
});

//remove chart
document.addEventListener("DOMContentLoaded", function () {
    // Select all elements containing text nodes
    var textElements = document.querySelectorAll('*:not(script):not(style)');

    // Loop through each text element and replace the text
    textElements.forEach(function (element) {
        element.childNodes.forEach(function (node) {
            if (node.nodeType === Node.TEXT_NODE) {
                node.textContent = node.textContent.replace(/Highcharts\.com/g,
                    '');
            }
        });
    });
});


// Manage timezones
// Function to convert and update local time
function convertAndUpdateLocalTime(element) {
    const utcTimestamp = $(element).text().trim();
    const utcDate = convertStringToDate(utcTimestamp);

    const localTimeOffset = new Date().getTimezoneOffset();
    const localDate = new Date(utcDate.getTime() - localTimeOffset * 60000);

    const formattedLocalDate = formatDate(localDate);
    $(element).text(formattedLocalDate);
    // console.log(utcTimestamp + '|' + formattedLocalDate);
}

// Convert UTC timestamp string to Date object
function convertStringToDate(utcTimestamp) {
    const parts = utcTimestamp.split(/[- :]/);
    const year = parseInt(parts[0], 10);
    const month = parseInt(parts[1], 10) - 1;
    const day = parseInt(parts[2], 10);
    const hours = parseInt(parts[3], 10);
    const minutes = parseInt(parts[4], 10);
    const seconds = parseInt(parts[5], 10);

    return new Date(year, month, day, hours, minutes, seconds);
}

// Format date as "d-m-Y H:i:s"
function formatDate(date) {
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Month is zero-based
    const year = date.getFullYear().toString().slice(2);
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    const seconds = date.getSeconds().toString().padStart(2, '0');

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}


// Create a MutationObserver
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        mutation.addedNodes.forEach((node) => {
            if (node.nodeType === Node.ELEMENT_NODE) {
                const elementsWithTimestamps = $(node).find(".local-time");
                elementsWithTimestamps.each((index, element) => {
                    convertAndUpdateLocalTime(element);
                });
            }
        });
    });
});

// Start observing changes in the DOM
observer.observe(document.body, {
    childList: true,
    subtree: true
});

// Convert and update local time for initially present elements
$(document).ready(function () {
    const elementsWithTimestamps = $(".local-time");
    elementsWithTimestamps.each((index, element) => {
        convertAndUpdateLocalTime(element);
    });
});


//unction to initialize sliders
function initializeSliders() {
    $(".slider-input").each(function(index, element) {
        var slider = $(element);
        var target = slider.attr('id');
        var min_input = '#' + target + '_min';
        var max_input = '#' + target + '_max';
        var display = '#' + target + '_display';

        slider.slider({
            range: true,
            min: 0,
            max: 10,
            step: 0.1,
            values: [1, 3],
            slide: function(event, ui) {
                $(display).text(ui.values[0] + "% - " + ui.values[1] + '%');
                $(min_input).val(ui.values[0]);
                $(max_input).val(ui.values[1]);
            }
        });
    });
}

// initializeSliders function when the page loads
$(document).ready(function() {
    if ($(".slider-input").length > 0) {
        initializeSliders();
    }
});



