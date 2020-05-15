<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Korisničko ime:')); ?></label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> form_input_text"
                                   name="username" value="<?php echo e(old('name')); ?>" required autocomplete="username" autofocus
                                   placeholder="unesite korisničko ime">

                            <?php $__errorArgs = ['name'];
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

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-mail: ')); ?></label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control form_input_text <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email"
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

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Lozinka: ')); ?></label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control form_input_text <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="password" required autocomplete="new-password"
                                   placeholder="unesite lozinku">

                            <?php $__errorArgs = ['password'];
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

                    <div class="form-group row">
                        <label for="password-confirm"
                               class="col-md-4 col-form-label text-md-right"><?php echo e(__('Ponovljena lozinka: ')); ?></label>

                        <div class="col-md-6">
                            <input id="password_confirm" type="password" class="form-control form_input_text <?php $__errorArgs = ['password_confirm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="password_confirm" required autocomplete="new-password"
                                    placeholder="unesite lozinku ponovo">

                            <?php $__errorArgs = ['password_confirm'];
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

                    <div class="form-group row mb-0">
                        <label for="optradio" class="col-md-4 col-form-label text-md-right">
                            <?php echo e(__('Registruj se kao:')); ?></label>
                        <div class="col-md-2 float-md-left">
                                <label><input type="radio" name="optradio" value="slikar"
                                        class="text-md-left float-md-left" checked>Slikar</label>
                                <label><input type="radio" name="optradio" value="kupac"
                                        class="text-md-left float-md-left">Kupac</label>
                        </div>
                        <div class="col-md-6 offset-md-6 float-md-right">
                            <button type="submit" class="btn btn-warning">
                                <?php echo e(__('Registruj se')); ?>

                            </button>
                        </div>
                    </div>

                </form>
            <br> <br>
        </div>
    </div>
</div>
<footer>
    <a class="btn btn-link-btn" href="<?php echo e(route('welcome')); ?>">
        <button type="button" class="btn btn-warning">
            <?php echo e(__('Povratak na početnu')); ?>

        </button>
    </a>
</footer>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\project\resources\views/auth/register.blade.php ENDPATH**/ ?>