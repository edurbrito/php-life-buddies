<?php 

    include_once('./includes/session.php');
    include_once('./templates/tpl_common.php');
    
    if(isset($_SESSION['email']))
        $email = $_SESSION['email'];

    draw_header($email); ?>

    <div class="adopt-list-container">
    <section class="top-banner">
        <img src="../css/images/MainPage.png" />
        <img class="Text1" src="../css/images/Text1.png" />
        <img class="Text2" src="../css/images/Text2.png" />
        <a href="/pages/adopt-list.php"><h2 class="large-text">FIND HERE YOUR LIFE BUDDY</h2></a>
    </section>
    
</div>
<?php
    draw_footer();
?>