
<h3>Register</h3>

<!--REGISTER-->
<form action="index.php?ctrl=security&action=register" method="POST">

    <label for="nickName">Nickname</label>
    <input type="text" name="nickName" id="nickName" required>

    <label for="email">Email</label>
    <input type ="text" name="email" id="email" required></input>

    <label for="password">Password</label>
    <input type ="password" name="password" id="password" required></input>

    <label for="passwordConfirm">Password</label>
    <input type ="password" name="password_confirmation" id="password_confirmation" required></input>

    <input class="button" type="submit" name="submit" id="submit" value="Créer un compte">

</form>
