<div class="wrapper">
    <!-- Sidebar -->
    <?= $this->load->view('_shared/sidebar', '', true) ?>
    <!-- End of sidebar -->
    <div class="main">
        <!-- Topbar -->
        <?= $this->load->view('_shared/topbar', '', true) ?>
        <!-- End of topbar -->
        <!-- Content -->
        <main class="content">
            <div class="container-fluid p-0">
                <div id="persons" class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="clearfix">
                                    <form class="form-inline float-right mt-1 d-none d-md-flex">
                                        <a class="btn btn-primary mr-2" data-toggle="modal" href="#create">
                                            <i class="align-middle" data-feather="plus"></i> Add New
                                        </a>
                                        <a id="reload" class="btn btn-primary" href="javascript:void(0)">
                                            <i class="align-middle" data-feather="rotate-ccw"></i> Reload
                                        </a>
                                    </form>
                                    <h3 class="card-title mb-2"><?= $page_title ?></h3>
                                    <h4 class="card-subtitle"><?= $page_subtitle ?></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatables__default" class="table table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Group</th>
                                            <th>Is Validated</th>
                                            <th>Is Voted</th>
                                            <th>Created</th>
                                            <th>Modified</th>                                                         
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </main>
        <!-- End of content -->
        <!-- Footer -->
        <?= $this->load->view('_shared/footer', '', true) ?>
        <!-- End of footer -->
    </div>
</div>

<!-- Create modal -->
<div class="modal fade" id="create" data-backdrop="static" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="createModalTitle">Create</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="create-form">
                <div class="modal-body px-5">
                    <div id="ajax-preloader"></div>
                    <div class="row">
                        <div class="col-4 col-lg-4">
                            <div class="form-group">
                                <label for="prefix">Prefix</label>
                                <select class="form-control" name="prefix">
                                    <option value="" selected>&mdash;</option>
                                    <option value="Fr.">Fr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Bro.">Bro.</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Engr.">Engr.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Arch.">Arch.</option>
                                    <option value="Atty.">Atty.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-8 col-lg-8">
                            <div class="form-group">
                                <label for="first-name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first-name" name="first_name" value="<?= set_value('first_name') ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8">
                            <div class="form-group">
                                <label for="last-name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last-name" name="last_name" value="<?= set_value('last_name') ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-4 col-lg-4">
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control" id="suffix" name="suffix" value="<?= set_value('suffix') ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="create-group">Group <span class="text-danger">*</span></label>
                                <select id="create-group" class="form-control" name="group_id">
                                    <option value="" selected>&mdash;</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 col-lg-4">
                            <div class="form-group">
                                <label for="group">Is Candidate? <span class="text-danger">*</span></label><br/>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="create-is-candidate1" name="is_candidate" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="create-is-candidate1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="create-is-candidate2" name="is_candidate" class="custom-control-input" value="0">
                                    <label class="custom-control-label" for="create-is-candidate2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 col-lg-8">
                            <div class="form-group">
                                <label for="create-position">Position</label>
                                <select id="create-position" class="form-control" name="position_id">
                                    <option value="0" selected>&mdash;</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-6">
                            <div class="form-group">
                                <label for="group">Gender <span class="text-danger">*</span></label><br/>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="create-gender1" name="gender_id" class="custom-control-input" value="3">
                                    <label class="custom-control-label" for="create-gender1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="create-gender2" name="gender_id" class="custom-control-input" value="4">
                                    <label class="custom-control-label" for="create-gender2">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 btn-change-state">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of create modal -->

