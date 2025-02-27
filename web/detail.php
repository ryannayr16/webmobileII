<?php
session_start(); // Mulai sesi untuk melacak pengunjung
include 'header.php';

if (!isset($_GET['id'])) redirect('404');

// Dapatkan ID berita dari URL
$id_berita = $_GET['id'];

// Query untuk mendapatkan detail berita
$sqlDetail = 'SELECT
    berita.judul,
    berita.gambar,
    berita.teks_berita,
    berita.tgl_posting,
    berita.id_admin,
    berita.dilihat,
    admin.id_admin,
    admin.nama_lengkap,
    kategori.id_kategori,
    kategori.kategori
FROM
    admin
INNER JOIN berita ON admin.id_admin = berita.id_admin
INNER JOIN kategori ON kategori.id_kategori = berita.id_kategori
WHERE berita.id_berita = "'.$id_berita.'"';

$qryDetail = $mysqli->query($sqlDetail) or die("Error retrieving detail:" . $mysqli->error);

$found = $qryDetail->num_rows;

if ($found > 0) {
    $detail = $qryDetail->fetch_assoc();

    // Periksa apakah berita ini sudah dilihat sebelumnya dalam sesi
    if (!isset($_SESSION['viewed_'.$id_berita])) {
        // Tambahkan 1 ke jumlah dilihat
        $stat = $detail['dilihat'] + 1;
        $sqlStat = 'UPDATE berita SET dilihat = "'.$stat.'" WHERE id_berita = "'.$id_berita.'"';
        $mysqli->query($sqlStat) or die("Error menyimpan statistik: " . $mysqli->error);

        // Tandai berita ini sebagai sudah dilihat dalam sesi
        $_SESSION['viewed_'.$id_berita] = true;
    }
} else {
    echo "<script>window.location = '404.php'</script>";
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="container konten-wrapper">
            <div class="panel panel-default">
                <div class="panel-body main">
                    <div class="col-md-8">
                        <div class="post-detail">
                            <div class="row post-title">
                                <div class="col-sm-12">
                                    <span><?php echo strtoupper($detail['judul']); ?></span>
                                </div>
                            </div>
                            <div class="row post-meta">
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;
                                    <a href="<?php echo $base_url . 'author.php?id=' . $detail['id_admin']; ?>"><?php echo $detail['nama_lengkap']; ?></a>
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;<?php echo $detail['tgl_posting']; ?>
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;<?php echo $detail['dilihat'] ?>x
                                </div>
                                <div class="col-sm-3">
                                    <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;
                                    <a href="<?php echo $base_url . 'kategori.php?id=' . $detail['id_kategori'] . '&amp;kategori=' . strtolower($detail['kategori']); ?>">
                                        <em><?php echo $detail['kategori']; ?></em>
                                    </a>
                                </div>
                            </div>
                            <div class="row post-content">
                                <div class="col-sm-12">
                                    <div class="image wow fadeIn">
                                        <img src="<?php echo $base_url; ?>images/<?php echo $detail['gambar']; ?>">
                                    </div>
                                    <div class="text">
                                        <?php echo $detail['teks_berita']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include 'sidebar.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
