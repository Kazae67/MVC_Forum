<?php

// Au départ, on passe par l'index, qui va nous aiguiller vers une des methodes du controller
// Puis si on envoie une requette a la BDD, on passera par la couche "Manager" qui
// va renvoyer une réponse au "Controller" 
// et le controller va renvoyer une "View"

// dans le dossier view/forum, j'ai toutes mes views qui concernent le forum.

$categories = $result["data"]['categories'];

//(Vérification si le user est admin)
if (isset($_SESSION["user"]) && ($_SESSION["user"]->getRole()=='admin')) {
    $admin=true;
  }
  else{
    $admin=false;
  }
?>
<h3>Liste des categories</h3>

<?php
if($admin){
?>
    <form  action="index.php?ctrl=category&action=addNewCategory" method="post">
        <label for="categoryName">Nouvelle catégorie :</label>
        <input type="text" name="categoryName" id="categoryName"></input>

        <input type="submit" name="submit" id="submit" value ="Créer">
    </form>
<?php }
  
if($categories){?>
    <?php
foreach ($categories as $category) {
    ?>
    <div class="forum-post-card-category">
        <p><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?=$category->getId()?>"><?=$category->getCategoryName()?></a></p>
    </div>
    <?php
}

    ?>
    </tbody>
</table>
<?php }?>

  
