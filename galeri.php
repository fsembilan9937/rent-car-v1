<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Master Galeri</h1>
    </div>
    <?php
    if (isset($_GET['pg'])) :

      if (isset($_GET['act'])) :
        switch ($_GET['act']):
          case 'add':
            include "modul/galeri/in_galeri.php";
            break;

          case 'edit':
            include "modul/galeri/up_galeri.php";
            break;

          default:
            include "modul/galeri/r_galeri.php";
            break;
        endswitch;

      else :
        include "modul/galeri/r_galeri.php";
      endif;

    else :
      include "home.php";
    endif;
    ?>
  </section>
</div>