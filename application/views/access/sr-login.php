<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo ucwords(str_replace('_',' ',$site_name)) . ' | ' . ucwords(str_replace('_',' ', $meta_title)); ?></title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link href="<?php echo site_url('private/css/login.min.css'); ?>" rel="stylesheet">
    </head>

    <body>

        <section class="container">
            <?php
            $attr = array(
                'class' => 'login-form',
                'name'  => ''
            );

            echo form_open('access/sr/login', $attr);
            ?>

            <div class="form-head">
                <h3><?php echo $site_name; ?></h3>
            </div>

            <div class="form-input">
                <div class="form-error">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label class="remember">
                        <input type="checkbox" name="remember_me" value="1"> &nbsp;
                        Remember Me
                    </label>
                </div>

                <div class="form-group">
                    <input type="submit" name="submit_login" class="btn" value="Login">
                </div>

                <div class="form-group">
                    <a href="<?php echo base_url(); ?>">Home</a>
                </div>
            </div>

            <?php echo form_close(); ?>
        </section>

    </body>
</html>
