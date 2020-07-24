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
    <title>Comments</title>

</head>
<body>
<div class="row">
    <div class="col-sm-8 blog-main">
        <button value="hide" id='sH-btn' class="btn btn-default" onclick="hideComments(this.value)">Hide Comments</button>
        
        <div class="comments">
            <ul>
                <?php foreach($comments as $comment){?>
                    <li>
                        <p><?php echo($comment['author']); ?></p>
                        <p><?php echo($comment['text']); ?></p>
                    </li>
                    <form method="POST">
                    <input type="hidden" name="del_comment" value=1>
                    <input type="hidden" name="post_id" value="<?php echo($post['id']); ?>" />
                    <input type="hidden" name="comment_id" value="<?php echo($comment['id']); ?>" />
                    <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                    <hr>
                <?php }?>
            </ul>
        </div>
    </div>
     
</div>

</body>
</html>