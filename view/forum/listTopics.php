<?php
$topics = $result["data"]["topics"] ?? null;
$category = $result["data"]["category"] ?? null;
?>

<h1>Topics list</h1>

<?php
if ($topics !== null) {
    foreach ($topics as $topic) {
        ?>
        <p><?= $topic->getTitle() ?></p>
        <?php
    }
}
?>

