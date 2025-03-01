<?php
  require_once("formCart2.php");
  require_once("backend/auth.php");
  require_once("backend/authWithCookie.php");
  require_once("repository/shoeRepository.php");
  require_once("repository/cartRepository.php");
  
  $cartRepository = new CartRepository();
  $shoeRepository = new ShoeRepository();
  $infoUser = Auth::loginWithCookie();

  $shoe = $shoeRepository->getById($_GET['id'])->fetch_assoc();
  $listShoe = $shoeRepository->getAll(12);
  $arrLinkImage = $shoeRepository->getImage($_GET['id']);

  

  if(isset($_POST['submit_cart'])){
    $user_id = Auth::loginWithCookie()['id'];
    
    if($cartRepository->findByUserIdAndShoeIdAndStatus($user_id, $_GET['id'], 1)->num_rows == 0) {
        // Thêm sản phẩm vào giỏ hàng
        $cartRepository->insert($user_id, $_GET['id'], $_POST['choose_color'], $_POST['choose_size'], 1);

        // Hiển thị thông báo đặt hàng thành công
        // echo "Đặt hàng thành công!";

        // Xóa id sau khi đặt hàng thành công
        // unset($_GET['id']);

        // Điều hướng người dùng đến trang cần thiết (ví dụ: trang giỏ hàng)
        // Có thể chuyển hướng bằng cách sử dụng header hoặc JavaScript
        header("Location: cart.php");
        // hoặc
        // echo '<script>window.location = "cart.php";</script>';
    } else {
        // Nếu sản phẩm đã tồn tại trong giỏ hàng, bạn có thể hiển thị một thông báo khác
        echo "<script>alert('Trong Giỏ Hàng đã có sản phẩm này !!!');
                                window.location.href='cart.php';
                                </script>";
     }
  }
//   if (isset($_POST['send_rev'])) {
//     $name = $_POST['name_rev'];
//     $email = $_POST['email_rev'];
//     $rating = $_POST['rating_rev'];
//     $review = $_POST['content_rev'];
//     $shoe_id = $_POST['shoe_id'];
//     $avatar= $_POST['avatar_rev'];


//     // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng
//     $sql = "INSERT INTO reviews (name, email, rating, review,shoe_id) VALUES ('$name', '$email', '$rating', '$review','$shoe_id','$avatar')";

