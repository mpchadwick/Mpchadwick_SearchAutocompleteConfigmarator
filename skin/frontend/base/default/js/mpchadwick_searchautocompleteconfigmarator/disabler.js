if (typeof Varien.searchForm != 'undefined') {
    // Rather than modifying the controller, or block let's stop it here
    // so the request never even gets dispatched
    Varien.searchForm.addMethods({
        initAutocomplete : function(url, destinationElement) {
            return false;
        }
    })
}