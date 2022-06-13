<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
            <div class="card card-user">
                <div class="card-body">
                    <div class="author">
                        <div class="block block-one"></div>
                        <div class="block block-two"></div>
                        <div class="block block-three"></div>
                        <div class="block block-four"></div>
                        <img class="avatar" src="/upload/images/default/user-default.png" alt="...">
                        <h5 class="title h3">Registrate Como Cliente Para Comprar Comida</h5>
                    </div>

                    <?= $this->render('_form', compact('client', 'user', 'user_custom'))
                    ?>
                </div>
                <div class="form-group">
                    <p>O</p>
                    <a class="" href="/site/login">Iniciar Sesión</a>
                    <p>O</p>
                    <a class="" href="/user-owner/register">Registrate como dueño de restaruante</a>
                </div>
            </div>
        </div>
    </div>
</div>