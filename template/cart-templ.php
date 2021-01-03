<?php if(isset($templateParams["cartupdate"])): ?>
    <h5 class="center"><?php echo $templateParams["cartupdate"] ?></h5>
<?php endif; ?>

<?php foreach($templateParams["events"] as $event): ?>
    <div class="col s12">
        <div class="card horizontal">
            <div class="card-image">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $event['imgevent'] ).'"/>'; ?>
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <h5 class= "center red-text"><?php echo $event["eventname"]; ?></h5>
                    <p class="center"><?php echo $event["eventpreview"]; ?></p>
                    <p class="center"><?php echo date_format(date_create($event["date"]), "d/m/Y"); ?></p>
                    <p class="center">€<?php echo $event["price"]; ?></p>
                    <a  href="espandiEvento.php?id=<?php echo $event["eventid"];?>" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">more_horiz</i></a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php if(count($templateParams["events"])!=0): ?>
    <div class=" center footer">
        <button data-target="modal1" id="buy" class="btn teal darken-3 col s4 offset-s7 modal-trigger" type="submit" name="action">procede to payment
        </button>
    </div>
    <?php endif; ?>


    <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4>Confirm the payment</h4>
                        <p class="red-text">Total : <?php echo $templateParams["total"];?> $<p>
                        <p>The amount of money will be payed with your favourite payment method</p>
                </div>
                <div class="modal-footer">
                    <a class="modal-close waves-effect waves-green btn-flat">back</a>
                    <a href="buy.php" class="modal-close waves-effect waves-green btn-flat">pay</a>
                </div>
            </div>
