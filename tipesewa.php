<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Master Tipe Sewa</h1>
    </div>
    <?php
    if (isset($_GET['pg'])) :

      if (isset($_GET['act'])) :
        switch ($_GET['act']):
          case 'add':
            include "modul/tipesewa/in_tsewa.php";
            break;

          case 'edit':
            include "modul/tipesewa/up_tsewa.php";
            break;

          default:
            include "modul/tipesewa/r_tsewa.php";
            break;
        endswitch;

      else :
        include "modul/tipesewa/r_tsewa.php";
      endif;

    else :
      include "home.php";
    endif;
    ?>
  </section>
</div>