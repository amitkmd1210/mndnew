<?php
include('config.php');
session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

$error = '';
$success = '';

if(isset($_REQUEST['id'])) {

    $id = $_REQUEST['id'];
    // echo $id; exit;

    $sql = "delete from items where id = '$id' ";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_affected_rows($conn) > 0) {

    // unlink("uploads/" . $row['image']);
    // $success = "Row daleted successfully";
    header('Location: view_items.php');
    }
    else {
        $error = "Error".mysqli_error($conn);
    }
}
?>

<?php
include('header.php');
include('navbar.php');
?>


<?php if($error): ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<?php if($success): ?>
<div class="alert alert-danger"><?php echo $success; ?></div>
<?php endif; ?>

<?php
include('footer.php');
?>