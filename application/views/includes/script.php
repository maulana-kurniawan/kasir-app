<script src="<?= base_url('assets/plugins/overlay-scrollbar/overlay-scrollbar.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/select2/js/i18n/id.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-validation/localization/messages_id.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/inputmask/jquery.inputmask.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/adminlte.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/chart.js/Chart.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/croppie/croppie.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
<script>
	var Alert = Swal.mixin({
		title: 'Perhatian!',
		footer: 'Anda sedang dialihkan, tunggu sebentar...',
		allowOutsideClick: false,
		showConfirmButton: false,
		timer: 3000
	});
	var Toast = Swal.mixin({
		toast: true,
		position: 'top',
		title: 'Perhatian!',
		showConfirmButton: false,
		timer: 3000,
		width: 400
	});
	$("#cek").change(function() {
		$(this).prop("checked") ? $("[name='password']").prop("type", "text") : $("[name='password']").prop("type", "password");
	});
	$(function() {
		$("#logout").on('click', function() {
			Swal.fire({
				icon: 'info',
				title: 'Perhatian!',
				html: 'Apakah anda yakin ingin <span class="text-red">mengakhiri</span> sesi anda?',
				allowOutsideClick: false,
				showCancelButton: true,
				confirmButtonColor: '#28a745',
				cancelButtonColor: '#dc3545',
				confirmButtonText: '<i class="fas fa-check fa-fw"></i>',
				cancelButtonText: '<i class="fas fa-times fa-fw"></i>'
			}).then((result) => {
				if (result.isConfirmed) {
					Alert.fire({
						icon: 'success',
						html: 'Anda berhasil keluar dari akun <b><?= $this->session->userdata('nama') ?></b>',
					}).then(function() {
						window.location.href = "<?= base_url('logout'); ?>";
					});
				}
			});
		});
	});
</script>
