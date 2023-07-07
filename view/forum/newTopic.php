<?php
if (isset($result["data"]['category'])) {
    $category = $result["data"]['category'];
}

?>

    <h3>Add a topic to the category "<?= $category->getCategoryLabel() ?>"</h3>

    <form class="form-new-topic" action="index.php?ctrl=topic&action=newTopic&id=<?= $category->getId() ?>" method="POST">
        <label for="title">Nom du topic</label>
        <input type="text" name="title" id="title">

        <label for="text">Topic description</label>
        <textarea rows="5" name="text" id="text"></textarea>

        <input class="button" type="submit" name="submit" id="submit" value="Créer le topic">
    </form>


