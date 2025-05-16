<!-- Bootstrap Bundle (JS) via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables via CDN -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<script src="<?= base_url('assets/js/main.js') ?>"></script>


<!-- DataTables init -->
<script>
  $(document).ready(function () {
    $('.datatable').DataTable();
  });
</script>
