<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator BMI</title>
    <!-- Tambahkan viewport meta tag untuk responsif -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tambahkan tautan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                        <?php
                        session_start();
                        if (isset($_SESSION['username'])) {
                            echo "<h3>" . $_SESSION['username'] . "</h3>";
                        }
                        ?>
                </ul>
            </div>
        </nav>

        <h1 class="text-center">Kalkulator BMI</h1>
        <form action="#" method="post" onsubmit="return hitungBMI()">
            <!-- Tambahkan class "form-row" untuk layout yang responsif -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="berat">Berat Badan:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="berat" name="berat" placeholder="Masukkan berat badan" autocomplete="off" required>
                        <select class="form-control" id="satuanBerat" name="satuanBerat">
                            <option value="">Pilih Satuan Berat Badan</option>
                            <option value="kg">Kilogram (kg)</option>
                            <option value="lb">Pon (lb)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="tinggi">Tinggi Badan:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="tinggi" name="tinggi" placeholder="Masukkan tinggi badan" autocomplete="off" required>
                        <select class="form-control" id="satuanTinggi" name="satuanTinggi">
                            <option value="">Pilih Satuan Tinggi Badan</option>
                            <option value="inch">Inci (in)</option>
                            <option value="feet">Kaki (ft)</option>
                            <option value="m">Meter (m)</option>
                            <option value="cm">Sentimeter (cm)</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="reset" class="btn btn-danger" onclick="resetBMI()">Reset</button>
            <button type="submit" class="btn btn-primary float-right">Hitung BMI</button>
        </form>

        <div class="card mt-3">
            <div class="card-body"
                <h5 class="card-title">Hasil BMI</h5>
                <div id="hasilBMI"></div>
                <hr>
                <h5 class="card-t  ,,,,,,,,,xxxxmmmmmmmntle">Keterangan BMI</h5>
                <div id="keteranganBMI"></div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="mt-4">
                    <h3>Riwayat BMI</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Berat Badan</th>                                    
                            <th>Satuan Berat</th>
                                <th>Tinggi Badan</th>
                                <th>Satuan Tinggi</th>
                                <th>BMI</th>
                                <th>Tanggal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="riwayatBMI">
                        <!-- Data BMI akan ditampilkan di sini -->
                        </tbody>
                    </table>
                    <button class="btn btn-danger" onclick="hapusRiwayat()">Hapus Riwayat</button>
                </div>
            </div>                
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        var riwayatData = []; // Menyimpan riwayat data BMI

        function hitungBMI() {
            // Ambil nilai berat badan dan tinggi badan dari input
            var berat = parseFloat(document.getElementById("berat").value);
            var tinggi = parseFloat(document.getElementById("tinggi").value);
            var satuanBerat = document.getElementById("satuanBerat").value;
            var satuanTinggi = document.getElementById("satuanTinggi").value;

            // Konversi ke kilogram dan meter jika perlu
            if (satuanBerat === "lb") {
                berat1 = berat * 0.453592;
            } else if (satuanBerat === "kg") {
                berat1 = berat;
            }
            if (satuanTinggi === "inch") {
                tinggi1 = tinggi * 0.0254;
            } else if (satuanTinggi === "feet") {
                tinggi1 = tinggi * 0.3048;
            } else if (satuanTinggi === "cm") {
                tinggi1 = tinggi * 0.01;
            } else if (satuanTinggi === "m") {
                tinggi1 = tinggi;
            }

            // Hitung BMI
            var bmi = berat1 / (tinggi1 * tinggi1);

            // Tampilkan hasil BMI
            var hasilBMI = "BMI Anda adalah: " + bmi.toFixed(1);

            // Tampilkan keterangan BMI
            var keteranganBMI = "";
            nerHTML = keteranganBMI;

            // Simpan data BMI ke dalam riwayat
            var tanggal = new Date().toLocaleDateString();
            var data = {
                berat: berat + " ",
                satuanBerat: satuanBerat,
                tinggi: tinggi + " ",
                satuanTinggi, satuanTinggi,
                bmi: bmi.toFixed(1),
                keterangan: keteranganBMI,
                tanggal: tanggal
            };
            riwayatData.push(data);

            // Tampilkan data BMI dalam tabel riwayat
            tampilkanRiwayat();

            return false; // Mencegah formulir untuk mengirimkan permintaan
        }

        function resetBMI() {
            document.getElementById("hasilBMI").innerHTML = "";
            document.getElementById("keteranganBMI").innerHTML = "";
        }

        function tampilkanRiwayat() {
            var tabelRiwayat = document.getElementById("riwayatBMI");
            tabelRiwayat.innerHTML = "";

            if (riwayatData.length === 0) {
                return; // Tidak ada data riwayat
            }

            for (var i = 0; i < riwayatData.length; i++) {
                var row = tabelRiwayat.insertRow(i);
                var cellNo = row.insertCell(0);
                var cellBerat = row.insertCell(1);
                var cellsatuanBerat = row.insertCell(2);
                var cellTinggi = row.insertCell(3);
                var cellsatuanTinggi = row.insertCell(4);
                var cellBMI = row.insertCell(5);
                var cellTanggal = row.insertCell(6);
                var cellOpsi = row.insertCell(7);

                cellNo.innerHTML = i + 1;
                cellBerat.innerHTML = riwayatData[i].berat;
                cellsatuanBerat.innerHTML = riwayatData[i].satuanBerat;
                cellTinggi.innerHTML = riwayatData[i].tinggi;
                cellsatuanTinggi.innerHTML = riwayatData[i].satuanTinggi;
                cellBMI.innerHTML = riwayatData[i].bmi;
                cellTanggal.innerHTML = riwayatData[i].tanggal;

                // Tambahkan tombol "Edit" dan "Hapus" dalam satu baris
                cellOpsi.innerHTML = '<button class="btn btn-primary btn-edit mr-2" onclick="aksiData(' + i + ', \'edit\')">Edit</button><button class="btn btn-danger" onclick="aksiData(' + i + ', \'hapus\')">Hapus</button>';
            }

            // Dapatkan semua tombol "Edit" dengan kelas "btn-edit"
            var tombolEdit = document.querySelectorAll(".btn-edit");

            // Tambahkan listener untuk tombol "Edit"
            for (var j = 0; j < tombolEdit.length; j++) {
                tombolEdit[j].addEventListener("click", function () {
                    // Lakukan aksi edit di sini
                    // ...
                });
            }
        }

        function hapusData(index) {
            riwayatData.splice(index, 1);
            tampilkanRiwayat();
        }

        function hapusRiwayat() {
            riwayatData = [];
            tampilkanRiwayat();
        }

        function aksiData(index, tipe) {
            if (tipe === 'edit') {
                var beratTinggi = riwayatData[index];
                var beratInput = prompt("Masukkan berat badan baru:", beratTinggi.berat.split(" ")[0]);
                var satuanBeratInput = prompt("Masukkan satuan berat badan baru (kg atau lb):", beratTinggi.satuanBerat.split(" ")[0]);
                var tinggiInput = prompt("Masukkan tinggi badan baru:", beratTinggi.tinggi.split(" ")[0]);
                var satuanTinggiInput = prompt("Masukkan satuan tinggi badan baru (m, cm, ft, atau in):", beratTinggi.satuanTinggi.split(" ")[0]);

                // Validasi input
                if (beratInput === null || satuanBeratInput === null || tinggiInput === null || satuanTinggiInput === null) {
                    return; // Batal jika pengguna menekan "Batal"
                }

                // Parse nilai yang diubah
                var beratBaru = parseFloat(beratInput);
                var satuanBeratBaru = satuanBeratInput;
                var tinggiBaru = parseFloat(tinggiInput);
                var satuanTinggiBaru = satuanTinggiInput;

                // Update data dalam riwayat
                riwayatData[index].berat = beratBaru.toFixed(0) + " " + satuanBeratBaru;
                riwayatData[index].satuanBerat = satuanBeratBaru;
                riwayatData[index].tinggi = tinggiBaru.toFixed(0) + " " + satuanTinggiBaru;
                riwayatData[index].satuanTinggi = satuanTinggiBaru;

                // Hitung ulang BMI
                if (satuanBeratBaru === "lb") {
                    beratBaru1 = beratBaru * 0.453592;
                } else if (satuanBeratBaru === "kg") {
                    beratBaru1 = beratBaru;
                }

                if (satuanTinggiBaru === "inch") {
                    tinggiBaru1 = tinggiBaru * 0.0254;
                } else if (satuanTinggiBaru === "ft") {
                    tinggiBaru1 = tinggiBaru * 0.3048;
                } else if (satuanTinggiBaru === "cm") {
                    tinggiBaru1 = tinggiBaru * 0.01;
                }
                var bmiBaru = beratBaru1 / (tinggiBaru1 * tinggiBaru1);
                riwayatData[index].bmi = bmiBaru.toFixed(1);

                // Perbarui tampilan riwayat
                tampilkanRiwayat();
            } else if (tipe === 'hapus') {
                hapusData(index);
            }
        }
    </script>
</body>
</html>
