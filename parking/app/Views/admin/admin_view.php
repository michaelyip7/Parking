<!DOCTYPE html>
<html>

<head>
    <style>
        #option ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #003158;
        }

        #option li a {
            display: block;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
        }

        #option li a:hover {
            background-color: #00ccff;
            color: white;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;

        }
    </style>
</head>

<body>
    <?php
    $email = session()->get('email');
    $password = session()->get('password');
    if ($email == 'admin@admin.com' && ($password == 'admin' || $password == 'ADMIN')) { ?>
        <div class="<?= $contain; ?>">
            <div class="row" style="padding:10px;">

                <div class="col-1" id="option">

                </div>
                <div class="col-10" style="border:solid; border-radius:20px;">
                    <h1 class="mt-2 text-center">User</h1>
                    <a href="<?= base_url('/Admin/create_account') ?>" class="btn btn-primary " style="margin:20px;">Add Account </a>
                    <a href="<?= base_url('/Admin/create_institusi') ?>" class="btn btn-primary ">Edit Institusi </a>
                    <a href="<?= base_url('/Admin/create_tarif') ?>" class="btn btn-primary " style="margin:20px;">Edit Tarif </a>
                    <?php if (session()->getFlashdata('success msg')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success msg'); ?>
                        </div>
                    <?php endif; ?>
                    <table id="myTable" class="table">
                        <thead style="font-weight: bold;">
                            <td>ID</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>Role</td>
                            <td>Status</td>
                            <td>Action</td>
                        </thead>
                        <?php $i = 1; ?>
                        <?php
                        foreach ($user as $row) {
                            echo '<tr>';
                            echo '<td>' . $i++ . '</td>';
                            echo '<td>' . $row['nama'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['jabatan'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                            if ($row['status'] == 'Disable') {
                                echo '<td><a class="btn btn-success" style="min-width:80px;" href= "' . base_url('Admin/updateuser/' . $row['id']) . '/Enable">Enable</a></td>';
                            } else {
                                echo '<td><a class="btn btn-danger" style="min-width:80px;" href= "' . base_url('Admin/updateuser/' . $row['id']) . '/Disable">Disable</a></td>';
                            }

                            echo '<td></td>';

                            echo '</tr>';
                        }
                        ?>
                    </table>
                <?php } ?>

                </div>
            </div>
        </div>

</body>

</html>