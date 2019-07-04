<nav id="nav">
  <ul>
    <li><a href="nearbyShops">Nearby Shops</a></li>
    <li><a href="preferedShops" class="active">Prefered Shops</a></li>
  </ul>
  <a href="logout">Logout</a>
</nav>
<div id="container">
<?php 
  if(!isset($_SESSION['id'])){
    header("location: login");
  }
  $shops = Shop::getShops();
  for($i=0;$i<count($shops);$i++){
    if(Shop::liked($_SESSION['id'],$shops[$i]->id)){
    ?>
    <div class="shop" id="shop_<?= $shops[$i]->id ?>">
      <span class="name"><p><?= $shops[$i]->name; ?></p></span>
      <span class="image"><img src="<?= $shops[$i]->image; ?>"></span>
      <?php if(!Shop::disliked($_SESSION['id'],$shops[$i]->id)){ ?><span class="dislikebtn" id="dislike_<?= $shops[$i]->id;?>">Dislike</span><?php }?>
      <?php if(!Shop::disliked($_SESSION['id'],$shops[$i]->id)){ ?><span class="likebtn" style="background: #A0A0A0 ;" id="remove_<?= $shops[$i]->id;?>">X</span><?php }?>
    </div>
    <?php
    }
  }
?>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/like_dislike.js"></script>