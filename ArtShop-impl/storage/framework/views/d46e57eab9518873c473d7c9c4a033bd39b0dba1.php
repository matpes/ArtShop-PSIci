<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtShop</title>
    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('images/logo.png')); ?>" type="image/gif" sizes="16x16">

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
    <div class="row">
        <div class="col-md-12 float-md-right">
            <img   class = "img-fluid img-rounded"  alt="profilna_slika" style="width:100%"
                   src=<?php if(is_null($user->picture_path)){ echo'images/avatar.png';}
                   else {$path = 'images/users/'.$user->picture_path; echo $path; } ?>>
        </div>
    </div>
    <hr>
    <div class="container-fluid spaceFromHeader">
        <div class="row justify-content-center">
            
            <div class="col-md-4 mb-0">
                
                <label for="profilna" class="col-md-4 col-form-label text-md-right">
                    <?php echo e(__('Profilna slika: ')); ?></label>
                <div class="col-md-8 offset-md-4">
                    <img id='profilna' class = "img-fluid" src= $path style="width:100%" alt="profilna_slika">
                </div>
                <br>
                
                <div class="col-md-4 text-md-right">E-mail: </div>
                <div class="col-md-8 offset-md-4"><?php echo e(__($user->email)); ?></div>
                <br>
                
                <div class="col-md-4 text-md-right">Korisničko ime: </div>
                <div class="col-md-8 offset-md-4"><?php echo e(__($user->username)); ?></div>
                <br>
                
                <div class="col-md-4 text-md-right">Lozinka: </div>
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-warning">
                        <?php echo e(__('Promeni lozinku')); ?>

                    </button>
                </div>
                <br>
                
                <div class="col-md-4 text-md-right">Tip naloga: </div>
                    <?php if(Auth::check()): ?>
                        <?php if($user->isSlikar): ?>
                        <div class="col-md-8 offset-md-4">slikar </div>
                            <br>
                            
                            <div class="col-md-4 text-md-right">Prosečna ocena: </div>
                            <div class="col-md-8 offset-md-4">
                                <?php if(is_null($slikar)){
                                        $ocena = "Nemate još nijednu ocenu/sliku";
                                    } else{
                                        $ocena = $slikar->sumaOcena / $slikar->brOcenjenihSlika;
                                    }
                                    echo $ocena; ?>
                            </div>
                            <br>
                            
                            <div class="col-md-4 text-md-right">Broj ocena: </div>
                            <div class="col-md-8 offset-md-4">
                                <?php echo $brOcena; ?>
                            </div>
                        <?php elseif($user->isAdmin): ?>
                        <div class="col-md-8 offset-md-4"> admin </div>
                        <?php else: ?>
                        <div class="col-md-8 offset-md-4"> kupac </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <br>
            </div>
            
            <div class="col-md-4 mb-0">
                <br> <br>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="col-md-8 offset-md-4">
                            <a class="btn btn-link" href="<?php echo e(route('password.reset'), [csrf_token()]); ?>">
                                <?php echo e(__('Promeni lozinku')); ?>

                            </a>
                        </div>
                    </div>
                </div>
                <br> <br> <br> <br>
                <div class="row justify-content-center">
                    <div class="col-md-12 float-md-right">

                    
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-0">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <?php if(Auth::check()): ?>
                            <?php if($user->isSlikar): ?>
                                
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-link" href="<?php echo e(route('profile.user')); ?>">
                                        <?php echo e(__('Moj profil lozinku')); ?>

                                    </a>
                                </div>
                                <br>
                                
                                
                                <br>
                                
                                
                                
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-link" href="<?php echo e(route('home')); ?>">
                                        <?php echo e(__('Povratak na početnu')); ?>

                                    </a>
                                </div>
                                <br>
                            <?php elseif($user->isAdmin): ?>
                                <div class="col-md-8 offset-md-4"> admin </div>
                            <?php else: ?>
                                
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-link" href="<?php echo e(route('home')); ?>">
                                        <?php echo e(__('Povratak na početnu')); ?>

                                    </a>
                                </div>
                                <br>
                            <?php endif; ?>
                            
                            <div class="col-md-8 offset-md-4">
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn-warning">
                                        <?php echo e(__('Izloguj se')); ?>

                                    </button>
                                </form>
                            </div>
                            <br>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <footer>
        <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
    </footer>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\project\resources\views/profile/user_info.blade.php ENDPATH**/ ?>