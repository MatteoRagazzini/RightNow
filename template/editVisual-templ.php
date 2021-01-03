<h3 class="center teal-text">Edit visual</h3>
<?php
  $visual = $templateParams["visual"];
?>
<form class="center" action="#" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="input-field col s12">
      <input id="name" type="text" class="validate" name="name" value="<?php echo $visual["name"] ?>">
      <label for="name">Name</label>
    </div>
    <div class="input-field col s12">
      <textarea id="imgtext" class="materialize-textarea" data-length="80" name="imgtext" ><?php echo $visual["imgtext"]; ?></textarea>
      <label for="imgtext">Image text</label>
    </div>
    <div class="input-field col s12">
      <input id="imgpath" type="text" class="validate" name="imgpath" value="<?php echo $visual["imgpath"] ?>">
      <label for="imgpath">Image path</label>
    </div>
    <div class="input-field col s12">
      <input id="imgtitle" type="text" class="validate" name="imgtitle" value="<?php echo $visual["imgtitle"] ?>">
      <label for="imgtitle">Image title</label>
    </div>
    <div class="input-field col s12">
      <input id="title1" type="text" class="validate" name="title1" value="<?php echo $visual["title1"] ?>">
      <label for="title1">Title 1</label>
    </div>
    <div class="input-field col s12">
      <input id="title2" type="text" class="validate" name="title2" value="<?php echo $visual["title2"] ?>">
      <label for="title2">Title 2</label>
    </div>
    <div class="input-field col s12">
      <input id="title3" type="text" class="validate" name="title3" value="<?php echo $visual["title3"] ?>">
      <label for="title3">Title 3</label>
    </div>
    <div class="input-field col s12">
      <textarea id="text1" class="materialize-textarea" data-length="80" name="text1" ><?php echo $visual["text1"]; ?></textarea>
      <label for="text1">Text 1</label>
    </div>
    <div class="input-field col s12">
      <textarea id="text2" class="materialize-textarea" data-length="80" name="text2" ><?php echo $visual["text2"]; ?></textarea>
      <label for="text2">Text 2</label>
    </div>
    <div class="input-field col s12">
      <textarea id="text3" class="materialize-textarea" data-length="80" name="text3" ><?php echo $visual["text3"]; ?></textarea>
      <label for="text3">Text 3</label>
    </div>
    <div class="input-field col s12">
      <textarea id="credits" class="materialize-textarea" data-length="80" name="credits" ><?php echo $visual["credits"]; ?></textarea>
      <label for="credits">Credits</label>
    </div>


    <button id="save" class="btn waves-effect waves-light teal darken-3 col s4 m6 offset-s4" type="submit" name="action">Save
      <i class="material-icons right">send</i>
    </button>
    </div>
</form>
