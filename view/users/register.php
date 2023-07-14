<!-- FORMULAIRE D'INSCRIPTION -->
<h3>Register</h3>
<form action="index.php?ctrl=security&action=register" method="post">
    
    <!-- Champ d'entrée pour le pseudonyme -->
    <label for="nickName">Nickname</label>
    <input type="text" name="nickName" id="nickName" required />

    <!-- Champ d'entrée pour l'e-mail -->
    <label for="email">Email</label>
    <input type="text" name="email" id="email" required />

    <!-- Champ d'entrée pour le mot de passe -->
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required />

    <!-- Champ d'entrée pour la confirmation du mot de passe -->
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required />

    <!-- Bouton de soumission du formulaire -->
    <input class="button" type="submit" name="submit" id="submit" value="Register" />
</form>
