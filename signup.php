<?php 
    require "header.php";
?>

    <main>
        <section>
            <h1 class="form-signup-head">Signup</h1>
           <?php
            
            // run the correct sign-in errors
            if (isset($_GET['error'])) { 
                if ($_GET['error'] == 'emptyfields') {
                    echo "<p class='signuperror'>Fill in all fields!</p>";
                } else if($_GET['error'] == 'invaliduidmail') {
                    echo "<p class='signuperror'>Invalid username and email!</p>";
                } else if($_GET['error'] == 'invaliduid') {
                    echo "<p class='signuperror'>Invalid username!</p>";
                } else if($_GET['error'] == 'invalidmail') {
                    echo "<p class='signuperror'>Invalid email!</p>";
                } else if($_GET['error'] == 'passwordcheck') {
                    echo "<p class='signuperror'>Your passwords do no match!</p>";
                } else if($_GET['error'] == 'usertaken') {
                    echo "<p class='signuperror'>Username is already taken!</p>";
                }
            }    
            else if (isset($_GET['signup']) == 'success') {
                echo '<p class="signupsuccess">Signup successful!</p>';
            }
            
            ?>
            
            <form class="form-signup" action="includes/signup.inc.php" method="post">
                <input class="input-info" type="text" name="uid" placeholder="Username">
                <input class="input-info" type="text" name="mail" placeholder="E-mail">
                <input class="input-info" type="password" name="pwd" placeholder="Password">
                <input class="input-info" type="password" name="pwd-repeat" placeholder="Repeat password">
                <button class="btn" type="submit" name="signup-submit">Signup</button>
            </form>
        </section>
    </main>

<?php 
    require "footer.php";
?>