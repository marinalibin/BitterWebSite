<?php

// include("connect.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author monal
 */
include_once('includes/Fedex/fedex-common.php');

class User {

    private $userId;
    private $password;
    private $lastname;
    private $firstName;
    private $userName;
    private $province;
    private $contactNo;
    private $dateAdded;
    private $location;
    private $url;
    private $address;
    private $postalCode;
    private $email;
    private $profImage;
    private $description;
    private $from_id;
    private $to_id;

    public function __get($property) {
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function __construct() {
        
    }

    public function getUserName($username) {
        global $con;
        $sql_username = "Select * from users  WHERE screen_name= '$username'";
        $result = mysqli_query($con, $sql_username);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserPassword($username, $password) {
        global $con;
        $sql_username = "Select * from users  WHERE screen_name= '$username'";
        $result = mysqli_query($con, $sql_username);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0) {
            $this->userName = $row["screen_name"];
            if (password_verify($password, $row["password"])) {
                $this->lastname = $row["last_name"];
                $this->firstName = $row["first_name"];
                $this->userId = $row["user_id"];
                $this->profImage = $row["profile_pic"];
                return true;
            } else {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function insert() {
        global $con;
        $sql = "Insert into users (first_name,last_name,screen_name ,password,address,province,postal_code ,
                                 contact_number,email,url,description,location)
            values('$this->firstName','$this->lastname','$this->userName','$this->password','$this->address','$this->province','$this->postalCode','$this->contactNo','$this->email','$this->url','$this->description','$this->location')";
        mysqli_query($con, $sql);
        if (mysqli_affected_rows($con) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function follow() {
        global $con;
        $sql = "INSERT into follows (from_id,to_id )VALUES('$this->from_id'  ,'$this->to_id')";
        mysqli_query($con, $sql);
        if (mysqli_affected_rows($con) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function ValidateIMG() {
        global $con;
        if ($_FILES['pic']['size'] > (1024 * 1024)) {
            unlink($_FILES['pic']['tmp_name']); //delete the file
            return false;
        } else {

            if (move_uploaded_file($_FILES['pic']['tmp_name'], "Images/profilepics/" . $_FILES['pic']['name'])) {
                $picLocation = "images/profilepics/" . $_FILES['pic']['name'];
                $sql = "UPDATE users SET profile_pic='$picLocation' WHERE user_id = '$this->userId'";
                if (mysqli_query($con, $sql)) {
                    $this->profImage = $picLocation;
                    return true;
                } else {
                    return false;
                }
            } else {
                unlink($_FILES['pic']['tmp_name']);
                return false;
            }
        }
    }

    public function FollowUser() {
        global $con;
        $sql = "Select profile_pic,first_name, last_name,screen_name,user_id from users where user_id != '$this->userId' AND user_id "
                . "NOT IN (select to_id from follows where from_id = '$this->userId ') ORDER by RAND() LIMIT 3";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $this->profImage = $row['profile_pic'];
            if (isset($this->profImage)) {

                echo '<img class = "bannericons" src=' . $this->profImage . ' />';
            } else {
                echo '<img class = "bannericons" src="images/profilepics/default.jfif" />';
            }
            $this->userName = $row["screen_name"];
            $this->firstName = $row["first_name"];
            $this->lastname = $row["last_name"];
            $this->userId = $row['user_id'];
            $userId = $this->userId = $row['user_id'];

            $dispalyString = $this->userName . " " . $this->firstName . " " . $this->lastname;

            echo '
		 
		  
                  <a href="userpage.php?userid=' . $userId . '">@' . Substr($dispalyString, 0, 25) . '</a>
                   <br>
                 <a href="Follow_proc.php?user_id=' . $this->userId . '"><button type="submit"  class="followbutton">Follow</button></a>
                  
                   <hr >
                ';
        }
    }

    public function SelectProvince($id) {
        global $con;
        $sql = "select province from users where user_id= '$id'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $this->province = $row["province"];

            echo $this->province;
            return $this;
        }
    }

    public function GetProfileDate($id) {
        global $con;
        $sql = "select date_created from users where user_id= '$id'";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $this->dateAdded = $row["date_created"];
            $date = str_replace('/', '-', $this->dateAdded);
            $newDate = date("Y-m-d", strtotime($date));
            echo $newDate;
            return $this;
        }
    }

    public function GetProfilName($id) {
        global $con;
        $sql = "select first_name, last_name from users where user_id= '$id'";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $this->firstName = $row["first_name"];
            $this->lastname = $row["last_name"];

            echo $this->firstName . " " . $this->lastname;
            return $this;
        }
    }

    public function GetImage($id) {
        global $con;
        $sql = "select profile_pic from users where user_id= '$id'";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $this->profImage = $row["profile_pic"];
            if ($row["profile_pic"] != null) {
                echo "<img class='bannericons' src=" . $this->profImage . ">";
            } else {
                echo "<img class='bannericons' src='images/profilepics/default.jfif'>";
            }

        }
    }

    public function FollowersIKnow($id, $loggedId) {
        global $con;
        $sql = "select user_id, first_name, last_name, screen_name, profile_pic from users where user_id != $id and user_id != $loggedId "
                . "and user_id IN (SELECT to_id from follows where from_id=$id) "
                . "and user_id IN (SELECT to_id from follows where from_id=$loggedId) order by rand() limit 3";
       
        $result = mysqli_query($con, $sql);
        
        
        while ($row = mysqli_fetch_array($result)) {
            $this->profImage = $row['profile_pic'];
            if (isset($this->profImage)) {

                echo '<img class = "bannericons" src=' . $this->profImage . ' />';
            } else {
                echo '<img class = "bannericons" src="images/profilepics/default.jfif" />';
            }
            $this->userName = $row["screen_name"];
            $this->firstName = $row["first_name"];
            $this->lastname = $row["last_name"];
            $this->userId = $row['user_id'];


            $dispalyString = $this->userName . " " . $this->firstName . " " . $this->lastname;

            echo '
		 
		
                  <a href="userpage.php?userid=' . $row['user_id'] . '">@' . Substr($dispalyString, 0, 25) . '</a>
                   <br>
                
                  
                   <hr >
                ';
        }
    }

    public function GetCountFollowers($id,$loggedId) {
        global $con;
         $sql1 = "select * from users where user_id != $id and user_id != $loggedId "
                . "and user_id IN (SELECT to_id from follows where from_id=$id) "
                . "and user_id IN (SELECT to_id from follows where from_id=$loggedId)";
            mysqli_query($con, $sql1);
            $num_rows= mysqli_affected_rows($con);

       
            echo $num_rows;
       
    }

    public static function GetUsersFromSearch($text) {
        global $con;
        $sql = "select user_id, screen_name, last_name, first_name from users where lower(first_name) like (lower('%$text%')) or lower(last_name) like(lower('%$text%')) or lower(screen_name) like(lower('%$text%'))";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {

            $dispalyString = $row["screen_name"] . " " . $row["first_name"] . " " . $row["last_name"];
            echo '<BR><BR>';
            echo '<a href="userpage.php?userid=' . $row['user_id'] . '">@' . $dispalyString . '</a>&nbsp';

            User::GetWhoIFollow($row["user_id"], $_SESSION['SESS_MEMBER_ID']);
            User::GetWhoFollowsME($row["user_id"], $_SESSION['SESS_MEMBER_ID']);
        }
    }

    public static function GetWhoIFollow($userId, $loggedin) {
        global $con;
        $sql = "select * from users where $userId in(select to_id from follows where from_id = $loggedin)";
        $result = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_array($result)) {
                echo " " . "|Following";
            } else {
                echo " " . '<a href="Follow_proc.php?user_id=' . $userId . '"><button type="submit"  class="followbutton">Follow</button></a>';
            }
       
    }

    public function FollowUserOnUserPage($id) {
        global $con;
        $sql = "Select profile_pic,first_name, last_name,screen_name,user_id from users where user_id != '$id' AND user_id "
                . "NOT IN (select to_id from follows where from_id = '$id ') ORDER by RAND() LIMIT 3";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $this->profImage = $row['profile_pic'];
            if (isset($this->profImage)) {

                echo '<img class = "bannericons" src=' . $this->profImage . ' />';
            } else {
                echo '<img class = "bannericons" src="images/profilepics/default.jfif" />';
            }
            $this->userName = $row["screen_name"];
            $this->firstName = $row["first_name"];
            $this->lastname = $row["last_name"];
            $this->userId = $row['user_id'];
            $userId = $this->userId = $row['user_id'];

            $dispalyString = $this->userName . " " . $this->firstName . " " . $this->lastname;

            echo '
		 
		  
                  <a href="userpage.php?userid=' . $userId . '">@' . Substr($dispalyString, 0, 25) . '</a>
                   <br>
                 <a href="Follow_proc.php?user_id=' . $id . '"><button type="submit"  class="followbutton">Follow</button></a>
                  
                   <hr >
                ';
        }
    }
    


