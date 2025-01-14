<?php include 'header.php'; ?>
<?php
// Koneksi ke database

// Periksa apakah parameter `id` tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID kategori tidak ditemukan.");
}

$id_kategori = intval($_GET['id']);

// Ambil data kategori berdasarkan ID
$sql = "SELECT * FROM kategori WHERE id_kategori = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id_kategori);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Kategori tidak ditemukan.");
}

$kategori = $result->fetch_assoc();

// Proses penyimpanan perubahan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori_baru = htmlspecialchars($_POST['kategori'], ENT_QUOTES, 'UTF-8');

    if (empty($kategori_baru)) {
        $error = "Nama kategori tidak boleh kosong.";
    } else {
        $update_sql = "UPDATE kategori SET kategori = ? WHERE id_kategori = ?";
        $update_stmt = $mysqli->prepare($update_sql);
        $update_stmt->bind_param("si", $kategori_baru, $id_kategori);

        if ($update_stmt->execute()) {
            header("Location: kategori.php?pesan=sukses_update");
            exit;
        } else {
            $error = "Gagal memperbarui kategori.";
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
                            <h2 class="page-header"><i class="fa fa-folder-o"></i> Edit Kategori</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-lg-6">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="kategori">Nama Kategori</label>
                                        <input class="form-control" id="kategori" value="<?php echo htmlspecialchars($kategori['kategori'], ENT_QUOTES, 'UTF-8'); ?>" name="kategori" type="text" placeholder="Tambah Kategori">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="submit" name="btn_edit">
                                            <i class="fa fa-check"></i> Edit
                                        </button>
                                        <a href="kategori.php" class="btn btn-secondary btn-sm">Batal</a>
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