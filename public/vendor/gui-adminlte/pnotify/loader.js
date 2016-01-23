window.notify = {

    self: this,

    open: function (title, message, type)
    {
        // Set defaults
        if (typeof title == "undefined") title = "";
        if (typeof message == "undefined") message = "";
        if (typeof type == "undefined") type = "notice";

        return new PNotify({
            title: title,
            text: message,
            type: type,
            delay: 2000,
            animate_speed: 'fast'
        });
    },

    notice: function (title, message)
    {
        return window.notify.open(title, message, 'notice');
    },

    success: function (title, message)
    {
        return window.notify.open(title, message, 'success');
    },

    error: function (title, message)
    {
        return window.notify.open(title, message, 'error');
    },

    info: function (title, message)
    {
        return window.notify.open(title, message, 'info');
    }

};