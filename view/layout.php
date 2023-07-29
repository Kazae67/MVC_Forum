<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a45e9c27c8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
    <title>FORUM</title>
</head>
<body>
    <div id="wrapper"> 
        <div id="mainpage"></div>
        <header>
            <nav>
                <div id="nav-list">
                    <a href="index.php?ctrl=category&action=listCategories">
                    </a>
                    <a class="button" href="index.php?ctrl=topic&action=listAllTopics">Topics list</a>
                    <a class="button" href="index.php?ctrl=category&action=listCategories">Categories list</a>
                </div>
                <div id="nav-user">
                    <?php if ($user = App\Session::getUser()): ?>
                        <a class="button" href="index.php?ctrl=security&action=myProfile"><?= $user->getNickname() ?></a>
                        <a class="button" href="index.php?ctrl=security&action=logOut">Logout</a>
                    <?php else: ?>
                        <a class="button" href="index.php?ctrl=security&action=login">Login</a>
                        <a class="button" href="index.php?ctrl=security&action=register">Register</a>
                    <?php endif; ?>
                </div>
            </nav>
            <!-- Message de succes ou d'erreur -->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
        </header>
        
        <main id="forum">
            <?= $page ?>
        </main>
    </div>
    <footer>
        <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
        <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    });
                }
            });

            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?");
            });

            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        });
    </script>
</body>
</html>
