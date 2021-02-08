<?php
session_start();
require_once 'DBBlackbox.php';

if ($_POST) {

    var_dump($_POST);

    $is_valid = true;
    $data = [];
    $data['title'] = '';
    $data['year'] = '';
    $data['genre'] = '';
    $data['rating'] = '';
    $messages = [];

    if (empty($_POST['title'])) {
        $is_valid = false;
        $messages[] = "Your data is invalid - title is empty";
    }

    if ($_POST['year'] < 1900) {
        $is_valid = false;
        $messages[] = "Your data is invalid - year is not correct";
    }

    if ($is_valid) {
        
        $data['title'] = $_POST['title'];
        $data['year'] = $_POST['year'];
        $data['genre'] = $_POST['genre'];
        $data['rating'] = $_POST['rating'];

        if($data['id'] === "null") {
            $id = insert($data);
            $messages[] = "Data saved under id: {$id}";
            $_SESSION['messages'] = $messages;
            header("Location: index.php?page=add");

        } else {
            update($_POST['id'], $data);
            $messages[] = "Data updated under id: {$_POST['id']}";
            $_SESSION['messages'] = $messages;
            header("Location: index.php?page=browse");
        }
    }
    
    exit;
}
