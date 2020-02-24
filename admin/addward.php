    <div class="container" style="width:80%;">
    	<h3>add ward</h3>
    	<form action="saveward.php" method="POST">
    <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="enter ward name" id="example-text-input" name="ward" style="width: 80%;" autocomplete="off">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter number of beds" id="example-text-input" name="beds" style="width: 80%;" autocomplete="off">
  </div>
  </div>
  <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter daily charges" id="example-text-input" name="charges" style="width: 80%;" autocomplete="off">
  </div>
  </div>
<div class="form-group row">
  <div class="col-10">
    <select placeholder="select" name="sex" style="width: 80%;height: 3em;"><option disabled>select sex</option>
        <option>male</option>
        <option>female</option>
        <option>pediatric</option>
        </select>
        <input type="hidden" name="trigger" value="1">
  </div>
</div>
<div class="form-group row">
  
  <div class="col-10">
    
  </div>
</div>
<div class="col-10">
<button class="btn btn-success" style="width: 80%;">save</button>
</div>