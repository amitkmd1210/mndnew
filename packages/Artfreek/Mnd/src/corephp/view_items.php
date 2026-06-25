<?php
include('config.php');

session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

$error = '';
$success = '';
$data = [];

$sql = "select * from items order by id desc";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    // echo "<pre>"; print_r($data);
}
else {
    $error = "No data found";
}

?>
<?php
include('header.php');
include('navbar.php');
?>

<div class="table-responsive">
    <center><h3 class="tbl">View Items</h3></center>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Created Date</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if(!empty($data)) {

        foreach($data as $key => $value) {
        ?>
        <tr>
            <td><?php echo $key + 1; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['price']; ?></td>
            <td><img src="uploads/<?php echo $value['image']; ?>" alt="" width="60" height="60"></td>
            <td><a href="edit_item.php?id=<?php echo $value['id']; ?>" class="btn btn-primary" >Edit</a>&nbsp;<a href="delete_item.php?id=<?php echo $value['id']; ?>" class="btn btn-danger" onclick="delete_fun()">Delete</a></td>
            
        </tr>
        <?php 
        }
        }
        else {
            ?>
            <tr>
                <td>
                    <span>No data found.</span>
                </td>
                
            </tr>
            <?php
        }
         ?>
    </tbody>
</table>
</div>

<?php
include('footer.php');
?>
<script>
    function delete_fun() {
        alert('Are you want to delete!');
    }
</script>