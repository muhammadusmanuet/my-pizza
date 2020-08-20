<?php

include('config/db_connect.php');

$sql = 'SELECT title,ingredients,id FROM pizzas ORDER BY created_at';
$result = mysqli_query($conn, $sql);
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);

if ($pizzas) {

    explode(',', $pizzas[0]['ingredients']);
}

?>

<!DOCTYPE html>

<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container mt-5 z-depth-1">

    <!--Section: Content-->
    <section class="text-center dark-grey-text">

        <h1 class="text-muted mb-5">Newest Pizzas</h1>

        <div class="row text-center d-flex justify-content-center">
            <?php foreach ($pizzas as $pizza) : ?>

                <div class="col-lg-3 offset-1 col-md-5 mb-4 border pb-3 mt-5">

                    <img src="images/pizza.svg" alt="pizza" class="w-50 mt-n5">

                    <h5 class="font-weight-normal mb-3 mt-3"><?php echo $pizza['title'] ?></h5>

                    <ul style="list-style: none; margin-block-start: 0rem !important; padding-inline-start: 0rem !important;">

                        <?php foreach (explode(',', $pizza['ingredients']) as $ing) : ?>

                            <li class="ml-n1"><?php echo htmlspecialchars($ing) ?></li>

                        <?php endforeach; ?>

                    </ul>

                    <hr>

                    <a href="details.php?id=<?php echo $pizza['id'] ?>" class="text-dark">More Info</a>

                </div>

            <?php endforeach; ?>

        </div>

    </section>

</div>







<?php include('templates/footer.php') ?>





</html>