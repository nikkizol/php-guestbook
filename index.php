<?php
require "Post.php";
require "PostLoader.php";
//image this code could be a complex query
$users = ['John Doe', 'Joe Doe', 'John Smith', 'An Onymous'];
$articles = ['Terror over london', 'Football: a useless hobby?', 'Economic crisis ahead, says expert', 'Fortis is Fortwas'];
//end controller
//start view
$file = "guestbook.json";
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



if (isset($_POST['submit'])) {
    $guestbook->pushToArray($messageArray);
    $arrayOfMessages = $guestbook->getAllpost();
    var_dump($arrayOfMessages);
    $encoded = $guestbook->encodeAllpost();
    var_dump($encoded);
    $saveInJson = $guestbook->saveInJson($file, $encoded);
    var_dump($saveInJson);
}


$json = @file_get_contents('guestbook.json');
$data = json_decode($json, true);

$last20Msg = array_slice($data, -20);



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
        }
        .msg {
            padding: 10px;
        }
    </style>
</head>
<body>
<form method="post">
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
    <input type="submit" name="submit">
</form>
<?php foreach (array_reverse($last20Msg) as $msg) : ?>
    <div class="msg">
        <p><strong>Name:</strong> <?php echo $msg['name']; ?></p>
        <p><strong>Title: </strong> <?php echo $msg['title']; ?></p>
        <p><strong>Date of post:</strong> <?php echo $msg['date']; ?></p>
        <p><strong>Message:</strong> <?php echo $msg['message']; ?></p>
    </div>
<?php endforeach ?>

</body>
</html>