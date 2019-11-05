<div class="wrapper">
    <!-- Sidebar -->
    <?= $this->load->view('_shared/sidebar', '', true) ?>
    <!-- End of sidebar -->
    <div class="main">
        <!-- Topbar -->
        <?= $this->load->view('_shared/topbar', '', true) ?>
        <!-- End of topbar -->
        <!-- Content -->
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
        $.fn.activeList();
    });
</script>

</body>
</html>