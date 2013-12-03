<?php
# Change me to indicate what day and time your Beer O'Clock is
# Ours is on Friday's at 5pm sharp
$beerDay = "Friday";
$beerTime = "17:00:00";

$todaysDate = date('Y-m-d');
$todaysTime = date('H:i:s');
$today = "$todaysDate $todaysTime";

if ( date('l', strtotime($todaysDate)) === $beerDay &&
    strtotime($beerTime) >= strtotime($todaysTime) ) {
    $nextDate = date("Y-m-d $beerTime", strtotime('today'));
}
else {
    $nextDate = date("Y-m-d $beerTime", strtotime("next $beerDay"));
}

# Get the time difference
$diff = abs(strtotime($nextDate) - strtotime($today));

# I'm pretty sure there's an easier way to do this
# Anyways, calculate different units of time from diff
$years   = floor($diff / (365*60*60*24));
$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
$minutes  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

# I am best served as json
header('Content-Type: application/json');

# Using Geckoboard's Text widget to display the time, hence the formatting
echo json_encode (array('item' => array(array('text'=>"$days days $hours hours $minutes minutes", type => "0"))));
?>
