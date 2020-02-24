<script
  src="https://code.jquery.com/jquery-1.8.3.min.js"
  integrity="sha256-YcbK69I5IXQftf/mYD8WY0/KmEDCv1asggHpJk1trM8="
  crossorigin="anonymous"></script>
  <script type="text/javascript">var test = $('#test');
$(test).select2({
    data:[
        {id:0,text:"enhancement"},
        {id:1,text:"bug"},
        {id:2,text:"duplicate"},
        {id:3,text:"invalid"},
        {id:4,text:"wontfix"}
    ],
    multiple: true,
    width: "300px"
});

$(test).change(function() {
    //var ids = $(test).val(); // works
    //var selections = $(test).filter('option:selected').text(); // doesn't work
    //var ids = $(test).select2('data').id; // doesn't work (returns 'undefined')
    //var selections = $(test).select2('data').text; // doesn't work (returns 'undefined')
    //var selections = $(test).select2('data');
    var selections = ( JSON.stringify($(test).select2('data')) );
    //console.log('Selected IDs: ' + ids);
    console.log('Selected options: ' + selections);
    //$('#selectedIDs').text(ids);
    $('#selectedText').text(selections);
});
</script>
<style type="text/css">p { margin: 1em 0; }</style>
<input type="hidden" id="test" />
<p>Selected IDs: <span id="selectedIDs"></span></p>
<p>Selected Options: <span id="selectedText"></span></p>