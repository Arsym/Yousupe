<?php 
function get_CURL($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($curl);
  curl_close($curl);

  return json_decode($result, true);

}
  $urlVideos = 'https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id='.$keyword.'&key=AIzaSyD7grJfMvOf2b2GZJlvtndboT0kVLnOHTc';
  $result = get_CURL($urlVideos);

  $profilPic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
  $channelName = $result['items'][0]['snippet']['title'];
  $subs = $result['items'][0]['statistics']['subscriberCount'];
 ?>
<div class="container my-5">
  <div class="row justify-content-center text-center">
    <div class="col-md-1">
      <img class="rounded-circle img-thumbnail" src="<?= $profilPic; ?>" width="70">
    </div>
      <div class="col-md-5 my-1">
      <h5><b><?= $channelName; ?></b></h5>
      <p class="subs"><?= $subs; ?> Subscribers</p>
    </div>
  </div><br>
    <h3 class="text-center">Video Terbaru</h3>
      <hr>
    <div id="my_video_list" class="text-center">
      <?php
      if(isset($_GET['keyword'])) {
       $keyword = $_GET['keyword'];
      } else {
        error_reporting(0);
        echo "<h6>Cara Mendapatkan Channel ID</h6><img class=\"img-fluid\" src=".base_url('assets/img/how.png')." alt=\"Cara mengambil ChannelId\">";
      };

      //$anotherkey = AIzaSyD7grJfMvOf2b2GZJlvtndboT0kVLnOHTc;
      //$mykey(limit) = AIzaSyBk26X-h1iDju4fSChHl2q2m_jJr4haBdE;
      $API_Url = 'https://www.googleapis.com/youtube/v3/';
      $API_Key = 'AIzaSyD7grJfMvOf2b2GZJlvtndboT0kVLnOHTc';

      $channelId = $keyword;
      // UCVh-gnBAYDF90hQm-AJwaWg
      // UCkXmLjEr95LVtGuIm3l2dPg
      // UCuXur6PjZTSy--300O1iTwA
       
      $parameter = [
          'id'=> $channelId,
          'part'=> 'contentDetails',
          'key'=> $API_Key
      ];
      $channel_URL = $API_Url . 'channels?' . http_build_query($parameter);
      $json_details = json_decode(file_get_contents($channel_URL), true);
       

      $playlist = $json_details['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
       
      $parameter = [
          'part'=> 'snippet',
          'playlistId' => $playlist,
          'maxResults'=> '50',
          'key'=> $API_Key
      ];
      $channel_URL = $API_Url . 'playlistItems?' . http_build_query($parameter);
      $json_details = json_decode(file_get_contents($channel_URL), true);

      $my_videos = [];
      foreach($json_details['items'] as $video){          
        $my_videos[] = array( 'v_id'=>$video['snippet']['resourceId']['videoId'], 'v_name'=>$video['snippet']['title'] );
      }

      while(isset($json_details['nextPageToken'])){
        $nxt_page_URL = $channel_URL . '&pageToken=' . $json_details['nextPageToken'];
        $json_details = json_decode(file_get_contents($nxt_page_URL), true);
          
        foreach($json_details['items'] as $video) {
            $my_videos[] = array( 'v_id'=>$video['snippet']['resourceId']['videoId'], 'v_name'=>$video['snippet']['title'] );
        }
      }

      foreach($my_videos as $video){
        // error_reporting(0);
        if (isset($video)) {
          echo '<a href="javascript:void(0)" onclick="https://www.youtube.com/watch?v='. $video['v_id'] .'" style="background: url(\'https://i.ytimg.com/vi/'. $video['v_id'] .'/mqdefault.jpg\')">
                <div>'. $video['v_name'] .'</div>
            </a>';
          }
      }
      ?>
    </div>
  </div>

    <div id="my_player">
      <div></div>
    </div>