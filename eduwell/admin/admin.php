<?php

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}


require_once "../classes/AdminKurzov.php";
use Admin\AdminKurzov;

// Pripojenie k databáze
$admin = new AdminKurzov(); 

$studenti = $admin->getAllStudents();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <title>Admin Panel</title>
	
	<!-- Bootstrap core CSS -->
    <link href="/eduwell/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/eduwell/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/eduwell/assets/css/templatemo-eduwell-style.css">
    <link rel="stylesheet" href="/eduwell/assets/css/owl.css">
    <link rel="stylesheet" href="/eduwell/assets/css/lightbox.css">
</head>
<body>
<?php include_once('../casti_stranky/header.php');  ?>

<section>
    <h2>Vitaj, admin!</h2>
    <a href="logout.php">Odhlásiť sa</a>

    <h2>Zoznam prihlásených na kurzy</h2>

<table border="1">
    <thead>
        <tr>
            <th>Názov kurzu</th>
            <th>Dátum kurzu</th>
            <th>Meno</th>
            <th>Priezvisko</th>
            <th>Pohlavie</th>
            <th>Vek</th>
            <th>Mesto bydliska</th>
            <th>Stav absolvovania</th>
            <th>Akcie</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($studenti as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['nazov_kurzu']) ?></td>
                <td><?= htmlspecialchars($student['datum_kurzu']) ?></td>
                <td><?= htmlspecialchars($student['meno']) ?></td>
                <td><?= htmlspecialchars($student['priezvisko']) ?></td>
                <td><?= htmlspecialchars($student['pohlavie']) ?></td>
                <td><?= htmlspecialchars($student['vek']) ?></td>
                <td><?= htmlspecialchars($student['mesto_bydliska']) ?></td>
                <td><?= htmlspecialchars($student['stav_absolvovania']) ?></td>
                <td>
                    <a href="update.php?id=<?= $student['id'] ?>">Upraviť</a> | 
                    <a href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('Naozaj chcete vymazať tohto študenta?')">Vymazať</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="insert.php">Pridať nového študenta</a>
</section>
<!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>

</body>
</html>


