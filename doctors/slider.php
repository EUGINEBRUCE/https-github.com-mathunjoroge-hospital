<!DOCTYPE html>
<html>
<head>
  <title>slider</title>
</head>
<body>
  <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
  <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
    <a href="img/city-1.jpg" itemprop="contentUrl" data-size="1000x667" data-index="0">
      <img src="img/city-1-thumb.jpg" height="400" width="600" itemprop="thumbnail" alt="Beach">
    </a>
  </figure>
  <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
      <a href="img/city-2.jpg" itemprop="contentUrl" data-size="1000x667" data-index="1">
          <img src="img/city-2-thumb.jpg" height="400" width="600" itemprop="thumbnail" alt="">
      </a>
  </figure>
</div>

</body>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
 
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
 
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">$('.picture').each( function() {
    var $pic     = $(this),
        getItems = function() {
            var items = [];
            $pic.find('a').each(function() {
                var $href   = $(this).attr('href'),
                    $size   = $(this).data('size').split('x'),
                    $width  = $size[0],
                    $height = $size[1];
 
                var item = {
                    src : $href,
                    w   : $width,
                    h   : $height
                }
 
                items.push(item);
            });
            return items;
        }
 
    var items = getItems();
});</script>
<script type="text/javascript">var $pswp = $('.pswp')[0];
$pic.on('click', 'figure', function(event) {
    event.preventDefault();
     
    var $index = $(this).index();
    var options = {
        index: $index,
        bgOpacity: 0.7,
        showHideOpacity: true
    }
     
    // Initialize PhotoSwipe
    var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
    lightBox.init();
});</script>
</html>