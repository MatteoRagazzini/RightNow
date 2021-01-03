<h3 class="center teal-text">Create visual</h3>
<h5 class="center"><?php echo $templateParams["error"];?></h5>
<form class="center" action="#" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="input-field col s12">
      <input id="name" type="text" class="validate required" name="name">
      <label for="name">Name</label>
    </div>
    <div class="input-field col s12">
      <textarea id="imgtext" class="materialize-textarea validate" data-length="80" name="imgtext" required ></textarea>
      <label for="imgtext">Image text</label>
    </div>
    <div class="input-field col s12">
      <input id="imgpath" type="text" class="validate" name="imgpath" required>
      <label for="imgpath">Image path</label>
    </div>
    <div class="input-field col s12">
      <input id="imgtitle" type="text" class="validate" name="imgtitle" required>
      <label for="imgtitle">Image title</label>
    </div>
    <div class="input-field col s12">
      <input id="title1" type="text" class="validate" name="title1" required>
      <label for="title1">Title 1</label>
    </div>
    <div class="input-field col s12">
      <input id="title2" type="text" class="validate" name="title2" required>
      <label for="title2">Title 2</label>
    </div>
    <div class="input-field col s12">
      <input id="title3" type="text" class="validate" name="title3" required>
      <label for="title3">Title 3</label>
    </div>
    <div class="input-field col s12">
      <textarea id="text1" class="materialize-textarea validate" data-length="80" name="text1" required></textarea>
      <label for="text1">Text 1</label>
    </div>
    <div class="input-field col s12">
      <textarea id="text2" class="materialize-textarea validate" data-length="80" name="text2" required></textarea>
      <label for="text2">Text 2</label>
    </div>
    <div class="input-field col s12">
      <textarea id="text3" class="materialize-textarea validate" data-length="80" name="text3" required></textarea>
      <label for="text3">Text 3</label>
    </div>
    <div class="input-field col s12">
      <textarea id="credits" class="materialize-textarea validate" data-length="80" name="credits" required ></textarea>
      <label for="credits">Credits</label>
    </div>


    <button id="save" class="btn waves-effect waves-light teal darken-3 col s4 m6 offset-s4" type="submit" name="action">Save
      <i class="material-icons right">send</i>
    </button>
    </div>
</form>
