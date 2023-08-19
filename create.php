<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $Nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO mahasiswa VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $Nama, $nim, $fakultas, $alamat]);
    // Output message
    $msg = 'tambah data berhasil';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah mahasiswa</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="nama" id="nama">
        <label for="nim">nim</label>
        <label for="fakultas">fakultas</label>
        <input type="text" name="nim" id="nim">
        <input type="text" name="fakultas" id="fakultas">
        <label for="alamat">alamat</label>
        <input type="text" name="alamat" id="alamat">
        <input type="submit" value="Create data">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>