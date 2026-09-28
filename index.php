<?php
// ==============================
// DATA PRODUK (disimpan dalam array PHP)
// ==============================
$produk = [
    [
        "nama"     => "Keyboard Mekanik K75",
        "kategori" => "Keyboard",
        "harga"    => 1250000,
        "stok"     => 12,
        "ikon"     => "⌨️",
    ],
    [
        "nama"     => "Mouse Wireless M300",
        "kategori" => "Mouse",
        "harga"    => 185000,
        "stok"     => 25,
        "ikon"     => "🖱️",
    ],
    [
        "nama"     => "Headset Gaming H7",
        "kategori" => "Audio",
        "harga"    => 425000,
        "stok"     => 0,
        "ikon"     => "🎧",
    ],
    [
        "nama"     => "Power Bank 20.000 mAh",
        "kategori" => "Charger",
        "harga"    => 299000,
        "stok"     => 8,
        "ikon"     => "🔋",
    ],
    [
        "nama"     => "Webcam 4K Pro C1000",
        "kategori" => "Kamera",
        "harga"    => 1350000,
        "stok"     => 0,
        "ikon"     => "📷",
    ],
    [
        "nama"     => "Flashdisk 64 GB USB 3.0",
        "kategori" => "Penyimpanan",
        "harga"    => 95000,
        "stok"     => 40,
        "ikon"     => "💾",
    ],
];

// ==============================
// FUNGSI BANTU
// ==============================
function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Diskon 10% untuk harga Rp1.000.000 atau lebih
const BATAS_DISKON = 1000000;
const PERSEN_DISKON = 10;

function hitungHargaDiskon($harga)
{
    return $harga - ($harga * PERSEN_DISKON / 100);
}

// Jumlah produk dihitung otomatis dari array
$totalProduk = count($produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | Cia Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container navbar__inner">
            <a href="#" class="brand">Cia<span>Store</span></a>
            <nav class="menu">
                <a href="#beranda">Beranda</a>
                <a href="#katalog">Katalog</a>
                <a href="#kontak">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero" id="beranda">
        <div class="container hero__inner">
            <h1>Perangkat dan aksesoris teknologi untuk kerja dan main.</h1>
            <p>Cia Store menyediakan keyboard, mouse, audio, dan perlengkapan harian lainnya dengan stok yang selalu diperbarui.</p>
            <a href="#katalog" class="btn btn--light">Lihat katalog</a>
        </div>
    </section>

    <!-- INFORMASI JUMLAH PRODUK -->
    <section class="info">
        <div class="container info__inner">
            <div class="info__item">
                <strong><?= $totalProduk; ?></strong>
                <span>Produk dalam katalog</span>
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK -->
    <main class="container katalog" id="katalog">
        <h2>Katalog Produk</h2>

        <div class="grid">
            <?php foreach ($produk as $item) : ?>
                <?php
                // Percabangan untuk menentukan status berdasarkan stok
                if ($item["stok"] > 0) {
                    $status      = "Tersedia";
                    $kelasStatus = "badge--ada";
                } else {
                    $status      = "Stok Habis";
                    $kelasStatus = "badge--habis";
                }

                // Percabangan untuk menentukan diskon berdasarkan harga
                $dapatDiskon = $item["harga"] >= BATAS_DISKON;
                if ($dapatDiskon) {
                    $hargaAkhir = hitungHargaDiskon($item["harga"]);
                }
                ?>
                <article class="card <?= $item["stok"] == 0 ? 'card--habis' : ''; ?>">
                    <div class="card__thumb"><?= $item["ikon"]; ?></div>

                    <div class="card__body">
                        <span class="card__kategori"><?= htmlspecialchars($item["kategori"]); ?></span>
                        <h3 class="card__nama"><?= htmlspecialchars($item["nama"]); ?></h3>
                        <?php if ($dapatDiskon) : ?>
                            <div class="harga">
                                <div class="harga__atas">
                                    <span class="harga__normal"><?= formatRupiah($item["harga"]); ?></span>
                                    <span class="badge-diskon">Diskon <?= PERSEN_DISKON; ?>%</span>
                                </div>
                                <p class="card__harga"><?= formatRupiah($hargaAkhir); ?></p>
                            </div>
                        <?php else : ?>
                            <p class="card__harga"><?= formatRupiah($item["harga"]); ?></p>
                        <?php endif; ?>

                        <div class="card__meta">
                            <span class="badge <?= $kelasStatus; ?>"><?= $status; ?></span>
                            <span class="card__stok">Stok: <?= $item["stok"]; ?></span>
                        </div>

                        <?php if ($item["stok"] > 0) : ?>
                            <button type="button" class="btn btn--beli">Beli Sekarang</button>
                        <?php else : ?>
                            <button type="button" class="btn btn--beli" disabled>Tidak tersedia</button>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer" id="kontak">
        <div class="container footer__inner">
            <div>
                <strong class="footer__brand">Cia Store</strong>
                <p>Toko perangkat dan aksesoris teknologi.</p>
            </div>
            <p>&copy; <?= date("Y"); ?> Cia Store. Semua hak dilindungi.</p>
        </div>
    </footer>

</body>
</html>