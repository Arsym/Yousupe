  <div class="container my-5">
    <h3 class="text-center">Playlist Channel</h3>
      <hr>
    <div id="my_video_list" class="text-center">
      <?php
      if(isset($_GET['keyword'])) {
       $keyword = $_GET['keyword'];
      } else {
        error_reporting(0);
        echo "<h6>Cara Mendapatkan Channel ID</h6><img class=\"img-fluid\" src=".base_url('assets/img/how.png')." alt=\"Cara mengambil ChannelId\">";
      };

      $API_Url = 'https://www.googleapis.com/youtube/v3/';
      $API_Key = 'AIzaSyD7grJfMvOf2b2GZJlvtndboT0kVLnOHTc';

      $channelId = $keyword;
      // UCVh-gnBAYDF90hQm-AJwaWg
      // UCkXmLjEr95LVtGuIm3l2dPg
      // UCuXur6PjZTSy--300O1iTwA
       
      $parameter = [
          'part'=> 'snippet,contentDetails',
          'channelId' => $channelId,
          'maxResults'=> '50',
          'key'=> $API_Key
      ];
      $channel_URL = $API_Url . 'playlists?' . http_build_query($parameter);
      $json_details = json_decode(file_get_contents($channel_URL), true);

      $my_videos = [];
      foreach($json_details['items'] as $video){
        $my_videos[] = array( 'p_id'=>$video['id'], 'p_name'=>$video['snippet']['title'], 'thumbs'=>$video['snippet']['thumbnails']['medium']['url'] );
      }

      while(isset($json_details['nextPageToken'])){
        $nxt_page_URL = $channel_URL . '&pageToken=' . $json_details['nextPageToken'];
        $json_details = json_decode(file_get_contents($nxt_page_URL), true);
          
        foreach($json_details['items'] as $video) {
            $my_videos[] = array( 'p_id'=>$video['id'], 'p_name'=>$video['snippet']['title'], 'thumbs'=>$video['snippet']['thumbnails']['medium']['url'] );
        }
      }

      foreach($my_videos as $video){
        if (isset($video)) {
          echo '<a href="javascript:void(0)" onclick="location.href=\''.base_url('playlist/item/').$video['p_id']."?keyword=".$keyword.'\'" style="background: url('.$video['thumbs'].')">
                <div>'. $video['p_name'] .'</div>
            </a>';
          }
      }
      ?>
    </div>
  </div>
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?= base_url('assets/js/jquery-3.4.0.min.js') ?>"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?= base_url('assets/js/popper.min.js') ?>"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?= base_url('assets/js/mdb.min.js') ?>"></script>
  <script>
    
  </script>
</body>

</html>