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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

        <link href="styles/blog.css" rel="stylesheet">
        <link href="styles/styles.css" rel="stylesheet">
    </head>
    <header>
        <div class="blog-masthead">
            <div class="container">
                <nav class="nav">
                    <a class="nav-link active" href="posts.php">Home</a>
                    <a class="nav-link" href="create.php">Create</a>
                </nav>
            </div>
        </div>

    
    </header>
</html>