(function (factory) {
    "use strict";
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    }
    else if(typeof module !== 'undefined' && module.exports) {
        module.exports = factory(require('jquery'));
    }
    else {
        factory(jQuery);
    }
}(function ($, undefined) {
    $(document).ready(function () {
        $("a[href*='admin.php?page=Poptin-support']").on("click", function (e) {
            e.preventDefault();
            setTimeout(function () {
                window.open(poptin_settings.support_link, "_blank");
            })
        })
    });
}));