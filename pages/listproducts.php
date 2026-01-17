<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f4f6f9; }
        .sidebar {
            width: 230px;
            min-height: 100vh;
            background-color: #2c3e50;
            position: fixed;
            color: white;
        }
        .sidebar h4 {
            padding: 20px;
            background-color: #1f2d3d;
            text-align: center;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #cfd8dc;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #34495e;
            color: white;
        }
        .content {
            margin-left: 230px;
            padding: 30px;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>Dashboard</h4>
    <a href="#">Home</a>
    <a href="#" class="bg-secondary text-white">List Produk</a>
    <a href="#">Customer</a>
    <a href="#">Transaksi</a>
    <a href="#">Laporan</a>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <h4>List Produk</h4>
                <button class="btn btn-success" onclick="openTambah()">+ Tambah Produk</button>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelProduk"></tbody>
            </table>

        </div>
    </div>
</div>

<!-- MODAL TAMBAH / EDIT PRODUK -->
<div class="modal fade" id="modalProduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Produk</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="indexEdit">

                <div class="mb-2">
                    <label>Kode</label>
                    <input type="text" id="kode" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Nama</label>
                    <input type="text" id="nama" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Kategori</label>
                    <input type="text" id="kategori" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Harga</label>
                    <input type="number" id="harga" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Stok</label>
                    <input type="number" id="stok" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Satuan</label>
                    <input type="text" id="satuan" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="simpan()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let produk = [
    {kode:"K01", nama:"AQUA", kategori:"Minuman", harga:3000, stok:10, satuan:"pcs"},
    {kode:"K02", nama:"TANGGO", kategori:"Snack", harga:2000, stok:10, satuan:"pcs"}
];

let modal = new bootstrap.Modal(document.getElementById('modalProduk'));

function tampil() {
    let tabel = "";
    produk.forEach((p, i) => {
        tabel += `
        <tr>
            <td>${i+1}</td>
            <td>${p.kode}</td>
            <td>${p.nama}</td>
            <td>${p.kategori}</td>
            <td>Rp ${p.harga}</td>
            <td>${p.stok}</td>
            <td>${p.satuan}</td>
            <td>
                <button class="btn btn-sm btn-primary" onclick="edit(${i})">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="hapus(${i})">Hapus</button>
            </td>
        </tr>`;
    });
    document.getElementById("tabelProduk").innerHTML = tabel;
}

function openTambah() {
    indexEdit.value = "";
    document.querySelectorAll("input").forEach(i => i.value = "");
    modal.show();
}

function simpan() {
    let data = {
        kode: kode.value,
        nama: nama.value,
        kategori: kategori.value,
        harga: harga.value,
        stok: stok.value,
        satuan: satuan.value
    };

    let index = indexEdit.value;
    if (index === "") {
        produk.push(data);
    } else {
        produk[index] = data;
    }

    modal.hide();
    tampil();
}

function edit(index) {
    let p = produk[index];
    indexEdit.value = index;
    kode.value = p.kode;
    nama.value = p.nama;
    kategori.value = p.kategori;
    harga.value = p.harga;
    stok.value = p.stok;
    satuan.value = p.satuan;
    modal.show();
}

function hapus(index) {
    if (confirm("Yakin ingin menghapus produk?")) {
        produk.splice(index, 1);
        tampil();
    }
}

tampil();
</script>

</body>
</html>