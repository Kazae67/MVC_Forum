<?php
$topics = $result["data"]["topics"];
?>

<h1>LIST CATEGORY</h1>

<?php
if ($topics !== null) {
    foreach ($topics as $topic) {
        ?>
        <p><?= $topic->getTitle() ?></p>
        <?php
    }
}
?>

