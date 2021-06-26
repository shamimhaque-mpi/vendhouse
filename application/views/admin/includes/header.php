<!DOCTYPE html>
<html lang="en" ng-app="MainApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Pannel</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url('private/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Bootstrap Date Picker -->
    <link href="<?php echo site_url('private/plugins/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">

    <!-- Bootstrap file upload CSS -->
    <link href="<?php echo site_url('private/plugins/bootstrap-fileinput-master/css/fileinput.min.css') ;?>" rel="stylesheet">
    
    <!-- Tag It CSS -->
    <link href="<?php echo site_url('private/css/jquery.tagit.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('private/css/tagit.ui-zendesk.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url('private/css/simple-sidebar.css'); ?>" rel="stylesheet">

    <!-- Awesome Font CSS -->
    <link href="<?php echo site_url('private/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('private/plugins/lightbox/dist/css/lightbox.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    
    <link href="<?php echo site_url('private/css/profile.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('private/css/form.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('private/css/top-nav.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('private/css/style.css'); ?>" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="<?php echo site_url('private/css/responsive.css'); ?>" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javaScript" src="<?php echo site_url('private/js/jquery.js'); ?>"></script>
    <script type="text/javaScript" src="<?php echo site_url('private/js/jquery-ui.min.js'); ?>"></script>
    
    <!-- Tag It JS -->
    <script type="text/javaScript" src="<?php echo site_url('private/js/jquery-ui.min.js'); ?>"></script>
    <script type="text/javaScript" src="<?php echo site_url('private/js/tag-it.min.js'); ?>"></script>
    
    <!-- includ moment for bootstrap calander -->
    <script type="text/javascript" src="<?php echo site_url('private/js/Moment.js'); ?>"></script>
    <script type="text/javaScript" src="<?php echo site_url('private/plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') ;?>"></script>
    <!-- texteditor Core Javascript -->
	
    <script src="<?php echo site_url('private/plugins/tinymce/js/tinymce/tinymce.min.js')?>"></script>

    <script>
        // Texteditor Script
        tinymce.init({ 
            selector: '#tinyTextarea',
            theme: 'modern',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            // content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | code',
            skin: 'lightgray',
            content_css: "<?php echo site_url('private/css/tinymce.css'); ?>"
        });
    </script>
</head>




<body <?php echo $active; ?>>
    
    <!--toastr link start -->

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

<!--toastr link end -->

    <div id="wrapper">

























