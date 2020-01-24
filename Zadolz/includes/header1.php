<header class="header-wrapper">
<nav class="navbar navbar-expand-lg navigation">
        <a class="navbar-brand" href="index.php">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbar-header">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Главная</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Контакты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Учебные материалы</a>
              </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="auth.php">
                        <?php
					if(isset($_COOKIE[user])){
						include ('db.php');
						$result = mysqli_query($conn, "SELECT surname FROM users WHERE id='$_COOKIE[user]'");
						$user_array = mysqli_fetch_assoc($result);
						$surname = $user_array['surname'];
						echo $surname;
					}else{
					 	echo 'Личный кабинет';
					}
					?></a>
                  </li>
              </ul>
          </form>
        </div>
    </nav>
</header>