<?php

    include_once('../templates/tpl_common.php');
    include_once('../database/db_user.php');
    
    draw_header(getUser());
?>
    
<?php
    draw_footer();
?>