<!-- Update modal -->
<div class="modal fade" id="update" data-backdrop="static" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="updateModalTitle">Update</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="update-form">
                <div class="modal-body px-5">
                    <div id="ajax-preloader"></div>
                    <input type="hidden" name="id">
                    <input type="hidden" name="qrcode">
                    <div class="row">
                        <div class="col-6 col-lg-6">
                            <div class="form-group">
                                <label for="access-code">Access Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="access-code" name="access_code" maxlength="10" placeholder="">
                            </div>
                        </div>
                        <div class="col-6 col-lg-6">
                            <div class="qrcode text-center">
                                <!-- This is where the QR CODE load -->
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <hr/>
                        </div>
                        <div class="col-4 col-lg-4">
                            <div class="form-group">
                                <label for="prefix">Prefix</label>
                                <select class="form-control" name="prefix">
                                    <option value="" selected>&mdash;</option>
                                    <option value="Fr.">Fr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Bro.">Bro.</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Engr.">Engr.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Arch.">Arch.</option>
                                    <option value="Atty.">Atty.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-8 col-lg-8">
                            <div class="form-group">
                                <label for="first-name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first-name" name="first_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-8 col-lg-8">
                            <div class="form-group">
                                <label for="last-name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last-name" name="last_name" placeholder="">
                            </div>
                        </div>
                        <div class="col-4 col-lg-4">
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control" id="suffix" name="suffix" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label for="update-group">Group <span class="text-danger">*</span></label>
                                <select id="update-group" class="form-control" name="group_id">
                                    <option value="" selected>&mdash;</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- The first submit button prevent implicit submission of the form -->
                    <button type="submit" disabled style="display: none" aria-hidden="true"></button>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 btn-change-state">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of update modal -->

<!-- Delete modal -->
<div class="modal fade" id="delete" data-backdrop="static" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteModalTitle">Delete</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="delete-form">
                <input type="hidden" name="id">
                <div id="ajax-preloader"></div>
                <div class="modal-body p-5">
                    <p class="text-center m-0">
                        <!-- This is where the delete confirmation message load -->
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg btn-danger rounded-pill px-5 btn-change-state">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of delete modal -->

<!-- JS libraries -->
<script type="text/javascript" src="<?= base_url('public/assets/dist/js/app.js') ?>"></script>

