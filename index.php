<?php
// koneksi
$conn = mysqli_connect("localhost", "root", "", "db_saw");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | SAW</title>

    <!-- CSS BOOTSTRAP-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- MY CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form>
        <fieldset disabled>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Jurnal :</label>
                <div class="col-sm-11">
                    <input type="email" class="form-control" id="disabledTextInput" placeholder="Decision Support System for The Program Indonesia Pintar Scholarship using Simple Additive Weighting method">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Penulis :</label>
                <div class="col-sm-11">
                    <input type="email" class="form-control" id="disabledTextInput" placeholder="Yosep Septiana, Fitri Nuraeni, Kamelia Anisa">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Publisher :</label>
                <div class="col-sm-11">
                    <input type="email" class="form-control" id="disabledTextInput" placeholder="Sinkron : Jurnal dan Penelitian Teknik Informatika">
                </div>
            </div>
        </fieldset>
    </form>
    <hr>


    <h3 class="text-center">Decision Support System for The Program Indonesia Pintar Scholarship using Simple Additive Weighting method</h3>
    <hr>

    <!-- Tabel alternatif -->
    <p class="text-center fw-bold">Tabel Alternatif</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th>No</th>
                <th>Kode Alternatif</th>
                <th>Nama Alternatif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_alternatif");
            $no = 1;
            while ($alternatif = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $alternatif['alternatif_kode'] ?></td>
                    <td><?= $alternatif['alternatif_nama'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- Tabel kriteria -->
    <p class="text-center fw-bold">Tabel Kriteria</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Kode Kriteria</th>
                <th>Kategori Kriteria</th>
                <th>Bobot Kriteria</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_kriteria");
            $no = 1;
            while ($kriteria = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $kriteria['kriteria_nama'] ?></td>
                    <td><?= $kriteria['kriteria_kode'] ?></td>
                    <td><?= $kriteria['kriteria_kategori'] ?></td>
                    <td><?= $kriteria['kriteria_bobot'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- Tabel sub-kriteria -->
    <p class="text-center fw-bold">Tabel Sub-Kriteria</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Kode Sub-Kriteria</th>
                <th>Sub-Kriteria</th>
                <th>Bobot Sub-Kriteria</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_subkriteria INNER JOIN ta_kriteria ON ta_subkriteria.kriteria_kode = ta_kriteria.kriteria_kode");
            $no = 1;
            while ($subKriteria = $data->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $subKriteria['kriteria_nama']; ?></td>
                    <td><?= $subKriteria['subkriteria_kode'] ?></td>
                    <td><?= $subKriteria['subkriteria_keterangan'] ?></td>
                    <td><?= $subKriteria['subkriteria_bobot'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- array ranks untuk menampung hasil perangkingan -->
    <?php $ranks = array(); ?>
    <!-- Tabel nilai pemfaktoran -->
    <p class="text-center fw-bold">Tabel Matrix Keputusan</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Alternatif</th>
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                $kriteriaRows = mysqli_num_rows($data);
                ?>
                <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>
            </tr>
            <tr class="table-info">

                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                while ($kriteria = $data->fetch_assoc()) { ?>
                    <td><?= $kriteria['kriteria_nama']; ?></td>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
            $no = 1;
            while ($alternatif = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $alternatif['alternatif_nama'] ?></td>
                    <?php
                    $alternatifKode = $alternatif['alternatif_kode'];
                    $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alternatifKode' ORDER BY kriteria_kode");
                    while ($data_nilai = $sql->fetch_assoc()) { ?>
                        <td><?= $data_nilai['nilai_faktor'] ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- Tabel proses normalisasi  -->
    <p class="text-center fw-bold">Tabel Normalisasi</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Alternatif</th>
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                $kriteriaRows = mysqli_num_rows($data);
                ?>
                <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>

            </tr>
            <tr class="table-info">
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                while ($kriteria = $data->fetch_assoc()) { ?>
                    <td><?= $kriteria['kriteria_nama']; ?></td>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
            $no = 1;
            while ($alternatif = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $alternatif['alternatif_nama'] ?></td>
                    <?php
                    $alternatifKode = $alternatif['alternatif_kode'];
                    $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alternatifKode' ORDER BY kriteria_kode");
                    while ($data_nilai = $sql->fetch_assoc()) { ?>
                        <?php
                        $kriteriaKode = $data_nilai['kriteria_kode'];
                        $sqli = $conn->query("SELECT * FROM ta_kriteria WHERE kriteria_kode='$kriteriaKode' ORDER BY kriteria_kode");
                        while ($kriteria = $sqli->fetch_assoc()) {
                        ?>
                            <?php if ($kriteria['kriteria_kategori'] == "cost") { ?>
                                <?php
                                $sqlMin =  $conn->query("SELECT kriteria_kode, MIN(nilai_faktor) AS min FROM tb_nilai WHERE kriteria_kode='$kriteriaKode' GROUP BY kriteria_kode");
                                while ($nilai_Min = $sqlMin->fetch_assoc()) {
                                ?>
                                    <td><?= number_format($hasil = $nilai_Min['min'] / $data_nilai['nilai_faktor'], 2); ?></td>
                                <?php } ?>


                            <?php } elseif ($kriteria['kriteria_kategori'] == "benefit") { ?>
                                <?php
                                $sqlMax =  $conn->query("SELECT kriteria_kode, MAX(nilai_faktor) AS max FROM tb_nilai WHERE kriteria_kode='$kriteriaKode' GROUP BY kriteria_kode");
                                while ($nilai_Max = $sqlMax->fetch_assoc()) {
                                ?>
                                    <td><?= number_format($hasil = $data_nilai['nilai_faktor'] / $nilai_Max['max'], 2); ?></td>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- Tabel proses preferensi -->
    <p class="text-center fw-bold">Tabel Hasil Preferensi</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-info">
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Alternatif</th>
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                $kriteriaRows = mysqli_num_rows($data);
                ?>
                <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>
                <th rowspan="2">Nilai Akhir</th>

            </tr>
            <tr class="table-info">
                <?php
                $data = $conn->query("SELECT * FROM ta_kriteria");
                while ($kriteria = $data->fetch_assoc()) { ?>
                    <td><?= $kriteria['kriteria_nama']; ?></td>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
            $no = 1;
            while ($alternatif = $data->fetch_assoc()) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $alternatif['alternatif_nama'] ?></td>
                    <?php $hasilSum = 0; //variabel hasilSum untuk proses sum nanti
                    ?>

                    <?php
                    $alternatifKode = $alternatif['alternatif_kode'];
                    $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alternatifKode' ORDER BY kriteria_kode");
                    while ($data_nilai = $sql->fetch_assoc()) { ?>
                        <?php
                        $kriteriaKode = $data_nilai['kriteria_kode'];
                        $sqli = $conn->query("SELECT * FROM ta_kriteria WHERE kriteria_kode='$kriteriaKode' ORDER BY kriteria_kode");
                        while ($kriteria = $sqli->fetch_assoc()) {
                        ?>
                            <?php if ($kriteria['kriteria_kategori'] == "cost") { ?>
                                <?php
                                $sqlMin =  $conn->query("SELECT kriteria_kode, MIN(nilai_faktor) AS min FROM tb_nilai WHERE kriteria_kode='$kriteriaKode' GROUP BY kriteria_kode");
                                while ($nilai_Min = $sqlMin->fetch_assoc()) {
                                ?>
                                    <?php $hasil = $nilai_Min['min'] / $data_nilai['nilai_faktor']; ?>

                                    <td><?= number_format($min_dikali_kriteria = $hasil * $kriteria['kriteria_bobot'], 2); ?></td>

                                    <?php $hasilSum = $hasilSum + $min_dikali_kriteria; ?>

                                <?php } ?>


                            <?php } elseif ($kriteria['kriteria_kategori'] == "benefit") { ?>
                                <?php
                                $sqlMax =  $conn->query("SELECT kriteria_kode, MAX(nilai_faktor) AS max FROM tb_nilai WHERE kriteria_kode='$kriteriaKode' GROUP BY kriteria_kode");
                                while ($nilai_Max = $sqlMax->fetch_assoc()) {
                                ?>
                                    <?php $hasil = $data_nilai['nilai_faktor'] / $nilai_Max['max']; ?>

                                    <td><?= number_format($max_dikali_kriteria = $hasil * $kriteria['kriteria_bobot'], 2); ?></td>

                                    <?php $hasilSum = $hasilSum + $max_dikali_kriteria; ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                    <td><?= number_format($hasilSum, 2);  //hasil sum
                        ?></td>

                    <?php
                    //masukan  nilai hasil-sum, nama-alternatif, kode-alternatif ke dalam variabel $ranks(baris 26)
                    $rank['hasilSum'] = $hasilSum;
                    $rank['alternatifNama'] = $alternatif['alternatif_nama'];
                    $rank['alternatifKode'] = $alternatif['alternatif_kode'];
                    array_push($ranks, $rank);
                    ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <hr>


    <!-- Tabel ranking -->
    <p class="text-center fw-bold">Tabel Perangkingan</p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-warning">
                <th>Ranking</th>
                <th>Kode Alternatif</th>
                <th>Nama Alternatif</th>
                <th>Nilai SAW</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            rsort($ranks);
            foreach ($ranks as $r) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $r['alternatifKode']; ?></td>
                    <td><?= $r['alternatifNama']; ?></td>
                    <td><?= number_format($r['hasilSum'], 2); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>