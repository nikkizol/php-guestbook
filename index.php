<?php
require "Post.php";
require "PostLoader.php";
//image this code could be a complex query
$users = ['John Doe', 'Joe Doe', 'John Smith', 'An Onymous'];
$articles = ['Terror over london', 'Football: a useless hobby?', 'Economic crisis ahead, says expert', 'Fortis is Fortwas'];
//end controller
//start view
session_start();

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
$messagePost = new Post($_POST['title'], $_POST['date'], $_POST['name'], $_POST['text']);

$title = $messagePost->getTitle();
$date = date("Y/m/d h:i:sa");
$name = $messagePost->getAuthorName();
$message = $messagePost->getContent();
$messageArray = ['message' => $message, 'name' => $name, 'date' => $date, 'title' => $title];
var_dump($messageArray);

$guestbook = new PostLoader();

if (!isset($_SESSION['guestbook'])) {
    $_SESSION['guestbook'] = $guestbook;
} else {
    $guestbook = $_SESSION['guestbook'];
}

if ($_POST['name'] != "") {
    $guestbook->pushToArray($messageArray);
}
$file = "guestbook.json";
$arrayOfMessages = $guestbook->getAllpost();
var_dump($arrayOfMessages);
$encoded = $guestbook->encodeAllpost();
var_dump($encoded);
$saveInJson = $guestbook->saveInJson($file, $encoded);
var_dump($saveInJson);


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
        <label for="text">Text</label><br>
        <textarea id="text" name="text" rows="4" cols="50" required></textarea>
    </section>
    <input type="submit" name="submitButton">
</form>


</body>
</html>