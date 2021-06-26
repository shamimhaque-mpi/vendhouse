<!DOCTYPE html>
<html ng-app="MainApp">
<head>
<?php
    $logo_data=json_decode($meta->logo,true);
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucwords(str_replace('_',' ',config_item('site_name')));?> | <?php echo ucwords(str_replace('_',' ',$meta_title)); ?></title>
    <link rel="icon" href="<?php echo site_url($logo_data['faveicon']); ?>" type="image/x-icon" />
    
    <!--<link rel="stylesheet" href="<?php echo base_url('public/inc/bootstrap/css/bootstrap.css'); ?>">-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url('/public/resources/bootstrap.min.css') ?>">
    
    <!--<link href="<?php echo site_url('private/plugins/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">-->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet"> -->
    <link href="<?= base_url('/public/resources/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
    
    <!--<link rel="stylesheet" href="<?php echo base_url('public/css/font-awesome.css');?>" />-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" /> -->
    <link rel="stylesheet" href="<?= base_url('/public/resources/font-awesome.min.css') ?>" />
    
    <link rel="stylesheet" href="<?php echo base_url('public/css/elegent.min.css');?>" />

    <link rel="stylesheet" href="<?php echo base_url('public/css/textslider.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/inc/slick/slick.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/inc/slick/slick-theme.css');?>">

    <link rel="stylesheet" href="<?php echo base_url('public/css/main.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/menu.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/responsive.css');?>">
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" href="<?= base_url('/public/resources/ionicons.min.css') ?>">

    <!-- share plugin -->
    <!-- <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5ad5db81d0b9d300137e39f8&product=inline-share-buttons"></script> -->
    <script type="text/javascript" src="<?= base_url('/public/resources/sharethis.js') ?>"></script>

    <!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url("public/slider/engine1/style.css"); ?>" />
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="<?= base_url('/public/resources/jquery-ui.css') ?>">
    <script type="text/javascript" src="<?php echo site_url("public/slider/engine1/jquery.js"); ?>"></script>
    <!-- End WOWSlider.com HEAD section -->

    <!--All Script-->
    <!--<script src="<?php echo base_url('private/js/angular.js'); ?>"></script>-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular.min.js"></script> -->
    <script src="<?= base_url('/public/resources/angular.min.js') ?>"></script>
    
    <script src="<?php echo base_url('private/js/dirPagination.js');?>"></script>
    <script src="<?php echo base_url('private/js/angular-sanitize.min.js');?>"></script>
    <script src="<?php echo base_url('private/js/frontend_ngScript.js'); ?>"></script>

    <!--<script src="<?php echo base_url('public/js/jquery-1.12.3.min.js'); ?>" type="text/javascript"></script>-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.3/jquery.min.js" type="text/javascript"></script> -->
    <script src="<?= base_url('/public/resources/jquery.min.js') ?>" type="text/javascript"></script>
    
    <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <script src="<?= base_url('/public/resources/jquery-ui.min.js') ?>"></script>
    
    <script src="<?php echo base_url('public/js/jquery.sidebar.js'); ?>" type="text/javascript"></script>
    <!-- <script src="https://jillix.github.io/jQuery-sidebar/js/handlers.js"></script> -->
    <script src="<?= base_url('/public/resources/handlers.js') ?>"></script>
    
    
    <!-- nicescroll -->
    <script src="<?php echo base_url('public/js/jquery.nicescroll.min.js'); ?>" type="text/javascript"></script>
    
    <!--<script src="<?php echo base_url('public/inc/bootstrap/js/bootstrap.js'); ?>" type="text/javascript"></script>-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script> -->
    <script src="<?= base_url('/public/resources/bootstrap.min.js') ?>" type="text/javascript"></script>
    
    <!--<script type="text/javascript" src="<?php echo site_url('private/js/Moment.js'); ?>"></script>-->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script> -->
    <script type="text/javascript" src="<?= base_url('/public/resources/moment.min.js') ?>"></script>
    
    <!--<script type="text/javaScript" src="<?php echo site_url('private/plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') ;?>"></script>-->
    <!-- <script type="text/javaScript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> -->
    <script type="text/javaScript" src="<?= base_url('/public/resources/bootstrap-datetimepicker.min.js') ?>"></script>
    
    <script src="<?php echo base_url('public/js/slicknav.js'); ?>"></script>
    <script src="<?php echo base_url('public/inc/slick/slick.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/superplaceholder.js'); ?>"></script>
    
    
    <meta property="og:image" content="<?php echo site_url(isset($meta_path) ? $meta_path:'') ?>"/>
    <meta property="og:image:width" content="200"/>
    <meta property="og:image:height" content="286"/>
    <meta property="og:title" content="<?php echo isset($meta_title) ? $meta_title:'' ?>"/>
    <meta property="og:description" content="<?php echo isset($meta_description) ? $meta_description:'' ?>"/>

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'solaimanlipinormal';
            /*src: url('solaimanlipi-webfont.woff2') format('woff2'),*/
            src: url('<?php echo base_url('public/fonts/solaimanlipi-webfont.woff2'); ?>') format('woff2'), 
                 url('<?php echo base_url('public/fonts/solaimanlipi-webfont.woff'); ?>') format('woff2');   
            font-weight: normal;
            font-style: normal;
        }
        html{
            scroll-behavior: smooth;
        }
    </style>
    
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<!--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "100",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "show",
        "hideMethod": "hide"
    };
</script>

</head>
<body ng-controller="orderShowCtrl" ng-cloak>
    

<?php if($this->session->flashdata('success')){  ?>
    <script>
        toastr.success('<?php echo $this->session->flashdata('success');?>');
    </script>
<?php } ?>

<?php if($this->session->flashdata('warning')){  ?>
    <script>
        toastr.warning('<?php echo $this->session->flashdata('warning');?>');
    </script>
<?php } ?>
