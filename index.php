<?php
    include('config/databaseConn.php');
    
    $sql = 'SELECT * FROM data ORDER BY datejoined';

    $result = mysqli_query($connect, $sql);

    $apps = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($connect);

?>

<!DOCTYPE html>
<html>
    
    <?php include('templates/header.php'); ?>

    <h4 class="center grey-text">Apps</h4>
    <div class="container">
        <div class="row">
            <?php foreach ($apps as $app) {?>
                <div class="col s6 md">
                    <div class="card z-depth-0">
                        <img src="images/exe.png" alt="" class="exe">
                        <div class="card-content center">
                            <h4><?php echo htmlspecialchars($app['app']);?></h4>
                            <div>
                                <ul>
                                    <?php foreach(explode(',' , $app['lang']) as $lan) { ?>
                                        <li><?php echo htmlspecialchars($lan);?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $app['id'];?>" class="brand-text">More info!</a>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>

    <?php include('templates/footer.php'); ?>

</html>