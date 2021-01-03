<?php
        $event = $templateParams["events"];
    ?>

      <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-image">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $event['imgevent'] ).'" alt=""/>'; ?>
                    </div>
                </div>
            </div>

            <div class="input-field col s5 add-margin">
                <i title="city" class="material-icons prefix">location_on</i>
                <label for="city"><?php echo $event["eventcity"]; ?></label>
            </div>

            <div class="input-field col s6 add-margin">
                <i title="date" class="material-icons prefix">event</i>
                <label for="date"><?php echo date_format(date_create($event["date"]), "d/m/Y"); ?></label>
            </div>

            <div class="input-field col s5 add-margin">
                <i title="price" class="material-icons prefix">attach_money</i>
                <label for="price">€<?php echo $event["price"]; ?></label>
            </div>

            <div class="input-field col s7 add-margin">
                <i title="room available" class="material-icons prefix">group</i>
                <label for="places"><?php echo ($event["maxtickets"] - count($dbh->ticketsSold($event["eventid"]))); ?> remaining places</label>
            </div>

            <div class="input-field col s12 add-margin">
                <i title="organiser" class="material-icons prefix">account_circle</i>
                <label for="organiser">Organized by <?php $user= $dbh->getUser($event["organiser"]);
                                                        echo($user[0]["username"]);?></label>
            </div>

            <div class="input-field col s12 add-margin">
                <i aria-hidden="true" class="material-icons prefix">short_text</i>
                <label for="preview">preview</label>
            </div>

            <div class="input-field col s12">
                <p><?php echo $event["eventpreview"]; ?></p>
            </div>

            <div class="input-field col s12 ">
                <i aria-hidden="true" class="material-icons prefix">subject</i>
                <label for="description">description</label>
            </div>

            <div class="input-field col s12">
                <p><?php echo $event["eventdescription"]; ?></p>
            </div>


            <div class="row">
            <a href="javascript:history.go(-1)" class="btn teal darken-3 col s3">back</a>
                <?php if($dbh->isInMyEvents($_SESSION["userid"],$event["eventid"])): ?>
                <?php elseif($dbh->isInCart($_SESSION["userid"], $event["eventid"])): ?>
                    <a href="#modal1"
                    class="btn teal darken-3 col s7 offset-s2 modal-trigger " name="remove">remove from cart
                    <i class="material-icons right">remove_shopping_cart</i></a>

                    <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Are you sure?</h4>
                            <p>Remember that you will lose your priority</p>
                    </div>

                    <div class="modal-footer">
                        <a href="cart.php?removeeventid=<?php echo $event["eventid"];?>" class="modal-close waves-effect waves-green btn-flat">Agree</a>
                        <a class="modal-close waves-effect waves-green btn-flat">Disagree</a>
                    </div>
            </div>
                <?php else: ?>
                    <a href="cart.php?addeventid=<?php echo $event["eventid"];?>" class="btn teal darken-3 col s6 offset-s3" name="add" value="add">add to cart
                    <i class="material-icons right">add_shopping_cart</i></a>
                <?php endif; ?>
                </div>
    </div>
