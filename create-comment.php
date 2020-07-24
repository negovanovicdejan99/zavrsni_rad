<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create comment</title>

</head>
<body>
<?php 
    include 'header.php';
?>
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
header("Location: single-post.php?post_id=$post_id");
?>
</body>
</html>