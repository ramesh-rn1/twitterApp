<?php
require_once('TwitterAPIExchange.php');

$settings = array(
'oauth_access_token' => "4044727213-eWC9isawbFsNSZ9Ripzft5WosX8yeFAHP019PSS",
'oauth_access_token_secret' => "1RK7UllD6Tvz6h2eQwgqlni4j9UGJTR7nUHu8RWlrxazk",
'consumer_key' => "VNt8Fg13Sf5i6qrvwQDniqXO0",
'consumer_secret' => "mL6jyH19Z1zBacxeRy8bIiCKcmB4iqNEoit1ZA5IZhIZkPjVe3"
);
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
if (isset($_GET['user']))  {$user = $_GET['user'];}  else {$user  = "iagdotme";}
if (isset($_GET['count'])) {$count = $_GET['count'];} else {$count = 20;}
$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
foreach($string as $items)
    {
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
    }
?>