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
 <script>
        function validateForm() {
            var x = document.forms["create-comment"]["author_comment"].value;
            var y = document.forms["create-comment"]["text_comment"].value;
            if (x == "" || y == "") {
             alert('Author name or text is empty');   
            }
            }
    </script>
<?php
    $sql = "SELECT posts.title, posts.body, posts.author, posts.created_at, posts.id FROM posts WHERE posts.id = :postId";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':postId', $_GET['post_id']);

    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $post = $statement->fetch();

    $sql = "SELECT comments.author, comments.text, comments.post_id, comments.id FROM comments  WHERE comments.post_id = :postId";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':postId', $_GET['post_id']);

    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $comments = $statement->fetchAll();
?>
<?php 
    if (!empty($_GET['comment_id'])) {
        $commentId = $_GET['comment_id'];
        $postId = $_GET['post_id'];
        
        $sqlDelCom = "DELETE FROM comments WHERE comments.id = :commId";
        try {
            $statement = $connection->prepare($sqlDelCom);
            $statement->bindParam(':commId', $commentId);
            $statement->execute();
            header("Location: http://localhost:8080/single-post.php?post_id=$postId");

        }
        catch(PDOException $e) {
            echo $e->getMessage();
    }

    }

?>
    <script>
        function hideComments(c) {
            if(c === 'hide') {
                document.querySelectorAll('.comments')[0].classList.add('invisible');
                document.getElementById("sH-btn").value="show";
                document.getElementById("sH-btn").innerHTML="Show comments";
                }
                else if (c === 'show') {
                document.querySelectorAll('.comments')[0].classList.remove('invisible');
                document.getElementById("sH-btn").value="hide";
                document.getElementById("sH-btn").innerHTML="hide comments";
                }
            }
    </script>
    <?php 
    function deleteBtn(){
        echo('radi');
     }
    ?>
<main role="main" class="container">
<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title"><a href=""><?php echo($post['title']); ?></a></h2>
            <p class="blog-post-meta"><?php echo($post['created_at']); ?> by <a href="#"><?php echo($post['author']); ?></a></p>
            <p><?php echo($post['body']); ?></p>
        </div>
        <div>
            
            <form name="create-comment" action="create-comment.php" onsubmit="return validateForm()" method="POST">
                Author: <input type="text" name="author_comment">
                <br><br>
                Text: <input type="text" name="text_comment">
                <br><br>
                <input type="hidden" name="post_id" value="<?php echo($post['id']); ?>" />

                <button type="submit" value="submit">Submit</button>
            </form>
            
        </div>
        <?php include 'comments.php' ?>
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