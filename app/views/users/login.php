<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <!-- Flash Message -->
            <?php flash('register_success'); ?>
            <h2 class="text-center">Login To You're Account</h2>
            <p class="text-center">Please fill out this form to register with us!</p>
            <form action="<?php echo URLROOT;?>/users/login" method="POST">
                <div class="form-group">
                    <label for="email">Email : <sup class="text-danger">*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo(!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"value="<?php echo $data['email']; ?>"/>
                    <span class="invalid-feedback"><?php echo $data['email_err'];?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password : <sup class="text-danger">*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo(!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"value="<?php echo $data['password']; ?>"/>
                    <span class="invalid-feedback"><?php echo $data['password_err'];?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block"/>
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT;?>/users/register" class="btn btn-light btn-block">No account? Register now!</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'?>