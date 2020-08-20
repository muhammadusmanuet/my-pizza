<?php

include('config/db_connect.php');

$errors = array('email' => '', 'title' => '', 'ingredients' => '');
$validvalues = array('email' => '', 'title' => '', 'ingredients' => '');
$count = 0;

if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br>';
    } else {
        global $email;
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address<br>';
        }
        else {
            $validvalues['email'] = $_POST['email'];
            $count++;
        }
    }
    if (empty($_POST['title'])) {
        $errors['title'] = 'A title is required <br>';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title must be letters and spaces only<br>';
        }
        else {
            $validvalues['title'] = $_POST['title'];
            $count++;
        }
    }
    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'At least one ingredients is required <br>';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'Ingredients must be a comma seperated list';
        }
        else {
            $validvalues['ingredients'] = $_POST['ingredients'];
            $count++;
        }
    }

    if(array_filter($errors)){
        
    }
    else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "INSERT INTO pizzas(email, title, ingredients) VALUES ('$email', '$title', '$ingredients')";

        if(mysqli_query($conn,$sql)){
            header('Location: index.php');
        }
        else {
            echo 'query error: ' . mysqli_error($conn);
        }

        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>


<section class="container bg-white py-5 px-5">
    <form method="POST" action="add.php">
        <div class="text-center">
            <h1 class="text-muted">Add a Pizza</h1>
        </div>
        <div class="form-group">
            <label>Your email:</label>
            <input type="text" class="form-control" name="email" value="<?php echo $validvalues['email'] ?>">
            <p class="text-danger"><?php echo $errors['email'] ?></p>
        </div>
        <div class="form-group">
            <label>Pizza Title:</label>
            <input type="text" class="form-control" name="title" value="<?php echo $validvalues['title'] ?>">
            <p class="text-danger"><?php echo $errors['title'] ?></p>
        </div>
        <div class="form-group">
            <label>Ingredients:</label>
            <input type="text" class="form-control" name="ingredients" value="<?php echo $validvalues['ingredients'] ?>">
            <p class="text-danger"><?php echo $errors['ingredients'] ?></p>
        </div>
        <div class="text-center">
            <input class="btn text-uppercase rounded-0 mt-3" type="submit" name="submit" value="submit"> 
    </form>
</section>

<?php include('templates/footer.php') ?>

</html>