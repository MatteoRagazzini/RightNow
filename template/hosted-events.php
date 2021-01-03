<?php if(isset($templateParams["usererror"])): ?>
    <h5 class="center"><?php echo $templateParams["usererror"] ?></h5>
<?php endif; ?>

<?php foreach($templateParams["hosted"] as $event): ?>

    <div class="row">
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card medium">
          <div class="card-image">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $event['imgevent'] ).'" alt=""/>'; ?>
          </div>
          <div class="card-content black-text">
            <span class="card-title center bold"><?php echo $event["eventname"]; ?> </span>
            <p class="center">Current participants: <?php echo count($dbh->ticketsSold($event["eventid"]));echo "/"; echo($event["maxtickets"]); ?></p>
          </div>
          <div class="card-action">
              <?php if(!$dbh->isPast($event["eventid"])): ?>
                  <a class="modal-trigger" href="#modal<?php echo $event["eventid"]; ?>">INVITE USER</a>
                  <a class="modal-trigger" href="#modal2<?php echo $event["eventid"]; ?>">INVITE LIST</a>
              <?php endif; ?>
            <a href="modify.php?id=<?php echo $event["eventid"]; ?>">EDIT</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal per invitare utente singolo -->
    <div id="modal<?php echo $event["eventid"]; ?>" class="modal">
      <div class="modal-content">
        <h4>Invite People</h4>
        <form class="center" action="organize.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col s12">
                <div class="input-field col s12">
                  <i class="material-icons prefix" aria-hidden ="true">person</i>
                    <input placeholder="username" id="inviteuser<?php echo $event["eventid"]; ?>" name="inviteuser" type="text" class="validate">
                    <input type="hidden" name="eventid" value="<?php echo $event["eventid"]; ?>"/>
                    <label for="inviteuser<?php echo $event["eventid"]; ?>">Insert username</label>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat" >Cancel</a>
            <button id="saveUser<?php echo $event["eventid"]; ?>" class="btn waves-effect waves-light black col s4 m6 offset-s6" type="submit" name="action">Invite
            <i class="material-icons right" aria-hidden ="true">send</i>
            </button>
          </form>
        </div>
      </div>

      <!-- modal per lista  -->
      <div id="modal2<?php echo $event["eventid"]; ?>" class="modal">
        <div class="modal-content">
          <h4>Invite People</h4>
          <form class="center" action="organize.php" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col s12">
                  <div class="input-field col s12">
                    <i class="material-icons prefix" aria-hidden ="true">group</i>
                      <input placeholder="listname" id="invitelist<?php echo $event["eventid"]; ?>" name="invitelist" type="text" class="validate">
                      <input type="hidden" name="eventid" value="<?php echo $event["eventid"]; ?>"/>
                      <label for="invitelist<?php echo $event["eventid"]; ?>">Insert the users list</label>
                  </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" >Cancel</a>
              <button id="saveList<?php echo $event["eventid"]; ?>" class="btn waves-effect waves-light black col s4 m6 offset-s6" type="submit" name="action">Invite
              <i class="material-icons right" aria-hidden ="true">send</i>
              </button>
            </form>
          </div>
        </div>

<?php endforeach; ?>


        <div class="fixed-action-btn">
      <a  href="create.php" class="btn-floating waves-effect waves-light tooltipped btn-large teal darken-3"  data-position="left" data-tooltip="Create new event">
        <i class="large material-icons" title="create new event">add</i>
      </a>
    </div>
