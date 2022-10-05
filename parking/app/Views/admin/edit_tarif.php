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
    var valglobal = 1;
    var flatglobal = 'fixed';

    window.onload = function() {
        <?php if (null !== old('tipe')) {

            echo "show(" . old('kendaraan_id') . ",'" . old('tipe') . "')";
        } ?>

    }

    function show(val, flat) {
        var tarif = <?php echo json_encode($tarif); ?>;
        valglobal = val;
        flatglobal = flat;
        tarif = tarif[val - 1];
        var x = document.getElementById("show_flatprice");
        var y = document.getElementById("show_flatnewprice");
        document.getElementById("tipe").value = flat;
        x.style.display = "none";
        y.style.display = "none";

        document.getElementById("harga").value = tarif['harga'];
        document.getElementById("harga_flat").value = tarif['harga_flat'];



        <?php if (null == old('tipe')) {

            echo   "document.getElementById('newprice_flat').value = '';";
        } ?>
        if (flat == 'fixed') {
            document.getElementById("newprice_flat").value = tarif['harga_flat'];
            x.style.display = "none";
            y.style.display = "none";
        } else {
            x.style.display = "flex";
            y.style.display = "flex";
        }

    }
</script>

<body>

    <div class="container" style="margin:auto; width:40%; border: 3px solid black;margin-top:20px;">
        <div class="row" style="padding: 3px;">
            <div class="col-12 mb-3">
                <h2 class="my-3" style="text-align:center"> Parking Price </h2>
                <form action="<?= base_url('/Admin/update_tarif') ?>" method="post">
                    <div class="row mb-2">
                        <label for="kendaraan_id" class="col-sm-4 col-form-label" style="font-size:18px;margin-top:5px;">Kendaraan</label>
                        <div class="col-sm-8">
                            <select name="kendaraan_id" style="margin-top:10px; width: 100%;height:30px;" onchange="show(this.value,flatglobal)">

                                <?php foreach ($tarif as $t) : ?>
                                    <option value="<?= $t['kendaraan_id'] ?>"><?= $t['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="tipe" class="col-sm-4 col-form-label" style="font-size:18px;margin-top:-8px;">Tipe</label>
                        <div class="col-sm-8">
                            <select id="tipe" name="tipe" style="width: 100%;height:30px;" onchange="show(valglobal,this.value)">
                                <option value="fixed">Fixed</option>
                                <option value="flat">Flat</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="harga" class="col-sm-4 col-form-label" style="font-size:18px;">Fixed Price</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga" id="harga" value="<?= $tarif[0]['harga']; ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mb-2" id="show_flatprice" style="display:none;">
                        <label for="harga" class="col-sm-4 col-form-label" style="font-size:18px;">Flat Price</label>
                        <div class="col-sm-8">
                            <input type="text" name="harga_flat" id="harga_flat" value="<?= $tarif[0]['harga_flat']; ?>" class="form-control" readonly>
                        </div>
                    </div>



                    <div class="row mb-2">
                        <label for="newprice_fixed" class="col-sm-4 col-form-label" style="font-size:18px;">New Fixed Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control <?= ($validation->HasError('newprice_fixed')) ? 'is-invalid' : ''; ?>" value="<?= old('newprice_fixed') ?>" id="newprice_fixed" name="newprice_fixed">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('newprice_fixed'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2" id="show_flatnewprice" style="display:none;">
                        <label for="harga_flat" class="col-sm-4 col-form-label" style="font-size:18px;">New Flat Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control <?= ($validation->HasError('newprice_flat')) ? 'is-invalid' : ''; ?>" id="newprice_flat" value="<?= old('newprice_flat') ?>" name="newprice_flat" value="<?= $tarif[0]['harga_flat']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('newprice_flat'); ?>
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
                            <a class="btn btn-secondary " href="<?= base_url('Admin/') ?>">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</body>

</html>