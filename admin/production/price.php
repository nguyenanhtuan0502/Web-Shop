<?php
    require_once("../../backend/filterAdmin.php");
    require_once("../../repository/orderRepository.php");

    $orderRepository = new OrderRepository();

    $orderList = $orderRepository->getAll();
    include("../../connect.php");
    $sql = "SELECT * FROM contacts LIMIT 5"; 
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>ADMIN Controler | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link href="css/shoe.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../../index.php" class="site_title"><i class="fa fa-home" aria-hidden="true"></i> <span>HOME</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Welcome,</span>
                <h2> <?php require_once("../../backend/filterWithCookieAdmin.php") ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>HUS STORE - ADMIN</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-paw"></i> Quản Lý <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="shoe.php">Quản Lý Sản Phẩm</a></li>
                      <li><a href="order.php">Quản Lý Đơn Hàng</a></li>
                      <li><a href="user.php">Quản Lý User</a></li>
                    </ul>
                  </li>
                
                  <li><a><i class="fa fa-money"></i>Sản Phẩm Bán Chạy<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="banchay.php">Biểu đồ bán chạy</a></li>
                    <li><a href="Khovoucher.php">Thêm Voucher</a></li>
                     
                    </ul>
                  </li>

                  <li><a><i class="fa fa-line-chart"></i> Biểu Đồ Doanh Thu<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="truycap.php">Lượt truy cập</a></li>
                      <li><a href="price.php">Doanh Thu</a></li>
                      <li><a href="price_month.php">Theo Tháng</a></li>
                     
                     
                    </ul>
                  </li>

                </ul>
                
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <?php require_once("../../backend/filterWithCookieAdmin.php") ?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Profile</a>
                      <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                  <a class="dropdown-item"  href="javascript:;">Help</a>
                    <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">
                            <?php
                            if ($result->num_rows > 0) {
                                echo $result->num_rows.'+'; // Hiển thị tổng số hàng
                            } else {
                                echo '0';
                            }
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span> 
                                        <span>
                                            <span><?php echo $row['NAME']; ?></span>
                                            <span class="time"><?php echo date('H:i', strtotime($row['created_at'])); ?></span>
                                        </span>
                                        <span class="message">
                                            <?php echo $row['message']; ?>
                                        </span>
                                    </a>
                                </li>
                        <?php
                            }
                        } else {
                            echo '<li class="nav-item"><a class="dropdown-item">No messages</a></li>';
                        }
                        ?>
                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item" href="see_all_alerts.php"> <!-- Điều hướng đến trang hiển thị tất cả các thông báo -->
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                   </a>
                                </div>
                              </li>
                          </ul>
                     </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- Thư viện Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="right_col" role="main">
    <!-- Table for the bar chart -->
    <div style="width: 48%;">
        <table id="tableShoe">
            
            <?php
            $i = 1;
            $revenueData = array(); // Initialize an array to store revenue data

            foreach ($orderList as $order) {
                if ($order['status'] == 3) { // Only calculate for approved orders
                    $date = $order['date'];
                    $revenue = $order['price'] - $order['price'] * $order['sale'] * 0.01;

                    // Check if the date is already processed
                    $existingIndex = array_search($date, array_column($revenueData, 'date'));

                    if ($existingIndex !== false) {
                        // If date exists, aggregate the revenue
                        $revenueData[$existingIndex]['revenue'] += $revenue;
                    } else {
                        // If date doesn't exist, add a new entry
                        $revenueData[] = array(
                            'date' => $date,
                            'revenue' => $revenue
                        );

                        // Display the table row
                        ?>
                        
                        <?php
                    }
                }
            }
            
            // Encode revenue data as JSON for use in JavaScript
            $revenueDataJson = json_encode($revenueData);
            ?>
        </table>
    </div>

    <!-- Canvas for the bar chart -->
    <div class="row">
    <div style="width: 48%;">
        <canvas id="revenueBarChart" width="400" height="200"></canvas>
    </div>
            
    <!-- Canvas for the pie chart -->
    <div style="width: 30%;margin-left: 200px;">
    <div class="col-md-12 col-sm-12">
        <canvas id="revenuePieChart" width="400" height="200"></canvas>
    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        var revenueData = <?php echo $revenueDataJson; ?>;

        // Extract labels and values for the bar chart
        var barLabels = revenueData.map(function (item) {
            return item.date;
        });

        var barValues = revenueData.map(function (item) {
            return item.revenue;
        });

        var ctxBar = document.getElementById('revenueBarChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar', // Use 'bar' for a bar chart
            data: {
                labels: barLabels,
                datasets: [{
                    label: 'Doanh Thu',
                    data: barValues,
                    backgroundColor: 'gray', // Adjust the color here
                    borderColor: 'rgba(75, 192, 192, 1)', // Adjust the color here
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: function (value, context) {
                            return value + ' VND';
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Extract labels and values for the pie chart
        var pieLabels = barLabels;
        var pieValues = barValues;

        var ctxPie = document.getElementById('revenuePieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie', // Use 'pie' for a pie chart
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieValues,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ]
                }]
            }
        });
    </script>
</div>             
        </table>
        </div>
        
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- HUScons -->
    <script src="../vendors/HUScons/HUScons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
