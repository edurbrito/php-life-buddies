<?php 

    include_once('./includes/session.php');
    include_once('./templates/tpl_common.php');
    
    if(isset($_SESSION['email']))
        $email = $_SESSION['email'];

    draw_header($email);
    draw_footer();
?>