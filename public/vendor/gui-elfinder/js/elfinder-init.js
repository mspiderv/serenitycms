// Documentation for client options:
// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
$().ready(function() {
    $('.elfinder').each(function() {
        $(this).elfinder({
            // set your elFinder options here
            customData: {
                _token: variables['csrfToken']
            },
            url: variables['elfinderConnectorURL']
        });
    });
});