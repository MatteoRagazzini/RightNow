<?php foreach($templateParams["events"] as $event): ?>
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card medium">
        <div class="card-image">
          <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $event['imgevent'] ).'" alt=""/>'; ?>
        </div>
        <div class="card-content">
            <div class="row">
                <span class="card-title red-text bold col s6"><?php echo $event["eventname"]; ?></span>
                <div class="col s6">
                    <p class="col s4 offset-s2"><?php echo date_format(date_create($event["date"]), "d/m/Y"); ?></p>
                </div>
            </div>
           <p><?php echo $event["eventpreview"]; ?></p>
          <a  href="espandiEvento.php?id=<?php echo $event["eventid"];?>" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">more_horiz</i></a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php if($templateParams["title"] == "My events"): ?>
  <br><br><br>
  <div class="fixed-action-btn">
    <a  href="search.php" class=" btn-floating waves-effect waves-light tooltipped btn-large teal darken-3" data-position="left" data-tooltip="Search event">
      <i class="large material-icons" title="search event">search</i>
    </a>
  </div>
<?php endif; ?>
