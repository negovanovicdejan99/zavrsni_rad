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
    <title>Single post</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">

    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>
<?php 
    include 'header.php';
?>

<?php
    $sql = "SELECT posts.title, posts.body, posts.author, posts.created_at, posts.id FROM posts WHERE posts.id = :postId";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':postId', $_GET['post_id']);

    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $post = $statement->fetch();

    $sql = "SELECT comments.author, comments.text, comments.post_id FROM comments  WHERE comments.post_id = :postId";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':postId', $_GET['post_id']);

    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $comments = $statement->fetchAll();
?>
<main role="main" class="container">
<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title"><a href=""><?php echo($post['title']); ?></a></h2>
            <p class="blog-post-meta"><?php echo($post['created_at']); ?> by <a href="#"><?php echo($post['author']); ?></a></p>
            <p><?php echo($post['body']); ?></p>
        </div>
        <h3>Comments</h3>
        <ul>
            <?php foreach($comments as $comment){?>
                <li>
                <p>by <?php echo($comment['author']); ?></p>
                <p><?php echo($comment['text']); ?></p>
                </li>
                <hr>
            <?php }?>
        </ul>
    </div>
    
    <?php 
        include 'sidebar.php';
    ?> 
</div>
</div>
<?php 
    include 'footer.php';
?>
</body>
</html>