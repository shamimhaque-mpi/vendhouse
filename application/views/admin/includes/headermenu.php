<?php 
    $where=array('messages_condition'=>'unread');
    $counter=$this->action->read('messages',$where,'desc');
    $total_msg=count($counter);
    $latest_msg=$this->action->read_limit('messages',$where,'desc','5');
    $info = $this->action->read("users",array('username'=>$username));
?>
<style>
    .view-site:hover{
        color: #333;
    }

@media screen and (max-width: 480px) {
    .hello{
        display: none;
    }
}
</style>


<!-- Page Content -->
<div id="page-content-wrapper">


    <!-- top navigation start -->
    <div class="row">
        <nav class="col-xs-12 content-fixed-nav">
            <ul>
                <li>
                    <a href="#menu-toggle" id="menu-toggle">
                        <i class="fa fa-angle-left"></i>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>

                <li class="dropdown">
                    <a id="message-menu" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge badge-messages"><?php echo $total_msg; ?></span>
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="message-menu">
                        <li class="dropdown-menu-description"><a><?php echo caption('Messages'); ?></a></li>
                        <?php foreach ($latest_msg as $key => $msg) { ?>
                        <li><a href="<?php echo base_url('visitors/comments/view_comments')?>?id=<?php echo $msg->id; ?>" title="<?php echo $msg->messages_date; ?>"><?php echo $msg->messages_name; ?></a></li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('visitors/comments'); ?>"><?php echo caption('All'); ?></a></li>
                    </ul>
                </li>

                <li style="min-width: 85px;"><a class="view-site" style="font-weight: bold;" target="_blank" href="<?php echo base_url(); ?>"><?php echo caption('View_Site');?></a></li>

            </ul>
            
            
            <ul class="nav-inner-right">
                <li class="hello" style="width: auto;">
                    <a style="font-weight: bold;"><span style="color: #000;">Hello: </span> <span style="color: #00A8FF;"><?php echo $info[0]->name; ?></span></a>
                </li>
                
                <li class="user-menu dropdown" style="width: 72px;">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown" >
                        <img class="nav-pic" src="<?php echo site_url($image); ?>"/>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-menu-description"><a><?php echo caption('Settings'); ?></a></li>
                        <li><a href="<?php echo site_url("settings/profile");?>"><?php echo caption('Profile'); ?></a></li>
                        <li><a href="<?php echo site_url('settings/createProfile'); ?>"><?php echo caption('Create_Profile'); ?></a></li>
                        <li><a href="<?php echo site_url("settings/allProfile");?>"><?php echo caption('All_Profile'); ?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('access/users/logout'); ?>"><?php echo caption('Log_Out'); ?></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!-- top navigation end -->

    <div class="main-area">&nbsp;</div>