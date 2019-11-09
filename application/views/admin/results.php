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
                <div id="groups" class="row">
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
                                            <th>Position Name</th>
                                            <th>Full Name</th>
                                            <th>Group</th>
                                            <th>Total Votes</th>                                                         
                                            <th>Percentage</th>
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

<!-- JS libraries -->
<script type="text/javascript" src="<?= base_url('public/assets/dist/js/app.js') ?>"></script>

<script type="text/javascript">
    $(function () {

        let baseURL = $.fn.baseURL();

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
                        "url": baseURL + "/admin/results/results",
                        "type": "GET"
                    },
                    "columns": [
                        {
                            "searchable": false,
                            "data": null
                        },
                        {"data": "position_name"},
                        {
                            "data": {
                                "data":"prefix",
                                "data":"first_name", 
                                "data":"last_name"
                            },
                            "mRender": function (data) {
                                return data.prefix + " " + data.first_name + " " + data.last_name;
                            }
                        },       
                        {"data": "group_name"},    
                        {"data": "total_votes"}, 
                        {"data": "percentage"}  
                    ],
                    "lengthMenu": [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
                    "order": [[0, "asc"]],
                    "columnDefs": [
                        {"orderable": false, "targets": [0]}
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

        let app = {
            init: function() {
                $.fn.activeList();
            }
        }

        getAll.init();
        app.init();
    });
</script>

</body>
</html>