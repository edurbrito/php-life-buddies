<?php 

    include_once('./includes/session.php');
    include_once('./templates/tpl_common.php');
    include_once('./database/db_user.php');
    
    draw_header(getUser());
    draw_footer();
?>