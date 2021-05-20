<?php include('partials/menu.php'); ?>
<!-- main content section starts -->
<div class="main-content image-center">
<div class="wrapper">
 <h1>Manage Admin</h1>
 <br/>
<?php
   if(isset($_SESSION['add']))
   {
      echo $_SESSION['add'];//Displaying Session Message
      unset($_SESSION['add']);//Removing Session Message after refresh
   }
   if(isset($_SESSION['delete']))
   {
      echo $_SESSION['delete'];//Displaying Session Message for delete
      unset($_SESSION['delete']);//Removing Session Message after refresh
   }
   if(isset($_SESSION['update']))
   {
      echo $_SESSION['update'];//Displaying Session Message for update
      unset($_SESSION['update']);//Removing Session Message after refresh
   }
   if(isset($_SESSION['user-not-found']))
   {
      echo $_SESSION['user-not-found'];//Displaying Session Message for no data in database
      unset($_SESSION['user-not-found']);//Removing Session Message after refresh
   }
   if(isset($_SESSION['pwd-not-match']))
   {
      echo $_SESSION['pwd-not-match'];//Displaying Session Message for pwd doesnt match
      unset($_SESSION['pwd-not-match']);//Removing Session Message after refresh
   }
   if(isset($_SESSION['change-pwd']))
   {
      echo $_SESSION['change-pwd'];//Displaying Session Message for change pwd
      unset($_SESSION['change-pwd']);//Removing Session Message after refresh
   }

?>
<br/><br/>
 <!-- button to add admin -->
 <a href="add-admin.php" class="btn-primary">Add Admin</a>
 <br/><br/>
 <table class="tbl-full">
     <tr>
         <th>S.N.</th>
         <th>Full Name</th>
         <th>Username</th>
         <th>Actions</th>
</tr>
<?php 
 $sql="SELECT * FROM tbl_admin";
 //Execute the query
 $res= mysqli_query($conn, $sql);
 //check whether the query is executed or not
 if($res==TRUE)
 {
     // count rows to check whether we have data in database or not
     $count = mysqli_num_rows($res);//function to get all the rows in database

     $sn=1;//create a variable and assign the value
     //check the num of rows
     if($count>0)
     {
         //we have data in database
         while($rows=mysqli_fetch_assoc($res))
         {
             //using while loop to get all the data from database
             //And while loop will run as long as we have data in database

             //get individual data
             $id=$rows['id'];
             $full_name=$rows['full_name'];
             $username=$rows['username'];

             //display the values in our table
             ?>
                       <tr>
                                    
    <td><?php echo $sn++; //increment operation for id?>.</td>
    <td><?php echo $full_name; //fetched the entered data from add addmin.php or database admin table to manage admin.php?></td>
    <td><?php echo $username; ?></td>
    <td>
    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class ="btn-primary">Change Password</a>
    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class ="btn-secondary">Update Admin</a>
        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; //get id value and redirect to deleteadmin.php page?>" class ="btn-danger">Delete Admin</a>
    </td>
</tr>
             <?php
         }
     }
     else{
         //we dont have data in Database
     }
 }
?>

</table>
</div>
</div>
<!-- Main content section ends-->
<?php include('partials/footer.php'); ?>
