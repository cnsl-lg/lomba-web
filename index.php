<?php
session_start();

if(!isset($_SESSION["login"])) {
  header('Location: login.php');
  exit;
}

require 'functions.php';

// MENGIRIMKAN PARAMETER AMBIL TABEL KE FUNCTION query
$topTrending = query("SELECT * FROM overview WHERE keterangan = 'trending' LIMIT 3");
$topFirst = query("SELECT * FROM overview WHERE keterangan = 'top' LIMIT 1");
$testimoni = query("SELECT * FROM testimoni");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website Pariwisata</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light shadow-lg">
    <div class="container">
      <a class="navbar-brand fw-bold fs-3 text-primary" href="#">MaduraCation</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body ms-lg-auto">
          <div class="navbar-nav">
            <a class="nav-link fs-5 me-lg-4 fw-bold" href="#trending-tour">Trending Tour</a>
            <a class="nav-link fs-5 me-lg-4 fw-bold" href="#top-destination">Top Destination</a>
            <a class="nav-link fs-5 me-lg-4 fw-bold" href="#testimonial">Testimonial</a>
            <button class="language btn d-flex align-items-center gap-2 p-0 fw-semibold me-lg-4 py-2 py-lg-0">
              <i class="bi bi-globe fs-5"></i>
              <p class="d-lg-none m-0">Select language</p>
            </button>
            <a class="btn btn-primary my-3 my-lg-0 me-lg-2 rounded-4 d-flex align-items-center" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->

  <!-- Header -->
  <header class="header-home">
    <div class="container h-100 d-flex justify-content-center align-items-center">
      <div class="row">
        <div class="col text-center text-light">
          <h1 class="fw-bold mb-2">Selamat Datang Di Website <span>MaduraCation</span></h1>
          <p class="fs-4 fw-semibold mb-4">Temukan destinasi favoritmu di madura.</p>
          <form>
            <input type="text" class="form-control rounded-pill" id="text" placeholder="Cari tempat destinasi">
          </form>
        </div>
      </div>
    </div>
  </header>
  <!-- Akhir Header -->

  <!-- Trending Tour -->
  <div class="trending-tour" id="trending-tour">
    <div class="container">
      <div class="row mb-4">
        <div class="col text-center">
          <h2 class="fs-1 fw-bold">Trending Tour in 2023</h2>
          <p class="fs-5">Tempat - tempat destinasi yang sedang ramai dikunjungi para pariwisatawan.</p>
        </div>
      </div>
      <div class="row justify-content-center justify-content-sm-evenly">
        <?php foreach($topTrending as $item) :?>
        <div class="col-lg-3 col-sm-5 mb-4">
          <div class="card small-card rounded-4 overflow-hidden">
            <img src="images/<?= $item["gambar"];?>" class="card-img-top" alt="Air Terjun Toroan">
            <div class="card-body">
              <h5 class="card-title"><?= $item["nama"];?></h5>
              <p class="card-text"><?= $item["deskripsi"];?></p>
              <a href="<?= $item["link"];?>.php" class="btn btn-primary w-100 rounded-pill">Go somewhere</a>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <!-- Akhir Trending Tour -->

  <!-- Top Destination -->
  <div class="top-destination container" id="top-destination">
    <div class="row align-items-center">
      <div class="col-lg-5 text-center">
        <h2 class="fw-bold display-5 mb-3 mb-lg-0 fst-italic">Top Destination</h2>
      </div>
      <div class="col-lg-7">
        <a href="gualaban.php">
          <?php foreach($topFirst as $item) :?>
          <div class="card text-bg-dark rounded-5 overflow-hidden">
            <img src="images/<?= $item["gambar"];?>" class="card-img" alt="Gua Blaban - Pamekasan" style="filter: brightness(40%);">
            <div class="card-img-overlay">
              <h1 class="card-title fw-bolder text-light"><?= $item["nama"];?></h1>
              <p class="card-text fw-semibold text-light"><?= $item["deskripsi"];?></p>
              <p class="card-text text-light"><small>Last updated 3 mins ago</small></p>
            </div>
          </div>
          <?php endforeach;?>
        </a>
      </div>
    </div>
  </div>
  <!-- Akhir Top Destination -->

  <!-- Testimonial -->
  <div class="testimonial container my-5" id="testimonial">
    <div class="row mb-3">
      <div class="col text-center">
        <h2 class="fs-1 fw-bold">Testimonial Pengunjung</h2>
      </div>
    </div>
    <div class="row justify-content-sm-around justify-content-center gap-1">
      <?php foreach($testimoni as $item) :?>
      <div class="col-lg-3 col-sm-5 mb-4">
        <div class="card small-card rounded-4 overflow-hidden">
          <div class="card-body text-center">
            <div class="header mb-4 d-flex justify-content-around align-items-center">
              <h5 class="card-titl"><?= $item["namaUser"];?></h5>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" role="button"></button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="ubah.php?id=<?php echo $item["id"];?>">Ubah</a></li>
                  <li><a class="dropdown-item" href="hapus.php?id=<?php echo $item["id"];?>" onclick="return confirm('Anda yakin ingin menghapusnya?');">Hapus</a></li>
                </ul>
              </div>
            </div>
            <p class="card-text"><?= $item["komentar"];?></p>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <!-- Akhir Testimonial -->

  <!-- Subscribe -->
  <div class="subscribe container">
    <div class="row align-items-center d-flex flex-column flex-sm-row">
      <div class="col">
        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="100%" height="511.67482" viewBox="0 0 740.85681 511.67482" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M963.4284,387.83741h-.20019l-114.79981,49.02-157.06982,67.07a5.06611,5.06611,0,0,1-3.88037.02l-162.04981-67.23-117.62011-48.8-.17969-.08h-.2002a7.00778,7.00778,0,0,0-7,7v304a7.00779,7.00779,0,0,0,7,7h556a7.00778,7.00778,0,0,0,7-7v-304A7.00778,7.00778,0,0,0,963.4284,387.83741Z" transform="translate(-229.5716 -194.16259)" fill="#fff"/><path d="M965.42767,389.83741a.99681.99681,0,0,1-.5708-.1792L688.298,197.05469a5.01546,5.01546,0,0,0-5.72851.00977L408.00274,389.65626a1.00019,1.00019,0,0,1-1.14868-1.6377l274.567-192.5918a7.02216,7.02216,0,0,1,8.02-.01318l276.55884,192.603a1.00019,1.00019,0,0,1-.57227,1.8208Z" transform="translate(-229.5716 -194.16259)" fill="#3f3d56"/><polygon points="194.121 202.502 456.132 8.319 720.132 216.319 469.632 364.819 333.632 333.819 194.121 202.502" fill="#e6e6e6"/><path d="M574.68393,650.70367H445.24362a6.04737,6.04737,0,1,1,0-12.09473H574.68393a6.04737,6.04737,0,1,1,0,12.09473Z" transform="translate(-229.5716 -194.16259)" fill="#6c63ff"/><path d="M491.68393,624.70367H445.24362a6.04737,6.04737,0,1,1,0-12.09473h46.44031a6.04737,6.04737,0,1,1,0,12.09473Z" transform="translate(-229.5716 -194.16259)" fill="#6c63ff"/><path d="M689.38856,504.82207a7.56366,7.56366,0,0,1-2.86914-.562L524.9286,437.21123v-209.874a7.00818,7.00818,0,0,1,7-7h310a7.00817,7.00817,0,0,1,7,7v210.0205l-.30371.12989L692.34462,504.22734A7.6162,7.6162,0,0,1,689.38856,504.82207Z" transform="translate(-229.5716 -194.16259)" fill="#fff"/><path d="M689.38856,505.32158a8.07177,8.07177,0,0,1-3.05957-.59863L524.4286,437.54521v-210.208a7.50851,7.50851,0,0,1,7.5-7.5h310a7.50851,7.50851,0,0,1,7.5,7.5V437.68779l-156.88769,66.999A8.10962,8.10962,0,0,1,689.38856,505.32158Zm-162.96-69.1123,160.66309,66.66455a6.11822,6.11822,0,0,0,4.668-.02784L847.4286,436.36748V227.33721a5.50653,5.50653,0,0,0-5.5-5.5h-310a5.50654,5.50654,0,0,0-5.5,5.5Z" transform="translate(-229.5716 -194.16259)" fill="#3f3d56"/><path d="M963.4284,387.83741h-.20019l-114.79981,49.02-157.06982,67.07a5.06611,5.06611,0,0,1-3.88037.02l-162.04981-67.23-117.62011-48.8-.17969-.08h-.2002a7.00778,7.00778,0,0,0-7,7v304a7.00779,7.00779,0,0,0,7,7h556a7.00778,7.00778,0,0,0,7-7v-304A7.00778,7.00778,0,0,0,963.4284,387.83741Zm5,311a5.002,5.002,0,0,1-5,5h-556a5.002,5.002,0,0,1-5-5v-304a5.01106,5.01106,0,0,1,4.81006-5l118.18994,49.04,161.28028,66.92a7.12081,7.12081,0,0,0,5.43994-.03l156.27978-66.74,115.2002-49.19a5.0162,5.0162,0,0,1,4.7998,5Z" transform="translate(-229.5716 -194.16259)" fill="#3f3d56"/><path d="M664.23161,298.78882h-110a8,8,0,1,1,0-16h110a8,8,0,0,1,0,16Z" transform="translate(-229.5716 -194.16259)" fill="#6c63ff"/><path d="M607.23161,264.78882h-53a8,8,0,1,1,0-16h53a8,8,0,0,1,0,16Z" transform="translate(-229.5716 -194.16259)" fill="#6c63ff"/><path d="M769.20012,378.78882h-168a8,8,0,1,1,0-16h168a8,8,0,0,1,0,16Z" transform="translate(-229.5716 -194.16259)" fill="#ccc"/><path d="M769.20012,415.78882h-168a8,8,0,1,1,0-16h168a8,8,0,0,1,0,16Z" transform="translate(-229.5716 -194.16259)" fill="#ccc"/><path d="M270.5196,425.141a4.50805,4.50805,0,0,1-4.41113-3.61572L262.4698,403.3861a37.00031,37.00031,0,0,1,72.55566-14.55225l3.6377,18.13916a4.50457,4.50457,0,0,1-3.52637,5.29688L271.40632,425.0526A4.51285,4.51285,0,0,1,270.5196,425.141Z" transform="translate(-229.5716 -194.16259)" fill="#2f2e41"/><polygon points="154.088 501.059 142.656 501.058 137.22 456.962 154.092 456.963 154.088 501.059" fill="#a0616a"/><path d="M134.49,497.79125h22.04782a0,0,0,0,1,0,0v13.88195a0,0,0,0,1,0,0H120.60812a0,0,0,0,1,0,0v0A13.88193,13.88193,0,0,1,134.49,497.79125Z" fill="#2f2e41"/><polygon points="34.969 500.944 24.442 496.486 36.63 453.76 52.166 460.341 34.969 500.944" fill="#a0616a"/><path d="M244.738,685.49875h22.04781a0,0,0,0,1,0,0V699.3807a0,0,0,0,1,0,0H230.856a0,0,0,0,1,0,0v0A13.88193,13.88193,0,0,1,244.738,685.49875Z" transform="translate(60.18447 -236.37171) rotate(22.95463)" fill="#2f2e41"/><circle cx="70.22361" cy="201.87183" r="24.56103" fill="#a0616a"/><path d="M300.95772,507.76609l-.252-.81836c-6.69263-21.75439-13.61035-44.23975-20.53784-65.62549l-.1875-.57715.42578-.43261c10.75293-10.93848,30.89721-15.30176,46.85864-10.146,16.064,5.18555,27.134,19.731,25.75024,33.83447a36.13073,36.13073,0,0,0,6.428,23.89307l.64087.92969-1.00195.52344A181.86993,181.86993,0,0,1,301.80562,507.643Z" transform="translate(-229.5716 -194.16259)" fill="#3f3d56"/><path d="M271.3359,687.18308a4.98652,4.98652,0,0,1-2.49341-.67285l-13.26734-7.66211a4.97281,4.97281,0,0,1-2.03027-6.44629l29.48071-69.95215,22.53076-102.02441,41.0608-14.93066.37329.17187c44.02173,20.22168,40.61889,165.165,39.4895,194.01563a5.005,5.005,0,0,1-4.55835,4.77636l-12.34717,1.61328a5.0459,5.0459,0,0,1-5.40918-4.13671l-25.207-112.6543a1.00107,1.00107,0,0,0-.82251-.86817.97679.97679,0,0,0-1.04224.49219L275.70821,684.61961a4.97955,4.97955,0,0,1-3.04956,2.38476A5.04155,5.04155,0,0,1,271.3359,687.18308Z" transform="translate(-229.5716 -194.16259)" fill="#2f2e41"/><path d="M286.08274,584.37668a9.37694,9.37694,0,0,0-3.87036-13.84776l.67146-21.41747L269.968,545.529l-.52343,30.25894a9.42778,9.42778,0,0,0,16.63814,8.58875Z" transform="translate(-229.5716 -194.16259)" fill="#a0616a"/><path d="M269.6357,561.73777l-.75806-.00391a4.96987,4.96987,0,0,1-4.92309-4.60644c-1.23877-15.95117-5.043-70.28613-1.97925-99.74463a20.76393,20.76393,0,0,1,24.1853-17.40869l.78858.17431-.00586.80811c-.28076,38.7583-.2627,77.29-.24512,114.55371a4.99852,4.99852,0,0,1-3.90527,4.88965A64.50946,64.50946,0,0,1,269.6357,561.73777Z" transform="translate(-229.5716 -194.16259)" fill="#6c63ff"/><path d="M299.038,608.22117a13.58219,13.58219,0,0,1-13.42285-11.93164l1.08765-89.45117-17.779-44.96973a26.40455,26.40455,0,0,1,16.98462-28.06348l4.75293-1.78271a7.28575,7.28575,0,0,1,9.38964,4.291L318.38375,485.811l.00464.07227c1.27124,19.70019,7.00854,117.749-4.43067,120.67383a63.11805,63.11805,0,0,1-14.78979,1.66308Z" transform="translate(-229.5716 -194.16259)" fill="#6c63ff"/><path d="M404.65474,550.60549a9.377,9.377,0,0,1-4.41049-13.68532l-12.3744-17.4938,8.79685-10.11275,17.12808,24.95007a9.42779,9.42779,0,0,1-9.14,16.3418Z" transform="translate(-229.5716 -194.16259)" fill="#a0616a"/><path d="M392.29806,528.12344a4.03709,4.03709,0,0,1-3.24621-1.80777l-.065-.09847c-20.47511-30.9902-41.64716-63.03519-63.10521-94.98042l-.231-.34423.29529-.291a19.09777,19.09777,0,0,1,14.08426-5.10753,18.82025,18.82025,0,0,1,13.90706,6.52325c18.75145,22.81535,45.51338,70.16921,53.26874,84.1399a3.962,3.962,0,0,1-1.23382,5.23137,63.42116,63.42116,0,0,1-12.16521,6.47171A3.82563,3.82563,0,0,1,392.29806,528.12344Z" transform="translate(-229.5716 -194.16259)" fill="#6c63ff"/><path d="M385.424,588.28465c-12.26416.00781-56.1438-84.48243-64.81543-101.41993l-.075-.20507-9.59277-51.82813a7.28388,7.28388,0,0,1,5.8667-8.49365l4.99609-.90332a26.40512,26.40512,0,0,1,28.95972,15.40674l12.53466,52.6875,41.91309,71.21191a13.59134,13.59134,0,0,1-5.47681,17.292,63.07627,63.07627,0,0,1-13.55566,6.14649,2.67131,2.67131,0,0,1-.75464.10547Z" transform="translate(-229.5716 -194.16259)" fill="#6c63ff"/><path d="M318.87117,396.24694h-49.5v-6a25.02817,25.02817,0,0,1,25-25h4a25.02817,25.02817,0,0,1,25,25v1.5A4.50493,4.50493,0,0,1,318.87117,396.24694Z" transform="translate(-229.5716 -194.16259)" fill="#2f2e41"/></svg>
      </div>
      <div class="col mb-5 mb-sm-0">
        <h2>Subscribe Untuk Mendapatkan Berita Terbaru</h2>
        <form action="" method="post">
          <input type="email" class="form-control mt-4 mb-3" id="email" placeholder="Masukkan email" name="email" required>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Akhir Subscribe -->

  <!-- Footer -->
  <footer class="bg-primary text-light py-5">
    <div class="container">
      <div class="row flex-column flex-sm-row">
        <div class="col">
          <h4>Kontak kami</h4>
          <p class="mb-1"><i class="bi bi-envelope-fill"></i> email : evan@gmail.com</p>
          <p><i class="bi bi-geo-alt-fill"></i> Jl. Nangka 6, No. 21, Perumnas kamal, Bangkalan</p>
        </div>
        <div class="col text-center text-sm-start mt-5 mt-sm-0">
          <p>Copyright MaduraVocation 2023, All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Akhir Footer -->

  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="library/jquery/jquery.min.js"></script>
  <script>
    // TOGGLE UNTUK BACKGROUND PADA NAVBAR
    $(window).scroll(function() {
      $('.navbar').toggleClass('bg-light shadow-lg', $(this).scrollTop()>50);
    })
  </script>
</body>
</html>