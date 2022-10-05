<!DOCTYPE html>
<html>

<head>
	<style>
		body {
			min-height: 100vh;
		}
	</style>
</head>

<body>
	<div class="container" style=" width:50%; border: 3px solid black;margin-top:20px; ">
		<div class="row" style="padding: 3px;">
			<div class="col-12 mb-3">
				<h2 class="my-3" style="text-align:center"> Form Tiket </h2>
				<form action="<?= base_url('/Transaksi/finish/' . $transaksi['id']) ?>" method="post">
					<?= csrf_field(); ?>
					<div class="row mb-3">
						<label for="id" class="col-sm-3 col-form-label" style="margin-left:10px;">ID</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?= $transaksi['id']; ?>" name="id" readonly>
						</div>
					</div>
					<div class="row mb-3">
						<label for="kendaraan_id" class="col-sm-3 col-form-label" style="margin-left:10px;">Kendaraan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?= $kendaraan['nama']; ?>" name="kendaraan_id" readonly>
						</div>
					</div>
					<div class="row mb-3">
						<label for="no_identitas" class="col-sm-3 col-form-label" style="margin-left:10px;">No Identitas</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?= $transaksi['plat_nomor']; ?>" name="plat_nomor" readonly>
						</div>
					</div>
					<div class="row mb-3">
						<label for="no_identitas" class="col-sm-3 col-form-label" style="margin-left:10px;">Waktu Masuk</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?= $transaksi['waktu_masuk']; ?>" name="waktu_masuk" readonly>
						</div>
					</div>
					<div class="row mb-3">
						<label for="no_identitas" class="col-sm-3 col-form-label" style="margin-left:10px;">Waktu Keluar</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?= $transaksi['waktu_keluar']; ?>" name="waktu_keluar" readonly>
						</div>
					</div>
					<div class="row justify-content-center mb-3" style="padding: 3px;">
						<button type="submit" class="btn btn-warning"> Finish</button>
						<a class="btn btn-secondary ml-2" href="<?= base_url('Transaksi/') ?>">Back</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>