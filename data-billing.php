<?php
include_once('app/Mahasiswa.php');

$mahasiswa = new Mahasiswa;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pencarian Data</h4>
                    </div>
                    <div class="card-body">
                    <form action="" method="get">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInput">INPUTKAN NIM</label>
                                <input type="text" class="form-control mb-2" id="nim" name="nim" placeholder="NIM" required>
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInput">INPUTKAN MASA</label>
                                <input type="text" class="form-control mb-2" id="masa" name="masa" placeholder="Masa" required>
                            </div>
                                <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">CARI DATA</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($_GET['nim'])) { ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <?php 
                            $nim = $_GET['nim'];
                            $masa = $_GET['masa'];
                            $hasil = $mahasiswa->getBillingByNomorBillingDanMasa($nim, $masa);
                            if($hasil) { ?>
                            <a class="btn btn-success" href="export-excel.php?nim=<?= $nim ?>&masa=<?=$masa?>" role="button">Download Excel</a><br><br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Masa</th>
                                        <th>Nomor Billing</th>
                                        <th>Tanggal Setor</th>
                                        <th>Total SKS</th>
                                        <th>Total Bayar</th>
                                        <th>Jenis Bayar</th>
                                        <th>Status Billing</th>
                                        <th>Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($hasil['dataPribadi'] as $row) { ?>
                                    <tr>
                                        <td><?= $row['nim'] ?></td>
                                        <td><?= $row['masa']['masa'] ?></td>
                                        <td><?= $row['nobilling'] ?></td>
                                        <td><?= $row['tanggal_setor'] ?></td>
                                        <td><?= $row['total_sks'] ?></td>
                                        <td><?= $row['total_bayar'] ?></td>
                                        <td><?= $row['jenis_bayar']['keterangan'] ?></td>
                                        <td><?= $row['status_billing']['keterangan'] ?></td>
                                        <td><?= $row['status_pembayaran']['keterangan'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <?php } else { ?>
                                <div class="alert alert-danger" role="alert">Data dengan NIM <b><?= $_GET['nim'] ?></b> Tidak Ditemukan </div>
                            <?php } ?>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>