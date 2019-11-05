<div class="wrapper">
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">
                <div id="ballot-form" class="row">
                    <div id="ajax-preloader"></div>
                    <div class="col-12 col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title text-uppercase text-white"><strong>Official Ballot</strong></h5>
                                <h6 class="card-subtitle text-white">To make your selection, select the button to the left of the option.</h6>
                            </div>
                            <form id="create-form">
                                <div class="card-body">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php if (position()): ?>
                                            <div class="row">
                                                <?php foreach (position() as $p): ?>
                                                    <div id="position" class="col-lg-12 col-md-12 col-xs-12 mt-3">
                                                        <h3 class="position-header"><?= $p['name'] ?>
                                                            <small>&mdash; Vote for <?= convert_number_to_words($p['max_selection']) ?> (<?= $p['max_selection'] ?>)</small>
                                                        </h3>
                                                        <hr/>
                                                    </div>
                                                    <div id="candidate" class="col-lg-12 col-md-12 col-xs-12">
                                                        <?php if (candidate($p['id'])): ?>
                                                            <div class="row">
                                                                <?php foreach (candidate($p['id']) as $c): ?>
                                                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                                                        <div class="checkbox <?= $p['id'] . '_' . $p['max_selection'] ?>">
                                                                            <input id="<?= $p['id'] . '_' . $p['max_selection'] ?>" data-type="max" type="hidden" value="<?= $p['max_selection'] ?>">
                                                                            <input type="checkbox" id="candidate(<?= $c['id'] ?>)" name="candidate_id[]" value="<?= $c['id'] ?>" <?= set_checkbox('candidate_id', $c['id']) ?> />
                                                                            <label for="candidate(<?= $c['id'] ?>)">
                                                                                <span class="fullname"><?= $c['prefix'] . nbs() . $c['first_name'] . nbs() . $c['last_name'] . nbs() . $c['suffix'] ?></span><br/>
                                                                                <small class="group"><?= '(' . $c['group_short_name'] . ') &nbsp;' . $c['group_long_name'] ?></small>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="alert alert-danger">No records found.</div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <p class="alert alert-danger p-3">No records found.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-primary btn-lg btn-enable-disable btn-block rounded-pill px-5 btn-change-state text-uppercase" disabled data-toggle="modal">Continue</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Confirmation modal -->
<div class="modal fade" id="confirmation" data-backdrop="static" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="confirmationModalTitle">Notification</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form>
                <div class="modal-body p-5">
                    <div id="ajax-preloader"></div>
                    <h4 class="text-center text-uppercase mt-0">Confirm your selections.</h4>
                    <p class="text-center m-0">
                        If correct, click the submit button to cast your votes.<br/> 
                        Otherwise, click the return button to alter your selections.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-secondary rounded-pill px-5 btn-change-state" data-dismiss="modal">Return to Ballot</button>
                    <button type="button" id="confirm" class="btn btn-lg btn-primary rounded-pill px-5 btn-change-state">Submit Ballot</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of confirmation modal -->

<!-- Notification modal -->
<div class="modal fade" id="notif" data-backdrop="static" role="dialog" aria-labelledby="notifModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="notifModalTitle">Notification</h3>
            </div>
            <div id="ajax-preloader"></div>
            <div class="modal-body p-5">
                <!-- This is where the notif message load -->
            </div>
        </div>
    </div>
</div>
<!-- End of notification modal -->

<!-- JS libraries -->
<script type="text/javascript" src="<?= base_url('public/assets/dist/js/app.js') ?>"></script>

<script type="text/javascript">
    $(function () {

        let baseURL = $.fn.baseURL();
        let apiURL = $.fn.apiURL();
        let isProcessing = false;

        // POST: Add new
        let create = {
            init: function() {
                this.submitForm();
            },
            submitForm: function() {

                // Prevent multiple ajax request
                if (isProcessing) return;
                isProcessing = true;

                $('#create-form').on('submit', function(e){

                    let _this = $(this);

                    let jqXHR = $.ajax({
                        url: baseURL + '/user/ballot/submit_form',
                        type: 'POST',
                        dataType: 'json',
                        data: _this.serialize(),
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            $('#confirmation').find('#ajax-preloader').preloader().show();
                            $('#confirmation').find('.btn-change-state').attr('disabled', 'disabled');
                        }
                    });

                    jqXHR.done(function (data) {
                        if (data.status === true) {
                            // Hide this modal
                            $('#confirmation').modal('hide');
                            
                            $('#confirmation').on('hidden.bs.modal', function(){
                                $('body').addClass('modal-open');
                            });

                            // Show and append notif msg  
                            $('#notif').modal('show').find('.modal-body').html(
                                '<h4 class="text-center text-uppercase mt-0">Thank you!</h4>' +
                                '<p class="text-center m-0">Your votes has been recorded.</p>'
                            );

                            // Hide notif after (x) number of seconds 
                            setTimeout(function(){ 
                                $('#notif').modal('hide');
                                // Logout session and redirect to auth
                                window.location.replace(baseURL + '/auth/logout');
                            }, 3600);
                        } else {
                            // Error msg response
                            console.log(data.message);
                        }
                    });

                    jqXHR.always(function () {
                        $('#confirmation').find('#ajax-preloader').preloader().hide();
                        $('#confirmation').find('.btn-change-state').removeAttr('disabled');
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
                this.buttonToggle();
                this.confirmationDialog();
                this.checkboxLimit();
                $.fn.disableContextMenu();
            },
            buttonToggle: function () {
                $('input:checkbox').on('click', function () {
                    if ($(this).is(':checked')) {
                        $('.btn-enable-disable').removeAttr('disabled').attr('href', '#confirmation');
                    } else {
                        $('.btn-enable-disable').attr('disabled', true).removeAttr('href');
                    }
                })
            },
            confirmationDialog: function () {
                let _this = $('#confirmation');

                _this.on('show.bs.modal', function (e) {
                    let form = $(e.relatedTarget).closest('form');
                    $(this).find('.modal-footer #confirm').data('form', form);
                });

                _this.find('.modal-footer #confirm').on('click', function () {
                    $(this).data('form').submit();
                });
            },
            checkboxLimit: function () {
                let data = [];

                $('input[data-type="max"]').each(function () {
                    data.push({
                        id: $(this).attr("id"),
                        value: $(this).attr("value")
                    });
                });

                $.each(data, function () {
                    let pos = this.id;
                    let max = this.value;
                    let checkboxes = $('.' + pos + ' ' + 'input:checkbox');
                    checkboxes.change(function () {
                        let current = checkboxes.filter(':checked').length;
                        checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
                    });
                });
            }
        }

        create.init();
        app.init();
    });
</script>

</body>
</html>