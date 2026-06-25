<?php
include('config.php');
session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

$error = '';
$success = '';
$editData = [];

if(isset($_REQUEST['id'])) {

    $id = $_REQUEST['id'];
    // echo $id; exit;

    $sql = "select * from items where id = '$id' ";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {

     $editData = mysqli_fetch_assoc($result);
    //  echo "<pre>";
    //  print_r($editData); exit;
    }
    else {
        $error = "No data found";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "<pre>"; print_r($_POST); exit;
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $id = $_POST['id'];

    $sql = "update items set name='$item_name', price='$item_price' where id = '$id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0) {
        $success = "Item Updated";
    }
    else {
        $error = "Could not add itesm Error .".mysqli_error($conn);
    }
}
?>

<?php
include('header.php');
include('navbar.php');
?>

<div class="row">
    <div class="col-md-8">

    <?php if($error) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if($success) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <h3>Update Item</h3>

        <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $editData['id'] ?>" />.

    <div class="col-md-6">
        <label for="item-name">Item name</label>
        <input type="text" class="form-control" name="item_name" value="<?php echo $editData['name'] ?>" placeholder="Enter item name" required/>
    </div>

    <div class="col-md-6">
        <label for="item-name">Price</label>
        <input type="text" class="form-control" value="<?php echo $editData['price'] ?>" name="item_price" placeholder="Enter Price" required/>
    </div>

    <div class="col-md-6">
         <img src="uploads/<?php echo $editData['image']; ?>" width="80" height="80">
        <label for="item-name">Image</label>
    </div>

    <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>

    </form>

    </div>
</div>

<?php
include('footer.php');
?>