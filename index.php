<?php
require "Post.php";
require "PostLoader.php";

$file = "guestbook.json";


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


if (isset($_POST['submit'])) {
    $messagePost = new Post($_POST['name'], $_POST['title'], $_POST['date'], $_POST['text']);
    $title = $messagePost->getTitle();
    $date = date("Y/m/d h:i:sa");
    $name = $messagePost->getAuthorName();
    $message = $messagePost->getContent();
    $guestbook = new PostLoader($name, $title, $date, $message);
    $guestbook->saveData();

}
$json = @file_get_contents('guestbook.json');
$data = json_decode($json, true);
$last20Msg = array();
if (!empty($json)) {
    $last20Msg = array_slice($data, -20);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Guest Book</title>
    <style>
        h1, h2 {
            text-align: center;
        }

        body {
            margin: auto;
            width: 80%;
        }

        .form {
            margin: auto;
            width: 50%;
        }

    </style>
</head>
<body>
<div class="form">
    <form class="text-center border border-light p-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          method="post">
        <p class="h4 mb-4">Leave a message</p>
        <!-- Title -->
        <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Title" name="title"
               required>
        <!-- Name -->
        <input type="text" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Name" name="name"
               required>
        <!-- Message -->
        <div class="form-group">
        <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Message"
                  name="text" required></textarea>
        </div>
        <!-- Send button -->
        <button class="btn btn-info btn-block" type="submit" name="submit">Send</button>
    </form>
</div>
<h2>Last messages:</h2>
<div class="container">
    <div class="row">
        <?php foreach (array_reverse($last20Msg) as $msg) : ?>
            <div class="col-3">
                <div class="card mt-4">
                    <div class="card-header">
                        <strong>Title: <?php echo $msg['title']; ?></strong>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name: <?php echo $msg['name']; ?></h5>
                        <p class="card-text">Message: <?php echo $msg['message']; ?> </p>
                        <p class="card-text">Date: <br><?php echo $msg['date']; ?> </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>