//     if ($conn->query($sql) === TRUE) {
//         echo "<script>alert('Cảm ơn bạn đã đánh giá cho sản phẩm   !');</script>";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }   
if (isset($_POST['send_rev'])) {
  $name = $_POST['name_rev'];
  $email = $_POST['email_rev'];
  $rating = $_POST['rating_rev'];
  $review = $_POST['content_rev'];
  $shoe_id = $_POST['shoe_id'];

  // Xử lý tệp tin đã tải lên
  $avatar_dir = "uploads/"; // Thư mục lưu trữ ảnh đại diện
  $avatar_path = $avatar_dir . basename($_FILES["avatar_rev"]["name"]);

  if (move_uploaded_file($_FILES["avatar_rev"]["tmp_name"], $avatar_path)) {
      echo "";
  } else {
      echo "";
  }

  // Lưu đường dẫn ảnh đại diện vào biến để thêm vào cơ sở dữ liệu
  $avatar_url = $avatar_path;

  // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bản
  $sql = "INSERT INTO reviews (name, email, rating, review, shoe_id, avatar) VALUES ('$name', '$email', '$rating', '$review', '$shoe_id', '$avatar_url')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Cảm ơn bạn đã đánh giá cho sản phẩm: " . $shoe['shoe_name'] . "');</script>"; // \\n: ngắt dòng
      
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

    
// Đóng kết nối


?>
<!DOCTYPE html>
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
    <title>HUS - Product Detail</title>
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
   
  <style>
    #imageShoeMini{
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
    #shoeImageZoom{
      width: 620px;
      height: 620px;
      object-fit: cover;
    }
    #imageShoe2{
        max-width: 100%;
        max-height: 310px;
        min-height: 310px;
        object-fit: cover;
    }
  </style>
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
                  <li class="menu-item menu-item-has-children has-mega-menu"><a href="#">Men</a>
                    
                  </li>
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
            <div class="ps-cart"><a class="ps-cart__toggle" href="cart.php"><span><i><?php  echo $cartList->num_rows ?></i></span><i class="ps-icon-shopping-cart"></i></a>
           
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
      <div class="test">
        <div class="container">
          <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                </div>
          </div>
        </div>
      </div>
      <div class="ps-product--detail pt-60">
        <div class="ps-container">
          <div class="row">
            <div class="col-lg-10 col-md-12 col-lg-offset-1">
              <div class="ps-product__thumbnail">
                <div class="ps-product__preview">
                  <div class="ps-product__variants">
                       <?php
                          foreach($arrLinkImage as $linkImage){
                        ?>
                          <div class="item"><img id="imageShoeMini" src="<?php echo $linkImage['link_image'] ?>" alt=""></div>
                        <?php
                          }
                        ?>
                  </div>
                </div>
                <div class="ps-product__image">
                    <?php
                      foreach($arrLinkImage as $linkImage){
                    ?>
                      <div class="item"><img id="shoeImageZoom" class="zoom" src="<?php echo $linkImage['link_image'] ?>" alt="" data-zoom-image="<?php echo $linkImage['link_image'] ?>"></div>
                    <?php
                      }
                    ?>
                </div>
              </div>
              <div class="ps-product__thumbnail--mobile">
                <div class="ps-product__main-img"><img src="images/shoe-detail/1.jpg" alt=""></div>
                <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="images/shoe-detail/1.jpg" alt=""><img src="images/shoe-detail/2.jpg" alt=""><img src="images/shoe-detail/3.jpg" alt=""></div>
              </div>
              <div class="ps-product__info">
                <div class="ps-product__rating">
  <div class="ps-product__rating">
  <select class="ps-rating" id="userRating">
    <option value="1">1 Star</option>
    <option value="2">2 Stars</option>
    <option value="3">3 Stars</option>
    <option value="4">4 Stars</option>
    <option value="1">5 Stars</option>
  </select>
  <span id="averageRating">(<span id="displayAverage">Đánh Giá</span>)</span>
   <a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">(Đã có 
      <?php $shoe_id = $shoe['shoe_id'];
      $sql = "SELECT * FROM reviews WHERE shoe_id = $shoe_id ORDER BY created_at DESC"; 
      $result = $conn->query($sql);  echo $result->num_rows 
      ?> 
      lượt đánh giá)
   </a>
  

</div>

<script>
  // JavaScript code for handling star rating
  document.addEventListener("DOMContentLoaded", function() {
    // Sample reviews data
    const reviews = [
      { rating: 4 },
      { rating: 5 },
    ];

    document.getElementById("userRating").addEventListener("change", function() {
      const userRating = document.getElementById("userRating").value;

      // Add the user's rating to the reviews array
      reviews.push({ rating: parseInt(userRating) });

      const totalRating = reviews.reduce((sum, review) => sum + review.rating, 0);
      const averageRating = totalRating / reviews.length;
      document.getElementById("displayAverage").textContent = averageRating.toFixed(1);
    });

    document.getElementById("readReviews").addEventListener("click", function(event) {
      event.preventDefault();

      for (const review of reviews) {
        console.log(`Rating: ${review.rating}`);
      }
    });
  });
