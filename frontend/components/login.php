<div class="row justify-content-center mt-5">
    <div class="col-lg-4 col-md-8 col-sm-10 mt-5">
        <div class="card">
            <img src="<?php echo URL_ROUTE ?>/frontend/assets/media/system/images/loginheader.jpg" class="card-img-top">
            <div class="card-body">
                <form action="<?php $auth->login(); ?>" method="post">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">person</div>
                        </div>
                        <input type="email" class="form-control" id="username" name="user-email" placeholder="example@email.com">
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">lock</div>
                        </div>
                        <input type="password" class="form-control" id="password" name="user-password" placeholder="********">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block" name="login">Iniciar Sesión</button>
                    </div>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center" href=" auth/forgotPassword">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
</div>