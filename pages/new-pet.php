<?php

session_start();

if (!isset($_SESSION['email']))
    die(header('Location: ./login.php'));

include_once('../templates/tpl_common.php');

draw_header("Send New Pet For Adoption", array('new_pet.css'));
?>

<section class="pet-container">
    <section class="pet-lists">
        <ul>
            <li>
                <img src="../images/canary.png" alt="A yellow canary" width="200" height="180">
                <i class="far fa-star fa-2x"></i>
            </li>
            <li>
                <h2 class="large-text">PROPOSALS</h2>
                <!-- Listar todas as propostas
            <article class="pet-proposals">    
                <h4>Maria Cantanhede</h4>
                <button>Accept</button>
                <button>Decline</button>
            </article> -->
            </li>
            <li>
                <h2 class="large-text">QUESTIONS</h2>
                <!-- Listar todos os comentários -->
                <!-- <article class="pet-comments">
                <h4><i class="fas fa-angle-right"></i> Maria Cantanhede</h4>
                <p>Hello, is this bird single? I am interested in a buddy for my trips to Mexico!!</p>
            </article>
            <article class="pet-comments">
                <h4><i class="fas fa-angle-right"></i> Manel Ferreira</h4>
                <p>No, he isn't! You must stay home Maria!</p>
            </article> -->
                <div class="questions-box">
                    <input type="text" name="send_question">
                    <i class="fas fa-arrow-circle-up fa-2x"></i>
                </div>
            </li>
        </ul>
    </section>

    <section class="pet-info">
        <form method="post" action="../actions/action_new_pet.php">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="John Doe The Second" required>
            <label for="species">Species:</label>
            <input type="text" name="species" placeholder="Bird" required>
            <label for="age">Age:</label>
            <input type="text" name="age" placeholder="1 year" required>
            <label for="color">Color:</label>
            <input type="text" name="color" placeholder="Blue" required>
            <label for="location">Location:</label>
            <input type="text" name="location" placeholder="Down the Street" required>
            <input type="submit" value="Submit" class="large-text">
        </form>
    </section>
</section>

<?php
draw_footer();
?>