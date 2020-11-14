<?php
if (isset($_SESSION['email']) || 1) // REMOVE THIS 1
    $email = $_SESSION['email'];

include_once('../templates/tpl_common.php');

draw_header($email);
?>
<div class="adopt-list-container">
    <section class="top-banner">
        <img src="../css/images/banner.png" />
        <h2>Adoption List</h2>
    </section>
    <section class="adopt-list">
        <article class="adopt-list-item">
            <img src="../css/images/dog.svg" />
            <h3>Pet Name, Age</h3>
            <button>View Post</button>
        </article>
        <article class="adopt-list-item">
            <img src="../css/images/dog.svg" />
            <h3>Pet Name, Age</h3>
            <button>View Post</button>
        </article>
        <article class="adopt-list-item">
            <img src="../css/images/dog.svg" />
            <h3>Pet Name, Age</h3>
            <button>View Post</button>
        </article>
        <article class="adopt-list-item">
            <img src="../css/images/dog.svg" />
            <h3>Pet Name, Age</h3>
            <button>View Post</button>
        </article>
        <article class="adopt-list-item">
            <img src="../css/images/dog.svg" />
            <h3>Pet Name, Age</h3>
            <button>View Post</button>
        </article>
        <article class="adopt-list-item">
            <img src="../css/images/dog.svg" />
            <h3>Pet Name, Age</h3>
            <button>View Post</button>
        </article>
        <article class="adopt-list-item">
            <img src="../css/images/dog.svg" />
            <h3>Pet Name, Age</h3>
            <button>View Post</button>
        </article>
        <article class="adopt-list-item">
            <img src="../css/images/dog.svg" />
            <h3>Pet Name, Age</h3>
            <button>View Post</button>
        </article>
    </section>
</div>


<?php
draw_footer();
?>