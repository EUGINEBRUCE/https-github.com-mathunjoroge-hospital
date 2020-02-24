<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Photo Viewer for Local Files and Directories</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="http://static.jstree.com/3.0.4/assets/dist/themes/default/style.min.css" />
    	<link rel="stylesheet" type="text/css" href="http://rii.uthscsa.edu/mango/papaya/papaya.css?version=0.6.5&build=692" />
    	<script type="text/javascript" src="http://rii.uthscsa.edu/mango/papaya/papaya.js?version=0.6.5&build=692"></script>

    	<script type="text/javascript">
    	 	var params = [];
    	</script>

<style>
html, body {
  padding: 0;
  margin: 0;
}
#container {
  display: -webkit-box;
  -webkit-box-orient: horizontal;
  height: 100%;
}

#container > div {
  padding: 10px;
}

#sidebar {
  background:#ddd;
  display:none;
}
#sidebar:hover {
  background:#ccc;
}
#loadAll, #play {
  display:none;
}

#side {
	width: 20%;
	overflow: auto;
}
#results {
	background: #eee;
	/*width: 72%;*/
	display:none;
}
#infinity {
	clear:both;
}
.all {
	width:95%;
}
.all img{
	width:100%;
	height:100%;
}
#modal {
	width:100%;
	height:100%;
	display:none;
}
#modalbuttons {
	background: #ccc;
	font-weight: bold;
	padding: 5px;
	position: absolute;
	top: 0;
	right: 0;
	font-size: 20px;
	opacity: .5;
}
#modalbuttons div {
	cursor:pointer;
}
#modalzoom {
	margin-right:20px;
}
.all {
	width:100%;
}
#info {
	margin:10px;
}

