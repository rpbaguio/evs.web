<div class="wrapper">
    <!-- Sidebar -->
    <?= $this->load->view('_shared/sidebar', '', true) ?>
    <!-- End of sidebar -->
    <div class="main">
        <!-- Topbar -->
        <?= $this->load->view('_shared/topbar', '', true) ?>
        <!-- End of topbar -->
        <main class="content">
            <div class="container-fluid p-0">
                <div id="settings" class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title"><?= $page_title ?></h3>
                                <h4 class="card-subtitle"><?= $page_subtitle ?></h4>
                            </div>
                            <form id="update-form">
                                <div class="card-body">
                                    <div id="ajax-preloader"></div>
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label for="header">Header</label>
                                        <input type="text" class="form-control" id="header" name="header">
                                    </div>
                                    <div class="form-group">
                                        <label for="slogan">Slogan</label>
                                        <input type="text" class="form-control" id="slogan" name="slogan">
                                    </div>
                                    <div class="form-group">
                                        <label for="footer">Footer</label>
                                        <input type="text" class="form-control" id="footer" name="footer">
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <input type="text" class="form-control" id="logo" name="logo">
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 btn-change-state">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <?= $this->load->view('_shared/footer', '', true) ?>
        <!-- End of footer -->
    </div>
</div>

<!-- JS libraries -->
<script type="text/javascript" src="<?= base_url('public/assets/dist/js/app.js') ?>"></script>

<script type="text/javascript">
    $(function () {

        let baseURL = $.fn.baseURL();
        let apiURL = $.fn.apiURL();

        // GET: Display by id
        let getById = {
            init: function() {
                this.displayForm();
            },
            displayForm: function() {
                let _this = $('#settings');

                let jqXHR = $.ajax({
                    url: baseURL + '/admin/settings/setting/?id=1',
                    type: 'GET',
                    dataType: 'json',
                    data: _this.serialize(),
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        _this.find('#ajax-preloader').preloader().show();
                    }
                });

                jqXHR.done(function (data) {
                    if (data) {
                        // Populate form
                        _this.find('input:hidden[name="id"]').val(data.id);                                 
                        _this.find('input[name="header"]').val(data.header);
                        _this.find('input[name="slogan"]').val(data.slogan);
                        _this.find('input[name="footer"]').val(data.footer);
                        _this.find('input[name="logo"]').val(data.logo);
                    }
                });

                jqXHR.always(function () {
                    _this.find('#ajax-preloader').preloader().hide();
                });

                jqXHR.fail(function (jqXHR, textStatus, errorThrown) {
                    console.log('The following error occurred: ' + textStatus, errorThrown);
                });
            }
        }

        // PUT: Update
        let update = {
            init: function() {
                this.submitForm();
            },
            submitForm: function() {
                $('#update-form').on('submit', function(e){
                    
                    let _this = $(this);

                    let id = _this.find('input:hidden[name="id"]').val();
                
                    let jqXHR = $.ajax({
                        url: baseURL + '/admin/settings/update/id/' + id,
                        type: 'PUT',
                        dataType: 'json',
                        data: _this.serialize(),
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            _this.find('#ajax-preloader').preloader().show();
                            _this.find('.btn-change-state').attr('disabled', 'disabled');
                        }
                    });

		            jqXHR.done(function(data) {
                        if (data.status === true) {
                         
                        // Reset form
                        _this.find('.form-control').removeClass('is-invalid');

                        // Success msg response
                        $.fn.toastr(data.message, 'Notification', 'success', 'toast-top-right', 3600);
                        } else {
                            // Error msg response
                            $.fn.toastr(data.message, 'Notification', 'error', 'toast-top-right', 3600);
                            (Boolean(data.header)) ? _this.find('#header').addClass('is-invalid') : _this.find('#header').removeClass('is-invalid');
                            (Boolean(data.slogan)) ? _this.find('#slogan').addClass('is-invalid') : _this.find('#slogan').removeClass('is-invalid');
                            (Boolean(data.footer)) ? _this.find('#footer').addClass('is-invalid') : _this.find('#footer').removeClass('is-invalid');
                            (Boolean(data.logo)) ? _this.find('#logo').addClass('is-invalid') : _this.find('#logo').removeClass('is-invalid'); 
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
        }

        let app = {
            init: function() {
                $.fn.activeList();
            }
        }

        getById.init();
        update.init();
        app.init();
    });
</script>

</body>
</html>