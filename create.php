<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create post</title>

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

    <table style="width:100%">
      <tr>
        <th>Name</th>
        <th>Options</th>
      </tr>
      <tr>
        <td>Post title</td>
        <td>Edit Delete</td>
      </tr>
      <tr>
        <td>Post title</td>
        <td>Edit Delete</td>
      </tr>
  </table>

 
    <h1> Add new post </h1>
    <form action="posts.php" method="post">
    Post title 
    <br><input type="text" name="title"><br>
    Post content: 
    <br><textarea rows="5" cols="40" name="content"></textarea><br>
    Author:
     <br><input type="text" name="author"><br>
    <button type="submit">Save</button>
</form>
    </div>
    <?php 
        include 'sidebar.php';
    ?>
    </div>
<?php 
    include 'footer.php';
?>
</body>
</html>