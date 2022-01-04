<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Master Paket Rental</h1>
    </div>
    <?php
    if (isset($_GET['pg'])) :

      if (isset($_GET['act'])) :
        switch ($_GET['act']):
          case 'add':
            include "modul/paket/in_prental.php";
            break;

          case 'edit':
            include "modul/paket/up_prental.php";
            break;

          default:
            include "modul/paket/r_prental.php";
            break;
        endswitch;

      else :
        include "modul/paket/r_prental.php";
      endif;

    else :
      include "home.php";
    endif;
    ?>
  </section>
</div>