<script type="text/javascript">
    $(function () {

        let baseURL = $.fn.baseURL();
        let apiURL = $.fn.apiURL();
        let isProcessing = false;

        // GET: Display all
        let getAll = {
            init: function() {
                this.displayTable();
                this.reloadTable();
            },
            displayTable: function() {
                let table = $('#datatables__default').DataTable({
                    "processing": true,
                    "serverSide": false,
                    "responsive": true,
                    "ajax": {
                        "url": baseURL + "/admin/persons/persons",
                        "type": "GET"
                    },
                    "columns": [
                        {
                            "searchable": false,
                            "data": null
                        },
                        {"data": "full_name"},
                        {"data": "group_long_name"},
                        {
                            searchable: false,
                            data: "is_validated",
                            mRender: function (data) {
                                return ((parseInt(data) === 1) ? '<span class="badge badge-info text-uppercase">yes</span>' : '<span class="badge badge-danger text-uppercase">no</span>');
                            }
                        },
                        {
                            searchable: false,
                            data: "is_voted",
                            mRender: function (data) {
                                return ((parseInt(data) === 1) ? '<span class="badge badge-info text-uppercase">yes</span>' : '<span class="badge badge-danger text-uppercase">no</span>');
                            }
                        },
                        {
                            "data": "dt_created",
                            "mRender": function (data) {
                                return (data === null) ?  '' : moment(data).format('lll');
                            }
                        },
                        {
                            "data": "dt_updated",
                            "mRender": function (data) {
                                return (data === null) ?  '' : moment(data).format('lll');
                            }
                        },                      
                        {
                            "searchable": false,
                            "data": "id",
                            "mRender": function (data) {
                                return '<a href="#update" data-toggle="modal" data-id="' + data + '" title="Update" ><i class="align-middle material-icons md-22">mode_edit</i></a>';
                            }
                        },
                        {
                            "searchable": false,
                            "data": "id",
                            "mRender": function (data) {
                                return '<a href="#delete" data-toggle="modal" data-id="' + data + '" title="Delete"><i class="align-middle material-icons md-22">remove_circle_outline</i></a>';
                            }
                        }
                    ],
                    "lengthMenu": [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
                    "order": [[1, "desc"]],
                    "columnDefs": [
                        {"orderable": false, "targets": [0, 7, 8]}
                    ]
                });

                table.on('order.dt search.dt', function() {
                    table.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();
            },
            reloadTable: function() {
                $('#reload').on('click', function (e) {
                    $('#datatables__default').DataTable().ajax.reload(null, true); // user paging will reset on reload				                                
                    e.preventDefault();
                })
            }
        }

        // GET: Display by id
        let getById = {
            init: function() {
                this.resetForm();
                this.displayForm();
                this.autoFocus();
            },
            resetForm: function() {
                $('#update').on('hidden.bs.modal', function(){
                    
                    let _this = $(this);

                    _this.find('form')[0].reset();
                    _this.find('.form-control').removeClass('is-invalid');
                    _this.find('option:selected').remove();
                    _this.find('.select2-selection').removeAttr('style');
                    _this.find('.qrcode img').remove();
                });
            },
            autoFocus: function() {
                $('#update').on('shown.bs.modal', function(){
                    $(this).find('input[name="access_code"]').trigger('focus');
                });
            },
            displayForm: function() {
                $('#update').on('show.bs.modal', function (e) {
                    
                    let _this = $(this);
                    let id = $(e.relatedTarget).attr('data-id');

                    let jqXHR = $.ajax({
                        url: baseURL + '/admin/persons/person/?id=' + id,
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
                            _this.find('select[name="prefix"]').append('<option value="' + data.prefix + '" selected>' + data.prefix + '</option>'); 
                            _this.find('input[name="first_name"]').val(data.first_name);
                            _this.find('input[name="last_name"]').val(data.last_name);
                            _this.find('select[name="suffix"]').append('<option value="' + data.suffix + '" selected>' + data.suffix + '</option>'); 
                            _this.find('select[name="group_id"]').append('<option value="' + data.group_id + '" selected>' + data.group_long_name + '</option>'); 
                            _this.find('select[name="position_id"]').append('<option value="' + data.position_id + '" selected>' + data.position_name + '</option>');
                        }
                    });

                    jqXHR.always(function () {
                        _this.find('#ajax-preloader').preloader().hide();
                    });

                    jqXHR.fail(function (jqXHR, textStatus, errorThrown) {
                        console.log('The following error occurred: ' + textStatus, errorThrown);
                    });
                });
            }
        }

        // POST: Add new
        let create = {
            init: function() {
                this.resetForm();
                this.autoFocus();
                this.bindForm();
            },
            resetForm: function() {
                $('#create').on('hidden.bs.modal', function(){

                    let _this = $(this);

                    _this.find('form')[0].reset();
                    _this.find('.form-control').removeClass('is-invalid');
                    _this.find('.custom-control-input').removeClass('is-invalid');
                    _this.find('.select2-selection').removeAttr('style');
                });
            },
            autoFocus: function() {
                $('#create').on('shown.bs.modal', function(){
                    $(this).find('input[name="first_name"]').trigger('focus');
                });
            },
            bindForm: function () {
                $('#create').on('show.bs.modal', this.submitForm());
            },
            submitForm: function() {

                // Prevent multiple ajax request
                if (isProcessing) return;
                isProcessing = true;

                $('#create-form').on('submit', function(e){

                    let _this = $(this);

                    let jqXHR = $.ajax({
                        url: baseURL + '/admin/persons/create',
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
                            // Reload datatables
                            $('#datatables__default').DataTable().ajax.reload(null, false); // user paging is not reset on reload

                            // Success msg response
                            $.fn.toastr(data.message, 'Notification', 'success', 'toast-top-right', 7200);
                            
                            // Hide this modal
                            $('#create').modal('hide');
                        } else {
                            // Error msg response
                            $.fn.toastr(data.message, 'Notification', 'error', 'toast-top-right', 3600);
                            (Boolean(data.first_name)) ? _this.find('input[name="first_name"]').addClass('is-invalid') : _this.find('input[name="first_name"]').removeClass('is-invalid'); 
                            (Boolean(data.last_name)) ? _this.find('input[name="last_name"]').addClass('is-invalid') : _this.find('input[name="last_name"]').removeClass('is-invalid');  
                            (Boolean(data.group_id)) ? _this.find('span[aria-labelledby="select2-create-group-container"]').css({'border':'1px solid #d9534f'}) : _this.find('span[aria-labelledby="select2-create-group-container"]').removeAttr('style'); 
                            (Boolean(data.is_candidate)) ? _this.find('input[name="is_candidate"]').addClass('is-invalid') : _this.find('input[name="is_candidate"]').removeClass('is-invalid');   
                            (Boolean(data.position_id)) ? _this.find('span[aria-labelledby="select2-create-position-container"]').css({'border':'1px solid #d9534f'}) : _this.find('span[aria-labelledby="select2-create-position-container"]').removeAttr('style');
                            (Boolean(data.gender_id)) ? _this.find('input[name="gender_id"]').addClass('is-invalid') : _this.find('input[name="gender_id"]').removeClass('is-invalid'); 
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

        // PUT: Update
        let update = {
            init: function() {
                this.bindForm();
            },
            bindForm: function () {
                $('#update').on('show.bs.modal', this.submitForm());
            },
            submitForm: function() {
                $('#update-form').on('submit', function(e){
                    
                    let _this = $(this);
                    let id = _this.find('input:hidden[name="id"]').val();

                    let jqXHR = $.ajax({
                        url: baseURL + '/admin/persons/update/id/' + id,
                        type: 'PUT',
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
                            // Reload datatables
                            $('#datatables__default').DataTable().ajax.reload(null, false); // user paging is not reset on reload

                            // Success msg response
                            $.fn.toastr(data.message, 'Notification', 'success', 'toast-top-right', 3600);
                            
                            // Hide this modal
                            $('#update').modal('hide');
                        } else {
                            // Error msg response
                            $.fn.toastr(data.message, 'Notification', 'error', 'toast-top-right', 3600);
                            (Boolean(data.access_code)) ? _this.find('input[name="access_code"]').addClass('is-invalid').trigger('focus') : _this.find('input[name="access_code"]').removeClass('is-invalid');
                            (Boolean(data.first_name)) ? _this.find('input[name="first_name"]').addClass('is-invalid') : _this.find('input[name="first_name"]').removeClass('is-invalid'); 
                            (Boolean(data.last_name)) ? _this.find('input[name="last_name"]').addClass('is-invalid') : _this.find('input[name="last_name"]').removeClass('is-invalid');  
                            (Boolean(data.group_id)) ? _this.find('span[aria-labelledby="select2-update-group-container"]').css({'border':'1px solid #d9534f'}) : _this.find('span[aria-labelledby="select2-update-group-container"]').removeAttr('style'); 
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

        // PUT: Delete
        let softDelete = {
            init: function() {
                this.bindForm();
            },
            bindForm: function () {
                $('#delete').on('show.bs.modal', this.submitForm(), function(e){
                    $(this).find('input:hidden[name="id"]').val($(e.relatedTarget).attr('data-id'));
                    $(this).find('.modal-body p').text('Are you sure you want to delete this person?');
                });
            },
            submitForm: function() {
                $('#delete-form').on('submit', function(e){
                    
                    let _this = $(this);
                    let id = _this.find('input:hidden[name="id"]').val();
                    
                    let jqXHR = $.ajax({
                        url: baseURL + '/admin/persons/delete/id/' + id,
                        type: 'PUT',
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
                            // Reload datatables
                            $('#datatables__default').DataTable().ajax.reload(null, false); // user paging is not reset on reload

                            // Success msg response
                            $.fn.toastr(data.message, 'Notification', 'error', 'toast-top-right', 3600);
                            
                            // Hide this modal
                            $('#delete').modal('hide');
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

        $.fn.activeList();
        $.fn.groupsDDL();
        $.fn.positionsDDL();
        $.fn.qrcodeGenerator();
        getAll.init();
        getById.init();
        create.init();
        update.init();
        softDelete.init();
    });
</script>

</body>
</html>