<?php

$categories = $result["data"]['categories'];

if (isset($_SESSION["user"]) && ($_SESSION["user"]->getRole()=='admin')) {
    $admin=true;
  }
  else{
    $admin=false;
  }
?>
<h3>Categories list</h3>

<?php
if($admin){
?>
    <form  action="index.php?ctrl=category&action=addNewCategory" method="post">
        <label for="categoryLabel">New category :</label>
        <input type="text" name="categoryLabel" id="categoryLabel"></input>

        <input type="submit" name="submit" id="submit" value ="add">
    </form>
<?php }
  
if($categories){?>
    <?php
foreach ($categories as $category) {
    ?>
    <div class="forum-post-card-category">
        <p><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?=$category->getId()?>"><?=$category->getcategoryLabel()?></a></p>
    </div>
    <?php
}

    ?>
    </tbody>
</table>
<?php }?>

  
