var AlertMessagesWidget = {
    alertMessages: $('#alert-messages span'),
    closeButton:   $('#alert-messages .close'),

    init: function() {
        this.closeButton.on('click', function() {
            window.alert('hi');
        });
    },

    message: function(message) {
        this.init();
        this.clear();
        this.alertMessages.html(message);
        this.show();
    },

    clear: function() {
        this.alertMessages.html('');
    },

    show: function() {
        this.alertMessages.parent().show();
    },

    hide: function() {
        this.alertMessages.parent().hide();
    }
};

var FilterWidget = {
    settings: {
        nameCountVal:    $('#name-count-val'),
        nameCountLabel:  $('#name-count-label'),
        nameCountLetter: $('#name-count-letter'),
        tempLetter:      '',
        filterStyle:     $('#filter-style'),
        filter:          $('#filter')
    },

    nameCount: function() {
        var obj = this.settings;
        var names;

        if (obj.nameCountVal.length) {
            names = $('.man-name:visible');
            obj.nameCountVal.html(names.length);
        }

        return names.length;
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
            tempLetter = obj.nameCountLetter.html(),
            nameCount  = 0;

        obj.filter.on('keyup', function() {

            if (!this.value) {
                obj.filterStyle.html("");
                obj.nameCountLabel.html('Names begin with: ');
                obj.nameCountLetter.html(tempLetter);
                FilterWidget.nameCount();
                return;
            }

            obj.filterStyle.html(".searchable:not([data-index*=\"" + this.value.toLowerCase() + "\"]) { display: none; }");
            nameCount = FilterWidget.nameCount();
            obj.nameCountLabel.html('Name' + (nameCount === '1' ? '' : 's') + ' contain' + (nameCount === '1' ? 's' : '') + ': ');
            obj.nameCountLetter.html(this.value);
        });
    }
};

var AddWidget = {
    settings: {
        formNameAdd:    $('#form-name-add'),
        buttonNameAdd:  $('#button-name-add'),
        fieldNameAdd:   $('#field-name-add'),
        alertMessages:  $('#alert-messages')
    },

    init: function() {
        this.bindListener();
    },

    bindListener: function() {
        var obj      = this,
            settings = this.settings;

        settings.buttonNameAdd.on('click', function() {
            if (obj.validateFields() === false) {
                AlertMessagesWidget.message('You need to enter a "Man" name to add...');
                return;
            }

            settings.formNameAdd.submit();
        });
    },

    validateFields: function() {
        var settings = this.settings;

        if (settings.fieldNameAdd.val() === '') {
            return false;
        }

        return true;
    }
};

$(document).ready(function() {
    FilterWidget.init();
    AddWidget.init();
});
