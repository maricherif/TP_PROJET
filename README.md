<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=TPFormulaire;', 'root', '');
 $count = $db->prepare("SELECT  count(id) as cpt  from utilisateur");
$count->setFetchMode(pdo::FETCH_ASSOC);
$count->execute();
$tcount=$count->fetchAll();

@$page = $_GET["page"];
if(empty($page)) $page=1;
$nb_user_page=5;
$nb_page =($tcount[0]["cpt"]/$nb_user_page);
$debut=($page-1)*$nb_user_page;

$sel=$db->prepare("SELECT * from utilisateur order by utilisateur limit $debut, $nb_user_page");
$sel->setFetchMode(pdo::FETCH_ASSOC);
$sel->execute();
$tab=$sel->fetchAll();
if(count($tab)==0)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<footer>
    <?php echo $tcount[0]["cpt"] ?> 
    <div id ="pagination">
     <?php
        for($i=1;$i<=$nb_page;$i++){
             if($page!=$i)
            echo "<a href='?page=$i'>$i</a> &nbsp;";
            else
            echo"<a>$i</a> &nbsp;";
        }
     ?>
    </div>
    <section id="cont">
        <?php
        for($i=0;$i<count($tab);$i++)
        ?>
    </section>
</footer>
</body>
</html>