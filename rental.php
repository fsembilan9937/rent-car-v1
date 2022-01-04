<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Master Rental</h1>
    </div>
    <?php
    if (isset($_GET['pg'])) :

      if (isset($_GET['act'])) :
        switch ($_GET['act']):
          case 'add':
            include "modul/rental/in_rental.php";
            break;

          case 'edit':
            include "modul/rental/up_rental.php";
            break;

          default:
            include "modul/rental/r_rental.php";
            break;
        endswitch;

      else :
        include "modul/rental/r_rental.php";
      endif;

    else :
      include "home.php";
    endif;
    ?>
  </section>
</div>