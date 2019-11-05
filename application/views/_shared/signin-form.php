<div class="modal fade" id="loginModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="login-form">
                <div class="modal-body px-5">
                    <div id="ajax-preloader"></div>
                    <div class="logo text-center my-5">
                        <!-- This where the logo load -->
                    </div>
                    <div class="form-group access-code">
                        <div class="input-group">
                            <input type="password" class="form-control" id="access_code" name="access_code" value="<?=set_value('access_code')?>" maxlength="10" placeholder="ACCESS CODE" autocomplete="current-password">
                            <div class="input-group-append"><span class="input-group-text">show</span></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-5">
                    <button type="submit" class="btn btn-primary btn-lg btn-block rounded-pill px-5 btn-change-state text-uppercase">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS libraries -->
<script type="text/javascript" src="<?= base_url('public/assets/dist/js/app.js') ?>"></script>

<script type="text/javascript">
    $(function () {
        
        let baseURL = $.fn.baseURL();
        let apiURL = $.fn.apiURL();

        // POST: Login
        let login = {
            init: function () {
                this.autoFocus();
                this.bindForm();
            },
            autoFocus: function() {
                $('#loginModal').on('shown.bs.modal', function(){
                    $(this).find('input[name="access_code"]').trigger('focus');
                });
            },
            bindForm: function () {
                $('#loginModal').on('show.bs.modal', this.submitForm());
            },
            submitForm: function () {
                $('#login-form').on('submit', function (e) {

                    let _this = $(this);

                    let jqXHR = $.ajax({
                        url: baseURL + '/auth/login',
                        type: 'POST',
                        dataType: 'json',
                        data: _this.serialize(),
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            _this.find('#ajax-preloader').preloader().show();
                            _this.find('.btn-change-state').attr('disabled', 'disabled');
                        }
                    });

                    jqXHR.done(function (data) {
                        if (data.status === true) {
                            window.location.replace(baseURL + '/auth');
                        } else {
                            // Error msg response
                            $.fn.toastr(data.message, 'Notification', 'error', 'toast-top-right', 3600);
                            (Boolean(data.access_code)) ? _this.find('input[name="access_code"]').addClass('is-invalid') : _this.find('input[name="access_code"').removeClass('is-invalid');
                        }
                    });

                    jqXHR.always(function () {
                        _this.find('#ajax-preloader').preloader().hide();
                        _this.find('.btn-change-state').removeAttr('disabled');
                    });

                    jqXHR.fail(function (jqXHR, textStatus, errorThrown) {
                        console.log('The following error occurred: ' + textStatus, errorThrown);
                    });

                    e.preventDefault();
                });
            }
        };

        // Functions
        let app = {
            init: function () {
                this.logo(); // Login logo
                $.fn.togglePassword(); // Show or hide password
                $.fn.disableContextMenu(); // Disable browser context menu and highlighting
                $('#loginModal').modal(); // Show login modal
            },
            logo: function () {
                $.get(apiURL + '/settings', function (data) {
                    $('#loginModal').find('.logo').html(
                        '<img src="' + data.logo + '" alt="' + data.header + '"/>'
                    );
                });
            }
        }

        // Call functions
        login.init();
        app.init();
    });
</script>

</body>
</html>