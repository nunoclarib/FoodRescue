function pageScroll() {
    var height = document.body.scrollHeight;
    window.scrollTo(0, height); // horizontal and vertical scroll increments
}
scrolldelay = setTimeout('pageScroll()',1000); // scrolls every 100 milliseconds