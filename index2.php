<html>  
<head>  
    <title>Inline Table Insert Update Delete in PHP using jsGrid</title>  
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
  --> 

  <script src="external/jquery/jquery-1.8.3.js"></script>
  <link type="text/css" rel="stylesheet" href="dist/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="dist/jsgrid-theme.min.css" />
  <script type="text/javascript" src="dist/jsgrid.min.js"></script>
<style>
  .hide
  {
  display:none;
  }
</style>
</head>  
<body>  
    <div class="container">  
<br />
<div class="table-responsive">  
<h3 align="center">Inline Table Insert Update Delete in PHP using jsGrid</h3><br />
<div id="grid_table"></div>
</div>  
</div>
</body>  
</html>  
<script>

$('#grid_table').jsGrid({

 width: "100%",
 height: "600px",

 filtering: true,
 inserting:true,
 editing: true,
 sorting: true,
 paging: true,
 autoload: true,
 pageSize: 10,
 pageButtonCount: 5,
 deleteConfirm: "Do you really want to delete data?",

 controller: {
  loadData: function(filter){
   return $.ajax({
    type: "GET",
    url: "fetch_data.php",
    data: filter
   });
  },
  insertItem: function(item){
   return $.ajax({
    type: "POST",
    url: "fetch_data.php",
    data:item
   });
  },
  updateItem: function(item){
   return $.ajax({
    type: "PUT",
    url: "fetch_data.php",
    data: item
   });
  },
  deleteItem: function(item){
   return $.ajax({
    type: "DELETE",
    url: "fetch_data.php",
    data: item
   });
  },
 },

  fields: [
    {
      name: "USRCODE",
      type: "hidden",
      css: 'hide'
    },
    {
      name: "MATRICULE", 
      type: "text", 
      width: 150, 
      validate: "required"
    },
    {
		name: "CODE",	 
		type: "text", 
		width: 100, 
		validate: "required"
    },
    {
      name: "NOM", 
      type: "text", 
      width: 150, 
      validate: "required"
    },
    {
      name: "PRENOM", 
      type: "text", 
      width: 150,
      validate: "required"
    },
    {
      name: "MOT DE PASSE", 
      type: "text", 
      width: 150,
      validate: "required"
    },
    {
      name: "PROFIL", 
      type: "text", 
      width: 150,
      validate: "required"
    },
    {
    type: "control"
    }
 ]

});

</script>