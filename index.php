<?php
 header("Content-Type: application/json");

 date_default_timezone_set('UTC');

 $slack_name = $_GET['slack_name'];
 $track = $_GET['track'];
 $current_day = Date('l');
 $utc_time = Date('Y-m-d\TH:i:s\Z');
 $github_file_url = 'https://github.com/Ichallz/HNG.git';
 $github_repo_url = 'https://github.com/Ichallz/HNG';

 $data = array (
 "slack_name" => $slack_name,
 "track" => $track,
 "current_day" => $current_day,
 "utc_time" => $utc_time,
 "github_file_url" => $github_file_url,
 "github_repo_url" => $github_repo_url,
 );

echo   json_encode($data);
?>