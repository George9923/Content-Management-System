<?php  include "includes/db.php";
include "includes/header.php";
include "functionsCMS.php";?>

<?php 

if(isset($_POST['submit'])){
    $to = "george.prepelita@tremend.com";
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    if(empty($subject) || empty($body)){
        echo "Subject and body are required.";
    } else {
        $headers = "From: george.prepelita@tremend.com";
    }

    if(mail($to, $subject, $body, $headers)){
        echo "Email sent successfully.";
    } else {
        echo "Email sending failed.";
    }
}

?>
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>


                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>

                        
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="subject" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="body" id="body" cols="50" rows="10" placeholder="Enter your problem"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">

                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

<?php include "includes/footer.php";?>
