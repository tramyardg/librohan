const scrollTop = function () {
    $(document).scrollTop(0);
};
const refreshTimer = function (sec, id, func) {
    $('.alert-warning').remove();
    let time = sec;
    id.html(time);
    setInterval(function () {
        time--;
        id.html(time);
        // 1 second delay before actual reload
        if (time === 1) {
            location.reload();
            func();
        }
    }, 1000);
};
const disableInputSubmit = function (id) {
    id.attr("disabled", true)
};
const reloadPage = (pageUrl, sec, secContainer) => {
    secContainer.parent().removeClass('d-none');
    refreshTimer(sec, secContainer, function () {
        let locHref = location.href;
        let siteRoot = locHref.substring(0, locHref.lastIndexOf('/'));
        let homePageLink = siteRoot + '/' + pageUrl;
        window.location.replace(homePageLink);
    });
};
const bookCategory = {
    "0": "Biography",
    "1": "Fiction",
    "2": "History",
    "3": "Mystery",
    "4": "Suspense",
    "5": "Thriller"
};
Date.prototype.toDateInputValue = (function() {
    let local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
const arrSum = arr => arr.reduce((a,b) => a + b, 0);
const round2Dec = (num) => {
    return (Math.round(num * 100) / 100);
};