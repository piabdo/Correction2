<div class="menu2" id="menu">
<div class="menu2">
    <?php require 'model/pwd_model.php'; ?>
    <?php if($swt == 0):?>
    <form action="" method="POST">
        <div class="m_ident">
            <div class="Holder">
                <label for="">Identifiant</label>
                <input class="inp "type="text" value="" name="username" placeholder="Identifiant" />
            </div>
            <div class="Holder">
                <label for=""> Nouveau mot de passe ( Minimum 6 caractères, une majuscule, une minuscule et un caractère spécial )</label>
                <input class="inp "type="password" value="" name="password" placeholder="Mot de passe" />
            </div>
            <div class="Holder">
                <label for="">Confirmez nouveau votre mot de passe</label>
                <input class="inp "type="password" value="" name="password_conf" placeholder="Mot de passe" />
            </div>
            <div class="Holder">
                <button class="inp "type="submit">Confirmer</button>
            </div>
        </div>
    </form>
    <?php endif ?>
    <?php if(!empty($errors)): ?>
        <div class="errors">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif ?>
</div>
</div>
