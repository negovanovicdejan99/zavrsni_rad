<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comments</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">

    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>

<div class="row">
    <div class="col-sm-8 blog-main">
        <h3> Comments </h3>
        <button value="hide" id='sH-btn' class="btn btn-default" onclick="hideComments(this.value)">Hide Comments</button>
        
        <div class="comments">
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
    </div>
     
</div>

</body>
</html>