<?php
 include_once "header.php";
    //if(!isset($_SESSION['user'])){
    //    header('location: login.php?error=notLoggedIn ');
    //    exit();
    //
    //}
    //echo "<option value=''>Select Category</option>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="cont">
    <div class="article">
        
            <?php
            include_once '../classes/dbConnect.class.php';

            $db = new DB();
            $DB = $db->dbConnection();
            $sql = "SELECT * FROM articles";
            $result = $DB->query($sql);

            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $articles = $result->fetchAll();
            foreach ($articles as $article) {
                $id = $article['id'];
                echo "<div class='article_container'>";
                echo "<img src=". $article['imagepath'] .">";
                echo "<h4>" . $article['title'] . "</h4>";
                echo "<p class='con'>" . $article['content'] . "</p>";
                echo "<p class='author'>Date:" . $article['created_at'] . "</p>";
                echo "<button onclick='full_article($id)'>View Article</a></button>";
                echo "</div>";
            }

            

            ?>
       
    </div>
    </div>
  
</body>
<script>

function full_article(id){
    
    $.get('../classes/admin.class.php',{ action:'full_article', id:id})
    .done(function(data){
        $('.cont').html(data);
    });
}
</script>
</html>