<?php

include_once(dirname(__DIR__) . '/templates/tpl_common.php');

draw_header("Adoption List", array('adopt-list.css'), array('search.js'));

include_once(dirname(__DIR__) . '/database/db_pet.php');

$pets = getAllPets();

?>
<section id='search-container'>
  <form>
    <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
    <div class="group">
      <label for="name">Name:</label> <br/>
      <input type="text" id="name" name="name" list="suggestions-name">
      <datalist id="suggestions-name"></datalist>
    </div>
    <div class="group">
      <label for="species">Species:</label> <br/>
      <input type="text" id="species" name="species" list="suggestions-species">
      <datalist id="suggestions-species"></datalist>
    </div>
    <div class="group">
      <label for="color">Color:</label> <br/>
      <input type="text" id="color" name="color" list="suggestions-color">
      <datalist id="suggestions-color"></datalist>
    </div>
    <div class="group">
      <label for="age">Age:</label> <br/>
      <input type="text" id="age" name="age" list="suggestions-age">
      <datalist id="suggestions-age"></datalist>
    </div>
    <div class="group">
      <label for="location">Location:</label> <br/>
      <input type="text" id="location" name="location" list="suggestions-location">
      <datalist id="suggestions-location"></datalist>
    </div>
    <label for="match_type">Match Any Criteria:</label>
    <input type="checkbox" id="match_type" name="match_type">
    <input type="submit" value="Search">
  </form>
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