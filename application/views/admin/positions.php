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
                <div id="positions" class="row">
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
                                            <th>Name</th>
                                            <th>Max Selections</th>
                                            <th>Sequence</th>
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
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="max-selection">Max Selections <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="max-selection" name="max_selection" placeholder="">
                    </div>
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="form-group">
                                <label for="sequence">Sequence</label>
                                <input type="text" class="form-control" id="sequence" name="sequence" placeholder="">
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
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="max-selection">Max Selections <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="max-selection" name="max_selection" placeholder="">
                    </div>
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="form-group">
                                <label for="sequence">Sequence</label>
                                <input type="text" class="form-control" id="sequence" name="sequence" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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
                        "url": baseURL + "/admin/positions/positions",
                        "type": "GET"
                    },
                    "columns": [
                        {
                            "searchable": false,
                            "data": null
                        },
                        {"data": "name"},
                        {"data": "max_selection"},
                        {"data": "sequence"},
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
                        {"orderable": false, "targets": [0, 4, 5, 6, 7]}
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
            },
            resetForm: function() {
                $('#update').on('hidden.bs.modal', function(){
                    
                    let _this = $(this);

                    _this.find('form')[0].reset();
                    _this.find('.form-control').removeClass('is-invalid');
                });
            },
            displayForm: function() {
                $('#update').on('show.bs.modal', function (e) {
                    
                    let _this = $(this);
                    let id = $(e.relatedTarget).attr('data-id');

                    let jqXHR = $.ajax({
                        url: baseURL + '/admin/positions/position/?id=' + id,
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
                            _this.find('input[name="name"]').val(data.name);
                            _this.find('input[name="max_selection"]').val(data.max_selection);
                            _this.find('input[name="sequence"]').val(data.sequence);
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
                });
            },
            autoFocus: function() {
                $('#create').on('shown.bs.modal', function(){
                    $(this).find('input[name="name"]').trigger('focus');
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
                        url: baseURL + '/admin/positions/create',
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
                            (Boolean(data.name)) ? _this.find('input[name="name"]').addClass('is-invalid') : _this.find('input[name="name"]').removeClass('is-invalid'); 
                            (Boolean(data.max_selection)) ? _this.find('input[name="max_selection"]').addClass('is-invalid') : _this.find('input[name="max_selection"]').removeClass('is-invalid');  
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
                        url: baseURL + '/admin/positions/update/id/' + id,
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
                            (Boolean(data.name)) ? _this.find('input[name="name"]').addClass('is-invalid') : _this.find('input[name="name"]').removeClass('is-invalid'); 
                            (Boolean(data.max_selection)) ? _this.find('input[name="max_selection"]').addClass('is-invalid') : _this.find('input[name="max_selection"]').removeClass('is-invalid');  
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
                    $(this).find('.modal-body p').text('Are you sure you want to delete this position?');
                });
            },
            submitForm: function() {
                $('#delete-form').on('submit', function(e){
                    
                    let _this = $(this);
                    let id = _this.find('input:hidden[name="id"]').val();
                    
                    let jqXHR = $.ajax({
                        url: baseURL + '/admin/positions/delete/id/' + id,
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
        
        let app = {
            init: function() {
                $.fn.activeList();
            }
        }

        getAll.init();
        getById.init();
        create.init();
        update.init();
        softDelete.init();
        app.init();
    });
</script>

</body>
</html>