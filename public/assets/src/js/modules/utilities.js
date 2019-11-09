/*
    Filename    : utilities.js
    Location    : public/assets/js/utilities.js
    Purpose     : Extend jquery functions
    Created     : 11/01/2019 22:42:41 by rpbaguio
    Updated     : 
    Changes     : 
*/

let baseURL = 'http://localhost/evs.web';
let apiURL = 'http://localhost/evs.api';

$.fn.extend({
    baseURL: function() {
        return baseURL;
    },
    apiURL: function() {
        return apiURL;
    },
    preloader: function() {
        return this.html(
            '<div class="loader">' +
            '  <svg class="circular" viewBox="25 25 50 50">' +
            '    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>' +
            '  </svg>' +
            '</div>');
    },
    activeList: function () {
        let str = location.href.toLowerCase();
        $('.sidebar-nav li a').each(function () {
            if (str.indexOf(this.href.toLowerCase()) > -1) {
                $('.sidebar-nav li.active').removeClass('active');
                $(this).parent().addClass("active");
            }
        });
        $('.sidebar-nav li.active').parents().each(function () {
            if ($(this).is('li')) {
                $(this).addClass('active');
            }
        });
    },
    togglePassword: function () {
        let _this = $('.access-code');
        _this.find('span').on('click', function (e) {
            if (_this.find('input').attr('type') === 'text') {
                _this.find('input').attr('type', 'password');
                _this.find('span').text('show');
            } else if (_this.find('input').attr('type') === 'password') {
                _this.find('input').attr('type', 'text');
                _this.find('span').text('hide');
            }
            e.preventDefault();
        });
    },
    disableContextMenu: function () {
        let el = $('body');
        // Disable context menu (right click menu)
        el.bind("contextmenu", function (e) {
            e.preventDefault();
        });
        // Disable highlighting
        el.bind("selectstart", function (e) {
            e.preventDefault();
        });
    },
    toastr: function (notif_msg, notif_title, notif_type, notif_position, notif_timeout) {
        let message = notif_msg;
        let title = notif_title;
        let type = notif_type;
        let position = notif_position;
        let timeout = notif_timeout;
        toastr[type](message, title, {
            positionClass: position,
            closeButton: "toastr-close",
            progressBar: "toastr-progress-bar",
            newestOnTop: "toastr-newest-on-top",
            rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
            timeOut: timeout
        });
    },
    groupsDDL: function () {
        let _this = $('select[name="group_id"]');

        _this.select2({
            ajax: {
                url: apiURL + '/groups/',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term
                    }
                    return query;
                },
                processResults: function (data) {
                    return {results: data};
                }
            }
        });
    },
    positionsDDL: function () {
        let _this = $('select[name="position_id"]');

        _this.select2({
            ajax: {
                url: apiURL + '/positions/',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term
                    }
                    return query;
                },
                processResults: function (data) {
                    return {results: data};
                }
            }
        });
    },
    select2Helper: function() {
        $('input[name="is_candidate"]').on('change', function(){
            if($('input[name="is_candidate"]:checked').val() == 0) {
                $('select[name="position_id"]').append('<option value="0" selected>&mdash;</option>');
            } else {
                $('select[name="position_id"]').append('<option value="" selected></option>');
            }
        });
    },
    qrcodeGenerator: function() {
        $('input[name="access_code"]').change(function(){
            // Get access code from user input
            let access_code = $('input[name="access_code"]').val()
            
            // Set hidden input value from user input
            $('input:hidden[name="qrcode"]').val(access_code);

            $.get(apiURL + '/qrcode_generator/?access_code=' + access_code, function (data) {
                // Append generated qrcode to DOM
                $('.qrcode').html(
                    '<img src="' + data.qrcode_url  + '" alt="' + data.access_code + '" />'
                );
            });
        });
    }
});