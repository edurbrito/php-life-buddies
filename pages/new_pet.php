<?php 
    include_once('../templates/tpl_common.php');

    if(isset($_SESSION['email']))
        $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>New Pet</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/new_pet.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <div id="topbar">
            <!-- Include à barra genérica -->
            <?php draw_header($email); ?>
        </div>

        <div class="row">
            <div class="column">
                <img src="../images/canary.png" alt="A yellow canary" width="200" height="181.82">
                <i class="far fa-star fa-2x"></i>
                <section>
                    <h2 class="large-text">PROPOSALS</h2>
                    <article class="pet-proposals">
                        <!-- Listar todas as propostas -->
                        <h4>Maria Cantanhede</h4>
                        <button>Accept</button>
                        <button>Decline</button>
                    </article>
                </section>
                <section>
                    <h2 class="large-text">QUESTIONS</h2>
                    <!-- Listar todos os comentários -->
                    <article class="pet-comments">
                        <h4><i class="fas fa-angle-right"></i> Maria Cantanhede</h4>
                        <p>Hello, is this bird single? I am interested in a buddy for my trips to Mexico!!</p>
                    </article>
                    <article class="pet-comments">
                        <h4><i class="fas fa-angle-right"></i> Manel Ferreira</h4>
                        <p>No, he isn't! You must stay home Maria!</p>
                    </article>
                    <input type="text" id="send_comment">
                    <i class="fas fa-arrow-circle-up fa-2x"></i>
                </section>
            </div>
            <div class="column">
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
            </div>
        </div>
    </body>
</html>
