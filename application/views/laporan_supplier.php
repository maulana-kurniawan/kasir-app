<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
</head>

<body class="layout-top-nav">
	<div class="wrapper">
		<?php
		$this->load->view('includes/preloader');
		$this->load->view('includes/navbar');
		?>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Laporan</h1>
						</div>
					</div>
				</div>
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card card-green">
								<div class="card-header">
									<h3 class="card-title">Laporan Supplier</h3>
								</div>
								<form action="<?= base_url('laporan/supplier/cetak'); ?>" target="_blank">
									<div class="card-body">
										<div class="form-group">
											<label>Supplier</label>
											<select id="id_supplier" name="id_supplier" class="form-control select2 select2-green" data-dropdown-css-class="select2-green" style="width: 100%;">
												<?php foreach ($supplier as $s) { ?>
													<option value="<?= $s->id; ?>"><?= $s->nama_supplier; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label>Dari</label>
											<input type="date" id="dari" name="dari" class="form-control" value="<?= $dari; ?>">
										</div>
										<div class="form-group">
											<label>Sampai</label>
											<input type="date" id="sampai" name="sampai" class="form-control" value="<?= $sampai; ?>">
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" class="btn btn-block bg-green"><i class="fas fa-print fa-fw"></i></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('includes/footer'); ?>
	</div>
</body>
<?php $this->load->view('includes/script'); ?>
<script>
	$(function() {
		$('#id_supplier').select2().val(null).trigger('change');
		$('form').validate({
			rules: {
				id_supplier: {
					required: true
				}
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			}
		});
	});
</script>

</html>
