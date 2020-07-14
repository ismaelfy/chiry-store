<!-- header vertical -->
<?php
$active = (isset($_SESSION['active']) && $_SESSION['active'] != '') ? $_SESSION['active'] : 'pedidos';

?>
<header class="header">
    <div class="header-nav">
        <a href="#" class="bt-menu">
            <i class="left fa fa-bars"></i>
        </a>
        <div class="log">
            <a href="./"><img src="../img/logo.png"></a>
        </div>
        <div class="nav-menu">
            <nav class="contenedor-menu">
                <ul class="menu">
                    <li class="item <?= ($active == 'pedidos') ? ' active ' : ''; ?>">
                        <a href="./">
                            <i class="fas fa-receipt"></i>
                            pedidos
                        </a>
                    </li>
                    <li class="item <?= ($active == 'productos') ? ' active ' : ''; ?>">
                        <a href="./productos">
                            <i class="fas fa-hockey-puck"></i>
                            Productos
                        </a>
                    </li>


                </ul>
            </nav>
        </div>

    </div>

    <!-- nav bar user info -->
    <div class="nav-bar">
        <div class="box-info">
            <div class="cont message">
                <i class="fa fa-comments"></i>
            </div>
            <div class="cont notify">
                <i class="fa fa-bell"></i>
            </div>
            <div class="cont email">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="cont user-box">

                <div class="dropdown dropleft drodown">
                    <i class="fas fa-user fa-2x dropdown-toggle" type="button" id="account-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="account-info">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- contenedor de items -->
<div class="sms"></div>