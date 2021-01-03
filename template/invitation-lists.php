<?php if(isset($templateParams["usererror"])): ?>
    <h5 class="center"><?php echo $templateParams["usererror"] ?></h5>
<?php endif; ?>

<ul class="collapsible popout">
    <?php foreach($templateParams["lists"] as $list): ?>

    <li>
        <div class="collapsible-header"><i class="material-icons" aria-hidden="true">group</i><?php echo $list["listname"]; ?> <a class="secondary-content modal-trigger" href="#modal<?php echo $list["listid"]; ?>"><i class="material-icons" aria-hidden="true">cancel</i></a></div>

        <div class="collapsible-body">
            <span>
                <ul class="collection with-header">
                    <?php foreach($dbh->getUsersEnlist($list["listid"]) as $user): ?>
                        <li class="collection-item"><div><?php echo $user["username"]; ?><a href="managelists.php?useridentifier=<?php echo $user["userid"]; ?>&listidentifier=<?php echo $list["listid"]; ?>" class="secondary-content"><i class="material-icons" aria-hidden="true">cancel</i></a></div></li>
                    <?php endforeach; ?>
                    <li class="collection-item">
                        <form class="col s12" action="managelists.php" method="POST">
                            <div class="row">
                                <div class="input-field col s8">
                                    <input type="hidden" name="listid" value="<?php echo $list["listid"]; ?>"/>
                                    <input placeholder="username" id="user<?php echo $list["listid"]; ?>" name="adduser" type="text" class="validate">
                                    <label for="user<?php echo $list["listid"]; ?>">Add a user to this list</label>
                                </div><br>
                                <div class="col s4">
                                    <button id="adduserto<?php echo $list["listid"]; ?> "class="btn waves-effect waves-light teal darken-3 col s12 m6 l4" type="submit" name="action">ADD
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </span>
        </div>
    </li>
        <!-- <i class="material-icons prefix">add</i> -->

        <!-- Modal Structure -->
        <div id="modal<?php echo $list["listid"]; ?>" class="modal">
            <div class="modal-content">
                <h4><?php echo $list["listname"]; ?></h4>
                <p>Are you sure you want to delete this invitation list?</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Back</a>
                <a href="managelists.php?deleteid=<?php echo $list["listid"]; ?>" class="modal-close waves-effect waves-green btn-flat">Delete</a>
            </div>
        </div>


    <?php endforeach; ?>
</ul>
<br>
<form class="col s12" action="managelists.php" method="POST">
    <div class="row">
        <div class="input-field col s8">
            <i class="material-icons prefix" aria-hidden="true">add</i>
            <input placeholder="list name" id="newlistname<?php echo $list["listid"]; ?>" name="newlistname" type="text" class="validate">
            <label for="newlistname<?php echo $list["listid"]; ?>">Create new list</label>
        </div><br>
        <div class="col s4">
            <button id="newlist<?php echo $list["listid"]; ?>" class="btn waves-effect waves-light teal darken-3 col s12" type="submit" name="action">Create
            </button>
        </div>
    </div>

</form>

