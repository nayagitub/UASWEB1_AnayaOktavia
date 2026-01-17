<?php
include "koneksi.php";

/* =======================
   PROSES SIMPAN (TAMBAH / EDIT)
   ======================= */
if (isset($_POST['simpan'])) {
    $id     = $_POST['id_customer'];
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email  = $_POST['email'];

    if ($id == "") {
        mysqli_query($conn, "INSERT INTO tbl_pelanggan 
            VALUES (NULL,'$nama','$alamat','$email')");
    } else {
        mysqli_query($conn, "UPDATE tbl_pelanggan SET
            nama='$nama',
            alamat='$alamat',
            email='$email'
            WHERE id_customer='$id'");
    }

    echo "<script>location='dashboard.php?page=pelanggan'</script>";
}

/* =======================
   PROSES HAPUS
   ======================= */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM tbl_pelanggan 
        WHERE id_customer='$_GET[hapus]'");
    echo "<script>location='dashboard.php?page=pelanggan'</script>";
}

/* =======================
   AMBIL DATA
   ======================= */
$data = mysqli_query($conn, "SELECT * FROM tbl_pelanggan");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="card">
    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">
            <h4>List Pelanggan</h4>
            <button class="btn btn-success" onclick="openTambah()">+ Tambah Pelanggan</button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; while($p=mysqli_fetch_assoc($data)){ ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p['nama'] ?></td>
                    <td><?= $p['alamat'] ?></td>
                    <td><?= $p['email'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                            onclick="editPelanggan(
                                '<?= $p['id_customer'] ?>',
                                '<?= $p['nama'] ?>',
                                '<?= $p['alamat'] ?>',
                                '<?= $p['email'] ?>'
                            )">Edit</button>

                        <a href="?hapus=<?= $p['id_customer'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin hapus data?')">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<!-- MODAL TAMBAH / EDIT -->
<div class="modal fade" id="modalPelanggan">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pelanggan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id_customer" id="id_customer">

                <div class="mb-2">
                    <label>Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label>Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                </div>

                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" name="simpan">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let modal = new bootstrap.Modal(document.getElementById('modalPelanggan'));

function openTambah() {
    id_customer.value = "";
    nama.value = "";
    alamat.value = "";
    email.value = "";
    modal.show();
}

function editPelanggan(id,n,a,e) {
    id_customer.value = id;
    nama.value = n;
    alamat.value = a;
    email.value = e;
    modal.show();
}
</script>
