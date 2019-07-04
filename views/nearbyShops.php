<?php 
  // if user is not signed up then redirect to the login page
  if(!isset($_SESSION['id'])){
    header("location: login");
  }
?>
<nav id="nav">
  <ul>
    <li><a href="nearbyShops" class="active">Nearby Shops</a></li>
    <li><a href="preferedShops">Prefered Shops</a></li>
  </ul>
  <a href="logout">Logout</a>
</nav>

<div id="container">
<?php
  $shops = Shop::getShops(); // array of all the shops

  for($i=0;$i<count($shops);$i++){
    // if shops is neither disliked nor liked or hasn't been disliked for less than 2 hours
    if((!Shop::disliked($_SESSION['id'],$shops[$i]->id) AND !Shop::liked($_SESSION['id'],$shops[$i]->id)) OR (Shop::disliked($_SESSION['id'],$shops[$i]->id) AND !Shop::dislikedForLess2hours($_SESSION['id'],$shops[$i]->id) AND !Shop::liked($_SESSION['id'],$shops[$i]->id)) ){
      ?>
      <div class="shop" id="shop_<?= $shops[$i]->id ?>">
        <span class="name"><p><?= $shops[$i]->name; ?> (<?= $shops[$i]->distance; ?>m)</p></span>
        <span class="image"><img src="<?= $shops[$i]->image; ?>"></span>
        <?php if(!Shop::disliked($_SESSION['id'],$shops[$i]->id)){ ?><span class="dislikebtn" id="dislike_<?= $shops[$i]->id;?>">Dislike</span><?php }?>
        <?php if(!Shop::liked($_SESSION['id'],$shops[$i]->id)){ ?><span class="likebtn" id="like_<?= $shops[$i]->id;?>">Like</span><?php }?>
      </div>
      <?php
    }
  }
?>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/like_dislike.js"></script>