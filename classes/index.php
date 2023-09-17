<?php include "includesAdmin/headerAdmin.php";?>

<?php 
$post_counts=count_records(getUserPost()); 
$comments_count = count_records(get_all_posts_user_comments());
$categories_count = count_records(get_all_user_categories());
$post_published_counts = count_records(get_all_user_published_posts());
$post_draft_counts = count_records(get_all_user_draft_posts());

$commets_rejected_counts = count_records(get_all_user_rejected_comments());
$comments_approved_count = count_records(get_all_user_approved_comments());
?>


<div id="wrapper">


<?php include "includesAdmin/NavigationAdmin.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to your data <?php echo strtoupper( getUserName());?>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php echo "<div class='huge'>". $post_counts ."</div>"?>

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
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">      
                        
                    <?php 
                   
                        echo "<div class='huge'>{$comments_count}</div>"

                    ?>
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

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php echo "<div class='huge'>{$categories_count}</div>" ?>
  
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
            'Approved Comments',
            'Pending Commets', 
            'Categories'
        ];

          $element_count = [
            $post_counts, 
            $post_published_counts,
            $post_draft_counts,
            $comments_count,
            $comments_approved_count, 
            $commets_rejected_counts,
            $categories_count
        ];

          for($i = 0; $i < 7; $i++){

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
