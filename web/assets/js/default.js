define(['jquery', 'bootstrap', 'domReady!'], function ($, Boots) {
    
    /**
     * Adds a message in divs used to display flashbags
     * Display error or other notice
     * @param {string} sMessageType : error or other
     * @param {string} sMessage : message to display
     * @returns {undefined}
     */
    function displayMessage(sMessageType, sMessage) {
        var noticeClass = sMessageType === 'error' ? '.error-notice' : '.other-notice';
        
        // Remove all previous messages
        $(noticeClass).empty();
        
        // Add new message
        $(noticeClass).append('<p>' +sMessage +'</p>');
    }
});
