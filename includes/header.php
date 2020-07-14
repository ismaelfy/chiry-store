<?php
$show = $_POST['show'];
?>
<header>
    <div id="header-top" class="bg-dark">
        <div class="container-fluid contact-info d-flex justify-content-end justify-content-md-between align-items-center">
            <ul class="menu-info d-none d-md-flex">
                <li class="mr-2"><a href="#"><i class="fa fa-phone"></i>987 654 321</a></li>
                <li class="mr-2"><a href="#"><i class="fa fa-envelope"></i>info@groupbussines.com</a></li>
                <li class="mr-2"><a href="#"><i class="fa fa-map-marker"></i> jr. jupiter 126 sjl</a></li>
            </ul>
            <ul class="men-acount  d-md-flex justify-content-sm-end">
                <?php if (isset($_SESSION['u_inf'])) : ?>
                    <?php $user = $_SESSION['u_inf']; ?>
                    <li class='sig'><a class='acount_u'><i class='fa fa-user'></i> <?= $user['nombre'] ?></a>
                        <div class='box-user'>
                            <ul>
                                <li class='info'><a href='profile.php'><i class='fa fa-user'></i>Perfil</a></li>
                                <li class='favorit'> <a><i class='fa fa-heart'></i> Favoritos</a></li>
                                <li class='pedidos'> <a href='history.php'><i class='fa fa-history'></i> Operaciones </a></li>
                                <li class='info'> <a class='logut'><i class='fa fa-sign-out'></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                <?php else : ?>
                    <li><a class='acount_u' href='sign'><i class='fa fa-user'></i> my acount </a></li>
                <?php endif ?>

            </ul>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between py-lg-2">
        <div class="container">
            <a class="navbar-brand logo" href="./">
                <img src="img/logo.png" width="150" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <div class="row m-0 p-0 w-100 d-flex <?= ($show ? 'justify-content-center justify-content-lg-between' : ' justify-content-end') ?>">
                    <?php if ($show) {
                        include 'form_search.php';
                    } ?>

                    <ul class="navbar-nav col-sm-12 col-sm-12 col-lg-5 text-center justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Productos </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"> Recientes </a>
                        </li>

                        <li class="nav-item">
                            <div class="box-cart pt-3 pt-md-0">
                                <div class="conte-cart">
                                    <a class="cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Cart</span>
                                        <div class="all_cant">3</div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>