</script>


                <h1><?php echo $shoe['shoe_name'] ?></h1>
                <p class="ps-product__category"><a href="#"><?php echo $shoe['name'] ?></a></p>
                <h3 class="ps-product__price">
                  <?php 
                    echo ($shoe['price'] - $shoe['price']*$shoe['sale']*0.01);
                  ?> VND<del><br><?php echo $shoe['price'] ?> VND</del></h3>
                <div class="ps-product__block ps-product__quickview">
                  <h4>QUICK REVIEW</h4>
                  <p><?php echo substr($shoe['review'],0,10); ?></p>
                </div>
                <form action="" method="POST">
                <div class="ps-product__block ps-product__size">
                  
                  <h4>CHOOSE YOUR COLOR</h4>
                  <select name="choose_color" class="ps-select selectpicker">
                  <?php
                      $arrColor = explode(",",$shoe['color']);
                      foreach($arrColor as $color){
                  ?>
                    <option value="<?php echo $color; ?>"><?php echo $color; ?></option>
                  <?php
                      }
                  ?>
                  </select>
                </div>
                <div class="ps-product__block ps-product__size">
                  <h4>CHOOSE SIZE</h4>
                  <select name="choose_size" class="ps-select selectpicker">
                  <?php
                      $arrSize = explode(",",$shoe['size']);
                      foreach($arrSize as $size){
                  ?>
                    <option value="<?php echo $size; ?>"><?php echo $size; ?></option>
                  <?php
                      }
                  ?>
                  </select>
                </div>
                <div class="ps-product__shopping">
                <!-- <a class="ps-btn mb-10" href="cart.php?id=">Add to cart<i class="ps-icon-next"></i></a> --> 
                <button name="submit_cart" class="ps-btn mb-10">Add to cart<i class="ps-icon-next"></i></button>
                  <div class="ps-product__actions"><a class="mr-10" href="whishlist.php"><i class="ps-icon-heart"></i></a><a href="compare.php"><i class="ps-icon-share"></i></a></div>
                </div>
                </form>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="ps-product__content mt-50">
                <ul class="tab-list" role="tablist">
                  <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Overview</a></li>
                  <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a></li>
                </ul>
              </div>
              <!-- </div> -->
              <div class="tab-content mb-60">
                <div class="tab-pane active" role="tabpanel" id="tab_01">
                  <p><?php echo $shoe['review']; ?></p>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab_02">
                  <p style="font-size:20px" class="mb-20"><span style="font-size:18px !important;">Đánh Giá Về Sản Phẩm </span><strong><?php echo $shoe['shoe_name'] ?><sapn> :</sapn></strong></p>
                  
                  
                  <div class="ps-review">
                    <!-- <div class="ps-review__thumbnail"><?php echo '<img src="' . $checkCookie['img'] . '" alt="" style=" height: 77px; border-radius: 50%;">';?> </div> -->
                    <!-- <img src="images/user/1.jpg" alt=""></div> -->
                    <!-- <div class="ps-review__content">
                      <header>
                        <select class="ps-rating">
                          <option value="1">1</option>
                          <option value="1">2</option>
                          <option value="1">3</option>
                          <option value="1">4</option>
                          <option value="5">5</option>
                        </select>
                        <p>By<a href=""> TV2H_team</a> - November 25, 2017</p>
                      </header>
                      <p>Soufflé danish gummi bears tart. Pie wafer icing. Gummies jelly beans powder. Chocolate bar pudding macaroon candy canes chocolate apple pie chocolate cake. Sweet caramels sesame snaps halvah bear claw wafer. Sweet roll soufflé muffin topping muffin brownie. Tart bear claw cake tiramisu chocolate bar gummies dragée lemon drops brownie.</p>
                    </div> -->
                    <?php
                    $shoe_id = $shoe['shoe_id'];
                    $sql = "SELECT * FROM reviews WHERE shoe_id = $shoe_id ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    // Kiểm tra xem có dữ liệu hay không
                    if ($result->num_rows > 0) {
                        // Lặp qua các dòng dữ liệu
                        while ($row = $result->fetch_assoc()) {
                            // Hiển thị thông tin đánh giá trong mã HTML
                            echo '<div class="ps-review">';
                            // Kiểm tra xem avatar có tồn tại không
                          
                            if (isset($row['avatar']) && file_exists($row['avatar']) && $row['avatar'] !== 'uploads/') {
                              echo '<div class="ps-review__thumbnail"><img src="' . $row['avatar'] . '" alt="" style="height: 77px; border-radius: 50%;"></div>';
                            } else {
                                // Nếu không có ảnh hoặc giá trị là "uploads/", hiển thị ảnh mặc định từ $checkCookie['img']
                                echo '<div class="ps-review__thumbnail"><img src="' . $checkCookie['img'] . '" alt="Default Avatar" style="height: 77px; border-radius: 50%;"></div>';
                            }
                            echo '<div class="ps-review__content">';
                            echo '<header>';
                            echo '<select class="ps-rating">';
                            for ($i = 1; $i <= 5; $i++) {
                                // Đánh dấu ô rating có điểm tương ứng với đánh giá từ cơ sở dữ liệu
                                $selected = ($i == $row['rating']) ? 'selected' : '';
                                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                            }
                            echo '</select>';
                            echo '<p>By <a href="">' . $row['name'] . '</a> | '.'<span>' . $row['created_at'] .'</span>'. '</p>';
                            echo '</header>';
                            echo '<p style="color:black; font-weight: 500;">' . $row['review'] . '</p>';
                            // echo  $row['avatar'] ;
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "Không có đánh giá nào cho sản phẩm này.";
                    }
                    ?>

                    
                  </div>
                  <form class="ps-product__review" action="" method="post" enctype="multipart/form-data">
                    <hr>
                    <h3>ADD YOUR REVIEW</h3>
                    <p></p>
                    <div class="row">
                        

                        <input style="display:none" readonly name="shoe_id" class="form-control" type="text" value="<?php echo $shoe['shoe_id']; ?>" required>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <div class="form-group">
                              <label>Name<span style="color:red">*</span> :</label>
                              <input value="<?php echo $infoUser['fullname'] ?>" name="name_rev" class="form-control" type="text" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label>Email<span style="color:red">*</span> :</label>
                              <input value="<?php echo $infoUser['email'] ?>" name="email_rev" class="form-control" type="email" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label>Your rating<span style="color:red">*</span> :</label>
                              <select class="ps-rating" name="rating_rev">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <div class="form-group">
                              <label>Your Review<span style="color:red">*</span> :</label>
                              <textarea name="content_rev" class="form-control" rows="6" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Avatar review:</label>
                                <input type="file" name="avatar_rev" accept="image/*">
                            </div>
                            <div class="form-group">
                              <button  name="send_rev" class="ps-btn ps-btn--sm">Submit<i class="ps-icon-next"></i></button>
                            </div>
                          </div>
                    </div>
                    

                   
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
        <div class="ps-container">
          <div class="ps-section__header mb-50">
            <div class="row">
                  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                    <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                    <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
                  </div>
            </div>
          </div>
          <div class="ps-section__content">
          <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
              <?php 
                foreach($listShoe as $shoe){
                  if($shoe['sale']>0){
              ?>
              <div class="ps-shoes--carousel">
                <div class="ps-shoe">
                  <div class="ps-shoe__thumbnail">
                    <div class="ps-badge"><span>New</span></div>
                    <?php
                        echo '<div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-'.$shoe['sale'].' %</span></div>';
                    ?>
                    <a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
                    <?php
                          $arrLinkImage = $shoeRepository->getImage($shoe['shoe_id']);
                          if($arrLinkImage->num_rows > 0){
                            echo '<img id="imageShoe2" src="'.$arrLinkImage->fetch_assoc()['link_image'].'" alt="">';
                          }
                          else{
                            echo '<img src="images/shoe/1.jpg" alt="">';
                          }
                        ?>
                    <a class="ps-shoe__overlay" href="product-detail.php?id=<?php echo $shoe['shoe_id'] ?>"></a>
                  </div>
                  <div class="ps-shoe__content">
                    <div class="ps-shoe__variants">
                      <div class="ps-shoe__variant normal">
                          <?php
                            foreach($arrLinkImage as $linkImage){
                          ?>
                              <img id="imageShoeMini" src="<?php echo $linkImage['link_image'] ?>" alt="">
                          <?php
                            }
                          ?>
                      </div>
                      <select class="ps-rating ps-shoe__rating">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="2">5</option>
                      </select>
                    </div>
                    <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.php"><?php echo $shoe['shoe_name'] ?></a>
                      <p class="ps-shoe__categories"><a href="#"><?php echo $shoe['name'] ?></a></p><span class="ps-shoe__price">
                        <del><?php echo $shoe['price']?> VND</del>
                        <?php 
                          echo ($shoe['price'] - $shoe['price']*$shoe['sale']*0.01)." VND";
                        ?></span>
                    </div>
                  </div>
                </div>
              </div>
                <?php 
                  }
                  }
                ?>
            </div>
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