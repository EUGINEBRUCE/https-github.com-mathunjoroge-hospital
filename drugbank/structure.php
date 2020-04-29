<?php 
require_once('../main/auth.php');
include('db_connect.php');
 ?>
 <html>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Smiles Drawer Example</title>
<meta name="description" content="A minimal smiles drawer example.">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
<link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
<link href="../pharmacy/demo.css" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<style>
canvas { margin: 5px; }
</style>
<style>
canvas { margin: 5px;
margin-top: -8%;
margin-left:30%;
width: auto; 
height: auto;
 }
</style>
</head>
<body>
<header class="header clearfix" style="">
</button>
<?php include('../main/nav.php'); ?>   
</header>

<div class="container" >
    <p>&nbsp;</p>
    <h3 align="center">chemical structure for <?php echo $_GET['drug']; ?></h3><script type="text/javascript">
            </script>
</div>
<script type="text/javascript">
let drugbank = ['<?php echo $_GET['structure']; ?>'];
</script>  
<script src="dist/smiles-drawer.min.js"></script>

<script>
let options = {  };

// Initialize the drawer
let smilesDrawer = new SmilesDrawer.Drawer(options);

for (let i = 0; i < drugbank.length; i += 3) {
try {
let canvas = document.createElement('canvas');
div = document.createElement('div');
canvas.setAttribute('id', 'canvas' + i);
canvas.setAttribute('alt', drugbank[i]);
document.body.appendChild(div);
document.body.appendChild(canvas);

SmilesDrawer.parse(drugbank[i], function(tree) {
smilesDrawer.draw(tree, 'canvas' + i, 'light', false); 
}, function(err) {
console.log(err);
});

// if (td > 1000) console.log(schembl[i]);
} catch (exception) {

}
}
</script>
</div>
</body>
</html>