    public static function GetWhoFollowsME($userId, $loggedin) {
        global $con;
        $sql = "select * from users where $loggedin in(select to_id from follows where from_id = $userId)";
        $result = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_array($result)) {
            echo " " . "|Followed";
        } else {
            echo " " . "|Not Following ";
        }
    }

    public static function GetTweetsFromSearch($text) {
        global $con;
        $sql = "SELECT users.user_id,users.first_name, users.last_name, users.screen_name, tweets.tweet_text,tweets.tweet_id,tweets.reply_to_tweet_id, tweets.date_created,tweets.original_tweet_id FROM users INNER JOIN tweets ON users.user_id = tweets.user_id 
        WHERE lower(tweet_text) like (lower('%$text%'))ORDER BY date_created DESC LIMIT 10";

        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $now = new DateTime();
            $tweetTime = new DateTime($row['date_created']);
            $interval = $tweetTime->diff($now);
            $dispalyString = $row["screen_name"] . " " . $row["first_name"] . " " . $row["last_name"];
            echo '<BR><BR>';
            echo '<a href="userpage.php?userid=' . $row['user_id'] . '">@' . $dispalyString . '</a>&nbsp';
            if ($row['original_tweet_id'] != 0) {
                User::GetReTweetOnSearch($row['original_tweet_id']);
                echo "<strong>retweeted from" . " " . $row['first_name'] . $row['last_name'] . " " . "</strong>";
            }
            if ($interval->y > 1)
                echo $interval->format('%y years') . " ago" . '<BR>';
            elseif ($interval->y > 0)
                echo $interval->format('%y year') . " ago" . '<BR>';
            elseif ($interval->m > 1)
                echo $interval->format('%m months') . " ago" . '<BR>';
            elseif ($interval->m > 0)
                echo $interval->format('%m month') . " ago" . '<BR>';
            elseif ($interval->d > 1)
                echo $interval->format('%d days') . " ago" . '<BR>';
            elseif ($interval->d > 0)
                echo $interval->format('%d day') . " ago" . '<BR>';
            elseif ($interval->h > 1)
                echo $interval->format('%h hours') . " ago" . '<BR>';
            elseif ($interval->h > 0)
                echo $interval->format('%h hour') . " ago" . '<BR>';
            elseif ($interval->i > 1)
                echo $interval->format('%i minutes') . " ago" . '<BR>';
            elseif ($interval->i > 0)
                echo $interval->format('%i minute') . " ago" . '<BR>';
            elseif ($interval->s > 1)
                echo $interval->format('%s seconds') . " ago" . '<BR>';
            elseif ($interval->s > 0)
                echo $interval->format('%s second') . " ago" . '<BR>';
            echo '<BR>';
            echo $row['tweet_text'] . '<BR><BR>';

            echo '<img class = "bannericons" src="\Images\like.ico" />&nbsp';
            if($row['original_tweet_id']!=0){
                $tweetId=$row['original_tweet_id'];
            }
            else 
            {   
              
                $tweetId=$row["tweet_id"];
            }
            
          
            echo '<a href="Retweet.php?tweetid=' .$tweetId. '"><img class = "bannericons" src="\Images\retweet.png" /></a>';

            User::GetReplyIconOnSearch($row['reply_to_tweet_id'], $row['tweet_text']);
            echo '<hr >';
        }
    }

    public static function GetReTweetOnSearch($tweetId) {
        global $con;
        $sql = "select first_name, last_name, screen_name, tweet_text, tweets.date_created from tweets inner join users "
                . "on users.user_id = tweets.user_id where tweet_id=$tweetId";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {

        }
    }

    public static function GetReplyIconOnSearch($replytoid, $tweetText) {
       
        echo '
<a href="#" data-toggle="modal" data-target="#myModal' . $replytoid . '"><img class="bannericons"  src="Images/reply.png"></a>
<!-- The Modal -->
<div class="modal" id="myModal' . $replytoid . '">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      
      <div class="modal-body">
      <p>"' . $tweetText . '"</p>
        <form method="post" action="Reply.php">
            <textarea class="form-control" name="myReply" id="MyReply" rows="1" placeholder="Reply to Tweet" ></textarea>
            <input type="hidden" name="replyto" value = "' . $replytoid . '"></input>
            
            <input type="submit" name="button" id="replybutton" value="Reply" class="btn btn-primary btn-sm btn-block login-button"/>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>';
    }

    public static function ValidatePostalCode($postalCode) {

//Please include and reference in $path_to_wsdl variable.
        $path_to_wsdl = "includes/Fedex/wsdl/CountryService/CountryService_v5.wsdl";

        ini_set("soap.wsdl_cache_enabled", "0");

        $client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

        $request['WebAuthenticationDetail'] = array(
            'ParentCredential' => array(
                'Key' => getProperty('parentkey'),
                'Password' => getProperty('parentpassword')
            ),
            'UserCredential' => array(
                'Key' => getProperty('key'),
                'Password' => getProperty('password')
            )
        );

        $request['ClientDetail'] = array(
            'AccountNumber' => getProperty('shipaccount'),
            'MeterNumber' => getProperty('meter')
        );
        $request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Validate Postal Code Request using PHP ***');
        $request['Version'] = array(
            'ServiceId' => 'cnty',
            'Major' => '5',
            'Intermediate' => '0',
            'Minor' => '1'
        );

        $request['Address'] = array(
            'PostalCode' => $postalCode,
            'CountryCode' => 'CA'
        );

        $request['CarrierCode'] = 'FDXE';


        try {
            if (setEndpoint('changeEndpoint')) {
                // $newLocation = $client->__setLocation(setEndpoint('endpoint'));
            }

            $response = $client->validatePostal($request);

            if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
                // printSuccess($client, $response);

                return true;
            } else {
                return false;
            }

            //  writeToLog($client);    // Write to log file   
        } catch (Exception $exception) {
            // printFault($exception, $client);
            return false;
        }
    }
        
       public static function sendMessage($fromId,$toId,$message){
        global $con;
        $sql = "insert into messages (from_id, to_id, message_text) VALUES ($fromId,$toId,$message)";
        mysqli_query($con, $sql);
        if(mysqli_affected_rows($con)>0){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    public static function GetAllMessages(){
        global $con;
        $id=$_SESSION['SESS_MEMBER_ID'];
        $sql="Select users.user_id,users.screen_name,users.first_name, users.last_name, messages.message_text, messages.date_sent from users INNER JOIN messages"
                . " on users.user_id=messages.from_id where messages.to_id = $id";
        $result=mysqli_query($con, $sql);
        echo '<h3>Messages</h3>';
        while($row= mysqli_fetch_array($result)){
            echo '<a href="userpage.php?userid=' . $row['user_id'] . '">@' . $row['first_name']." " . $row['last_name']." " .$row['screen_name']. '</a><BR>';
            echo $row['message_text'];
            echo'<hr>';
            
        }
        
    }
    
    public static function GetUserScreenName($text){
        global $con;
        $id=$_SESSION['SESS_MEMBER_ID'];
        $sql = "select user_id,screen_name from users where (lower(first_name) like lower('%$text%') or lower(last_name) like lower('%$text%') or lower(screen_name) like lower('%$text%'))and user_id in(select to_id from follows where from_id=$id)";
        $result = mysqli_query($con, $sql);
        $users=array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($users,$row["screen_name"]);

        }
        echo json_encode($users);
    }
    
    //get to_id from messages table
    public static function GetToId($username){
        global $con;
        $sql = "SELECT user_id from users where screen_name = '$username' ";
        $result = mysqli_query($con, $sql);
        //echo $sql;
        if($row= mysqli_fetch_array($result)){
            return $row["user_id"];
        }
        
    }
    
    public static function InsertToMessages($fromId, $toId,$txt){
        global $con;
        $sql = "INSERT INTO messages(from_id,to_id,message_text,date_sent)
                VALUES($fromId,$toId,'$txt',CURRENT_TIMESTAMP)";
        mysqli_query($con, $sql);
       if (mysqli_affected_rows($con) == 1) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public static function GetLikes($id){
        global $con;
        $sql = "SELECT likes.user_id, likes.tweet_id, tweets.tweet_text, likes.date_created from likes inner join tweets on likes.tweet_id=tweets.tweet_id where tweets.user_id=$id ORDER BY likes.date_created DESC ";
        $result=mysqli_query($con, $sql);     
        echo "<h3>Liked Tweets</h3>";
        while($row= mysqli_fetch_array($result)){
            $now = new DateTime();
            $tweetTime = new DateTime($row['date_created']);
            $interval = $tweetTime->diff($now);
            User::GetName($row['user_id']);
         
            echo 'liked your tweet'." " ;
            if ($interval->y > 1)
                echo $interval->format('%y years') . " ago" . '<BR>';
            elseif ($interval->y > 0)
                echo $interval->format('%y year') . " ago" . '<BR>';
            elseif ($interval->m > 1)
                echo $interval->format('%m months') . " ago" . '<BR>';
            elseif ($interval->m > 0)
                echo $interval->format('%m month') . " ago" . '<BR>';
            elseif ($interval->d > 1)
                echo $interval->format('%d days') . " ago" . '<BR>';
            elseif ($interval->d > 0)
                echo $interval->format('%d day') . " ago" . '<BR>';
            elseif ($interval->h > 1)
                echo $interval->format('%h hours') . " ago" . '<BR>';
            elseif ($interval->h > 0)
                echo $interval->format('%h hour') . " ago" . '<BR>';
            elseif ($interval->i > 1)
                echo $interval->format('%i minutes') . " ago" . '<BR>';
            elseif ($interval->i > 0)
                echo $interval->format('%i minute') . " ago" . '<BR>';
            elseif ($interval->s > 1)
                echo $interval->format('%s seconds') . " ago" . '<BR>';
            elseif ($interval->s > 0)
                echo $interval->format('%s second') . " ago" . '<BR>';
            echo '<BR>';
            echo $row['tweet_text'] ;
            //print_r($row);
            
            echo'<hr>';
            
        }
        
    }
    
    public static function GetName($id){
        global $con;
        $sql = "SELECT user_id,first_name, last_name, profile_pic from users where user_id=$id";
        $result=mysqli_query($con, $sql);
        while($row= mysqli_fetch_array($result)){
        echo '<a href="userpage.php?userid=' . $row['user_id'] . '">' . $row['first_name']." " .$row['last_name']. '</a>  ';
        
        
    }
    }
    
    public static function GetLikesForRetweets($id){
        global $con;
        $sql = "SELECT * from tweets where original_tweet_id in (select tweet_id from tweets where user_id=$id)ORDER BY date_created DESC LIMIT 4";
         $result=mysqli_query($con, $sql);
         echo "<h3>Retweets</h3>";
        while($row= mysqli_fetch_array($result)){
            $now = new DateTime();
            $tweetTime = new DateTime($row['date_created']);
            $interval = $tweetTime->diff($now);
            User::GetName($row['user_id']);
         
            echo '<strong>retweeted your tweet</strong>'." " ;
            if ($interval->y > 1)
                echo $interval->format('%y years') . " ago" . '<BR>';
            elseif ($interval->y > 0)
                echo $interval->format('%y year') . " ago" . '<BR>';
            elseif ($interval->m > 1)
                echo $interval->format('%m months') . " ago" . '<BR>';
            elseif ($interval->m > 0)
                echo $interval->format('%m month') . " ago" . '<BR>';
            elseif ($interval->d > 1)
                echo $interval->format('%d days') . " ago" . '<BR>';
            elseif ($interval->d > 0)
                echo $interval->format('%d day') . " ago" . '<BR>';
            elseif ($interval->h > 1)
                echo $interval->format('%h hours') . " ago" . '<BR>';
            elseif ($interval->h > 0)
                echo $interval->format('%h hour') . " ago" . '<BR>';
            elseif ($interval->i > 1)
                echo $interval->format('%i minutes') . " ago" . '<BR>';
            elseif ($interval->i > 0)
                echo $interval->format('%i minute') . " ago" . '<BR>';
            elseif ($interval->s > 1)
                echo $interval->format('%s seconds') . " ago" . '<BR>';
            elseif ($interval->s > 0)
                echo $interval->format('%s second') . " ago" . '<BR>';
            echo '<BR>';
            echo $row['tweet_text'];        
            echo'<hr>';
            
            
        }
    }
    
    public static function GetReplies($id){
        global $con;
        $sql = "SELECT * from tweets where reply_to_tweet_id in (select tweet_id from tweets where user_id=$id)ORDER BY date_created DESC LIMIT 4";
         $result=mysqli_query($con, $sql);
         echo "<h3>Replies</h3>";
        while($row= mysqli_fetch_array($result)){
            $now = new DateTime();
            $tweetTime = new DateTime($row['date_created']);
            $interval = $tweetTime->diff($now);
            User::GetName($row['user_id']);
         
            echo '<strong>rplied to your tweet</strong>'." " ;
            if ($interval->y > 1)
                echo $interval->format('%y years') . " ago" . '<BR>';
            elseif ($interval->y > 0)
                echo $interval->format('%y year') . " ago" . '<BR>';
            elseif ($interval->m > 1)
                echo $interval->format('%m months') . " ago" . '<BR>';
            elseif ($interval->m > 0)
                echo $interval->format('%m month') . " ago" . '<BR>';
            elseif ($interval->d > 1)
                echo $interval->format('%d days') . " ago" . '<BR>';
            elseif ($interval->d > 0)
                echo $interval->format('%d day') . " ago" . '<BR>';
            elseif ($interval->h > 1)
                echo $interval->format('%h hours') . " ago" . '<BR>';
            elseif ($interval->h > 0)
                echo $interval->format('%h hour') . " ago" . '<BR>';
            elseif ($interval->i > 1)
                echo $interval->format('%i minutes') . " ago" . '<BR>';
            elseif ($interval->i > 0)
                echo $interval->format('%i minute') . " ago" . '<BR>';
            elseif ($interval->s > 1)
                echo $interval->format('%s seconds') . " ago" . '<BR>';
            elseif ($interval->s > 0)
                echo $interval->format('%s second') . " ago" . '<BR>';
            echo '<BR>';
            echo $row['tweet_text'] ;
      
            echo'<hr>';
            
            
        }
    }
            
    
        
  }


