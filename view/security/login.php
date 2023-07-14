<!-- FORMULAIRE DE CONNEXION -->
<h3>Login</h3>
<form action="index.php?ctrl=security&action=login" method="post">
    
    <!-- Champ d'entrée pour l'e-mail -->
    <label for="email">Email</label>
    <input type="text" name="email" id="email" required />

    <!-- Champ d'entrée pour le mot de passe -->
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required />

    <!-- Bouton de soumission du formulaire -->
    <input class="button" type="submit" name="submit" id="submit" value="Login" />
</form>
