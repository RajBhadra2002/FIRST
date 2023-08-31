
<?php
include('includes/displaydata.php'); 
$con=new mysqli('localhost','root','','data');
 if(isset($_POST['form_submit'])){
  $heading = $_POST['heading'];
  $description = $_POST['description'];
  $folder = 'uploads/';
  $image_file = $_FILES['image']['name'];
  $file = $_FILES['image']['tmp_name'];
  $path = $folder.$image_file;
  $target_file = $folder.basename($image_file);
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  //Allow only JPG, JPEG, PNG & GIF etc formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
  
  $error[] = 'Sorry, only JPG, PNG & GIF files are allowed';

  }
  
  
//move image to the folder 
move_uploaded_file($file, $target_file);
$con->query("INSERT INTO `banner` SET `heading`='".$heading."',`description`='".$description."',`image`='".$image_file."'");


}



$con=new mysqli('localhost','root','','data');
$all = $con->query('SELECT * FROM `banner`');

if ($_REQUEST['delete']) {
   $con->query("DELETE FROM `banner` WHERE `id`='".$_REQUEST['id']."'");
}




 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>PHP Bootstrap Modal Crud</title>
    <!-- Bootsrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>  

  <div class="container2">
        <div class="sidebar">
            <h2>Admin Pannel</h2>
            <ul class="menu">
                <li><a href="index.php">Product</a></li>
                <li><a href="#">About</a></li>
                <li><a href="">Gallery</a></li>
            </ul>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      

<form action="index.php" method="POST" enctype="multipart/form-data">

   
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Heading</label>
    <input type="text" class="form-control" name="heading">
</div>
    
    <div class="mb-3">
    <label for="floatingTextarea">Description</label>
     <textarea class="form-control" name="description"></textarea>
  
</div>

 <div class="mb-3">
  <label for="formFile" class="form-label">Image</label>
  <input class="form-control" type="file" name="image">
</div>
    
    <div class="modal-footer"> 
        <button name="form_submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</form>
      </div>
      </div>
    </div>
  </div>
</div>

<h1 class="text-center">Product Section</h1>
<div class="container my-3">

<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#completeModal">
Add
</button>
</div>


<table>
  <tr>
    <th>Id</th>
      <th>Product</th>
    <th>Name</th>
     <th>Description</th>
   
    
    <th colspan="2">Action</th>
  </tr>
 <?php while($value=$all->fetch_array()){ ?>
  <tr>
    <td><?php echo $value['id']; ?></td>
    <td class="dataimg"><img src="uploads/<?php echo $value['image']; ?>"></td>
    <td><?php echo $value['heading']; ?></td>
    <td><?php echo $value['description']; ?></td>
    
    <td>
      <button class="btn-edit"><a href="update.php?id=<?php echo $value['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></button>
     </td>
     <td>
     <button class="btn-trash"><a href="index.php?delete=ok&id=<?php echo $value['id']; ?>"><i class="fa-solid fa-trash"></i></a></button>
     </td>

</tr>
<?php } ?>

</table>








   













  




    <!-- bootstrap Javascript  -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>