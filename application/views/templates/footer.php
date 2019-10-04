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
  $(document).ready(function(e){
    $('#my_video_list a').on('click',function(e){
    e.preventDefault();

    var video_url = $(this).attr('onclick');   
    var video_id = video_url.substring(video_url.search('=')+1,video_url.length);
    
    $('#my_player div').html('<iframe width="720" height="400" src="https://www.youtube.com/embed/' + video_id + '" frameborder="0" allowfullscreen></iframe>');
      $('#my_player').fadeIn(500);
    });

    $('#my_player').on('click',function(e){
      $('#my_player').fadeOut(500);
      $('#my_player div').empty();
    });
    
  });
  </script>
</body>

</html>