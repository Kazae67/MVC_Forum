<script src="public/js/scrollSelect.js"></script>

<?php
// Vérifie si les données sont définies et les assigne aux variables, sinon assigne null
$posts = $result["data"]['posts'] ?? null;
$topic = $result["data"]['topic'] ?? null;

// Vérifie si l'utilisateur est défini et s'il a un rôle d'administrateur ou de modérateur
$admin = false;
if (isset($_SESSION["user"]) && in_array($_SESSION["user"]->getRole(), ['admin', 'moderator'])) {
    $admin = true;
}
?>

<!-- Catégorie -->
<div class="header-post">
    <div class="header-post-left">
        <a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?=$topic->getCategory()->getId()?>">Back to topics</a>
    </div>
    <div class="header-post-center">
        <h3><?=$topic->getCategory()->getCategoryLabel()?></h3>
    </div>
    <div class="header-post-right">
        <a title="Answer" class="button" href="#answer-form" onclick="scrollAndFocus()">Answer</a>
    </div>
</div>

<div class="post-container">
    <div class="post-header">
        <div class="post-header-left author-content">
            <!-- Titre -->
            <p><span class="post-title-label">Title:</span> <?=$topic->getTitle()?></p>
            <hr>
            <!-- Description -->
            <p class="post-topic-description"><?=$topic->getTopic_description()?></p>
        </div>
        <div class="post-header-right">
            <?php 
            // Si l'utilisateur est un administrateur
            if($admin){
                $action = $topic->getIs_Locked() == 0 ? 'lockTopicFromTopic' : 'unlockTopicFromTopic';
                $title = $topic->getIs_Locked() == 0 ? 'Lock topic' : 'Unlock topic';
                
                echo "<a title='{$title}' href='index.php?ctrl=topic&action={$action}&id={$topic->getId()}'>
                  <i class='icon {$title}'></i>
                </a>";
                
                // Vérifie si l'utilisateur actuel est le créateur du sujet
                if(isset($_SESSION["user"]) && $_SESSION["user"]->getId() == $topic->getUser()->getId()){
                    echo "<a title='Delete topic' href='index.php?ctrl=topic&action=deleteTopic&id={$topic->getId()}'></a>";
                }
            }
            ?>
        </div>
    </div>

    <div class="forum-posts">
        <?php 
        // Si les publications sont définies
        if($posts){
            $countPost = 0;
            foreach($posts as $post){
                $countPost++;
                ?>
                <div class="post-card">
                    <div class="forum-post-header">
                        <div class="forum-post-header-left">
                            <h3><a title="Check profile" href="index.php?ctrl=security&action=usersProfiles&id=<?= $post->getUser()->getId() ?>"><?= $post->getUser()->getNickname() ?></a></h3>
                            <!-- Vérifie que la date de création du post n'est pas null avant de l'afficher -->
                            <?php if ($post->getPostCreationDate() !== null): ?>
                                <p class="post-date"><?= $post->getPostCreationDate()->format('Y-m-d H:i:s') ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="forum-post-header-right">
                            <?php
                            if($admin){
                                // Si ce n'est pas le premier post, affiche le bouton de suppression
                                if($countPost > 1){
                                    echo "<a href='index.php?ctrl=post&action=deletePost&id={$post->getId()}'><p title='Delete post'</p></a>";
                                }
                                echo "<a href='index.php?ctrl=post&action=linkToModifyPost&id={$post->getId()}'><p title='Modify post'</p></a>";
                            }
                            ?>
                        </div>
                    </div>
                    <p class="post-text"><?= $post->getText() ?></p>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <?php
    // Si le sujet n'est pas verrouillé, affiche le formulaire de réponse (à mettre dans un fichier newPost)
    if ($topic->getIs_Locked() == 0) { ?>
        <form id="answer-form" class="form-add-topic" action="index.php?ctrl=post&action=addPostByTopic&id=<?= $topic->getId() ?>" method="POST">
            <label for="text"></label>
            <textarea rows="5" name="text" id="text"></textarea>
            <input class="button" type="submit" name="submit" id="submit" value="Answer">
        </form>
    <?php } ?>
</div>

