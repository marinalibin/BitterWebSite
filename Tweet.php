<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tweet
 *
 * @author monal
 */
class Tweet {

    private $tweetId;
    private $tweetText;
    private $userId;
    private $originalTweetId;
    private $replyToTweetId;
    private $dateAdded;
    private $userName;
    private $firstName;
    private $lastName;
    private $fullName;

    public function __get($property) {
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    function __construct() {
        
    }

    function __distruct() {
        echo "OBJECT DESTROYED ";
    }

    function insertTweet() {
        global $con;
        $sql = "INSERT into tweets (tweet_text, user_id,original_tweet_id,reply_to_tweet_id)VALUES"
                . " ('$this->tweetText','$this->userId','$this->originalTweetId',0)";
        mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) > 0) {
            return true;
        } else {
            return false;
        }//end if
    }

    public function DisplayTweet() {
        global $con;
        $sql = "SELECT users.user_id,users.first_name, users.last_name, users.screen_name, tweets.tweet_text,tweets.tweet_id, tweets.date_created,tweets.original_tweet_id FROM users INNER JOIN tweets ON users.user_id = tweets.user_id 
        WHERE tweets.reply_to_tweet_id = '0' AND users.user_id in 
        (Select follows.to_id FROM follows where follows.from_id = '$this->userId') or  users.user_id = '$this->userId' ORDER BY date_created DESC";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $this->userId = $row['user_id'];
            $this->userName = $row["screen_name"];
            $this->firstName = $row["first_name"];
            $this->lastName = $row["last_name"];
            $this->tweetText = $row['tweet_text'];
            $this->dateAdded = $row['date_created'];
            $this->originalTweetId = $row['tweet_id'];
            $now = new DateTime();
            $tweetTime = new DateTime($this->dateAdded);
            $interval = $tweetTime->diff($now);
            $dispalyString = $this->userName . " " . $this->firstName . " " . $this->lastName;
            // $retweet = new Tweet();
            $userid = $this->userId;

            echo '<a href="userpage.php?userid=' . $userid . '">@' . $dispalyString . '</a>&nbsp';
            if ($row['original_tweet_id'] != 0) {
                $original = $this->GetReTweet($row['original_tweet_id']);
                echo "<strong>retweeted from" . " " . $original->fullName . " " . "</strong>";
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
            echo $this->tweetText . '<BR><BR>';
            //tweetid for likes
            $tweetid = $this->originalTweetId;

            if ($this->isTweetLiked($_SESSION["SESS_MEMBER_ID"], $tweetid)) {
                echo '<a href="#"><img class = "bannericons" src="\Images\Liked.png" /></a>';
            } else {
                echo '<a href="LikeTweet.php?tweetid=' . $tweetid . '"><img class = "bannericons" src="\Images\like.ico" /></a>';
            }

            echo '<a href="Retweet.php?tweetid=' . $tweetid . '"><img class = "bannericons" src="\Images\retweet.png" /></a>';

            $this->GetReplyIcon($row['tweet_id'], $row['tweet_text']);
            echo '<hr >';
        }
    }

//this checks if it can be retweeted
    public function ReTweet($reTweetid) {
        global $con;

        $sql = "SELECT * from tweets where tweet_id = '$reTweetid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);


        if (mysqli_num_rows($result) > 0) {
            $this->originalTweetId = $reTweetid;
            $this->tweetText = $row['tweet_text'];
            return true;
        } else {
            return false;
        }
    }

    public function GetReTweet($tweetId) {
        global $con;
        $sql = "select first_name, last_name, screen_name, tweet_text, tweets.date_created from tweets inner join users "
                . "on users.user_id = tweets.user_id where tweet_id=$tweetId";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $this->fullName = $row['first_name'] . " " . $row['last_name'];
            $this->tweetText = $row['tweet_text'];
            $this->originalTweetId = $tweetId;
            return $this;
        }
    }

    public function GetReplyIcon($replytoid, $tweetText) {
        //echo '<a href="Reply.php?tweetid =' . $replytoid . '&tweetext' . $tweetText . '"><img src="images/reply.png"></a>';
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

    public function DisplayTweetCurrentUser($id) {
        global $con;
        $sql = "select users.user_id,users.first_name, users.last_name, users.screen_name,"
                . " tweets.tweet_text,tweets.original_tweet_id, tweets.tweet_id,tweets.date_created from users INNER JOIN tweets "
                . "ON users.user_id = tweets.user_id where users.user_id = '$id'ORDER BY date_created DESC";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $this->fullName = $row['first_name'] . " " . $row['last_name'];
            $this->userId = $row['user_id'];
            $this->tweetText = $row['tweet_text'];
            $this->userName = $row["screen_name"];
            $this->dateAdded = $row["date_created"];
            $this->originalTweetId = $row['tweet_id'];
            //$id=$this->userId;
            $now = new DateTime();
            $tweetTime = new DateTime($this->dateAdded);
            $interval = $tweetTime->diff($now);
            $dispalyString = $this->fullName . " " . $this->userName;

            //$fullName = new User();
            // $fullName->GetProfilName();

            echo '<a href="userpage.php?userid=' . $row['user_id'] . '">@' . $dispalyString . '</a>&nbsp';
            if ($row['original_tweet_id'] != 0) {
                $original = $this->GetReTweet($row['original_tweet_id']);
                echo "<strong>retweeted from" . " " . $original->fullName . " " . "</strong>";
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
            echo $this->tweetText . '<BR><BR>';
            //tweetid for likes
            $tweetid = $this->originalTweetId;
            if ($this->isTweetLiked($_SESSION["SESS_MEMBER_ID"], $tweetid)) {
                echo '<a href="#"><img class = "bannericons" src="\Images\Liked.png" /></a>';
            } else {
                echo '<a href="LikeTweet.php?tweetid=' . $tweetid . '"><img class = "bannericons" src="\Images\like.ico" /></a>';
            }

            echo '<a href="Retweet.php?tweetid=' . $tweetid . '"><img class = "bannericons" src="\Images\retweet.png" /></a>';
            $this->GetReplyIcon($row['tweet_id'], $row['tweet_text']);
            echo '<hr >';
        }
        return $this;
    }

    public function GetCountOfTweets($id) {
        global $con;
        $sql = "SELECT count(tweet_id)FROM tweets where user_id = $id";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            echo $row['count(tweet_id)'];
        }
    }

    public function GetCountOfFollowing($id) {
        global $con;
        $sql = "SELECT count(to_id) FROM follows where from_id = $id";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            echo $row['count(to_id)'];
        }
    }

    public function GetCountOfFollowers($id) {
        global $con;
        $sql = "SELECT count(from_id) FROM follows where to_id = $id";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($result)) {
            echo $row['count(from_id)'];
        }
    }

    public function likeTweet($userId, $tweetId) {
        global $con;
        $sql = "insert into likes (tweet_id,user_id) values ('$tweetId','$userId')";
        mysqli_query($con, $sql);
        if (mysqli_affected_rows($con) > 0) {
            return true;
        } else {
            return false;
        }//end if
    }

    public function isTweetLiked($userId, $tweetId) {
        global $con;
        $sql = "SELECT tweet_id,user_id FROM LIKES where tweet_id=$tweetId AND user_id=$userId";

        if ($result = mysqli_query($con, $sql)) {
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                return true;
            }
        }
        return false;
    }
    


}
