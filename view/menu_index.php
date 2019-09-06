<div class="menu" id="menu">
	<div class="menu_index" >
			<div class="m_pictures" id="m_pictures">
				<div id="myModal" class="modal">
					<div class="close" onclick="koko()">X</div>
					<div class="scroll"style="">
						<div class="titles">
							<p class="f-letter">
								<a class="f">S</a>
								ceaux
							</p>
							<p class="f-letter">
								<a class="f">P</a>
								einture
							</p>
							<p class="f-letter">
								<a class="f">P</a>
								artage
							</p>
						</div>
						<div class="like_img_share">
							<div class="seals" style="width: 15%; margin-right: 5vw;">
								<img id="likes" onclick="likes()" onmouseover="op_img1(this)" onmouseout="op_img2(this)" src="img/seal.png" style="width: 100%;" alt="N">
								<p id="likes_nb">0</p>
							</div>
							<img class="modal-content" id="img01">
							<img id="share_facebook" onclick="share_facebook()" class="share_facebook" src="img/fb.png" style="width: 15%;  margin-left: 5vw;">
						</div>
						<div id="caption" class="comments">
						</div>
						<form id ="add" class="add_com" action="" onsubmit="add_com()">
							<input type="text" id="com"  placeholder=" Ecrivez un commentaire..."/>
							<input type="button" class="send" onclick="add_com()" value="Envoyer" id="post"/>
						</form>
					</div>
				</div>
				<script type="text/javascript" src="js/index.js"></script>
			</div>
			<input type="button" onclick="paging()" class="send2" value="Autres Chevaliers" id="post"/>
	</div>
</div>