<?php  ?>
<html>
<head>
  <title>Bootstrap Jquery Add More Field Example</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 --></head>
<body>

<div class="container">
  

        <form action="action.php" >

      	<div class="input-group control-group after-add-more">

          <input type="text" name="addComponent[]" class="form-control" placeholder="Component Title Here">
          
              <div class="input-group-btn"> 
                <button class="btn btn-success add-component" type="button">Add</button>
              </div>
            
        </div>

        </form>

        <!-- Copy Fields -->
        
        <div class="template hide">
        
        <div class="control-group input-group" style="margin-top:10px">
            
            <input type="text" name="addComponent[]" class="form-control" placeholder="Component Title Here">
            
              <div class="input-group-btn"> 
              <button class="btn btn-danger remove" type="button">Remove</button>
              </div>
          
        </div>
        
</div>


<script type="text/javascript">

    $(document).ready(function() {

      $(".add-component").click(function(){ 
          var html = $(".template").html();
          $(".after-add-component").after(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>

</body>
</html>