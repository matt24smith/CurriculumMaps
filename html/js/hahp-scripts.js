/* Hamburger menu functionality https://bootstrapious.com/p/bootstrap-sidebar */
$(document).ready(function () {
    $('#sidebarToggle').on('click touch', function () {
        $('#sidebar').toggleClass('visible');
        $('#overlay').toggleClass('dim');
    });
});