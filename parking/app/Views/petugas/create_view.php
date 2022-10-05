<!DOCTYPE html>
<html>

<head>
	<style>
		body {
			min-height: 100vh;
		}
	</style>
</head>

<script>
	function show(val) {
		var x = document.getElementById("plat");
		if (val == "3") {
			document.getElementById("plat_nomor").value = 'Kosong';
			x.style.display = "none";
		} else {
			x.style.display = "flex";
		}
	}
</script>

<body>

	<div class="container" style="margin:auto; width:30%; border: 3px solid black;margin-top:20px;">
		<div class="row" style="padding: 3px;">
			<div class="col-12 mb-3">
				<h2 class="my-3" style="text-align:center"> Form Tiket </h2>
				<form action="<?= base_url('/Transaksi/save') ?>" method="post">
					<div class="row mb-2">
						<label for="kendaraan_id" class="col-sm-4 col-form-label" style="font-size:18px;">Kendaraan</label>
						<div class="col-sm-8">
							<select name="kendaraan_id" style="margin-top:10px; width: 100%;" onchange="show(this.value)">

								<?php foreach ($kendaraan as $k) : ?>
									<option value="<?php echo $k['kendaraan_id'] ?>"><?php echo $k['nama'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="row mb-3" style="padding: 3px;" id="plat">
						<label for="no_identitas" class="col-sm-4 col-form-label">Plat Nomor</label>
						<div class="col-sm-8">
							<input type="text" class="form-control <?= ($validation->HasError('plat_nomor')) ? 'is-invalid' : ''; ?>" name="plat_nomor" id="plat_nomor">
							<div class=" invalid-feedback">
								<?= $validation->getError('plat_nomor'); ?>
							</div>
						</div>
					</div>



					<div class="row" style="padding: 3px;">
						<div class="col-sm-8">
							<input type="hidden" class="form-control" name="status" value="in">
						</div>
					</div>
					<div class="row justify-content-center mb-3" style="padding: 3px;">
						<div>
							<button type="submit" class="btn btn-danger">Tambah</button>
							<a class="btn btn-secondary " href="<?= base_url('Transaksi/') ?>">Back</a>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</body>

</html>