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

    <div class="container" style="margin:auto; width:30%; border: 1px solid blue;margin-top:20px;">
        <form action="<?= base_url('/Admin/update_institusi') ?>" method="post" enctype="multipart/form-data">
            <h2 class="my-3" style="text-align:center"> Edit Institusi </h2>


            <div class="mb-3">
                <label for="universitas" class="form-label ml-1">Institusi</label>
                <input type="text" name="universitas" id="universitas" class="form-control   <?= ($validation->HasError('universitas')) ? 'is-invalid' : ''; ?>" placeholder="Nama Institusi..." value="<?= old('universitas'); ?>">
                <div class=" invalid-feedback">
                    <?= $validation->getError('universitas'); ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label ml-1">Logo</label>
                <div class="input-group mb-3">

                    <input type="file" class="form-control <?= ($validation->HasError('logo')) ? 'is-invalid' : ''; ?>" name="logo" id="logo" value="<?= old('universitas'); ?>">
                    <div class=" invalid-feedback">
                        <?= $validation->getError('logo'); ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-warning" style="margin-right:20px;">Tambah</button>
                <a class="btn btn-secondary " href="<?= base_url('Admin/') ?>">Back</a>
            </div>
        </form>

    </div>
</body>

</html>