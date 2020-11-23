<select id='patient' style='width: 40%;'  name="search" style="color:black;" data-live-search="true"  required/>
<option value='0' ></option>
</select> 
<script>
$(document).ready(function(){
$("#patient").select2({
placeholder:"enter patient name or number",

minimuminputLength:3,
theme: "classic",
ajax: {
url: "../doctors/patient.php?q=term",
dataType: 'json',
type: "POST",
delay: 250,
data: function (params) {
return {
q: params.term, // search term
};
},
processResults: function (data) {
return {
results: data
};
},
cache: true
}
});
});
</script>