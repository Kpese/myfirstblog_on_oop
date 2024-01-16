<?php require_once "header.php"?>
  <main id="main">
    <section>
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-12 text-center mb-5">
          <?php 
        $cat_id = null;
        if (isset($_GET["id"])) {
          $cat_id = $_GET["id"];
        }

        $search= null;
        if(isset($_GET["search"]) && $_GET["search"] != ""){
          $search = trim($_GET["search"]);
        }
        
        $rows = $data->getPost(null, $search, null, $cat_id);
        
        foreach ($rows as $row) : ?>
            <h1 class="page-title"><?php echo $row['category'] ?></h1>
          </div>
        </div>

        <div class="row mb-5">
        
          <div class="d-md-flex post-entry-2 half">
            <a href="post.php?id=<?php echo $row['id'] ?>" class="me-4 thumbnail">
              <img src="assets/img/<?php echo $row['post_photo'] ?>" alt="" class="img-fluid">
            </a>
            <div class="ps-md-5 mt-4 mt-md-0">
              <div class="post-meta mt-4"><?php echo $row['category']?></div>
              <h2 class="mb-4 display-4"><a href="post.php?id=<?php echo $row['id'] ?>"><?php echo $row['title']?> </a></h2>
              <?php echo substr($row['description'], 0, 135).'...'  ?>
               </div>
          </div>
<?php endforeach; ?>
        </div>

      </div>
    </section>



  </main><!-- End #main -->
<?php require_once "footer.php" ?>