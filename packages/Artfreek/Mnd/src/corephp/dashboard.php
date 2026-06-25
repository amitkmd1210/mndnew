<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

?>
<?php
include('header.php');
include('navbar.php');
?>

    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>Email: <?php echo $_SESSION['email']; ?></p>

    

<?php
include('footer.php');
?>