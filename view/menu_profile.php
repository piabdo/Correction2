<div class="menu3" id="menu">
<div class="menu_profil">
		<div class="m_webcam">
			<div class="m_assets">
				<div class="dropdown">
					<button class="dropbtn">CASQUES</button>
					<div class="dropdown-content">
						<div class="line">
							<a ><img id="1" onclick="addfilter(this)" src="img/helmets/1.png" /></a>
							<a ><img id="2" onclick="addfilter(this)" src="img/helmets/2.png" /></a>
							<a ><img id="3" onclick="addfilter(this)" src="img/helmets/3.png" /></a>
						</div>
						<div class="line">
							<a ><img id="4" onclick="addfilter(this)" src="img/helmets/4.png" /></a>
							<a ><img id="5" onclick="addfilter(this)" src="img/helmets/5.png" /></a>
							<a ><img id="6" onclick="addfilter(this)" src="img/helmets/6.png" /></a>
						</div>
						<div class="line">
							<a ><img id="7" onclick="addfilter(this)" src="img/helmets/7.png" /></a>
							<a ><img id="8" onclick="addfilter(this)" src="img/helmets/8.png" /></a>
							<a ><img id="9" onclick="addfilter(this)" src="img/helmets/9.png" /></a>
						</div>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">ARMURES</button>
					<div class="dropdown-content">
						<div class="line">
							<a ><img id="10" onclick="addfilter(this)" src="img/armors/1.png" /></a>
							<a ><img id="11" onclick="addfilter(this)" src="img/armors/2.png" /></a>
							<a ><img id="12" onclick="addfilter(this)" src="img/armors/3.png" /></a>
						</div>
						<div class="line">
							<a ><img id="13" onclick="addfilter(this)" src="img/armors/4.png" /></a>
							<a ><img id="14" onclick="addfilter(this)" src="img/armors/5.png" /></a>
							<a ><img id="15" onclick="addfilter(this)" src="img/armors/6.png" /></a>
						</div>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">ACCESSOIRS</button>
					<div class="dropdown-content">
						<div class="line">
							<a ><img id="16" onclick="addfilter(this)" src="img/accessories/1.png" /></a>
							<a ><img id="17" onclick="addfilter(this)" src="img/accessories/2.png" /></a>
							<a ><img id="18" onclick="addfilter(this)" src="img/accessories/3.png" /></a>
						</div>
						<div class="line">
							<a ><img id="19" onclick="addfilter(this)" src="img/accessories/4.png" /></a>
							<a ><img id="20" onclick="addfilter(this)" src="img/accessories/5.png" /></a>
							<a ><img id="21" onclick="addfilter(this)" src="img/accessories/6.png" /></a>
						</div>
						<div class="line">
							<a ><img id="22" onclick="addfilter(this)" src="img/accessories/7.png" /></a>
							<a ><img id="23" onclick="addfilter(this)" src="img/accessories/8.png" /></a>
							<a ><img id="24" onclick="addfilter(this)" src="img/accessories/9.png" /></a>
						</div>
						<div class="line">
							<a ><img id="25" onclick="addfilter(this)" src="img/accessories/10.png" /></a>
							<a ><img id="26" onclick="addfilter(this)" src="img/accessories/11.png" /></a>
							<a ><img id="27" onclick="addfilter(this)" src="img/accessories/12.png" /></a>
						</div>
						<div class="line">
							<a ><img id="28" onclick="addfilter(this)" src="img/accessories/13.png" /></a>
							<a ><img id="29" onclick="addfilter(this)" src="img/accessories/14.png" /></a>
							<a ><img id="30" onclick="addfilter(this)" src="img/accessories/15.png" /></a>
						</div>
					</div>
				</div>
			</div>
			<div id="d_webcam">
				<video id="webcam" width="540" height="405" autoplay="true"></video>
			</div>
			<div class="edit_menu">
				<div class="margin_menu"> <br /></div>
				<div class="edit_icons">
					<img onclick="increase()" src="img/icons/plus.png" />
					<img onclick="decrease()" src="img/icons/minus.png" />
					<img onclick="remove()" src="img/icons/cross.png" />
				</div>
			</div>
			<button class="button" onclick="send_json()">Créer peinture</button>
			<button class="button2" onclick="import_picutre()">Importer toile</button>
			<input type="file" id="import" accept="image/png, image/jpeg" style="display:none">

		</div>
		<canvas id="canvas" style="display:none;" width="540" height="405"></canvas>
		<div id="m_pictures" class="m_pictures">
			<?php require 'model/load_profile.php'?>
			<div id="myModal" class="modal">
				<span id="close" class="close">&times;</span>
				<div class="scroll"style="">
					<img class="modal-content" id="img01">
					<div id="caption"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/profile_webcam.js"></script>
		<script type="text/javascript" src="js/profile_takepicture.js"></script>
		<script type="text/javascript" src="js/profile_pics_menu.js"></script>

</div>
</div>