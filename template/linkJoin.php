<?php $news = count($dbh->getInvitations($_SESSION["userid"]))+count($dbh->getModifiedEvents($_SESSION["userid"])); ?>


<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view teal darken-3">
            <a ><i class="material-icons medium white-text">account_circle</i></a>
            <a ><span class="name white-text"><?php echo $_SESSION["username"]; ?></span></a>
            <a ><span class="email  white-text"><?php echo $_SESSION["email"]; ?></span></a>
        </div>
    </li>
    <li>
        <a href="search.php"><i class="material-icons">search</i>Search an event</a>
        <a href="inbox.php"><i class="material-icons">email</i>Inbox
            <?php if($news > 0): ?>
                <span id= "news" class="new badge teal darken-3 white-text" data-badge-caption=""><?php echo $news; ?></span>
            <?php endif; ?>
        </a>
        <a href="myEvents.php"><i class="material-icons">event_available</i>My events</a>
        <a href="cart.php"><i class="material-icons">shopping_cart</i>Cart</a>
        <a href="pastEvents.php"><i class="material-icons">event_note</i>Past events</a>
        <div class="divider"></div>
        <a href="logout.php"><i class="material-icons">directions_run</i>Logout</a>
    </li>
</ul>
<div class="row teal darken-3 no-margin perfect-height">
    <div class="col s2 perfect-height">
        <a href="#" data-target="slide-out" class="sidenav-trigger">
        <i class="perfect material-icons  white-text">menu</i>
        </a>
    </div>
        <ul id="tabs-swipe-demo" class="tabs col s8 teal darken-3">
            <li class="tab col s6"><a class = "white teal-text text-darken-3" href="join.php">Join</a></li>
            <li class="tab col s6"><a class = "white-text" href="organize.php">Organize</a></li>
        </ul>
    <div class="col s2 perfect-height">
        <picture>
          <source class="img perfect-height" media="(min-width: 900px)" srcset="res/title.png">
          <source class="img perfect-height" media="(min-width: 480px)" srcset="res/title.png">
          <img class="img perfect-height" src="res/logoPiccolo.jpg" alt="IfItDoesntMatchAnyMedia">
        </picture>
    </div>
</div>
