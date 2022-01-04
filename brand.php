<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Master Brand</h1>
    </div>
    <?php
    if (isset($_GET['pg'])) :

      if (isset($_GET['act'])) :
        switch ($_GET['act']):
          case 'add':
            include "modul/brand/in_brand.php";
            break;

          case 'edit':
            include "modul/brand/up_brand.php";
            break;

          default:
            include "modul/brand/r_brand.php";
            break;
        endswitch;

      else :
        include "modul/brand/r_brand.php";
      endif;

    else :
      include "home.php";
    endif;
    ?>
  </section>
</div>