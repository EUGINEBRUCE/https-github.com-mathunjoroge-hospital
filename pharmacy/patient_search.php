<style>
    /* Input field */
#patient + .select2 .select2-selection__rendered {  background-color: yellow; }

/* Each result */
#select2-patient-results { background-color: black; }

/* Higlighted (hover) result */
#select2-patient-results .select2-results__option--highlighted { background-color: #0033cc! important; }

/* Selected option */
#select2-patient-results .select2-results__option[aria-selected=true] { background-color: teal !important; }


// These 2 are special they would require js if you dont want to change the style for each select 2
/* Around the search field */
.select2-search { background-color: orange; }

/* Search field */
.select2-search input { background-color: pink; }
</style>
<select id='patient' style='width: 40%;'  name="search" data-live-search="true"  required/>
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