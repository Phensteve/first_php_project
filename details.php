<?php
    include('config/databaseConn.php');
    if (isset($_POST['delete'])) {

        $id_delete = mysqli_real_escape_string($connect, $_POST['id_delete']);

        $sql = "DELETE FROM data WHERE id = $id_delete";

        if (mysqli_query($connect, $sql)) {
            header('Location: index.php');
        }{
            echo "Query error: " . mysqli_error($connect);
        }
        // $result = mysqli_query($connect, $sql);
    }
    if (isset($_GET['id'])) {
        
        $id = mysqli_real_escape_string($connect, $_GET['id']);

        $sql = " SELECT * FROM data WHERE id = $id ";

        $result = mysqli_query($connect, $sql);

        $app = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($connect);

        // print_r($app);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
    <div class="container center">
        <?php if ($app) {?>
            <h4><?php echo htmlspecialchars($app['app']);?></h4>
            <p><?php echo htmlspecialchars($app['email']);?></p>
            <div><?php echo  htmlspecialchars($app['datejoined']);?></div>    
            <h5>Languages:</h5>
            <p><?php echo htmlspecialchars($app['lang']);?></p>         
            <p><?php echo 'Created by : ' . htmlspecialchars($app['name']);?></p>

        <?php } else{?>
            <h1 class="grey-text">Soryy but your app has not been registered with us!</h1>
        <?php } ?>
        <form action="details.php" method="POST">
            <input type="hidden" name="id_delete" value=<?php echo $app['id'];?>>
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>

    </div>
    <?php include('templates/footer.php'); ?>
</html>