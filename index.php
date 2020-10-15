<?php
require "Post.php";
require "PostLoader.php";
//image this code could be a complex query
$users = ['John Doe', 'Joe Doe', 'John Smith', 'An Onymous'];
$articles = ['Terror over london', 'Football: a useless hobby?', 'Economic crisis ahead, says expert', 'Fortis is Fortwas'];
//end controller
//start view

if (!isset($_POST['title'])) {
$_POST['title'] = "";
}

if (!isset($_POST['date'])) {
    $_POST['date'] = "";
}
if (!isset($_POST['name'])) {
    $_POST['name'] = "";
}
if (!isset($_POST['text'])) {
    $_POST['text'] = "";
}
$guestBook = new Post($_POST['title'], $_POST['date'], $_POST['name'], $_POST['text']);

$title = $guestBook->getTitle();
$date = date("Y/m/d h:i:sa");
$name = $guestBook->getAuthorName();
$message = $guestBook->getContent();
$entryarray = ['message' => $message, 'name' => $name, 'date' => $date, 'title' => $title];
var_dump($entryarray);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guest Book</title>
    <style>
        h1 {
            text-align: center;
        }

        body {
            margin: auto;
            width: 80%;
    </style>
</head>
<body>
<form action="#" method="post">
    <h1>Guest Book</h1>
    <h3>Leave a message:</h3>
    <section>
        <label for="title">Title</label><br>
        <input id="title" name="title" required>
    </section>
    <section>
        <label for="name">Name</label><br>
        <input id="name" name="name" required>
    </section>
    <section>
        <label for="Text">Text</label><br>
        <textarea id="text" name="text" rows="4" cols="50" required></textarea>
    </section>
    <input type="submit" name="submitButton">
</form>


</body>
</html>