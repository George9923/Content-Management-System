<?php include "includesAdmin/headerAdmin.php";?>

<div id="wrapper">


<?php include "includesAdmin/NavigationAdmin.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to admin <?php echo strtoupper( getUserName());?>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    

                    <div class='huge'><?php echo $post_counts = recordCount($connection, 'posts');?></div>



                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">        
                   
                    <div class='huge'><?php echo $comments_count = recordCount($connection, 'comments');?></div>

                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <div class='huge'><?php echo $users_count = recordCount($connection, 'users');?></div>

                  <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <div class='huge'><?php echo $categories_count = recordCount($connection, 'categories');?></div>
  
                        <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
    <!-- /.row -->


    <?php 

        $post_published_counts = checkStatus($connection, 'posts', 'post_status', 'published');
        $post_draft_counts = checkStatus($connection, 'posts', 'post_status', 'draft');
        $commets_rejected_counts = checkStatus($connection, 'comments', 'comment_status', 'rejected');
        $subscriber_count = checkUserRole($connection, 'users', 'user_role', 'subscriber')

    ?>




    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

          <?php 
          
          $element_text = [
            'All Post', 
            'Active Post',
            'Draft Posts', 
            'Comments',
            'Pending Commets', 
            'Users', 
            'Subscribers',
            'Categories'
        ];

          $element_count = [
            $post_counts, 
            $post_published_counts,
            $post_draft_counts,
            $comments_count, 
            $commets_rejected_counts,
            $users_count, 
            $subscriber_count,
            $categories_count
        ];

          for($i = 0; $i < 8; $i++){

            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

          }
          
          ?>

        //   ['Posts', 1000,],

        ]);

        var options = {
          chart: {
            title: ' ',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


    <div class="row"></div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>


<?php include "includesAdmin/footerAdmin.php";?>
