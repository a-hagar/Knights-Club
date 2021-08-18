<?php

use Webappdev\Knightsclub\models\{Database,Form};
require_once '../vendor/autoload.php';
//Just manually set values for session variables till login nd registration pages get ready
//$_SESSION['user_id'] = 1;
//$_SESSION['is_Admin'] = true;
if(isset($_SESSION['id']) && $_SESSION["isadmin"] == 1 ){
if (isset($_POST['deleteForm'])) {
  $id = $_POST['id'];
  $db = Database::getDb();

  $f = new Form();
  $form = $f->getFormById($id, $db);

  $user_id = $form->user_id;
  $subject = $form->subject;
  $content = $form->content;
  $date = $form->date;
}
if (isset($_POST['deleteconfirm'])) {
  $id = $_POST['id'];
  $db = Database::getDb();

  $f = new Form();
  $count = $f->deleteForm($id, $db);
  if ($count) {
    header("Location: ContactUsAdmin.php");
  } else {
    echo " Error in deleting!!";
  }


}
if (isset($_POST['close'])) {
  header("Location: ContactUsAdmin.php");
}
}else{
  header('Location:  ../ahmed-login/login.php');
}
require_once 'header.php';
?>

  <!-- MAIN CONTENT-->
  <div class="main-content">
  <div class="col-md-12">

  <div class="card">
    <div class="card-header">
      <strong class="card-title">Confirm Delete</strong>
    </div>
    <div class="card-body">

      <form method="post">
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
          <div>Are you sure you want to delete this Form?</div>
          You can't get this form back.
        </div>
        <input type="hidden" name="id" value="<?= $id; ?>"/>
        <div><?= $subject; ?></div>
        <div><?= $content; ?></div>
        <button name="deleteconfirm" class="btn btn-danger btn-sm">Delete</button>
        <button name="close" class="btn btn-primary btn-sm">Cancel</button>

      </form>
    </div>
  </div>
<?php require_once 'footer.php' ?>