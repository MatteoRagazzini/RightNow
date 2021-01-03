<h3 class="center teal-text">Visuals</h3>
<?php
  foreach($templateParams["visuals"] as $visual):
?>
<div class="row">
  <div class="col s12 m8 offset-m2 l6 offset-l3">
    <div class="card small">
      <div class="card-image">
        <img src="<?php echo $visual["imgpath"]; ?>" alt="Unsplashed background img 1">
      </div>
      <div class="card-content black-text">
        <p class="card-title"><?php echo $visual["name"]; ?>
            <?php if($visual["visualid"] == $dbh->getVisualInUse()["visualid"]): ?>
                ----- <strong>IN USE</strong>
          <?php endif; ?>
        </p>

      </div>
      <div class="card-action">
        <a href="editVisual.php?action=1&id=<?php echo $visual["visualid"];?>">EDIT</a>
        <a href="editVisual.php?action=2&id=<?php echo $visual["visualid"];?>">DELETE</a>
        <a href="editVisual.php?action=3&id=<?php echo $visual["visualid"];?>">USE</a>
      </div>
    </div>
  </div>
</div>



<?php endforeach; ?>
