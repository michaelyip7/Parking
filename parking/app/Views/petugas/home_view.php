<!DOCTYPE html>
<html>

<head>
	<style>
		body {
			min-height: 100vh;
		}
	</style>
</head>

<?php

use CodeIgniter\I18n\Time; ?>

<body>
	<div class="container mt-4" style="border:solid; border-radius:20px; margin-bottom: 40px;">
		<a href="<?= base_url('/Transaksi') ?>" class="btn btn-success mt-2"> Back</a>
		<h1 class="mt-2 text-center">Daftar Tiket</h1>

		<div class="row">
			<div class="col-2">
				<a href="<?= base_url('/Transaksi/create') ?>" class="btn btn-primary mb-3">Add Tiket </a>
			</div>
			<div class="col-5">

			</div>
			<div class="col-5">
				<form action="" method="get">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Input Vehicle Number" name="keyword">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" name="submit">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col">

				<?php if (session()->getFlashdata('success msg')) : ?>
					<div class="alert alert-success" role="alert">
						<?= session()->getFlashdata('success msg'); ?>
					</div>
				<?php endif; ?>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Petugas</th>
							<th scope="col">Kendaraan</th>
							<th scope="col">Plat Nomor</th>
							<th scope="col">Waktu Masuk</th>
							<th scope="col">Waktu Keluar</th>
							<th scope="col">Total Hour</th>
							<th scope="col">Tarif</th>
							<th scope="col">Status</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1 + (5 * ($currentPage - 1)); ?>
						<?php foreach ($transaksi as $t) : ?>
							<tr>
								<th scope="row"><?= $i++; ?></th>
								<td><?= $t['petugas']; ?></td>
								<td><?= $t['nama']; ?></td>
								<td><?= $t['plat_nomor']; ?></td>
								<td><?= $t['waktu_masuk']; ?></td>
								<?php if ($t['status'] == 'out') {
									echo '<td>' . $t['waktu_keluar'] . '</td>';
								} else {
									echo '<td> Check out dulu</td>';
								} ?>
								<td><?= time::parse($t['waktu_masuk'])->difference(time::parse($t['waktu_keluar']))->getHours() + 1; ?> Hour</td>
								<?php if (!empty($t['tarif'])) {
									echo	"<td>Rp " . number_format($t['tarif'], 0, ',', '.') . " </td>";
								} else {
									echo "<td>Butuh Konfirmasi </td>";
								} ?>
								<td><?= $t['status']; ?></td>
								<?php if ($t['status'] == 'in') { ?>
									<td>
										<a href=" <?= base_url('/Transaksi/selesai/' . $t['id']) ?>" class="btn btn-success"> Detail </a>
									</td>
								<?php } else { ?>
									<td>
										<a class="btn btn-secondary" style="color:white;" disabled> Done </a>
									</td>
								<?php } ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?= $pager->links('transaksi', 'tiket_pagination'); ?>
			</div>
		</div>
	</div>
</body>

</html>