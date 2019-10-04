  <div class="container my-5">
    <h3 class="text-center">Playlist Video</h3>
      <hr>
    <div id="my_video_list" class="text-center">
      <?php
      
      $API_Url = 'https://www.googleapis.com/youtube/v3/';
      $API_Key = 'AIzaSyD7grJfMvOf2b2GZJlvtndboT0kVLnOHTc';
       
      $parameter = [
          'part'=> 'snippet',
          'playlistId' => $id,
          'maxResults'=> '50',
          'key'=> $API_Key
      ];
      $channel_URL = $API_Url . 'playlistItems?' . http_build_query($parameter);
      $json_details = json_decode(file_get_contents($channel_URL), true);

      $my_videos = [];
      foreach($json_details['items'] as $video){
          //$my_videos[] = $video['snippet']['resourceId']['videoId'];
        $my_videos[] = array( 'v_id'=>$video['snippet']['resourceId']['videoId'], 'v_name'=>$video['snippet']['title'] );
      }

      while(isset($json_details['nextPageToken'])){
        $nxt_page_URL = $channel_URL . '&pageToken=' . $json_details['nextPageToken'];
        $json_details = json_decode(file_get_contents($nxt_page_URL), true);
          
        foreach($json_details['items'] as $video) {
            // $my_videos[] = $video['snippet']['resourceId']['videoId'];
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
