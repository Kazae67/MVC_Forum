<!-- HEADER NEW TOPIC -->
<div class="header-new-topic">
  <h3 class="header-new-topic-center">New Topic</h3>
</div>

<!-- NOUVEAU TOPIC CONTAINER -->
<div class="new-topic-container">
  <div class="new-topic-form">
    <?php
    // Vérifie si une catégorie a été envoyée dans les données de réponse et l'assigne si c'est le cas
    $category = $result["data"]['category'] ?? null;

    // Vérifie si un utilisateur est connecté
    $userLoggedIn = isset($_SESSION["user"]);
    ?>

    <?php if ($userLoggedIn && $category) : ?>
        <form action="index.php?ctrl=topic&action=newTopic&id=<?= $category->getId() ?>" method="POST">
            <div class="form-group">
              <label for="title">Topic name</label>
              <input type="text" name="title" id="title" required>
            </div>

            <div class="form-group">
              <label for="topic_description">Topic description</label>
              <textarea rows="5" name="topic_description" id="topic_description" required></textarea>
            </div>

            <input class="button" type="submit" name="submit" id="submit" value="Create the topic">
        </form>
    <?php elseif(!$userLoggedIn) : ?>
        <!-- L'utilisateur n'est pas connecté -->
        <a href="index.php?ctrl=security&action=login">Please log in</a>
    <?php else : ?>
        <!-- Pas de catégorie sélectionnée -->
        <p>Please select a category first</p>
    <?php endif; ?>
  </div>
</div>
