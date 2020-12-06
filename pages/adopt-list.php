<?php

include_once('../templates/tpl_common.php');

draw_header("Adoption List", array('adopt-list.css'), array('search.js'));

include_once('../database/db_pet.php');

$pets = getAllPets();

?>
<section id='search-container'>
  <form>
    <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
    <div class="group">
      <label for="name">Name:</label> <br/>
      <input type="text" id="name" name="name" type="text">
    </div>
    <div class="group">
      <label for="species">Species:</label> <br/>
      <input type="text" id="species" name="species" type="text">
    </div>
    <div class="group">
      <label for="color">Color:</label> <br/>
      <input type="text" id="color" name="color" type="text">
    </div>
    <div class="group">
      <label for="age">Age:</label> <br/>
      <input type="text" id="age" name="age" type="text">
    </div>
    <div class="group">
      <label for="location">Location:</label> <br/>
      <input type="text" id="location" name="location" type="text">
    </div>
    <br/>
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
      <img src="<?= htmlentities($pet['photo']) ?>" />
      <h3><?= $pet['name'] ?>, <?= htmlentities($pet['age']) ?></h3>
      <a href="/pages/pet.php?pet_id=<?= htmlentities($pet['id']) ?>"><button>View Post</button></a>
    </article>
  <?php } ?>
</section>


<?php
draw_footer();
?>