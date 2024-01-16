<?php require_once "header.php" ?>


<?php

// FOR COMMENTS
if (isset($_POST["submit"])) {
  $message = $_POST['message'];
  $name = $_POST['name'];
  $post_id = $_GET['id'];
  $data->setComment($post_id, $name, $message);
}


//FOR GETTING THE SINGLE POST
// $rows = $data->getPost($_GET['id'], null)[0] ?? header('location: ./');
if (isset($_GET["id"]) && $_GET["id"] > 0) {
  $rows = $data->getPost($_GET['id'])[0];
 
} else {
  header('location: ./');
}


?>

<main id="main">

  <section class="single-post-content">
    <div class="container">
      <div class="row">
        <div class="col-md-9 post-content" data-aos="fade-up">

          <!-- ======= Single Post Content ======= -->
          <div class="single-post">
            <div class="post-meta"><span class="date">
                <?php echo $rows['category'] ?>
              </span> <span class="mx-1">&bullet;</span> <span>
                <?php echo date("M d 'y", strtotime($rows['created_at'])) ?>
              </span></div>
            <h1 class="mb-5">
              <?php echo $rows['title'] ?>
            </h1>
            <figure class="my-4">
              <img src="assets/img/<?php echo $rows['post_photo'] ?>" alt="" class="img-fluid">
              <figcaption>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, odit? </figcaption>
            </figure>
            <p>
              <?php echo nl2br($rows['description']) ?>
            </p>
          </div><!-- End Single Post Content -->

          <!-- ======= Comments ======= -->
          <div class="comments">
            <h5 class="comment-title py-4">
              <?php echo $data->commentCode() ?> Comments
            </h5>
            <?php
            $res = $data->getComment();
            foreach ($res as $row): ?>
              <div class="comment d-flex mb-4">
                <div class="flex-shrink-0">
                </div>
                <div class="flex-grow-1 ms-2 ms-sm-3">
                  <div class="comment-meta d-flex align-items-baseline">
                    <h6 class="me-2">
                      <?php echo $row['comment_name'] ?>
                    </h6>
                    <span class="text-muted">
                      <?php echo date('M d Y', strtotime($row['created_at'])) ?>
                    </span>
                  </div>
                  <div class="comment-body">
                    <?php echo $row['comment_message'] ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div><!-- End Comments -->

          <!-- ======= Comments Form ======= -->
          <div class="row justify-content-center mt-5">

            <div class="col-lg-12">
              <h5 class="comment-title">Leave a Comment</h5>
              <form action="" method="POST">
                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <label for="comment-name">Name</label>
                    <input type="text" name="name" class="form-control" placeholder=" Enter your name">
                  </div>
                  <div class="col-12 mb-3">
                    <label for="comment-message">Message</label>

                    <textarea class="form-control" name="message" placeholder="Enter your name" cols="30"
                      rows="10"></textarea>
                  </div>
                  <div class="col-12">
                    <input type="submit" name="submit" class="btn btn-primary" value="Post comment">
                  </div>
                </div>
              </form>
            </div>
          </div><!-- End Comments Form -->

        </div>
        <div class="col-md-3">
          <!-- ======= Sidebar ======= -->
          <div class="aside-block">

            <ul class="nav nav-pills custom-tab-nav mb-4">
              <li class="nav-item" role="presentation">
                <button class="nav-link active">Latest</button>
              </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">

              <!-- latest -->
              <div class="tab-pane fade show active" id="pills-latest" role="tabpanel"
                aria-labelledby="pills-latest-tab">
                <div class="post-entry-1 border-bottom">
                  <?php 
                   $search= null;
                   if(isset($_GET["search"]) && $_GET["search"] != ""){
                     $search = trim($_GET["search"]);
                   }
                  $rows= $data->getPost(null, $search, null);
                  foreach ($rows as $row): ?>
                    <div class="post-meta"><span class="date">
                        <?php echo $row['category'] ?>
                      </span> <span class="mx-1">&bullet;</span> <span>
                        <?php echo date("M d 'y", strtotime($row['created_at'])) ?>
                      </span></div>
                    <h2 class="mb-2"><a href="post.php?id=<?php echo $row['id'] ?>">
                        <?php echo $row['title'] ?>
                      </a></h2>
                    <span class="author mb-3 d-block">
                      <?php echo $row['author_name'] ?>
                    </span>
                  <?php endforeach; ?>
                </div>
              </div> <!-- End Latest -->

            </div>
          </div>
          <div class="aside-block">
              <h3 class="aside-title">Categories</h3>
              <ul class="aside-links list-unstyled">
                <?php 
                $category = $data->getCategory();
                foreach ($category as $cat) : ?>
                <li><a href="about.php?id=<?php echo $cat['id'] ?>"><i class="bi bi-chevron-right"></i><?php echo $cat['category_name']?></a></li>
                <?php endforeach; ?>
              </ul>
            </div><!-- End Categories -->

            <div class="aside-block">
              <h3 class="aside-title">Tags</h3>
              <ul class="aside-tags list-unstyled">
              <?php 
                $tags = $data->getTags();
                foreach ($tags as $tag) : ?>
                <li><a href="about.php?id=<?php echo $tag['id'] ?>"><?php echo $tag['tag_name']?></a></li>
                <?php endforeach; ?>
              </ul>
            </div><!-- End Tags -->
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require_once "footer.php" ?>