/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');

// Sidebar

function changeCurrentByService(object) {
    var service = object.val();
    var extra = object.data('extra');
    var selectBox = $("#company-id");
    var servicePrice = $("#service-price");
    var current = $("#current-id");
    selectBox.html("");

    for (var company in extra.companies) {

        $("<option />", {value: company, text: extra.companies[company]}).appendTo(selectBox);
    }
    selectBox.show();

    servicePrice.show();

    servicePrice.val(null).prop('disabled', extra.free);
    current.val(extra.free ? extra.free : null);
}


$(document).ready(function () {

    /* Choose unlimited */
    var unlimited = $("#unlimited");
    if (unlimited.length > 0)
    {
        if (unlimited.is(':checked'))
        {
            $("#amount").val(0).prop('disabled', true);
        }

        unlimited.on('change', function() {
            if (unlimited.is(':checked'))
            {
                $("#amount").val("0").prop('disabled', true);
            } else {
                $("#amount").val("").prop('disabled', false);
            }
        });
    }
    /* END */

    /* Choose Service and Change Company Select */
    var selectRadios = $(".service-radio");

    if (selectRadios.length > 0) {
        var atLeastOne = $(".service-radio:checked");
        if (atLeastOne.val()) {
            changeCurrentByService(atLeastOne);
        }
    }
    selectRadios.on('change', function () {
        changeCurrentByService($(this));
    });
    /* END */


    /* Delete Item */
    $('.delete-it button').on('click', function (e) {
        e.preventDefault();
        var DeleteForm = $(this).parent('form');
        swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    DeleteForm.submit();
                }
                else {
                    return false;
                }
            });
    });

    /* Check All CheckBox */
    $("#select_all").change(function () {  //"select all" change
        var status = this.checked; // "select all" checked status

        $('.check-box').each(function () { //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
    });

    $('.check-box').change(function () {
        if (this.checked == false) { //if this item is unchecked
            $("#select_all")[0].checked = false; //change "select all" checked status to false
        }
        if ($('.check-box:checked').length == $('.check-box').length) {
            $("#select_all")[0].checked = true; //change "select all" checked status to true
        }
    });

    /* Show packages of order in table view */
    $(".table-striped > tbody > tr.order").on('click', function () {
        var id = $(this).data('id');
        $(".packages_of_" + id).toggle();
    })

    /* Date Range*/
    if ($('#daterange').length > 0) {

        var startDate = $("input[name='start_date']").val();
        var endDate = $("input[name='end_date']").val();
        if (startDate != '') {
            var start = moment(startDate);
            var end = moment(endDate);
        }
        else {
            var start = moment().subtract(29, 'days');
            var end = moment();
        }


        function cb(start, end) {
            $('#daterange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            $("input[name='start_date']").val(start.format('YYYY-MM-DD'));
            $("input[name='end_date']").val(end.format('YYYY-MM-DD'));
        }

        $('#daterange').daterangepicker({
            startDate: start,
            endDate: end,
            minDate: "01/01/2016",
            ranges: {
                'Bu gün': [moment(), moment()],
                'Dünən': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Son 7 Gün': [moment().subtract(6, 'days'), moment()],
                'Son 30 Gün': [moment().subtract(29, 'days'), moment()],
                'Bu ay': [moment().startOf('month'), moment().endOf('month')],
                'Bu İl': [moment().startOf('year'), moment()]
            },
            showDropdowns: true,
            autoApply: true,
            locale: {
                "format": "MM/DD/YYYY",
                "separator": " - ",
                "applyLabel": "Seç",
                "cancelLabel": "Ləğv",
                "fromLabel": "-DAN",
                "toLabel": "-DƏK",
                "customRangeLabel": "Xüsusi",
                "weekLabel": "H",
                "daysOfWeek": [
                    "Be",
                    "Ça",
                    "Ç",
                    "Ca",
                    "C",
                    "Ş",
                    "B"
                ],
                "monthNames": [
                    "Yanvar",
                    "Fevral",
                    "Mart",
                    "Aprel",
                    "May",
                    "İyun",
                    "İyul",
                    "Avqust",
                    "Sentyabr",
                    "Oktyabr",
                    "Noyabr",
                    "Dekabr"
                ],
                "firstDay": 1
            },
            "showCustomRangeLabel": false
        }, cb);

        cb(start, end);
    }

    /* Rating plugin */
    if ($('.stars-existing').length > 0) {
        $('.stars-existing').starrr({
            rating: 5
        });

        $('.stars-existing').on('starrr:change', function (e, value) {
            $("#amount").val(value);
            $('.stars-count-existing').html(value);
        });
    }

    /* Auto map picker */
    var selectAddress = $("#changeAddress");

    if (selectAddress.length > 0) {

        /* Get first selected address */
        var currentAddress = selectAddress.find(":selected").data('content');
        var contentOfAddress = $("#addressContent");

        if (contentOfAddress.data('type') == 'id')
            changeAddressContent(currentAddress);

        selectAddress.on("change", function () {
            var content = $("option:selected", this).data('content')
            if (content != "") {
                changeAddressContent(content);
            }

        });
    }

    /* Increase and decrease numeric input */
    if ($(".numeric").length > 0) {
        $(".numeric button").on("click", function (e) {
            e.preventDefault();
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();

            if ($button.data('type') == "+") {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }

            $button.parent().find("input").val(newVal);

        });
    }


    if ($('.fileinput').length > 0) {
        $('.fileinput').fileinput()
    }


    $(":input").inputmask();

    /* Disable enter submit on form */
    $('form:not(".can-enter")').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    /* Map Picker */
    if ($("#lat").length > 0) {
        var addressChanged = false;

        $("input[name='address']").on("change", function () {
            addressChanged = true;
        });

        var lat = $('#lat').val();
        var long = $('#lng').val();
        $('#us2').locationpicker({
            location: {latitude: lat, longitude: long},
            radius: false,
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                radiusInput: null,
                locationNameInput: $('#us2-address')
            },
            enableAutocomplete: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                var inputAddress = $("input[name='address']").val();
                if (inputAddress == '' || !addressChanged) {
                    $("input[name='address']").val($("#us2-address").val());
                }
                //$("#location").val(currentLocation.latitude + ", " + currentLocation.longitude);
            }
        });

        $("#getLocation").on("click", function (e) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                        $('#lat').focus();
                        $('#lat').val(position.coords.latitude);
                        $('#lng').val(position.coords.longitude);
                        $(document).focus();
                    }, function () {
                        alert("Settinglərdə locationu aktiv edin!");
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                alert("Sizin browser bunu dəstəkləmir!");
            }
            e.preventDefault();
        });
    }

    // TODO: This is some kind of easy fix, maybe we can improve this
    var setContentHeight = function () {
        // reset height
        $RIGHT_COL.css('min-height', $(window).height());

        var bodyHeight = $BODY.height(),
            leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
            contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

        // normalize content
        contentHeight -= $NAV_MENU.height() + $FOOTER.height();

        $RIGHT_COL.css('min-height', contentHeight);
    };

    $SIDEBAR_MENU.find('a').on('click', function (ev) {
        var $li = $(this).parent();

        if ($li.is('.active')) {
            $li.removeClass('active');
            $('ul:first', $li).slideUp(function () {
                setContentHeight();
            });
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active');
                $SIDEBAR_MENU.find('li ul').slideUp();
            }

            $li.addClass('active');

            $('ul:first', $li).slideDown(function () {
                setContentHeight();
            });
        }
    });

    // toggle small or large menu
    $MENU_TOGGLE.on('click', function () {
        if ($BODY.hasClass('nav-md')) {
            $BODY.removeClass('nav-md').addClass('nav-sm');

            if ($SIDEBAR_MENU.find('li').hasClass('active')) {
                $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
            }
        } else {
            $BODY.removeClass('nav-sm').addClass('nav-md');

            if ($SIDEBAR_MENU.find('li').hasClass('active-sm')) {
                $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
            }
        }

        setContentHeight();
    });

    // check active menu
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

    $SIDEBAR_MENU.find('a').filter(function () {
        return this.href == CURRENT_URL;
    }).parent('li').addClass('current-page').parents('ul').slideDown(function () {
        setContentHeight();
    }).parent().addClass('active');

    // recompute content when resizing
    $(window).smartresize(function () {
        setContentHeight();
    });

    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true,
            theme: 'minimal',
            mouseWheel: {preventDefault: true}
        });
    }
});
// /Sidebar

