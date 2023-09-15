<?php

    include('config/databaseConn.php');

    $errors = array('name' => '', 'email' => '', 'app' => '', 'lang' => '');
    $name = $email = $app = $lang = $form = '';

    if(isset($_POST['submit'])){
        if (empty($_POST['name'])) {
            $errors['name'] = "We would like to know your name.";
        }else {
            $name = $_POST['name'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
                $errors['name'] = "Only letters and spaces please!";
            }
        }

        if (empty($_POST['email'])) {
            $errors['email'] = "We would need your e-mail address to proceed to the next phase.";
        }else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Please provide a valid e-mail address!";
            }
        }

        if (empty($_POST['app'])) {
            $errors['app'] = 'We would like to know the name of your app.';
        }else {
            $app = $_POST['app'];
            $app1 = htmlspecialchars($_POST['app'])  . '<br/>';;
        }
        
        if (empty($_POST['lang'])) {
            $errors['lang'] = "We would like to know the languages you used for your app, at least two.";
        }else {
            $lang = $_POST['lang'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)+$/', $lang)) {
                $errors['lang'] =  "Separate with a comma please! Note: Write C++ as Cpp";
            }
        }
        if (array_filter($errors)) {

        }else{
            $name = mysqli_real_escape_string($connect, $_POST['name']);
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $app = mysqli_real_escape_string($connect, $_POST['app']);
            $lang = mysqli_real_escape_string($connect, $_POST['lang']);

            $sql = "INSERT INTO data(name, email, app, lang) VALUES('$name', '$email', '$app', '$lang')";

            if (mysqli_query($connect, $sql)) {
                echo "Your data has been received at our end";
                header ('Location: index.php');

            }else {
                echo "Query error : " . mysqli_error($connect);
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    
    <?php include('templates/header.php'); ?>
        <section class="container grey-text">
            <h3 class="center">Add your app</h3>
            <form action="drop.php" class="white" method="POST">
                <label>Your name:</label>
                <input type="text" name="name" value="<?php echo $name;?>"> 
                <div class="red-text"><?php echo htmlspecialchars($errors['name']);?></div><br>
                <label>Your e-mail:</label>
                <input type="text" name="email" value="<?php echo $email;?>"> 
                <div class="red-text"><?php echo htmlspecialchars($errors['email']);?></div><br>
                <label>Your app:</labele>
                <input type="text" name="app" value="<?php echo $app;?>"> 
                <div class="red-text"><?php echo htmlspecialchars($errors['app']);?></div><br>
                <label">Coding languages (separate with a comma):</label>
                <input type="text" name="lang" value="<?php echo $lang;?>">
                <div class="red-text"><?php echo htmlspecialchars($errors['lang']);?></div><br>
                <div class="center">
                <?php if ((array_filter($errors))) {
                        echo '<div class="red-text">There are errors in the form</div><br />';
                        }else {
                            echo '<div class="green-text">The form is empty</div> <br />';
                            }?>
                    <input type="submit" value="Submit" name="submit" class="btn brand z-depth-0">
                </div>
            </form>
        </section>
    <?php include('templates/footer.php'); ?>

</html>