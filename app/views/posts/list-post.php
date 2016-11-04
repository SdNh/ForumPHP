<?php



$query = $db->prepare("SELECT * FROM post");
$query->execute();
$result= $query->fetchAll(PDO::FETCH_ASSOC);


?>
<table class="table table-hover">
    <caption>List des poste</caption>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Message</th>
            <th>Réponse</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($result as $post): ?>
            <tr>
                <td><a href="<?php echo $router->generate('show-post', array('id' => $post['id'])); ?>"><?php echo ucfirst($post['title']); ?></a></td>
                <td>Message: <?php echo $post['content'];?></td>
                <td>Réponse: <?php echo $post['answer']; ?></td>
                <td>Date: <?php echo $post['date']; ?></td>
                <td><a href="<?php echo $router->generate('delete-post', array('id' => $post['id'])); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

 <a href="<?php echo $router->generate('new-post'); ?>" class="btn btn-primary">Create post</a>
 <a href="<?php echo $router->generate('home'); ?>" class="btn btn-default">Retourner à l'accueil</a>
