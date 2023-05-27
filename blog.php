<style>
.filterDiv {
  display: none;
}

.show {
  display: block;
}</style>

<section id="blog" class="section section-height-2 border-0 m-0 appear-animation" data-appear-animation="fadeIn">
    <div class="container">
        <div class="row mb-2">
            <div class="col">
                <div class="overflow-hidden">
                    <h2 class="text-color-primary font-weight-semibold text-3 line-height-7 positive-ls-2 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">RECENT POSTS</h2>
                </div>
                <div class="overflow-hidden mb-4">
                    <h3 class="text-color-dark font-weight-bold text-transform-none line-height-3 text-10 pe-1 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="400">My Blog</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mb-3">
                <div class="col pt-2 text-center text-lg-start text-center overflow-hidden">
                    <h3 class="text-3 text-dark m-0 font-weight-bold d-inline-block pe-4 mb-3" data-appear-animation="maskUp" data-appear-animation-delay="600">BROWSE ALL CATEGORIES:</h3>
                    <div class="d-inline-block ">
                    <?php
                        $d = $db -> prepare("SELECT * FROM blogCategories");
                        $d->execute();

                        $cResults = $d->fetchAll();

                        if (isset($cResults[0])) {
                            foreach($cResults as $cat){

                                echo '<button onclick="filterSelection(`'.$cat['filterId'].'`)" class="btn py-3 px-4 text-1 text-dark btn-light bg-transparent text-uppercase font-weight-bold me-2 mb-2" data-appear-animation="maskUp" data-appear-animation-delay="600">'.$cat['categoryName'].'</button>';
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row">
                <div class="col">
                    <div class="blog-posts overflow-hidden">
                        <div class="row">
                        <?php
                            $q = $db -> prepare("SELECT * FROM blogContents");
                            $q->execute();

                            $results = $q->fetchAll();

                            if (isset($results[0])) {
                                foreach($results as $key){

                                    $d = $db -> prepare("SELECT * FROM blogCategories WHERE id=?");
                                    $d->execute([$key['categoryId']]);
                                    $cResult = $d->fetch();

                                    $a =explode(">","$key[3]");
                                    $safeText = htmlspecialchars($a[1], ENT_QUOTES, 'UTF-8');
                                    $desc = substr($safeText, 0 , 105);

                                    $title = substr($key['title'], 0 , 25);

                                    echo "<div class='col-md-4 filterDiv ".$cResult['filterId']."'>
                                    <article>
                                        <div class='card border-0 border-radius-0 p-1' >
                                            <div class='card-body p-3 z-index-1'>
                                                <a href='blog-post.php?id=".$key['id']."' class='d-block opacity-hover-8'>
                                                    <img class='card-img-top border-radius-0 mb-2' width='352' height='180' src='admin/".$key['imagePath']."' alt='Card Image'>
                                                </a>
                                                <p class='text-uppercase text-color-default text-1 my-2 pb-1'>
                                                    <time pubdate datetime='2022-01-10'>".$key['date']."</time> 
                                                    <span class='opacity-3 d-inline-block px-2'>|</span> 
                                                    ".$key['author']."
                                                    <span class='opacity-3 d-inline-block px-2'>|</span> 
                                                    ".$cResult['categoryName']."
                                                </p>
                                                <div class='card-body p-0'>
                                                    <h4 class='card-title text-5 font-weight-bold pb-2 mb-2'><a class='text-color-dark text-color-hover-primary text-decoration-none' href='blog-post.php?id=".$key['id']."'>".$title."</a></h4>
                                                    <p class='card-text mb-2'>".$desc."...</p>
                                                    <a href='blog-post.php?id=".$key['id']."' class='btn btn-link font-weight-semibold text-decoration-none text-2 ps-0 pb-1 mb-2'>VIEW MORE</a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>";
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="blogFilter.js"></script>