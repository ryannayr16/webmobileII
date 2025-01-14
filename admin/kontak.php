<?php include 'header.php'; ?>
<?php
$limit = 10;
if(isset($_GET['p'])) {
    $noPage = $_GET['p'];
} else {
    $noPage = 1;
}

$offset = ($noPage - 1) * $limit;

$sql = "SELECT id, telp, no_handphone, email, alamat FROM kontak_redaksi LIMIT ".$offset.",".$limit;
$qry = $mysqli->query($sql) or die ($mysqli->error);

$sql_rec = "SELECT id FROM kontak_redaksi";

$total_rec = $mysqli->query($sql_rec);

$total_rec_num = $total_rec->num_rows;

$total_page = ceil($total_rec_num / $limit);

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
							<h2 class="page-header"><i class="fa fa-folder-o"></i> Kontak Redaksi</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="clear"></div>
							<hr>
							<table class="table table-hover">
								<thead>
									<tr>
										<th width="5%" style="text-align: right">ID</th>
										<th width="15%">Telepon</th>
										<th width="15%">No. Handphone</th>
										<th width="20%">E-mail</th>
										<th width="35%">Alamat</th>
										<th width="10%" style="text-align: center">Pilihan</th>
									</tr>
								</thead>
								<tbody>
								<?php while ($kontak = $qry->fetch_assoc()) { ?>
									<tr>
										<td align="right"><?php echo $kontak['id']; ?></td>
										<td><?php echo $kontak['telp']; ?></td>
										<td><?php echo $kontak['no_handphone']; ?></td>
										<td><?php echo $kontak['email']; ?></td>
										<td><?php echo $kontak['alamat']; ?></td>
										<td align="center">
											<a href="edit-kontak.php?act=edit&amp;id=<?php echo $kontak['id']; ?>" class="btn btn-sm btn-success">
												<i class="fa fa-edit"></i>
											</a>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12">
							<ul class="pagination">
							<?php if ($noPage > 1) { ?>

								<li>
									<a href="<?php echo "kontak_redaksi.php?p=".($noPage-1); ?>">
										<i class="glyphicon glyphicon-chevron-left"></i>
									</a>
								</li>

							<?php } ?>

							<?php for ($page = 1; $page <= $total_page; $page++) { ?>
								<?php if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $total_page)) { ?>
									<?php
										if ($page == $total_page && $noPage <= $total_page-5) echo "<li class='active'><a>...</a></li>";
										if ($page == $noPage) echo "<li class='active'><a href='#'>".$page."</a></li> ";
										else echo " <li><a href='".$_SERVER['PHP_SELF']."?p=".$page."'>".$page."</a></li> ";
										if ($page == 1 && $noPage >=6) echo "<li class='active'><a>...</a></li>";
									?>
								<?php } ?>
							<?php } ?>

							<?php if ($noPage < $total_page) { ?>
								<li>
									<a href="<?php echo "kontak_redaksi.php?p=".($noPage+1); ?>">
										<i class="glyphicon glyphicon-chevron-right"></i>
									</a>
								</li>
							<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
