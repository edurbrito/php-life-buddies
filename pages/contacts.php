<?php

include_once(dirname(__DIR__) . '/templates/tpl_common.php');

draw_header("Contact Us", array('contacts.css'));

?>

<div class = "contact_us">
    <p>
        This website was made in the context of the final project of <a target="_blank" rel="noopener noreferrer" href = "https://sigarra.up.pt/feup/pt/ucurr_geral.ficha_uc_view?pv_ocorrencia_id=459485"> Web Languages And Technologies</a> course of 2020.
    </p>
    <p>
        If you have any doubts or are interested in our product, you can contact us following the links below.
    </p>
    <ul>
        <li><a target="_blank" rel="noopener noreferrer" href="https://github.com/edurbrito">Eduardo Brito</a></li>
        <li><a target="_blank" rel="noopener noreferrer" href="https://github.com/PJscp16">Paulo Ribeiro</a></li>
        <li><a target="_blank" rel="noopener noreferrer" href="https://github.com/pdff2000">Pedro Ferreira</a></li>
        <li><a target="_blank" rel="noopener noreferrer" href="https://github.com/pedrovponte">Pedro Ponte</a></li>
    </ul>
    <p>
        You can find all website and database informations in our <a target="_blank" rel="noopener noreferrer" href = "https://github.com/FEUP-LTW/ltw-project-g62"> GitHub repository</a>.
</div>
    
<?php
    draw_footer();
?>
    