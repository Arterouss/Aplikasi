<?php
if (isset($_POST['hitung'])) {
  $nama = trim($_POST['nama']);
  $menu = $_POST['menu'];
  $jumlah_makanan = intval($_POST['jumlah_makanan']);
  $minuman = $_POST['minuman'];
  $jumlah_minuman = intval($_POST['jumlah_minuman']);

  // Validasi nama hanya huruf
  if (!preg_match("/^[A-Za-z\s]+$/", $nama)) {
    die("<script>alert('Nama hanya boleh huruf A-Z!'); history.back();</script>");
  }

  // Validasi input kosong
  if (empty($nama) || empty($menu) || $jumlah_makanan <= 0) {
    die("<script>alert('Input tidak lengkap!'); history.back();</script>");
  }

  // Validasi makanan: 1–15
  if ($jumlah_makanan < 1 || $jumlah_makanan > 15) {
    die("<script>alert('Jumlah makanan harus antara 1–15!'); history.back();</script>");
  }

  // Validasi minuman: 0–15
  if ($jumlah_minuman < 0 || $jumlah_minuman > 15) {
    die("<script>alert('Jumlah minuman harus antara 0–15!'); history.back();</script>");
  }

  // Harga
  $harga_makanan = [
    "Gacoan" => 25000,
    "Kebab" => 20000,
    "Nasi Padang" => 15000,
    "Molen" => 10000
  ];

  $harga_minuman = [
    "Es Teh" => 5000,
    "Matcha" => 10000,
    "Jus Jeruk" => 8000,
    "Es Sodor" => 11000,
    "-" => 0
  ];

  $total_makanan = $harga_makanan[$menu] * $jumlah_makanan;
  $total_minuman = $harga_minuman[$minuman] * $jumlah_minuman;
  $total = $total_makanan + $total_minuman;
  $pajak = $total * 0.1;
  $total_bayar = $total + $pajak;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Struk Pemesanan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="struk-container">
    <h3>Struk Pemesanan</h3>
    <table class="struk-tabel">
      <tr><th>Nama</th><td><?= htmlspecialchars($nama) ?></td></tr>
      <tr><th>Makanan</th><td><?= $menu ?> (<?= $jumlah_makanan ?> x Rp <?= number_format($harga_makanan[$menu], 0, ',', '.') ?>)</td></tr>
      <tr><th>Minuman</th><td><?= $minuman ?> (<?= $jumlah_minuman ?> x Rp <?= number_format($harga_minuman[$minuman], 0, ',', '.') ?>)</td></tr>
      <tr><th>Subtotal</th><td>Rp <?= number_format($total, 0, ',', '.') ?></td></tr>
      <tr><th>Pajak (10%)</th><td>Rp <?= number_format($pajak, 0, ',', '.') ?></td></tr>
      <tr><th>Total Bayar</th><td><b>Rp <?= number_format($total_bayar, 0, ',', '.') ?></b></td></tr>
    </table>
    <p class="terima-kasih">Terima kasih telah memesan di tempat kami!</p>
    <div class="pesan-lagi">
      <button class="btn-reset" onclick="window.location.href='index.html'">Pesan Lagi</button>
    </div>
  </div>
</body>
</html>
<?php
}
?>
