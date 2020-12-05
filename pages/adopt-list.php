<?php

include_once('../templates/tpl_common.php');

draw_header("Adoption List", array('adopt-list.css'), array('search.js'));

include_once('../database/db_pet.php');

$pets = getAllPets();

?>
<section id='search-container'>
  <form>
    <label for="species">Name:</label>
    <input type="text" id="name" name="name" type="text">
    <label for="species">Species:</label>
    <input type="text" id="species" name="species" type="text">
    <label for="color">Color:</label>
    <input type="text" id="color" name="color" type="text">
    <label for="age">Age:</label>
    <input type="text" id="age" name="age" type="text">
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" type="text">
    <label for="match_type">Match Any Criteria:</label>
    <input type="checkbox" id="match_type" name="match_type">
    <input type="submit" class="large-text" value="Search">
  </form>
  <!-- <ul id="suggestions-name"></ul>
  <ul id="suggestions-species"></ul>
  <ul id="suggestions-color"></ul>
  <ul id="suggestions-age"></ul>
  <ul id="suggestions-location"></ul> -->
</section>

<section class="adopt-list" id="adopt-list">
  <?php
  foreach ($pets as $pet) { ?>
    <article class="adopt-list-item">
      <img src="<?= $pet['photo'] ?>" />
      <h3><?= $pet['name'] ?>, <?= $pet['age'] ?></h3>
      <a href="/pages/pet.php?pet_id=<?= $pet['id'] ?>"><button>View Post</button></a>
    </article>
  <?php } ?>
</section>


<?php
draw_footer();
?>