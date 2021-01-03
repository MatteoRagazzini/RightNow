<form class="center" action="#" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="input-field col s12 ">
      <i class="material-icons prefix" aria-hidden="true">mode_edit</i>
      <input id="name" type="text" required class="validate" name="name">
      <label for="name">Name</label>
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix" aria-hidden="true">place</i>
      <input id="city" type="text" class="validate" name="city">
      <label for="city">City</label>
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix" aria-hidden="true">people_outline</i>
      <input id="maxtickets" type="number" min="1" step="1" class="validate" name="maxtickets">
      <label for="maxtickets">Max participant</label>
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix" aria-hidden="true">event</i>
      <input id="date" type="text" class="datepicker" name="date">
      <label for="date">Date</label>
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix" aria-hidden="true">attach_money</i>
      <input id="price" type="number" step="0.01" min="0" class="validate" name="price">
      <label for="price">Price</label>
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix" aria-hidden="true">short_text</i>
      <textarea id="preview" class="materialize-textarea validate" data-length="80" name="preview"></textarea>
      <label for="preview">Brief description</label>
    </div>

    <div class="input-field col s12">
      <i class="material-icons prefix" aria-hidden="true">subject</i>
      <textarea id="description" class="materialize-textarea validate" data-length="300"  name="description"></textarea>
      <label for="description">Description</label>
    </div>

    <div class="file-field input-field col s12">
      <div class="btn col s3">
        <span>Add image</span>
        <input title="Upload image" id="image" type="file" accept="image/*" name="image" required>
      </div>
      <div class="file-path-wrapper">

        <input title="Image path" class="file-path validate" type="text" title="Uploaded image" placeholder="Upload an image">
      </div>
    </div>

    <div class="input-field col s12">
            <select id="public" name="public">
                <option value="0">Private</option>
                <option value="1">Public</option>
            </select>
        <label for="public">Visibility</label>
    </div>

  </div>
    <div class="row add-margin">
        <a href="javascript:history.go(-1)" class="btn teal darken-3 col s4" name="action" value="add">back</a>
        <button id="create"class="btn waves-effect waves-light teal darken-3 col s4 offset-s4" type="submit" name="action">Create
            <i class="material-icons right" aria-hidden="true">send</i>
        </button>
    </div>
</form>


