<div class="row">
    <div class="row">
      <div class="col s12">
    <h5 class="center">Invites</h5>
  </div>
</div>
    <?php if(count($templateParams["invitations"])==0): ?>
      <p class="center"> You don't have any invite</p>
    <?php endif; ?>
    <?php foreach($templateParams["invitations"] as $invitation): ?>
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card grey lighten-1">
          <div class="card-content black-text">
            <span class="card-title">Invite</span>
            <p>You have been invited to the event <?php echo $invitation["eventname"]?>.</p>
          </div>
          <div class="card-action">
            <a href="espandiEvento.php?id=<?php echo $invitation["eventid"];?>" class="green-text">Show</a>
            <a href="inbox.php?action=1&id=<?php echo $invitation["eventid"];?>" class="red-text">Ignore</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- Notifications -->
    <div class="row">
      <div class="col s12">
    <h5 class="center">Notifications</h5>
  </div>
</div>
    <?php if(count($templateParams["notifications"])==0): ?>
      <p class="center">You don't have any notifications</p>
    <?php endif; ?>
    <?php foreach($templateParams["notifications"] as $notification): ?>
      <div class="col s12 m6 offset-m3">
        <div class="card orange lighten-5">
          <div class="card-content black-text">
            <span class="card-title"><?php echo $notification["eventname"]?></span>
            <p>Your event "<?php echo $notification["eventname"]?>" has been modified by the organiser.</p>
          </div>
          <div class="card-action">
            <a href="espandiEvento.php?id=<?php echo $notification["eventid"]?>" class="green-text">See changes</a>
            <a href="inbox.php?action=2&id=<?php echo $notification["eventid"];?>" class="red-text">Dismiss</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
