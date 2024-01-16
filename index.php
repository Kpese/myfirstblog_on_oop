<?php require_once"header.php"?>

  <main id="main">
    <section>
      <div class="container">
        <div class="row">

          <div class="col-md-9" data-aos="fade-up">
            <?php 
            $search= null;
            if(isset($_GET["search"]) && $_GET["search"] != ""){
              $search = trim($_GET["search"]);
            }

            $rows = $data->getPost(null, $search, 2);
            foreach ($rows as $row) : ?>
            <!-- <h3 class="category-title">Category: </h3> -->

            <div class="d-md-flex post-entry-2 half">
              <a href="post.php?id=<?php echo $row['id'] ?>" class="me-4 thumbnail">
                <img src="assets/img/<?php echo $row['post_photo'] ?>" alt="" class="img-fluid">
              </a>
              <div>
                <div class="post-meta"><span class="date"><?php echo $row['category'] ?></span> <span class="mx-1">&bullet;</span> <span><?php echo date("M d 'y", strtotime($row['created_at']))?></span></div>
                <h3><a href="post.php?id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></h3>
                <p><?php echo substr($row['description'], 0, 105).'...'  ?></p>
                <div class="d-flex align-items-center author">
                  <div class="photo"><img src="assets/img/<?php echo $row['author_img'] ?>" alt="" class="img-fluid"></div>
                  <div class="name">
                    <h3 class="m-0 p-0"><?php echo $row['author_name'] ?></h3>
                  </div>
                </div>
              </div>
            </div>
              <?php endforeach; ?>
            <!-- <div class="text-start py-4">
              <div class="custom-pagination">
                <a href="#" class="prev">Prevous</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#" class="next">Next</a>
              </div>
            </div> -->
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
                <div class="tab-pane fade show active" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                  <div class="post-entry-1 border-bottom">
                    <?php foreach ($rows as $row) : ?>
                    <div class="post-meta"><span class="date"><?php echo $row['category'] ?></span> <span class="mx-1">&bullet;</span> <span><?php echo date("M d 'y", strtotime($row['created_at'])) ?></span></div>
                    <h2 class="mb-2"><a href="post.php?id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></h2>
                    <span class="author mb-3 d-block"><?php echo $row['author_name'] ?></span>
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

  <?php require_once "footer.php"?>