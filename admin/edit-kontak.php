<?php include 'header.php'; ?>
<?php
// Koneksi ke database

// Periksa apakah parameter `id` tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID kontak tidak ditemukan.");
}

$id_kontak = intval($_GET['id']);

// Ambil data kontak berdasarkan ID
$sql = "SELECT * FROM kontak_redaksi WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id_kontak);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Kontak tidak ditemukan.");
}

$kontak = $result->fetch_assoc();

// Proses penyimpanan perubahan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $telp_baru = htmlspecialchars($_POST['telp'], ENT_QUOTES, 'UTF-8');
    $no_handphone_baru = htmlspecialchars($_POST['no_handphone'], ENT_QUOTES, 'UTF-8');
    $email_baru = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $alamat_baru = htmlspecialchars($_POST['alamat'], ENT_QUOTES, 'UTF-8');

    if (empty($telp_baru) || empty($no_handphone_baru) || empty($email_baru) || empty($alamat_baru)) {
        $error = "Semua field harus diisi.";
    } else {
        $update_sql = "UPDATE kontak_redaksi SET telp = ?, no_handphone = ?, email = ?, alamat = ? WHERE id = ?";
        $update_stmt = $mysqli->prepare($update_sql);
        $update_stmt->bind_param("ssssi", $telp_baru, $no_handphone_baru, $email_baru, $alamat_baru, $id_kontak);

        if ($update_stmt->execute()) {
            header("Location: kontak.php?pesan=sukses_update");
            exit;
        } else {
            $error = "Gagal memperbarui kontak.";
        }
    }
}
?>
<div class="container-fluid body">
    <div class="row">
        <div class="col-lg-2 sidebar">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="col-lg-10 main-content">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-header"><i class="fa fa-folder-o"></i> Edit Kontak Redaksi</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-lg-6">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="telp">Telepon</label>
                                        <input class="form-control" id="telp" value="<?php echo htmlspecialchars($kontak['telp'], ENT_QUOTES, 'UTF-8'); ?>" name="telp" type="text" placeholder="Masukkan Telepon">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_handphone">No. Handphone</label>
                                        <input class="form-control" id="no_handphone" value="<?php echo htmlspecialchars($kontak['no_handphone'], ENT_QUOTES, 'UTF-8'); ?>" name="no_handphone" type="text" placeholder="Masukkan No. Handphone">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input class="form-control" id="email" value="<?php echo htmlspecialchars($kontak['email'], ENT_QUOTES, 'UTF-8'); ?>" name="email" type="email" placeholder="Masukkan E-mail">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" rows="3"><?php echo htmlspecialchars($kontak['alamat'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="submit" name="btn_edit">
                                            <i class="fa fa-check"></i> Edit
                                        </button>
                                        <a href="kontak_redaksi.php" class="btn btn-secondary btn-sm">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
