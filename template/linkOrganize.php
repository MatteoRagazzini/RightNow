<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view teal darken-3">
            <a><i class="material-icons medium white-text" aria-hidden="true">account_circle</i></a>
            <a ><span class="name white-text"><?php echo $_SESSION["username"]; ?></span></a>
            <a ><span class="email  white-text"><?php echo $_SESSION["email"]; ?></span></a>
        </div>
    </li>
    <li>
        <a href="create.php"><i class="material-icons" aria-hidden="true">add_circle_outline</i>create event</a>
        <a href="managelists.php"><i class="material-icons" aria-hidden="true">group</i>manage invitation lists</a>
        <a href="organize.php"><i class="material-icons" aria-hidden="true">event</i>hosted events</a>
        <div class="divider"></div>
        <a href="logout.php"><i class="material-icons" aria-hidden="true">directions_run</i>logout</a>
    </li>
</ul>
<div class="row teal darken-3 no-margin perfect-height">
    <div class="col s2 perfect-height">
        <a href="#" data-target="slide-out" class="sidenav-trigger">
        <i class="perfect material-icons  white-text" title="menu" role="button">menu</i>
        </a>
    </div>
        <ul id="tabs-swipe-demo" class="tabs col s8 teal darken-3">
            <li class="tab col s6"><a class = "white-text" href="join.php">Join</a></li>
            <li class="tab col s6"><a class = "white teal-text text-darken-3" href="organize.php">Organize</a></li>
        </ul>
    <div class="col s2 perfect-height">
        <picture>
            <source class="img perfect-height" media="(min-width: 900px)" srcset="res/title.png">
            <source class="img perfect-height" media="(min-width: 480px)" srcset="res/title.png">
            <img class="img perfect-height" src="res/logoPiccolo.jpg" alt="logo rightnow">
        </picture>
    </div>
</div>
