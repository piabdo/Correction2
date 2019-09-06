<div class="menu2">
<?php require 'model/register_model.php'; ?>
		<?php if($swt == 0):?>
		<form action="" method="POST">
			<div class="m_ident">
				<div class="Holder">
					<label for="">Identifiant</label>
					<input class="inp "type="text" value="" name="r_username" placeholder="Identifiant" />
				</div>
				<div class="Holder">
					<label for="">Mot de passe ( Minimum 6 caractères, une majuscule, une minuscule et un caractère spécial )</label>
					<input class="inp "type="password" value="" name="r_password" placeholder="Mot de passe" />
				</div>
				<div class="Holder">
					<label for="">Confirmez votre mot de passe</label>
					<input class="inp "type="password" value="" name="r_password_conf" placeholder="Mot de passe" />
				</div>
				<div class="Holder">
					<label for="">Email</label>
					<input class="inp "type="email" value="" name="r_email" placeholder="Email" />
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