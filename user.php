<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Master User</h1>
    </div>
    <?php
    if (isset($_GET['pg'])) :

      if (isset($_GET['act'])) :
        switch ($_GET['act']):
          case 'add':
            include "modul/user/in_user.php";
            break;

          case 'edit':
            include "modul/user/up_user.php";
            break;

          default:
            include "modul/user/r_user.php";
            break;
        endswitch;

      else :
        include "modul/user/r_user.php";
      endif;

    else :
      include "home.php";
    endif;
    ?>
  </section>
</div>