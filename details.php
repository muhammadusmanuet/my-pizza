<?php

include('config/db_connect.php');

if (isset($_POST['delete'])) {

    $idd = $_POST['d-id'];

    $sql = "DELETE FROM pizzas WHERE id = $idd";

    if (mysqli_query($conn, $sql)) {
        
        header('Location: index.php');

    } else {
        
        echo 'query error: ' . mysqli_error($conn);
        
    }
}

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM pizzas WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $pizza = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($pizza) : ?>

    <div class="container mt-3 text-center">

        <h1 class="text-muted mb-3"><?php echo htmlspecialchars($pizza[0]['title']) ?></h1>

        <p class="text-muted mb-3"><?php echo 'Created by ' . htmlspecialchars($pizza[0]['email']) ?></p>

        <p class="text-muted mb-3"><?php echo htmlspecialchars($pizza[0]['created_at']) ?></p>

        <h2 class="text-muted mb-3">Ingredients: </h2>

        <p class="text-muted mb-3"><?php echo htmlspecialchars($pizza[0]['title']) ?></p>

        <form action="details.php" method="POST">

            <input type="hidden" name="d-id" value="<?php echo $id ?>">

            <input class="btn text-uppercase rounded-0 mt-3" type="submit" value="delete" name="delete">

        </form>

    </div>

<?php else : echo 'There is no such pizza'; ?>

<?php endif; ?>


<?php include('templates/footer.php') ?>

</html>