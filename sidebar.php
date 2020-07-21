
<?php
    $sql = "SELECT posts.title, posts.created_at, posts.id FROM posts ORDER BY created_at DESC LIMIT 5";
    $statement = $connection->prepare($sql);

    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $latestPosts = $statement->fetchAll();
    // var_dump($latestPosts);
?>
<aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Latest posts</h4>
                <?php
                foreach($latestPosts as $post){
                ?>
                <a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']); ?></a>
                <br>
                <?php } ?>
            </div>
        </aside><!-- /.blog-sidebar -->