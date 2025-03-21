<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Iglesia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-header img {
            width: 100px;
            margin-bottom: 10px;
        }

        .login-header h2 {
            color: #333;
            font-size: 24px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-login {
            width: 100%;
            background-color: #007bff;
            border: none;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            border-radius: 5px;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .footer-links {
            text-align: center;
            margin-top: 15px;
        }

        .footer-links a {
            color: #007bff;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <img src="<?= base_url('assets/images/logo.jpg'); ?>" alt="Logo Iglesia">
            <h2>Bienvenido</h2>
        </div>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
            </div>
            <br>
            <?php } ?>

        <?php echo form_open('do_login'); ?>
            <div class="mb-3">
                <input type="email" class="form-control" id="username" name="username" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-login">Iniciar Sesión</button>
        </form>
        <div class="footer-links">
            <a href="#">¿Olvidaste tu contraseña?</a><br>
            <a href="#">Registrarse</a>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades JS de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


