
<?php 
include 'include/connection.php';
include 'public/header.php';
?>
<!-- start content-->
<div class="content" >
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <?php 

            //GET ID POST
          $id=$_GET['id'];  
          $query="SELECT * FROM posts WHERE id='$id' ";
          
         $result= mysqli_query($conn,$query);
         $row=mysqli_fetch_assoc($result); 
           ?>

           
        
        <!--Stard Div posts-->
        <div class="post">
          <div class="post-image">
       <a href="post.php?id=<?php echo$row['id']; ?>"> <img class="img-responsive" src="upload/<?php echo$row['postImage']; ?>" ></img></a>
          </div>
          <div class="post-title">
            <h4><a href="post.php?id=<?php echo$row['id']; ?>"> <?php echo$row['postTitel'] ?> </a></h4>
        </div>
          <div class="post-details">
            <p class="post-info">
              <span><i class="fas fa-user">    </i> <?php echo$row['postAuthor']; ?></span>
              <span> <i class="far fa-calendar-alt"></i> <?php echo$row['postDate']; ?> </span>
              <span><i class="fas fa-tags"></i> <?php echo$row['postCat']; ?>  </span>
            </p>
            <p class="post-content">
             <?php echo$row['postContent'];?>
            </p>
             
            
          </div>
          
        </div>
       <!--end Div posts-->
      </div>
      <div class="col-md-3">
        <!-- Categories -->
        <div class="categories">
          <h4> التصنيفات </h4>

          <ul>
           
           <?php 
            $query="SELECT * FROM categories ORDER BY id";
            $result=mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($result)){
              ?>
            
            <li>
              <a href="category.php?category=<?php echo $row['categoryName'];?>">
                <span> <i class="fas fa-tags"></i></span>
                <span><?php echo $row['categoryName'];?></span>
              </a>
            </li>
            <?php
          }
           ?>
          </ul>
        </div>
        <!--End Categorys-->

        <!--Start Last Posts-->
        <div class="last_posts">
          <h4>أحدث المنشورات </h4>

          <ul>

          <?php 
            $query="SELECT * FROM posts ORDER BY id DESC  LIMIT 5";
            $result=mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($result)){
              ?>
            <li>
              <a href="post.php?id=<?php echo $row['id']; ?>">
                <span class="span-image"><img src="upload/<?php echo$row['postImage'] ?>" alt="img1" style="width: 80px; height: 60px" ></span>
                <span> <?php echo$row['postTitel']; ?>  </span>
                
              </a>
            </li>
           
          <?php 
            }
          ?>
          </ul>
        </div>
        <!--End Last Posts-->


      </div>
    </div>
  </div>
</div>
<!-- end content-->

<?php 
include 'public/footer.php';
?>
