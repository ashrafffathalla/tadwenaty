
<?php 
include 'include/connection.php';
include 'include/header.php';


?>



    <!--Start content-->
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4> لوحه التحكم </h4>
                    <ul>
                        <li>
                            <a href="categories.php">
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
                                <a href="newPost.html">
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
                    <button class="btn-custom"> مقال جديد</button>
                    <div class="add-category">

                    <?php 
                    
                        //start
if(isset($_POST['add'])){
    
    $pTitel=$_POST['titel'];
    $pCat=$_POST['category'];
    
    $pContent=$_POST['content'];
    $pAuthor="اشرف فتح الله ";
    $pAdd=$_POST['add'];
    
                        //img 
    $imageName= $_FILES['postImage']['name'];
    $imageTmp= $_FILES['postImage']['tmp_name'];
    
        if(empty($pTitel)||empty($pContent)){
            echo "<div class='alert alert-danger'>". "الرجاء ملئ الحقول كامله "."</div>";
        }
        elseif($pContent >10000 ){
            echo "<div class='alert alert-danger'>". "محتوي المنشور كبير "."</div>";
    
        }
        else{
            $postImage=rand(0,1000)."_".$imageName;
            move_uploaded_file($imageTmp,"upload\\".$postImage);
    
            $query="INSERT INTO posts(postTitel,postCat,postImage,postContent,postAuthor) 
            VALUES('$pTitel', '$pCat', '$postImage', '$pContent', '$pAuthor')";
           $res=mysqli_query($conn,$query);
    
           if(isset($res)){
               echo "<div class='alert alert-success'>". "تمت اضافه المنشور بنجاح "."</div>";
    
           }
           
           else {
            echo "<div class='alert alert-danger'>"."هناك خطأ ما"."</div>";
           } 
        
    }
    }
    //// END php
                    
                    ?>
                        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="titel" style="margin-bottom:2px;">عنوان المقال </label>
                            <input type="text" name="titel" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="cate" style="margin-bottom:2px;">التصنيف </label>
                            <select name="category" id="cate" class="form-control">
                                <?php 
                                
                                $query="SELECT * FROM categories";
                                $res= mysqli_query($conn,$query);
                                while($row=mysqli_fetch_assoc($res)){
                                    ?>
                                    <option>
                                    
                                    <?php 
                                    echo $row['categoryName'];
                                    ?>

                                    </option>
                                    <?php

                                }

                                ?>
                            </select>
                            </div>

                            <!--  start ADD img 4 Post-->
                            <div class="form-group">
                                <label for="image">صوره المقال </label>
                                <input type="file" id="image" class="form-control" name="postImage" >
                            </div>
                            <div class="form-group">
                                <label for="content">نص المقال </label>
                                <textarea name="content" id="" cols="30" rows="15" class="form-control"></textarea>
                            </div>
                           <!--end ADD img 4 Post-->
                            <button class=" btn-custom" name="add">  نشر المقاله</button>
                         
                        </form>
                    </div>
                 
                </div>




   <!-- jquery & Bootstrab.js-->
   <script src="js/jquery-3.5.1.min.js"></script>

   <!-- font Awesome-->
   <script src="https://kit.fontawesome.com/1910d71ae0.js" crossorigin="anonymous"></script>
   <!-- end font awesom-->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>