<?php
session_start();
include("connect.php");
include ("User.php");
include ("Tweet.php");
include("Includes/header.php");
//displays all the details for a particular Bitter user

include("Includes/header.php");
if (isset($_GET["message"])) {
    $message = $_GET["message"];
    echo "<script>alert('$message')</script>";
}
$id = $_GET['userid'];
if (isset($_SESSION['SESS_MEMBER_ID'])) {
    $userid = $_SESSION['SESS_MEMBER_ID'];
    // header("location:index.php");
} else {
    header("location:Login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no
              <meta name="author" content="">
              <link rel="icon" href="favicon.ico">

        <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

        <!-- Bootstrap core CSS -->
        <link href="includes/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="includes/starter-template.css" rel="stylesheet">
        <!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>


    </head>

    <body>

        <?php include("Includes/header.php"); ?>

        <BR><BR>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="mainprofile img-rounded">
                        <div class="bold">
                            <?php
                            $u = new User();
                            $u->GetImage($id);
                            ?>
                            <?php
                            $user1 = new User();
                            $user1->GetProfilName($id);
                            ?><BR></div>
                        <table>
                            <tr><td>
                                    tweets</td><td>following</td><td>followers</td></tr>
                            <tr><td><?php
                            $getTweets = new Tweet();

                            $getTweets->GetCountOfTweets($id);
                            ?></td>
                                <td><?php
                                    $getTweets->GetCountOfFollowing($id);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $getTweets->GetCountOfFollowers($id);
                                    ?>
                                </td>
                            </tr></table>
                        <img class="icon" src="images/location_icon.jpg">
                                    <?php
                                    $user = new User();
                                    $user->province;
                                    $user->SelectProvince($id);
                                    ?>
                        <div class="bold">Member Since:</div>
                        <div>
                        <?php
                        $user->dateAdded;
                        $user->GetProfileDate($id);
                        ?>
                        </div>
                    </div><BR><BR>

                    <div class="trending img-rounded">
                        <div class="bold">
                            <?php
                            //$user->userId = $_SESSION['SESS_MEMBER_ID'];
                          $user->GetCountFollowers($id,$_SESSION['SESS_MEMBER_ID']);
                            ?>
                            &nbsp;Followers you know<BR>
<?php
// $follower = new Tweet();
$user->FollowersIKnow($id,$_SESSION['SESS_MEMBER_ID']);
?>

                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                            <?php
                            date_default_timezone_set('America/Halifax');
                            $t = new Tweet();
                            $t->DisplayTweetCurrentUser($id);
                            ?>
                    <div class="img-rounded">

                    </div>
                    <div class="img-rounded">

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="whoToTroll img-rounded">
                        <div class="bold">Who to Troll?<BR></div>

<?php
$u = new User();
$u->profImg = $_SESSION["SESS_MEMBER_PIC"];
$u->userId = $_SESSION["SESS_MEMBER_ID"];
$u->FollowUser();
?>
                    </div><BR>

                </div>
            </div> <!-- end row -->
        </div><!-- /.container -->



        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="includes/bootstrap.min.js"></script>
        <footer>
<?php include("ContactUs.php"); ?>
        </footer>  
    </body>
</html>
