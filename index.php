<?php
session_start();
require_once 'DBBlackbox.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta title="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
</head>

<body>

    <?php

    if (isset($_SESSION['messages']) && (count($_SESSION['messages']) > 0)) {
        foreach (($_SESSION['messages']) as $message) {
    ?>
            <p><?= $message ?></p>
    <?php
        }
        unset($_SESSION['messages']);
    }
    ?>


    <h1>Movie Database</h1>

    <div id="menu">
        <a href="index.php">Homepage</a>
        <a href="index.php?page=add">Add movie</a>
        <a href="index.php?page=browse">Browse movies</a>
        <a href="index.php?page=about">About project</a>
    </div>



    <?php if (isset($_GET['page']) && $_GET['page'] == "about") : ?>

        <p>About this movie database</p>



        <!-- WHY CANT IT BE AT BOTTOM -->
        <!-- WHY CANT IT BE AT BOTTOM -->
        <!-- WHY CANT IT BE AT BOTTOM -->


    <?php elseif (isset($_GET['page']) && $_GET['page'] == "browse") : ?>   

        <p><strong>Movie database</strong></p>

        <?php
        $movies = select();
        foreach ($movies as $id => $movie) : ?>

            <p> <?= $movie['title'] ?> <a href="index.php?page=edit&id=<?= $id ?>">edit</a></p>

        <?php endforeach ?>




    <?php elseif (isset($_GET['page']) && $_GET['page'] == ("add" || "edit")) : ?>


        <?php if ($_GET['page'] == "add") : ?>

            <p>Add a movie</p>
            <form action="handler.php" method="POST">
                <input type="hidden" value ="null" name="id">
                <p>Title<input type="text" value="" name="title"></p>
                <p>Year<input type="text" value="" name="year"></p>
                <p>Genre<input type="text" value="" name="genre"></p>
                <p>Rating<input type="text" value="" name="rating"></p>
                <p><input type="submit" value="Add the Movie"></p>
            </form>

        <?php elseif ($_GET['page'] == "edit") : ?>

            <p>Edit a movie</p>

            <?php 
            $edit_id = $_GET['id'];
            $oldInfo = find($edit_id);
            ?>

            <form action="handler.php" method="POST">
                <input type="hidden" value= <?= $edit_id ?> name="id">
                <p>Title<input type="text" value=<?= $oldInfo['title']?> name="title"></p>
                <p>Year<input type="text" value=<?= $oldInfo['year']?> name="year"></p>
                <p>Genre<input type="text" value=<?= $oldInfo['genre']?> name="genre"></p>
                <p>Rating<input type="text" value=<?= $oldInfo['rating']?> name="rating"></p>
                <p><input type="submit" value="Edit the Movie"></p>
            </form>

        <?php endif ?>









    <?php else : ?>

        <p>Welcome to CBMD.</p>

    <?php endif; ?>



</body>

</html>