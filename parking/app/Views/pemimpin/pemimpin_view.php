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
    function tanggal(val) {

        document.getElementsByName("tgl_akhir")[0].setAttribute('min', val);
        if (val > document.getElementsByName("tgl_akhir")[0].value) {
            document.getElementsByName("tgl_akhir")[0].value = val;
        }

    }
    document.getElementById("option").value = 2022;
</script>

<body>
    <div class="container-fluid row" style="padding:10px;margin-top:20px;">
        <div class="col-1">
        </div>
        <div class="col-5" style="border:solid; border-top-left-radius: 20px 20px; border-bottom-left-radius: 20px 20px;">
            <h2 style="text-align:center;margin-top:10px;margin-bottom:10px;">Money Report</h2>
            <div style="text-align:center;">
                <form method="get">
                    <input type="date" name="tgl_awal" onchange="tanggal(this.value)">
                    <?php echo "-"; ?>
                    <input type="date" name="tgl_akhir">
                    <input type="submit">
                </form>


            </div>
            <input type="text" style="margin-left:60px;" value=" First Date: <?= $tgl; ?>" readonly>
            <input type="text" style="margin-bottom:20px;" value=" Last Date: <?= $tgl_akhir; ?>" readonly>

            <div class="card" style="width: 20rem;margin-left:100px;">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="background:#A9A9A9;"><b>Custom date : Rp <?= number_format($total_pilihan['tarif'], 2, ',', '.'); ?></b></li>
                    <li class="list-group-item" style="background:#A9A9A9;"><b>Harian : Rp <?= number_format($total_harian['tarif'], 2, ',', '.'); ?></b></li>
                    <li class="list-group-item" style="background:#A9A9A9;"><b>Mingguan : Rp <?= number_format($total_mingguan['tarif'], 2, ',', '.'); ?></b></li>
                    <li class="list-group-item" style="background:#A9A9A9;"><b>Bulanan : Rp <?= number_format($total_bulanan['tarif'], 2, ',', '.'); ?></b></li>
                    <li class="list-group-item" style="background:#A9A9A9;"><b>Tahunan : Rp <?= number_format($total_tahunan['tarif'], 2, ',', '.'); ?></b></li>
                </ul>
            </div>
        </div>
        <div class="col-5" style="border:solid; border-top-right-radius: 20px 20px; border-bottom-right-radius: 20px 20px;border-left:0">
            <h2 style="text-align:center;margin-top:10px;">Vehicle Report</h2>
            <div class="col-sm-11">
                <form method="get">
                    <div class="input-group-prepend mb-3">
                        <select id="option" name="option" style=" height:30px;width: 100%;" onchange="show(this.value)">
                            <option disabled hidden selected>Silahkan Pilih Tahun </option>
                            <?php
                            $min = $option['min'];
                            while ($min <= $option['max']) { ?>
                                <option value="<?php echo $min; ?>"><?php echo $min++; ?></option>
                            <?php } ?>
                        </select>
                        <div class="input-group-append">
                            <input type="submit">
                        </div>
                    </div>
                </form>

            </div>
            <div id="piechart"></div>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script type="text/javascript">
                // Load google charts
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);

                // Draw the chart and set the chart values
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Jenis Kendaraan', 'Jumlah'],
                        ['Mobil', <?= $total_mobil['kendaraan_id'] ?>],
                        ['Motor', <?= $total_motor['kendaraan_id'] ?>],
                        ['Sepeda', <?= $total_sepeda['kendaraan_id'] ?>]
                    ]);

                    // Optional; add a title and set the width and height of the chart
                    var options = {
                        'title': 'Vehicle Info <?= $choice; ?>',
                        'width': 500,
                        'height': 400
                    };

                    // Display the chart inside the <div> element with id="piechart"
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
            </script>
        </div>
    </div>
    </div>
</body>

</html>