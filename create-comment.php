<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create comment</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">

    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>
<?php
if (!empty($_POST['author_comment']) && !empty($_POST['text_comment'])){
        $author_comment = $_POST['author_comment'];
        $text_comment = $_POST['text_comment'];
        $post_id = $_POST['post_id'];
        print_r($_POST);
        $sqlComment = "INSERT INTO comments (author, text, post_id) VALUES (:author, :text, :post_id)";
        try {
            $statement = $connection->prepare($sqlComment);
            $statement->bindParam(':author', $author_comment);
            $statement->bindParam(':text', $text_comment);
            $statement->bindParam(':post_id', $post_id);
            $statement->execute();
        }
        catch(PDOException $e) {
            echo $e->getMessage();
    }
}
$post_id = $_POST['post_id'];
header("Location: http://localhost:8080/single-post.php?post_id=$post_id");
?>
</body>
</html>