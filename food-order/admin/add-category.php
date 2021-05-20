<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSSION['add'];
            unset($_SESSSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSSION['upload'];
            unset($_SESSSION['upload']);
        }
        ?>
        <br><br>
        <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input type="radio" name="active" value="yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form ends -->
        <?php 
        //check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
           // echo "clicked";
           //1.Get the Value From Cateogry Form
           $title =$_POST['title'];
           //for radio input ,we need to check whether the button is selected or not
           if(isset($_POST['featured']))
           {
               //Get the Value from form
               $featured = $_POST['featured'];
           }
           else
           {
               //set the default value
               $featured = "NO";
           }
           if(isset($_POST['active']))
           {
               $active = $_POST['active'];
           }
           else{
               $active= "No";
           }
           //check whether the image is selected or not and set the value for image name accordingly
          // print_r($_FILES['image']);//print_r used to display the values of array
          // die();//Break the code here
          if(isset($_FILES['image']['name']))
          {
              //upload the image
              //to upload image we need img name,source path and destination path
              $image_name = $_FILES['image']['name'];
              //upload the image only if image is selected
              if($image_name != "")
              {
                  //Auto Rename our image
                  //get the extension of our image(jpg,png,gif,etc) e.g. "specialfood1.jpg"
                  $ext =end(explode('.', $image_name));
                  //rename the image
                  $image_name = "Food_Category_".rand(000,999).'.'.$ext;//e.g. Food_Category_834.jpg
                  $source_path = $_FILES['image']['tmp_name'];
                  $destination_path = "../images/category/".$image_name;
                  //finally upload the image
                $upload = move_uploaded_file($source_path,$destination_path);
                //check whether the image is uploaded or not
                //and if the image is not uploaded then we will stop the process and redirect with error message
                if($upload==false)
                {
                 //set message
                 $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                 //redirect to add category page
                 header('location:'.SITEURL.'admin/add-category.php');
                 //stop the process
                 die();
              }
           }
             
        }
        else{
            //dont upload the image and set the image_name value as blank
            $image_name="";
        }
    
           //2.create sql query to insert category into database
           $sql ="INSERT into tbl_category SET
           title='$title',
           image_name='$image_name',
           featured='$featured',
           active='$active'
           ";
           //3.Execute the query and save in Database
           $res = mysqli_query($conn, $sql);
           //4.Check whether the query executed or not and data added or not
           if($res==true)
           {
               //query executed and category added
               $_SESSION['add']="<div class='sucess'>Category Added Sucessfully. </div>";
               //Redirect to Manage Category Page
               header('location:'.SITEURL.'admin/manage-category.php');
           }
           else
           {
               //Failed to add category
               $_SESSION['add']="<div class='error'>Failed to Add Category. </div>";
               //Redirect to add Category Page
               header('location:'.SITEURL.'admin/add-category.php');

           }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>