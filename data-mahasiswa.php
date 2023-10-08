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
                            <input type="text" class="form-control mb-2" id="nim" name="nim" placeholder="NIM">
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
                            $hasil = $mahasiswa->getDataPribadi($nim);
                            if($hasil) { ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Masa Registrasi Awal</th>
                                        <th>Program Studi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $hasil['nim'] ?></td>
                                        <td><?= $hasil['nama_mahasiswa'] ?></td>
                                        <td><?= $hasil['masa_reg_awal']['masa'] ?></td>
                                        <td><?= $hasil['info_ut']['program_studi']['kode_program_studi'] ?> | <?= $hasil['info_ut']['program_studi']['nama_program_studi'] ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Status DP</th>
                                        <th>UPBJJ</th>
                                        <th>Nomor HP</th>
                                        <th>Pendidikan Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $hasil['status_data_pribadi']['kode_status_dp'] ?></td>
                                        <td><?= $hasil['info_ut']['upbjj']['kode_upbjj'] ?> | <?= $hasil['info_ut']['upbjj']['nama_upbjj'] ?></td>
                                        <td><?= $hasil['info_kontak']['nomor_hp_mahasiswa'] ?></td>
                                        <td><?= $hasil['info_pendidikan_akhir']['pendidikan_akhir']['kode_pendidikan_akhir'] ?> | <?= $hasil['info_pendidikan_akhir']['pendidikan_akhir']['nama_pendidikan_akhir'] ?></td>
                                    </tr>
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