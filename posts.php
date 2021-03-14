<?php 
include 'include/connection.php';
include 'include/header.php';



             
                      

?>

<div class="content">
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

               <!-- Display all posts -->
               
              <div class="display-posts mt-5">
                <!--START DELETE POSTS PHP CODE -->
                <?php 
                                                        
                if(isset($_GET['id'])){ 
                    $id = $_GET['id'];   
                    $query="DELETE FROM posts WHERE id='$id'";
                $delete= mysqli_query($conn,$query);
                if(isset($delete)){                          
                    echo"<div class='alert alert-success'>"."تم حذف المقال بنجاح"."</div";
                    }
                
                                                        
                }
                ?>
                <!--END DELETE posts PHP CODE -->
              <table class="table table-borderd">
                   <tr>
                   <th> رقم المقال</th>
                   <th> عنوان المقال</th>
                   <th> كاتب المقال</th>
                   <th> صوره المقال</th>
                   <th> تاريخ المقال</th>
                    <th>حذف المقال </th>
                   </tr>

                <?php
                $query="SELECT * FROM posts ORDER BY id DESC";
                $res=mysqli_query($conn,$query);
                $no=0;
                while($row = mysqli_fetch_assoc($res)){
                    $no++;
                    ?>

                   <tr>
                   <td><?php echo $no;?></td>
                   <td><?php echo$row['postTitel'];?></td>
                   <td><?php echo$row['postAuthor'];?></td>
                   <td><img src="upload/<?php echo$row['postImage'];?>"width="60px" height="50px" ></td>
                   <td><?php echo$row['postDate'];?></td>
                   <td><a href="posts.php?id=<?php
                           echo $row['id']; ?>">
                               <button class="btn btn-danger">حذف المقال</button></a> 
                       </td>
                   </tr>



                    <?php
                }
                ?>
                  </table>
              </div>
                    <!-- end Display all posts -->
               
                </div>
            </div>
        </div>
    </div>

<?php 

include 'include/footer.php';
?>