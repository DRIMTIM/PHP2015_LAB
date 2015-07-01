<html>
<body>
	<div id="__navBar_inner" hidden="hidden">
		<div class="shop-menu pull-right">
			<ul class="nav navbar-nav">
				<?php 
					if($_SESSION[__USER] !== null){?>
					<li><a href="#"><i class="fa fa-star"></i> Lista de deseos</a></li>
					<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
					<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Carro</a></li>
					<li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> Cuenta</a></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo __ROOT . "/user/account"?>">Modificar Datos</a></li>
			            <li><a href="<?php echo __ROOT . "/user/closeAccount"?>">Cerrar Cuenta</a></li>
			            <li><a href="<?php echo __ROOT . "/user/logout"?>">Cerrar Sesión</a></li>
			          </ul>
			        </li>
				<?php }else{?>
				<li><a href="<?php echo __ROOT . "/user/login"?>"><i class="fa fa-lock"></i> Login</a></li>
				<li><a href="<?php echo __ROOT . "/user/signin"?>"><i class="fa fa-user"></i> Registro</a></li>
				<?php }?>
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#__navBar").html($("#__navBar_inner").html());
		});
	</script>
</body>
</html>