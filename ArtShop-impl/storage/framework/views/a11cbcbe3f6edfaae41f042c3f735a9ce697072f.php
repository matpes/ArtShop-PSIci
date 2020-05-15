<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body class="body">
    <div>
        <br><br><br>
        <hr>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php else: ?>
                        <br> <br> <br>
                    <?php endif; ?>
                    <br>
                    <form method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right form_label_text"><?php echo e(__('e-mail')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form_input_text"
                                       name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus
                                        placeholder="unesite e-mail">

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-3 float-md-right">
                                <button type="submit" class="btn btn-warning">
                                    <?php echo e(__('Pošalji mejl za resetovanje lozinke')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                    <br> <br>
                    <div class="form-group row mb-0">
                        <div class="col-md-4 offset-md-4 float-md-left">
                            <a class="btn btn-link-btn" href="<?php echo e(route('welcome')); ?>">
                                <button type="button" class="btn btn-warning">
                                    <?php echo e(__('Povratak na početnu')); ?>

                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <footer>
        <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
    </footer>
</body>>
</html>
<?php /**PATH C:\xampp\htdocs\project\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>