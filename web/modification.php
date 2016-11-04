<?php
require 'inc/database.php';
include 'inc/header.php';


if(isset($_POST['edit'])){
    //Quand le forum est soumis
    $q = $db->prepare("UPDATE product SET name = :title, description = :description, image = :image WHERE id = :id");
    $q->bindValue(":title", post('title'), PDO::PARAM_STR);
    $q->bindValue(":description", post('description'), PDO::PARAM_STR);
    $q->bindValue(":image", post('image'), PDO::PARAM_STR);
    
    if($q->execute()){
        echo "Le forum a été modifié.";
    }
}

$q = $db->prepare("SELECT * FROM forum WHERE id = :id");
//$_GET['id'] = strip_tags(trim($_GET['id']));
$q->bindValue(":id", get('id'), PDO::PARAM_INT);
$q->execute();
$forum = $q->fetch(); // Tableau avec les infos du forum
// Dans le cas où le forum n'existe pas
if(!$forum){
    echo "Le forum n'existe pas";
    include 'inc/footer.php';
    die();
}

?>

<form action="" method="POST">
    <div>
        <label>title :/label>
        <input type="text" name="title" value="<?php echo $forum['title'] ?>">
    </div>
    <div>
        <label>description :</label>
        <textarea name="description"><?php echo $forum['description'] ?></textarea>
    </div>
    <div>
        <label>image :</label>
        <input type="text" name="image" value="<?php echo $forum['image'] ?>">
    </div>
    
    <div>
        <button name="edit">Modifier le forum</button>
    </div>
</form>

<?php
include 'inc/footer.php';
?>
