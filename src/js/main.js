import 'jquery';
import 'bootstrap';
import 'nette.ajax.js';
import '../sass/main.sass';

$(function() {

    $.nette.init();
    window.Nette.init();

    $(document).ajaxStart(function() {
        $('#ajaxStatus').fadeIn();
    });

    $(document).ajaxComplete(function(e) {
        $('#ajaxStatus').fadeOut();
    });
});