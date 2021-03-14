
<?php 
session_start();
include 'include/connection.php';
include 'include/header.php';
//

   
     if(!isset($_SESSION['id'])){
        echo"<div class='alert alert-danger '>". 'لا توجد لديك صلاحيه للعبور '."</div>";
        header('REFRESH:2;URL=login.php');
     }
     else{
         
     

?>


    <!--Start content-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4> لوحه التحكم </h4>
                    <ul>
                        <li>
                            <a href="">
                                <span><i class="fas fa-tags"></i></span>
                                <span> التصنيفات</span>
                            </a>
                        </li>
                        <!--Articals-->

                        <li data-bs-toggle="collapse" data-bs-target="#menu">
                            <a href="#">
                                <span><i class="far fa-newspaper"></i></span>
                                <span> المقالات </span>
                            </a>
                        </li>
                        <ul class="collapse" id="menu">
                            <li>
                                <a href="newPost.php">
                                    <span><i class="fas fa-edit"></i></span>
                                    <span>مقال جديد </span>
                                </a>
                            </li>
                            <li>
                                <a href="posts.php">
                                    <span><i class="fas fa-th"></i></span>
                                    <span>كل المقالات</span>
                                </a>
                            </li>
                        </ul>
                         <!--End Articals-->
                        <li>
                           
                            <a href="index.php" target="_blank">
                                <span><i class="far fa-window-restore"></i></span>
                                <span> عرض الموقع</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <span><i class="fas fa-sign-out-alt"></i></span>
                                <span> تسجيل الخروج</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10" id="main-area">
                    <div class="add-category">
                <?php 
                
if(isset($_POST['add']))
{
    $cName =$_POST['category'];
    $cAdd =$_POST['add'];
    

    if(empty($cName)){
        echo "<div class='alert alert-danger'>"."حقل التصنيف فارغ"."</div>";
    }
    elseif($cName >100)
    {
        echo "<div class='alert alert-danger'>". " اسم التصنيف كبير جدا "."</div>";

    }
    else {
        $query= "INSERT INTO categories(categoryName) VALUES('$cName')";
        mysqli_query($conn,$query);
        echo  "<div class='alert alert-success'>". " تم اضافه التصنيف". "</div>";
    }
}

                ?>

                    <!-- category form -->

                        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                            <div class="form-group">
                                <label for="category">تصنيف جديد</label>
                            <input type="text" name="category" class="form-control">
                            </div>
                           
                           <span>  <button class=" btn-custom" name="add"><i class="fas fa-plus-circle"></i> اضافه</button>
                           </span>
                        </form>
                    </div>
                 <!-- Display Caegories-->
                 <div class="display-cat mt-5">
                 <!--START DELETE CATEGORT PHP CODE -->
                 <?php 
                                        
                    if(isset($_GET['id'])){ 
                        $id = $_GET['id'];   
                    $query="DELETE FROM categories WHERE id='$id'";
                    $delet= mysqli_query($conn,$query);
                    if(isset($delet)){
                        
                echo"<div class='alert alert-success'>"."تم حذف التصنيف بنجاح"."</div";
                        }
                                
                        }
        
                 ?>
                 <!--END DELETE CATEGORT PHP CODE -->
                <table class="table table-borderd">
                 <tr>
                 <th>رقم الفئه</th>
                 <th>عنوان الفئه</th>
                 <th> تاريخ الاضافه</th>
                 <th>حذف التصنيف</th>
                 </tr>
                 <?php 
                 $query= "SELECT*FROM categories ORDER BY id DESC ";
                 $res=mysqli_query($conn,$query);
                 $no=0;
                 while($row =mysqli_fetch_assoc($res)){
                     $no++;
                     ?>

                    <tr>
                    <td> <?php echo $no;  ?></td>
                    <td> <?php echo $row['categoryName'];  ?></td>
                    <td> <?php echo $row['date'];  ?></td>
                    <td> <a href="categories.php?id=<?php
                    echo $row['id'];?>">

                 <button class="btn btn-danger">حذف التصنيف</button></a> </td>
                  
                    </tr>                     
                     <?php
                 }
                 ?>
                 </table>
                 </div>
                  <!--END Display Caegories-->
                </div>
            </div>
        </div>
    </div>
    <!--End content-->
   <?php 
   }
   ?>
    <?php 
include('include/footer.php');
?>


