<aside class="sidebar">
	<div class="sidebar-node">
		<ul class="sidebar-list">
			<li><a href="index.php"><i class="fas fa-user"></i> Профиль</a></li>
			<li><a href="../index.php"><i class="fas fa-globe-europe"></i> На сайт</a></li>
		</ul>
	</div>
	<div class="sidebar-node">
		<p class="text-muted sidebar-header"></p>
		<ul class="sidebar-list">
			<?php				
				if(isset($_COOKIE['role']) && ($_COOKIE['role']==1 || $_COOKIE['role']==2 || $_COOKIE['role']==3)) {
			?>			
					<li>
						<a href="jornal.php"><i class="fas fa-columns">
							</i> Журнал
						</a>
					</li>
			<?php
				}
				
				if(isset($_COOKIE['role'])&& (($_COOKIE['role']==3) || $_COOKIE['role']==4 || $_COOKIE['role']==5)) {
			?>	
					<li>
						<a href="zadol.php"><i class="fas fa-layer-group">
							</i> Задолжности
						</a>
					</li>
			<?php
				}
			?>	
		</ul>
	</div>
</aside>