<?php
  require_once("formCart2.php");
  require_once("backend/authWithCookie.php");
  require_once("backend/auth.php");
  require_once("repository/cartRepository.php");
  require_once("repository/shoeRepository.php");
  require_once("repository/orderRepository.php");
  $cartRepository = new CartRepository();
  $shoeRepository = new ShoeRepository();
  $orderRepository = new OrderRepository();
  $infoUser = Auth::loginWithCookie();
  $cartList = $cartList = $cartRepository->findByUserIdAndStatus($infoUser['id'],1);

?>
<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"><![endif]
<!--[if IE 8]><html class="ie ie8"><![endif]
<!--[if IE 9]><html class="ie ie9"><![endif]
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="apple-touch-icon.png" rel="icon">
    <meta name="author" content="TV2H">
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">
    <title>HUS - Cart</title>
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/ps-icon/style.css">
    <!-- CSS Library-->
    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="plugins/Magnific-Popup/dist/magnific-popup.css">
    <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="plugins/revolution/css/settings.css">
    <link rel="stylesheet" href="plugins/revolution/css/layers.css">
    <link rel="stylesheet" href="plugins/revolution/css/navigation.css">
    <!-- Custom-->
    <link rel="stylesheet" href="css/style.css">
    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
  </head>
   
  <body class="ps-loading">
    <div class="header--sidebar"></div>
    <header class="header">
      <div class="header__top">
        <div class="container-fluid">
        <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                  <p>334 Nguyễn Trãi, Thanh Xuân, Hà Nội - Hotline: +84123456789 - 0123456789</p>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                  <div class="header__actions">
                    <?php
                      require_once("backend/filterWithCookie.php");
                    ?>
                    <!-- <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language<i class="fa fa-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">English</a></li>
                        <li><a href="#">Japanese</a></li>
                        <li><a href="#">Chinese</a></li>
                      </ul>
                    </div> -->
                  </div>
                </div>
          </div>
        </div>
      </div>
      <nav class="navigation">
        <div class="container-fluid">
          <div class="navigation__column left">
            <div class="header__logo"><a class="ps-logo" href="index.php"><img src="images/logo.png" alt=""></a></div>
          </div>
          <div class="navigation__column center">
                <ul class="main-menu menu">
                  <li class="menu-item menu-item-has-children dropdown"><a href="index.php">Home</a>
                  </li>
                  <li class="menu-item menu-item-has-children has-mega-menu"><a href="#">Men</a></li>
                  <li class="menu-item"><a href="#">Women</a></li>
                  <li class="menu-item"><a href="#">Kids</a></li>
                  <li class="menu-item menu-item-has-children dropdown"><a href="#">News</a>
                        <ul class="sub-menu">
                          <li class="menu-item menu-item-has-children dropdown"><a href="blog-grid.php">Blog-grid</a>
                                <ul class="sub-menu">
                                  <li class="menu-item"><a href="blog-grid.php">Blog Grid 1</a></li>
                                  <li class="menu-item"><a href="blog-grid-2.php">Blog Grid 2</a></li>
                                </ul>
                          </li>
                          <li class="menu-item"><a href="blog-list.php">Blog List</a></li>
                        </ul>
                  </li>
                  <li class="menu-item menu-item-has-children dropdown"><a href="contact-us.php">Contact</a>
                  </li>
                </ul>
          </div>
          <div class="navigation__column right">
            <form class="ps-search--header" action="do_action" method="post">
              <input class="form-control" type="text" placeholder="Search Product…">
              <button><i class="ps-icon-search"></i></button>
            </form>
            <div class="ps-cart"><a class="ps-cart__toggle" href="#"><span><i><?php echo $cartList->num_rows ?></i></span><i class="ps-icon-shopping-cart"></i></a>
              <?php require_once("formCart.php") ?>
            </div>
            <div class="menu-toggle"><span></span></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="header-services">
      <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with HUS Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with HUS Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with HUS Store</p>
      </div>
    </div>
    <main class="ps-main">
      <div class="ps-content pt-80 pb-80">
        <div class="ps-container">
          <div class="ps-cart-listing">
            <form method="post">
            <table class="table ps-cart__table">
              <thead>
                <tr>
                  <th>All Products</th>
                  <th>Price<th>
                  <th>Sale<th>
                  <th>Size<th>
                  <th>Color<th>
                  <th>Quantity</th> 
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <input id="cartSize" style="display: none;" value="<?php echo $cartList->num_rows ?>" type="number">
                <?php
                  $count = 0;
                  foreach($cartList as $cart){
                   
                    $shoe = $shoeRepository->getById($cart['shoe_id'])->fetch_assoc();
                    $arrLinkImage = $shoeRepository->getImage($shoe['shoe_id']);
                    
                    if($arrLinkImage->num_rows > 0){
                        $shoe_image= $arrLinkImage->fetch_assoc()['link_image'];
                    }
                    else{
                        $shoe_image= "images/product/cart-preview/1.jpg";
                    }
                ?>
                <tr>
                
                  <td><a class="ps-product__preview" href="product-detail.php?id=<?php echo $cart['shoe_id'] ?>"><img width="100" class="mr-15" src="<?php echo $shoe_image ?>" alt=""> <?php echo $shoe['shoe_name'] ?></a></td>
                  <td><span><?php echo $shoe['price'] ?></span> VND</td>
                  <td> </td>
                  <td><span id="price<?php echo $count ?>"><?php echo $shoe['price'] - $shoe['price']*$shoe['sale']*0.01 ?></span> VND <span><?php echo "(-".$shoe['sale']."%) "; ?></span></td>
                  <td> </td>
                  <td><span><?php echo $cart['shoe_size'] ?></span></td>
                  <script>
    var cartIds = cartIds || [];
    cartIds.push(<?php echo $cart['id']; ?>);
</script>

<td> </td>
<td><span><?php echo $cart['shoe_color'] ?></span></td>
<td> </td>
<td>

    <div class="form-group--number">
        <button id="minus<?php echo $count ?>" class="minus" onclick="eventMinus(<?php echo $count ?>)"><span>-</span></button>
        <input name="quantity[]" id="quantity<?php echo $count ?>" class="form-control" type="text" value="1">
        <button id="plus<?php echo $count ?>" class="plus" onclick="plusMinus(<?php echo $count ?>)"><span>+</span></button>
    </div>
</td>
<td>
    <span id="total<?php echo $count ?>"><?php echo $shoe['price'] - $shoe['price']*$shoe['sale']*0.01 ?></span> VND
    <input type="hidden" name="newTotal[]" id="newTotal<?php echo $count ?>" value="<?php echo $shoe['price'] - $shoe['price']*$shoe['sale']*0.01 ?>">
</td>
<td>
    <a href="deleteCart.php?userId=<?php echo $infoUser['id'] ?>&shoeId=<?php echo $shoe['shoe_id'] ?>"><div class="ps-remove"></div></a>
</td>
<?php $orderRepository->insert2($cart['id'],1); ?>
<script>
    
    function eventMinus(i) {
        var quantityElement = document.getElementById("quantity" + i.toString());
        console.log('Received cartId:', cartIds[i]);
        if (parseInt(quantityElement.value) > 1) {
            quantityElement.value = parseInt(quantityElement.value) - 1;
            updateTotal(i);
            saveQuantityToDatabase(cartIds[i], quantityElement.value);
        }
    }

    function plusMinus(i) {
        var quantityElement = document.getElementById("quantity" + i.toString());
        if (parseInt(quantityElement.value) < 100) {
            quantityElement.value = parseInt(quantityElement.value) + 1;
            updateTotal(i);
            saveQuantityToDatabase(cartIds[i], quantityElement.value);
        }
    }

    function updateTotal(count) {
        var price = parseFloat(document.getElementById("price" + count).innerText);
        var quantityElement = document.getElementById("quantity" + count);
        var quantity = parseInt(quantityElement.value);
        var newTotal = price * quantity;

        document.getElementById("total" + count).innerText = newTotal.toFixed(2) + " VND";
        document.getElementById("newTotal" + count).value = newTotal.toFixed(2);
        totalPrice();
    }

    function calculator(i) {
        var minusButton = document.getElementById("minus" + i.toString());
        var plusButton = document.getElementById("plus" + i.toString());

        minusButton.onclick = function (event) {
            eventMinus(i);
            event.preventDefault();
        };

        plusButton.onclick = function (event) {
            plusMinus(i);
            event.preventDefault();
        };

        var quantityInput = document.getElementById("quantity" + i);
        quantityInput.addEventListener("change", function () {
            updateTotal(i);
        });
    }

    function totalPrice() {
        var cartSize = document.getElementById("cartSize").value;
        var sum = 0;
        for (var i = 0; i < cartSize; i++) {
            var totalElement = document.getElementById("total" + i.toString());
            sum += parseFloat(totalElement.innerText);
        }
        document.getElementById("totalPrice").innerText = sum.toFixed(2) + " VND";
    }

    var cartSize = document.getElementById("cartSize").value;
    for (var i = 0; i < cartSize; i++) {
        calculator(i);
    }

    totalPrice();
    
    // cart.js

    function saveQuantityToDatabase(productId, quantity) {
        // Make a fetch request to your server
        fetch('test.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                productId: productId,
                quantity: quantity,
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response from the server if needed
            console.log('Quantity saved to database:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Other functions from your cart.js file
</script>

  
                <?php
                    $count++;
                    
                  }
               
                  // $orderRepository->insert2($cart['id'],2);
                ?>
              </tbody>
            </table>
            <div class="ps-cart__actions">
              <div class="ps-cart__promotion">
              </div>
              <div class="ps-cart__total">
                <h3>Total Price: <span id="totalPrice"> </span></h3>
                <a href="checkout.php" class="ps-btn">Process to checkout<i class="ps-icon-next"></i></a>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="ps-subscribe">
        <div class="ps-container">
          <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ">
                  <h3><i class="fa fa-envelope"></i>Sign up to Newsletter</h3>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12 col-xs-12 ">
                  <form class="ps-subscribe__form" action="do_action" method="post">
                    <input class="form-control" type="text" placeholder="">
                    <button>WELCOME</button>
                  </form>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                  <p>...and receive  <span>$20</span>  coupon for first shopping.</p>
                </div>
          </div>
        </div>
      </div>
      <div class="ps-footer bg--cover" data-background="images/background/parallax.jpg"><div>
          <!-- <h3 class="ps-section__title" data-mask="Payment"> - Các Đối Tác Thanh Toán Trực Tuyến </h3> -->
                <style>
                .payment-method{float:left;width:100%}
                .payment-method ul{display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-align-items:center;-ms-flex-align:center;align-items:center;margin:0;padding:0;list-style:none;white-space:nowrap;overflow-x:auto}
                .payment-method li{background:#f0f4f7;float:left;padding:10px;border-radius:3px}
                .payment-method li:not(:last-child){margin-right:10px}
                .payment-method img{width:116px;height:55px}
                </style>
                    <div class="payment-method">
                        <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="4">
                          <ul>
                            <!-- <li><img alt='Agribank' height='55' loading='normal' src='https://www.phanmemninja.com/wp-content/uploads/2019/04/Agribank-logo.png' width='116'/></li> -->
                            <li><img alt='MBbank' height='55' loading='normal' src='https://upload.wikimedia.org/wikipedia/commons/2/25/Logo_MB_new.png' width='116'/></li>
                            <li><img alt='zalo pay' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/zalo_pay.png' width='116'/></li>
                            <li><img alt='visa' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/visa.png' width='116'/></li>
                            <li><img alt='master card' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/master_card.png' width='116'/></li>
                            <li><img alt='vietcombank' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/vietcom_bank.png' width='116'/></li>
                            <li><img alt='vietinbank' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/vietin_bank.png' width='116'/></li>
                            <li><img alt='bidvbank' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/bidv_bank.png' width='116'/></li>
                            <li><img alt='sacombank' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/sacom_bank.png' width='116'/></li>
                            <li><img alt='eximbank' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/exim_bank.png' width='116'/></li>
                            <li><img alt='scbbank' height='55' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/scb_bank.png' width='116'/></li>
                            <li><img alt='vietcapitalbank' loading='normal' src='https://cdn.jsdelivr.net/gh/thietkeblogspot/images/vietcapital_bank.png' width='116'/></li>
                          </ul>
                        </marquee>
                    </div>
          </div>
        <div class="ps-footer__content">
          <div class="ps-container">
            <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--info">
                      <header><a class="ps-logo" href="index.php"><img src="images/logo-white.png" alt=""></a>
                        <h3 class="ps-widget__title">Address Office 1</h3>
                      </header>
                      <footer>
                        <p><strong>334 Nguyễn Trãi, Thanh Xuân, Hà Nội</strong></p>
                        <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                        <p>Phone: +323 32434 5334</p>
                        <p>Fax: ++323 32434 5333</p>
                      </footer>
                    </aside>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--info second">
                      <header>
                        <h3 class="ps-widget__title">Address Office 2</h3>
                      </header>
                      <footer>
                        <p><strong>144 Xuân Thủy, Cầu Giấy, Hà Nội</strong></p>
                        <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                        <p>Phone: +323 32434 5334</p>
                        <p>Fax: ++323 32434 5333</p>
                      </footer>
                    </aside>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                      <header>
                        <h3 class="ps-widget__title">Find Our store</h3>
                      </header>
                      <footer>
                        <ul class="ps-list--link">
                          <li><a href="#">Coupon Code</a></li>
                          <li><a href="#">SignUp For Email</a></li>
                          <li><a href="#">Site Feedback</a></li>
                          <li><a href="#">Careers</a></li>
                        </ul>
                      </footer>
                    </aside>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                      <header>
                        <h3 class="ps-widget__title">Get Help</h3>
                      </header>
                      <footer>
                        <ul class="ps-list--line">
                          <li><a href="#">Order Status</a></li>
                          <li><a href="#">Shipping and Delivery</a></li>
                          <li><a href="#">Returns</a></li>
                          <li><a href="#">Payment Options</a></li>
                          <li><a href="#">Contact Us</a></li>
                        </ul>
                      </footer>
                    </aside>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                      <header>
                        <h3 class="ps-widget__title">Products</h3>
                      </header>
                      <footer>
                        <ul class="ps-list--line">
                          <li><a href="#">Shoes</a></li>
                          <li><a href="#">Clothing</a></li>
                          <li><a href="#">Accessries</a></li>
                          <li><a href="#">Football Boots</a></li>
                        </ul>
                      </footer>
                    </aside>
                  </div>
            </div>
          </div>
        </div>
        <div class="ps-footer__copyright">
          <div class="ps-container">
            <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <p>&copy; <a href="#">HUSTHEMES</a>, Inc. All rights Resevered. Design by <a href="#"> TV2H_team</a></p>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <ul class="ps-social">
                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  
    <!-- JS Library-->
    <script type="text/javascript" src="plugins/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script type="text/javascript" src="plugins/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="plugins/gmap3.min.js"></script>
    <script type="text/javascript" src="plugins/imagesloaded.pkgd.js"></script>
    <script type="text/javascript" src="plugins/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="plugins/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="plugins/slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="plugins/elevatezoom/jquery.elevatezoom.js"></script>
    <script type="text/javascript" src="plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script><script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <!-- Custom scripts-->
    <script type="text/javascript" src="js/main.js"></script>




  </body>
</html>