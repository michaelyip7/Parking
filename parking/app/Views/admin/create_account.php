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

    <div class="container" style="margin:auto; width:40%; border: 1px solid blue;margin-top:20px;">
        <form action="<?= base_url('/Admin/save_account') ?>" method="post">
            <h2 class="my-3" style="text-align:center"> Form Account </h2>
            <div class="mb-3">
                <label for="universitas_id" class="form-label ml-1">Institusi</label>
                <input type="text" name="universitas_id" id="universitas_id" class="form-control" value="<?= $institusi['universitas'] ?> " readonly>
                <input type="hidden" name="universitas_id" id="universitas_id" class="form-control" value="1">

            </div>

            <div class="mb-3">
                <label for="nama" class="form-label ml-1">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control  <?= ($validation->HasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Insert Name..." value="<?= old('nama'); ?>" autofocus>
                <div class=" invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label ml-1">Email</label>
                <input type="text" name="email" id="email" class="form-control  <?= ($validation->HasError('email')) ? 'is-invalid' : ''; ?>" placeholder="Insert Email..." value="<?= old('email'); ?>">
                <div class=" invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label ml-1">Password</label>
                <input type="text" name="password" id="password" class="form-control   <?= ($validation->HasError('password')) ? 'is-invalid' : ''; ?>" placeholder="Insert Password..." value="<?= old('password'); ?>">
                <div class=" invalid-feedback">
                    <?= $validation->getError('password'); ?>
                </div>
            </div>
            <div class="mb-3 ">
                <select name="jabatan" style="width:100%;height:35px;">
                    <option value="petugas">Petugas</option>
                    <option value="pemimpin">Pemimpin</option>
                </select>
            </div>

            <div class="mb-3">
                <input type="hidden" name="status" id="status" class="form-control" value="Enable">
            </div>

            <div class="row justify-content-center">
                <button type="submit" class="btn btn-warning" style="margin-right:20px;">Add Account</button>
                <a class="btn btn-secondary " href="<?= base_url('Admin/') ?>">Back</a>
            </div>
        </form>

    </div>
</body>

</html>