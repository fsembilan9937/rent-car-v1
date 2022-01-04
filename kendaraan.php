<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Master Mobil</h1>
    </div>
    <?php
    if (isset($_GET['pg'])) :

      if (isset($_GET['act'])) :
        switch ($_GET['act']):
          case 'add':
            include "modul/kendaraan/in_kendaraan.php";
            break;

          case 'edit':
            include "modul/kendaraan/up_kendaraan.php";
            break;

          default:
            include "modul/kendaraan/r_kendaraan.php";
            break;
        endswitch;

      else :
        include "modul/kendaraan/r_kendaraan.php";
      endif;

    else :
      include "home.php";
    endif;
    ?>
  </section>
</div>