</div> <!-- content-wrapper -->

<footer class="footer text-center">
  <p>© Perpustakaan 2026</p>
</footer>

</div> <!-- main-panel -->
</div> <!-- page-body-wrapper -->
</div> <!-- container-scroller -->

<!-- JS -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<script src="assets/js/template.js"></script>
<script>
function confirmHapus(e){
  e.preventDefault();
  let link = e.currentTarget.getAttribute('href');

  Swal.fire({
    title: 'Yakin hapus?',
    text: "Data tidak bisa dikembalikan!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Ya, hapus!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = link;
    }
  });

  return false;
}
</script>

</body>
</html>