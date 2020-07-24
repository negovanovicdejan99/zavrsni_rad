<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

</head>

<body>
    <?php 
        include 'header.php';
    ?>
    <!-- Baza -->
    <?php 
        if (!empty($_POST['title'])){
            $first_name_post = $_POST['firstName'];
            $last_name_post = $_POST['lastName'];

            $title_post = $_POST['title'];
            $content_post = $_POST['content'];
            
            $sqlUser= "SELECT users.id, users.first_name, users.last_name FROM users WHERE first_name = '$first_name_post' AND last_name = '$last_name_post'";
            try {
                $statement = $connection->prepare($sqlUser);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                
                $user = $statement->fetch();
                print_r($user['id']);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            $sqlPost = "INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :userId)";

            try {
                $statement = $connection->prepare($sqlPost);
                $statement->bindParam(':title', $title_post);
                $statement->bindParam(':body', $content_post);
                $statement->bindParam(':userId', $user['id']);
                $statement->execute();
                // header("Location: posts.php");
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    ?>
    <?php
        $sql = "SELECT posts.title, posts.body, users.last_name, users.first_name, users.id, posts.created_at, posts.id FROM posts 
        INNER JOIN users ON users.id = posts.user_id
        ORDER BY created_at DESC";
        $statement = $connection->prepare($sql);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $posts = $statement->fetchAll();
    ?>

    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <?php foreach   ($posts as $post)  { ?>
                    <div class="blog-post">
                        <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']); ?></a></h2>
                        <p class="blog-post-meta"><?php echo($post['created_at']); ?> by <a href="#"><?php echo($post['first_name']); ?> <?php echo($post['last_name']); ?></a></p>
                        <p><?php echo($post['body']); ?></p>
                    </div><!-- /.blog-post -->
                <?php }?>
                <nav class="blog-pagination">
                    <a class="btn btn-outline-primary" href="#">Older</a>
                    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                </nav>
            </div><!-- /.blog-main -->
            <?php 
                include 'sidebar.php';
            ?>
        </div><!-- /.row -->
    </main><!-- /.container -->
    <?php 
        include 'footer.php';
    ?>
</body>
</html>