// Panel toolbox
$(document).ready(function () {
    $('.collapse-link').on('click', function () {
        var $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');

        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function () {
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css('height', 'auto');
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
});
// /Panel toolbox

// Tooltip
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
});
// /Tooltip

// Progressbar
if ($(".progress .progress-bar")[0]) {
    $('.progress .progress-bar').progressbar(); // bootstrap 3
}
// /Progressbar

// Switchery
$(document).ready(function () {
    if ($(".js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#26B99A'
            });
        });
    }

    if ($("input.flat").length) {

        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    }
});
// /iCheck

// Table
$('table input').on('ifChecked', function () {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('table input').on('ifUnchecked', function () {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});

var checkState = '';

$('.bulk_action input').on('ifChecked', function () {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
    checkState = 'all';
    countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
    checkState = 'none';
    countChecked();
});

function countChecked() {
    if (checkState === 'all') {
        $(".bulk_action input[name='table_records']").iCheck('check');
    }
    if (checkState === 'none') {
        $(".bulk_action input[name='table_records']").iCheck('uncheck');
    }

    var checkCount = $(".bulk_action input[name='table_records']:checked").length;

    if (checkCount) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(checkCount + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}

// Accordion
$(document).ready(function () {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

// NProgress
if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    });
}

/**
 * Resize function without multiple trigger
 *
 * Usage:
 * $(window).smartresize(function(){  
 *     // code here
 * });
 */
(function ($, sr) {
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
        var timeout;

        return function debounced() {
            var obj = this, args = arguments;

            function delayed() {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            }

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100);
        };
    };

    // smartresize 
    jQuery.fn[sr] = function (fn) {
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
    };

})(jQuery, 'smartresize');