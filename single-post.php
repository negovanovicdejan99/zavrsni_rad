<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Single post</title>

</head>
<body>

    <?php 
        include 'header.php';
    ?>

    <!-- Validate Comment -->
    <script>
        function validateFormComment() {
            var x = document.forms["create-comment"]["author_comment"].value;
            var y = document.forms["create-comment"]["text_comment"].value;
            if (x == "" || y == "") {
            alert('Author name or text is empty');   
            }
        }
    </script>

    <!-- Base -->
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

    <!-- Delete comment -->
    <?php 
        if (!empty($_POST['del_comment'])) {
            $commentId = $_GET['comment_id'];
            $postId = $_GET['post_id'];
        
            $sqlDelCom = "DELETE FROM comments WHERE comments.id = :commId";
            try {
                $statement = $connection->prepare($sqlDelCom);
                $statement->bindParam(':commId', $commentId);
                $statement->execute();
                header("Location: single-post.php?post_id=$post_id");

            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

    ?>

    <!-- Delete Post -->
    <?php 
        if (!empty($_POST['del_post'])) {
            $del_postId = $_POST['post_id'];
            // echo($del_postId);
            $sqlDelComments = "DELETE FROM comments WHERE comments.post_id = :postId";
            $sqlDelPost = "DELETE FROM posts WHERE posts.id = :postId";
            try {
                $statement = $connection->prepare($sqlDelComments);
                $statement->bindParam(':postId', $del_postId);
                $statement->execute();
                $statement = $connection->prepare($sqlDelPost);
                $statement->bindParam(':postId', $del_postId);
                $statement->execute();
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            } 
            header("Location: posts.php");
        }
    ?>

    <!-- Hidde Comment -->
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
    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href=""><?php echo($post['title']); ?></a></h2>
                    <p class="blog-post-meta"><?php echo($post['created_at']); ?> by <a href="#"><?php echo($post['author']); ?></a></p>
                    <p><?php echo($post['body']); ?></p>
                </div>
                <div>
                    <form method="POST" onsubmit="return confirm('Do you really want to delete this post?')">
                        <input type="hidden" name="post_id" value="<?php echo($post['id']); ?>" />
                        <input type="hidden" name="del_post" value="1" />
                        <button type="submit" class="btn btn-primary" value="delete-post" id="delete">Delete Post</button>
                    </form>
                </div>
                <div>
                    <h3> Comments </h3>
                    <form onsubmit="validateFormComment()" name="create-comment" action="create-comment.php" method="POST">
                        Author: <br><input type="text" name="author_comment">
                        <br>
                        Text: <br><input type="text" name="text_comment">
                        <br>
                        <input type="hidden" name="post_id" value="<?php echo($post['id']); ?>" />
                        <br>
                        <button type="submit" value="submit">Submit</button>
                    </form><br>
                </div>
                <?php include 'comments.php' ?>
            </div>
            <?php 
                include 'sidebar.php';
            ?> 
        </div>
    </main>
    <?php 
        include 'footer.php';
    ?>
</body>
</html>