<div class="menu" id="menu">
    <div class="menu2">
        <div class="m_ident">
                <p>ATTENTION ! Après modification vous devrez vous reconnecter.</p>
                <p>Vous serez notifié par missive (email) du resultat.</p>
                <form action="" method="POST">
                    <input class="button2" type="submit" name="not" value="NOTIFICATIONS"/>
                    <br />
                    <input class="button2" type="submit" name="us" value="MODIFIER  VOTRE  IDENTIFIANT"/>
                    <br />
                    <input class="button2" type="submit" name="pwd" value="MODIFIER  VOTRE  MDP"/>
                    <br />
                    <input class="button2" type="submit" name="em" value="MODIFIER  VOTRE  EMAIL"/>
                </form>
            <?php if(isset($_POST) && isset($_POST['not'])):?>
                <form action="" method="POST">
                        <div class="Holder">
                            <label for="">Cliquez sur confirmer pour changer de statu par rapport aux noitifactions de CAMAGRU</label>
                            <button class="inp "type="submit" value="" name="notification">Confirmer</button>
                        </div>
                </form>
            <?php elseif(isset($_POST) && isset($_POST['us'])):?>
                <form action="" method="POST">
                        <div class="Holder">
                            <label for="">Nouvel Identifiant</label>
                            <input class="inp "type="text" value="" name="new_username" placeholder="Nouvel Identifiant" />
                        </div>
                        <div class="Holder">
                            <button class="inp "type="submit">Confirmer</button>
                        </div>
                </form>
            <?php elseif(isset($_POST) && isset($_POST['pwd'])):?>
                <form action="" method="POST">
                        <div class="Holder">
                            <label for="">Mot de passe actuel</label>
                            <input class="inp "type="password" value="" name="password" placeholder="Mot de passe actuel" />
                        </div>
                        <div class="Holder">
                            <label for="">Nouveau mot de passe</label>
                            <input class="inp "type="password" value="" name="new_password" placeholder="Nouveau mot de passe" />
                        </div>
                        <div class="Holder">
                            <label for="">Confirmez votre nouveau mot de passe</label>
                            <input class="inp "type="password" value="" name="new_password_conf" placeholder="Confirmez votre nouveau mot de passe" />
                        </div>
                        <div class="Holder">
                            <button class="inp "type="submit">Confirmer</button>
                        </div>
                </form>
            <?php elseif(isset($_POST) && isset($_POST['em'])):?>
                <form action="" method="POST">
                        <div class="Holder">
                            <label for="">Email actuel</label>
                            <input class="inp "type="email" value="" name="email" placeholder="Email" />
                        </div>
                        <div class="Holder">
                            <label for="">Nouvel email</label>
                            <input class="inp "type="email" value="" name="new_email" placeholder="Email" />
                        </div>
                        <div class="Holder">
                            <button class="inp "type="submit">Confirmer</button>
                        </div>
                </form>
            <?php endif ?>
        </div>
    </div>
</div>