.tree,.tree ul,.tree li { list-style:none; margin:0; padding:0; zoom: 1; }
.tree ul { margin-left:8px; }
.tree li a { color:#555; padding:.1em 7px .1em 27px; display:block; text-decoration:none; border:1px dashed #fff; background:url(icon-file.gif) 5px 50% no-repeat; }
.tree li a.tree-parent { background:url(icon-folder-open.gif) 5px 50% no-repeat; }
.tree li a.tree-parent-collapsed { background:url(icon-folder.gif) 5px 50% no-repeat; }
.tree li a:hover,.tree li a.tree-parent:hover,.tree li a:focus,.tree li a.tree-parent:focus,.tree li a.tree-item-active { color:#000; border:1px solid#eee; background-color:#fafafa; -moz-border-radius:4px; -webkit-border-radius:4px; border-radius:4px; }
.tree li a:focus,.tree li a.tree-parent:focus,.tree li a.tree-item-active { border:1px solid #e2f3fb; background-color:#f2fafd; }
.tree ul.tree-group-collapsed { display:none; }
</style>

    <style>
      body {
          background-color: white;
          margin: 0;
      }
      /* this needs to be modified to correspond to the iframe w/h.
         vanilla papaya will try to enforce a W:H aspect ratio close
         to 2.4:1.93 */
      #papaya-container {
          position: relative;
          width: 800px;
          height: 600px;
      }
    </style>


</head>



<div id="modal">
	<div id="modalimg"></div>
	<div id="modalbuttons">
		<div id="modalzoom">Zoom</div>
		<div id="modalclose">Close</div>
	</div>
</div>

<div id="container">
  <div id="side">
    <!--<button id="loadAll">Load All</button>
    <button id="play">Play</button>-->
    <input type="file" id="file_input" webkitdirectory directory multiple/>
    <ul id="dir-tree"></ul>
  </div>
  <div id="sidebar"></div>
  <div id="results">
  	<div id="single"></div>
        <div id="papaya-container">
            <div id="papaya-viewer" style="width:100%;height:100%;"></div>
        </div>
  	<div id="infinity"></div>
  </div>
</div>


<script type="text/javascript" src="http://techslides.com/demos/image-browser/jquery-2.1.1.min.js"></script>
<script type='text/javascript' src="http://techslides.com/demos/image-browser/jquery.wheelzoom.js"></script>
<script type="text/javascript" src="http://techslides.com/demos/image-browser/jquery.tree.js"></script>
<script type="text/javascript" src="http://techslides.com/demos/image-browser/infinity.js"></script>
<script>
  window.URL = window.URL ? window.URL :
               window.webkitURL ? window.webkitURL : window;

  var viewer = []
  function Tree(selector) {
    this.$el = $(selector);
    this.fileList = [];
    var html_ = [];
    var tree_ = {};
    var pathList_ = [];
    var self = this;

    this.render = function(object) {
      if (object) {
        for (var folder in object) {
          if (!object[folder]) { // file's will have a null value
            html_.push('<li><a href="#" data-type="file">', folder, '</a></li>');
          } else {
            html_.push('<li><a href="#">', folder, '</a>');
            html_.push('<ul>');
            self.render(object[folder]);
            html_.push('</ul>');
          }
        }
      }
    };

    this.buildFromPathList = function(paths) {
      for (var i = 0, path; path = paths[i]; ++i) {
        var pathParts = path.split('/');
        var subObj = tree_;
        for (var j = 0, folderName; folderName = pathParts[j]; ++j) {
          if (!subObj[folderName]) {
            subObj[folderName] = j < pathParts.length - 1 ? {} : null;
          }
          subObj = subObj[folderName];
        }
      }
      return tree_;
    }

    this.init = function(e) {

      $('#info').hide();

      html_ = [];
      tree_ = {};
      pathList_ = [];
      self.fileList = e.target.files;

      for (var i = 0, file; file = self.fileList[i]; ++i) {
        pathList_.push(file.webkitRelativePath);
      }

      self.render(self.buildFromPathList(pathList_));

      self.$el.html(html_.join('')).tree({
        expanded: 'li:first'
      });

      var fileNodes = self.$el.get(0).querySelectorAll("[data-type='file']");
      for (var i = 0, fileNode; fileNode = fileNodes[i]; ++i) {
        fileNode.dataset['index'] = i;
      }

      $('#loadAll').show();

    }
  };


  	var tree = new Tree('#dir-tree');

  	var interval;

  	var count=0,lcount=0, clone;

  	$("#side").height(window.innerHeight-20);

  	$('#file_input').change(tree.init);


	tree.$el.click(function(e){
	    if (e.target.nodeName == 'A' && e.target.dataset['type'] == 'file') {
	      var file = tree.fileList[e.target.dataset['index']];
	      load(file);
	      $("#results,#sidebar").show();
	    }
	});







  	//Infinity setup
	var $el = $('#infinity');

	var listView = new infinity.ListView($el, {
	    lazy: function() {
		    var x = $(this).attr("data-infinity-pageid");
		    console.log(x);
		    if(x>1){
		    	i++;
		        if(tree.fileList.length>i){
		            load(tree.fileList.item(i),true);
		        }
		    }
	 	}
	});




	$('#sidebar').click(function(){
		$("#side").animate({width:'toggle'},200);
	    stop();
	});

	$('#loadAll').click(function(){
	    for (i = 0; i<9 ; i++) {
	        if(tree.fileList.length>i){
	          load(tree.fileList.item(i),true);
	        }
	    }
	    i--;
	    $("#results,#sidebar,#play").show();
	    $("#single div").remove();
	});


	$(window).resize(function() {
	  $("#side").height(window.innerHeight-20);
	});

        var scrollpos = 0;

	$('#results').on("click", "img", function(){
		scrollpos = document.body.scrollTop;
                clone = $(this).clone();
		clone.height(window.innerHeight);

		$("#modalimg").html(clone);
		$("#modal").show();
		$("#container").hide();

		clone.dblclick(function(){
			$(this).toggleClass("all");
		});

	});

	$('#modalzoom').click(function(){
		clone.wheelzoom();
	});

	$('#modalclose').click(function(){
		$("#modal").hide();
		$("#container").show();
		clone.remove();
                document.body.scrollTop = scrollpos;
	});

	$('#results').on("dblclick", "img", function(){
		stop();
		$("#side").animate({width:'toggle'},200);
		$("#results").toggleClass("all");
	});


	$('#results').on("click", "img", function(){
		stop();
		$("#results").toggleClass("click");

		if( $("#results").hasClass("click") ){
			$("#results img").height(window.innerHeight);
		} else {
			$("#results img").height("auto");
		}
	});

	//Slideshow with Infinity
	$('#play').click(function(){
		var txt = $(this).text();
		$("#results img").height(window.innerHeight);
		if(txt="Play"){
			$(this).text("Stop");
	    	$("#side").animate({width:'hide'},200);
	    	interval = window.setInterval(slide, 3000);
		} else {
			stop();
			$("#results img").height("auto");
		}
  	});

	function stop(){
		clearInterval(interval);
		$('#play').text("Play");
		count=0;
	}

	function slide(){
		count++;

		var nextslide = $(".image[data-slide="+count+"]");
		$('html, body').animate({
		    scrollTop: nextslide.offset().top
		}, 200);

	    if(count==lcount-1){
	    	$('#sidebar').trigger("click");
			$('html, body').animate({
			    scrollTop: 0
			}, 200);
	    }

	}




	function load(file,infinity){
	  var reader = new FileReader();

      console.log(file);
	  //check for image
      if (file.type.match(/image.*/)) {

		  reader.onload = function(e) {

		  	if(infinity){
			    var $newContent = $('<div class="image" data-slide="'+lcount+'"><img height="'+window.innerHeight+'" src="'+reader.result+'">');
			    listView.append($newContent);
			    lcount++;
		  	} else {
			    $("#single").html('<img src="'+reader.result+'"></div>');
		  	}

		  }
		  reader.readAsDataURL(file);

      } else {
         	console.log("not an picture");
      	    if (viewer.length == 0){
            var params = [];
            params["worldSpace"] = false;
            params["expandable"] = true;
            //params["kioskMode"] = true;
            getQueryParams(params);
            // papaya reads from "images"; we will insert one from the `filename` URL argument
            // params["images"] = [reader];

            addViewer("papaya-viewer", params, function() {
                // callback function
                console.log(papayaContainers);
                viewer = papayaContainers[papayaContainers.length - 1].viewer
                viewer.loadImage(file);
            });
            }
            else {
                viewer.loadImage(file);
            }

      }


	}


</script>



