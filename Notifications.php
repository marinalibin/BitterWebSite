<?php
include("connect.php");
include('User.php');
include ("Tweet.php");
?>
<?php
//this is the main page for our Bitter website, 
//it will display all tweets from those we are trolling
//as well as recommend people we should be trolling.
//you can also post a tweet from here
session_start();
if (isset($_GET["message"])) {
    $message = $_GET["message"];
    echo "<script>alert('$message')</script>";
}

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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="DESC MISSING">
        <meta name="author" content="Nick Taggart, nick.taggart@nbcc.ca">
        <link rel="icon" href="favicon.ico">




        <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

        <!-- Bootstrap core CSS -->
        <link href="includes/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="includes/starter-template.css" rel="stylesheet">
        <!-- Bootstrap core JavaScript-->
        <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            //just a little jquery to make the textbox appear/disappear like the real Twitter website does
            $(document).ready(function () {
                //hide the submit button on page load
                $("#button").hide();
                $("#tweet_form").submit(function () {

                    $("#button").hide();
                });
                $("#myTweet").click(function () {
                    this.attributes["rows"].nodeValue = 5;
                    $("#button").show();

                });//end of click event
                $("#myTweet").blur(function () {
                    this.attributes["rows"].nodeValue = 1;
                    //$("#button").hide();

                });//end of click event
            });//end of ready event handler

        </script>
    </head>

    <body>



        <!---->
        <?php
        $userPic = "";
        $u = new User();
        include("Includes/Header.php")
        ?>
        <BR><BR>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="mainprofile img-rounded">
                        <div class="bold">
                            <?php
                            if (!isset($_SESSION["SESS_MEMBER_PIC"])) {
                                echo "<img class='bannericons' src='images/profilepics/default.jfif'>";
                            } else {
                                $userPic = $_SESSION["SESS_MEMBER_PIC"];
                                echo "<img class='bannericons' src='" . $userPic . "'>";
                            }
                            ?>                              
                            <a href="userpage.php">
                                <?php
                                $user = new Tweet();
                                $user->DisplayTweet();
                                ?></a><BR></div>
                        <table>
                            <tr><td>
                                    tweets</td><td>following</td><td>followers</td></tr>
                            <tr><td><?php
                                    $getTweets = new Tweet();

                                    $getTweets->GetCountOfTweets($_SESSION['SESS_MEMBER_ID']);
                                    ?>
                                </td>
                                <td><?php
                                    $getTweets->GetCountOfFollowing($_SESSION['SESS_MEMBER_ID']);
                                    ?>
                                </td>
                                <td>   <?php
                                    $getTweets->GetCountOfFollowers($_SESSION['SESS_MEMBER_ID']);
                                    ?></td>
                            </tr></table>
                        <img class="icon" src="images/location_icon.jpg">
                        <?php
                        $user = new User();
                        $user->province;
                        $user->SelectProvince($_SESSION['SESS_MEMBER_ID']);
                        ?>
                        <div class="bold">Member Since:</div>
                        <div>
                            <?php
                            $user->dateAdded;
                            $user->GetProfileDate($_SESSION['SESS_MEMBER_ID']);
                            ?>
                        </div>
                        <BR><BR>

                        <BR><BR>


                    </div><BR><BR>
                    <div class="trending img-rounded">
                        <div class="bold">Trending</div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="img-rounded">
                    <?php 
                    date_default_timezone_set('America/Halifax');
                        User::GetLikes($_SESSION['SESS_MEMBER_ID']);
                        User::GetLikesForRetweets($_SESSION['SESS_MEMBER_ID']);
                        User::GetReplies($_SESSION['SESS_MEMBER_ID']);
                    
                    ?>
              
                    </div>

                    <div class="img-rounded">
                        <!--display list of tweets here-->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="whoToTroll img-rounded">
                        <div class="bold">Who to Troll?<BR></div>
                            <?php
//$u->profImg = $_SESSION["SESS_MEMBER_PIC"];
                            $u->profImg = $_SESSION["SESS_MEMBER_PIC"];
                            $u->userId = $_SESSION["SESS_MEMBER_ID"];
                            $u->FollowUser();
                            ?>                                

                        <!-- display people you may know here-->


                    </div><BR>
                    <!--don't need this div for now 
                    <div class="trending img-rounded">
                    © 2018 Bitter
                    </div>-->
                </div>
            </div> <!-- end row -->
        </div><!-- /.container -->



        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
        <script src="includes/bootstrap.min.js"></script>
        <footer>
            <?php include("ContactUs.php");
            ?>
        </footer>  

    </body>
</html>
