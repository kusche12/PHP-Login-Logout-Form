<?php 
    require "header.php";
?>

    <main>
        <section>
            <?php 
            if (isset($_SESSION['userId'])) { // You are logged in (this is SUPER IMPORTANT for changing content based on log in vs not logged in)
                echo '<p class="login-status">You are logged in!</p>';
            } else {
                echo '<p class="login-status">You are logged out!</p>';
            }
            ?>
        </section>
    </main>

<?php 
    require "footer.php";
?>
