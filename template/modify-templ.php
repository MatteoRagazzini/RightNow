<h5 class="center">
<?php
        if(isset($templateParams["notFound"])) {
           echo $templateParams["notFound"];
        }
        $event = $templateParams["events"][0];
        $participant = $templateParams["participant"];
    ?>
</h5>

<?php if($dbh->isPast($event["eventid"])){
    $disabled = 'readonly="true"';
    $imgdisabled = "disabled";
    $datepicker = "";
}else{
    $disabled = "";
    $datepicker = 'class="datepicker"';
    $imgdisabled = "";
}?>


<form class="center" action="#" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="input-field col s12">
      <i class="material-icons prefix">mode_edit</i>
      <input id="name" type="text" <?php echo $disabled; ?> class="validate" name="name" value="<?php echo $event["eventname"] ?>">
    </div>
    <div class="input-field col s12">
      <i class="material-icons prefix">place</i>
      <input id="city" type="text" <?php echo $disabled; ?> class="validate" name="city" value="<?php echo $event["eventcity"]; ?>">
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix">people_outline</i>
      <input id="maxtickets" type="number" <?php echo $disabled; ?> min="<?php echo $participant ?>" step="1" class="validate" name="maxtickets" value="<?php echo $event["maxtickets"]; ?>">
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix">event</i>
      <input id="date" type="text" <?php echo $disabled; ?> <?php echo $datepicker; ?> name="date" value="<?php echo $event["date"]; ?>">
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix">attach_money</i>
      <input value="<?php echo $event["price"]; ?>" id="price" type="number" <?php echo $disabled; ?> step="0.01" min="0" class="validate" name="price">
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix">short_text</i>
      <textarea id="preview" class="materialize-textarea" data-length="80" name="preview" ><?php echo $event["eventpreview"]; ?></textarea>
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix">subject</i>
      <textarea id="description" class="materialize-textarea" data-length="300"  name="description" ><?php echo $event["eventdescription"]; ?></textarea>
    </div>

    <div class="file-field input-field col s12">
      <div class="btn col s3">
        <span>Add image</span>
        <input id="image" <?php echo $imgdisabled; ?> type="file" accept="image/*" name="image" >
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
      <input id="eventid" type="hidden" name="eventid" value="<?php echo $event["eventid"]; ?>">
    <div class="input-field col s12">
      <select id="public" <?php echo $disabled; ?> name="public">
        <?php if($event["public"] == 0) {
          $field = "Private";
          $fieldnot = "Public";
        } else {
          $field = "Public";
          $fieldnot = "Private";
        }
        ?>
        <option value="<?php if($event["public"] == 0) {echo "0";} else {echo "1";}; ?>"> <?php echo $field; ?> </option>
        <option value="<?php if($event["public"] == 0) {echo "1";} else {echo "0";}; ?>"> <?php echo $fieldnot; ?> </option>
      </select>
    </div>
    <a href="javascript:history.go(-1)" class="btn teal darken-3 col s3" id="action">back</a>
    <button id="save" class="btn waves-effect waves-light teal darken-3 col s3 offset-s6" type="submit" name="action">Save
      <i class="material-icons right">send</i>
    </button>
    </div>
</form>
