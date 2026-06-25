<?php
include('config.php');

session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "<pre>"; print_r($_POST); exit;
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];

    $image_name = $_FILES['image']['name'];
    $image_files = $_FILES['image']['tmp_name'];

    $filename = time().'_'.$image_name;
    move_uploaded_file($image_files, "uploads/".$filename);

    $sql = "insert into items(name, price, image) values('$item_name', '$item_price', '$filename')";
    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0) {
        $success = "Item added";
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

        <h3>Add Item</h3>

        <form action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-6">
        <label for="item-name">Item Name</label>
        <input type="text" class="form-control" name="item_name" placeholder="Enter item name" required/>
    </div>

    <div class="col-md-6">
        <label for="item-name">Price</label>
        <input type="text" class="form-control" name="item_price" placeholder="Enter Price" required/>
    </div>

    <div class="col-md-6">
        <label for="item-name">Image</label>
        <input type="file" class="form-control" name="image" placeholder="Enter Price" required/>
    </div>

    <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>

    </form>

    </div>
</div>

<?php
include('footer.php');
?>