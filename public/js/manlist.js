var AlertMessagesWidget = {
    container:     $('#alert-messages'),
    alertMessages: $('#alert-messages span'),
    closeButton:   $('#alert-messages .close'),
    hideDuration:  400,
    hidePause:     3000,

    init: function() {
        this.container.on('click', function() {
            AlertMessagesWidget.container.hide(this.hideDuration);
        });
    },

    message: function(message) {
        this.init();
        this.clear();
        this.alertMessages.html(message);
        this.show();
    },

    notice: function(message) {
        this.message(message);
        this.container.removeClass('warning');
        this.container.addClass('success');
        setTimeout(function() {
            AlertMessagesWidget.hide();
        }, this.hidePause);
    },

    clear: function() {
        this.alertMessages.html('');
    },

    show: function() {
        this.alertMessages.parent().show();
    },

    hide: function(duration) {
        if (typeof duration === "undefined") {
            duration = AlertMessagesWidget.hideDuration;
        }

        this.alertMessages.parent().hide(duration);
    }
};

var FilterWidget = {
    settings: {
        nameCountVal:    $('#name-count-val'),
        nameCountLabel:  $('#name-count-label'),
        nameCountLetter: $('#name-count-letter'),
        tempLetter:      '',
        filterStyle:     $('#filter-style'),
        filter:          $('#filter'),
        filterCtr:       $('.ctr-filter'),
        filterHelp:      $('.ctr-filter-help'),
        filterHelpIcon:  $('.ctr-filter-help i'),
    },

    nameCount: function() {
        var obj = this.settings;
        var names;

        if (obj.nameCountVal.length) {
            names = $('.man-name:visible');
            obj.nameCountVal.html(names.length);
        }

        return Number(names.length);
    },

    init: function() {
        var obj = this.settings;

        if (obj.nameCountVal.length) {
            this.bindListener();
            this.nameCount();
        }
    },

    bindListener: function() {
        var obj        = this.settings,
            helpIcon   = $('.ctr-filter i');

        obj.filter.on('keyup', function() {
            FilterWidget.filter();
        });

        helpIcon.on('click', function() {
            obj.filterHelp.animate({
                height: '3.75rem'
            });
        });

        obj.filterHelp.find('a').on('click', function(e) {
            obj.filter.focus();
            e.preventDefault();
        });

        // Clear Filter
        obj.filterCtr.find('a').on('click', function(e) {
            obj.filter.val('');
            obj.filter.focus();
            FilterWidget.filter();
            e.preventDefault();
        });
    },

    filter: function() {
        var obj = this.settings,
            tempLetter = obj.nameCountLetter.html(),
            nameCount  = 0;

        if (!obj.filter.val()) {
            obj.filterStyle.html("");
            obj.nameCountLabel.html('Names begin with: ');
            obj.nameCountLetter.html(tempLetter);
            FilterWidget.nameCount();
            return;
        }

        obj.filterStyle.html(".searchable:not([data-index*=\"" + obj.filter.val().toLowerCase() + "\"]) { display: none; }");
        nameCount = Number(FilterWidget.nameCount());
        obj.nameCountLabel.html('Name' + (nameCount === 1 ? '' : 's') + ' contain' + (nameCount === 1 ? 's' : '') + ': ');
        obj.nameCountLetter.html(obj.filter.val());
    }
};

// var LoginWidget = {
//     settings: {
//         formLogin:     $('#form-login'),
//         buttonLogin:   $('#button-login')
//     },

//     init: function() {
//         this.bindListener();
//     },

//     bindListener: function() {
//         var obj      = this,
//             settings = this.settings;

//         settings.buttonLogin.on('click', function() {
//             if (obj.validateFields() === true) {
//                 settings.formLogin.submit();
//             }
//         });
//     },

//     validateFields: function() {
//         return true;
//     }
// };

var PageWidget = {
    init: function() {
        $('#back-to-top').on('click', function() {
            $("html, body").animate({ scrollTop: 0 }, 300);
        });

        var isVisible = false;
        $(window).scroll(function(){
            var shouldBeVisible = $(window).scrollTop()>200;
            if (shouldBeVisible && !isVisible) {
                isVisible = true;
                $('#back-to-top').animate({
                    opacity: 1
                });
            } else if (isVisible && !shouldBeVisible) {
                isVisible = false;
                $('#back-to-top').animate({
                    opacity: 0
                });
            }
        });

    }
};

var AddWidget = {
    settings: {
        formNameAdd:    $('#form-name-add'),
        buttonNameAdd:  $('#button-name-add'),
        fieldNameAdd:   $('#field-name-add'),
        alertMessages:  $('#alert-messages'),
        error:          ''
    },

    init: function() {
        this.bindListener();
    },

    bindListener: function() {
        var obj      = this,
            settings = this.settings;

        settings.buttonNameAdd.on('click', function() {
            if (obj.validateFields() === false) {
                AlertMessagesWidget.message(settings.error);
                return;
            }


            settings.formNameAdd.submit();
        });
    },

    validateFields: function() {
        var settings     = this.settings,
            fieldNameAdd = settings.fieldNameAdd.val(),
            regExp   = /mann?$/g;

        if (fieldNameAdd === '') {
            settings.error = 'You need to enter a "Man" name to add...';
            return false;
        }

        if (regExp.test(fieldNameAdd) === false) {
            settings.error = 'The name needs to end in "man" or "mann"...';
            return false;
        }

        return true;
    }
};

$(document).ready(function() {
    var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);

    if (isSafari) {
        $('html').addClass('safari-browser');
    }

    FilterWidget.init();
    AddWidget.init();
    PageWidget.init();
});
