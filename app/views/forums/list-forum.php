<?php
 $query = $db->prepare('SELECT * FROM forum');
    $query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC); 
?>
<table class="table table-hover">
    <caption>List des forums</caption> 
    <thead> 
        <tr> 
            <th>title</th> 
            <th>description</th> 
            <th>image</th> 
            <th>Actions</th> 
        </tr> 
    </thead> 
    <tbody>
        <?php foreach($result as $forum): ?>
            <tr>
                <td><a href="<?php echo $router->generate('show-forum', array('id' => $forum['id'])); ?>"><?php echo ucfirst($forum['title']); ?></a></td>
                <td>description <?php echo $forum['description']; ?></td>
                <td>image <?php echo $forum['image']; ?></td>
                <td><a href="<?php echo $router->generate('delete-forum', array('id' => $forum['id'])); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="<?php echo $router->generate('new-forum'); ?>" class="btn btn-primary">Create forum</a>
<a href="<?php echo $router->generate('home'); ?>" class="btn btn-default">Retourner à l'accueil</a>