<?php 
/**
 * 
 * 
 * @copyright   [Massive Technolab]
 * @author      Massive developer
 * @package     Flickr api
 * @version     $Id: flickr.php 2015-01-10 11:10:15 Massive developer $
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Massivetechnolab Flickr Images</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <style>
    img{
        margin-left: 8px;
        width: 300px;
        height: 250px;
    }
    </style>
  </head>
  <body>
  <div class="main-container">
  <div id="flickr-images"></div> 
<script type="text/javascript">
function getFlickrImages(setId) {
  var URL = "https://api.flickr.com/services/rest/" +  // Wake up the Flickr API gods.
    "?method=flickr.photosets.getPhotos" +  // Get photo from a photoset. https://www.flickr.com/services/api/flickr.photosets.getPhotos.htm
    "&api_key={Your API key}" +  // API key. Get one here: http://www.flickr.com/services/apps/create/apply/
    "&photoset_id=" + setId +  // The set ID.
    "&privacy_filter=1" +  // 1 signifies all public photos.
    "&per_page=28" + // For the sake of this example I am limiting it to 20 photos.
    "&format=json&nojsoncallback=1";  // Er, nothing much to explain here.

  // See the API in action here: https://www.flickr.com/services/api/explore/flickr.photosets.getPhotos
  $.getJSON(URL, function(data){
    var owner = data.photoset.owner;
    var phot_set_id = data.photoset.id;
    $.each(data.photoset.photo, function(i, item){
      // Creating the image URL. Info: https://www.flickr.com/services/api/misc.urls.html
      var img_src = "https://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_m.jpg";
      //var img_thumb = $("<img/>").attr("src", img_src).attr("id", item.id).css("margin", "8px");
      var link_src = "https://www.flickr.com/photos/" + owner + "/" + item.id + "/in/set-"+phot_set_id;
      var img_link =   $("<a/>").attr("href", link_src);
      var img_thumb = $('<img />').attr({src:img_src}).appendTo($('<a />').attr({href:link_src,target:"_blank"}).appendTo($('#flickr-images')));
      
    });
  });
}
$(document).ready(function() {
  getFlickrImages("72157650210689192"); // Call the function!
});
</script>
</div>
</body>
</html>
