<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create post</title>
</head>
<body>
    <?php 
        include 'header.php';
    ?> 

    <!-- Post Validation -->
    <script>
        function validateFormPost() {
            var x = document.forms["create-post"]["title"].value;
            var y = document.forms["create-post"]["content"].value;
            var z = document.forms["create-post"]["firstName"].value;
            var d = document.forms["create-post"]["lastName"].value;
            if (x == "" || y == "" || z == "" || d == "") {
                alert('Author name or title or text is empty');  
            }
        }
    </script> 

    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
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
                <form name="create-post" action="posts.php" method="post" onsubmit="return validateFormPost()">
                    Post title: 
                    <br><input type="text" name="title"><br>
                    Post content: 
                    <br><textarea rows="5" cols="40" name="content"></textarea><br>
                    First Name:
                    <br><input type="text" name="firstName"><br><br>
                    Last Name:
                    <br><input type="text" name="lastName"><br><br>
                    <button type="submit">Save</button>
                </form>
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