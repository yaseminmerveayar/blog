<div id="aboutMe" class="container pt-5">
    <div class="row py-4 mb-2">
        <?php

        $q = $db -> prepare("SELECT value FROM homeContents where key = :key");
        $q->execute(array('key'=>'aboutMe'));

        $result = $q->fetch();
        $a =explode("','","$result[0]");

        echo"<div class='col-md-7 order-2'>
        <div class='overflow-hidden'>
            <h2 class='text-color-dark font-weight-bold text-12 mb-2 pt-0 mt-0 appear-animation' data-appear-animation='maskUp' data-appear-animation-delay='300'>".$a[0]."</h2>
        </div>
        <div class='overflow-hidden mb-3'>
            <p class='font-weight-bold text-primary text-uppercase mb-0 appear-animation' data-appear-animation='maskUp' data-appear-animation-delay='500'>".$a[1]."</p>
        </div>
        <p class='lead appear-animation' data-appear-animation='fadeInUpShorter' data-appear-animation-delay='700'>".$a[2]."</p>
        <p class='pb-3 appear-animation' data-appear-animation='fadeInUpShorter' data-appear-animation-delay='800'>".$a[3]."</p>
        <hr class='solid my-4 appear-animation' data-appear-animation='fadeInUpShorter' data-appear-animation-delay='900'>
        <div class='row align-items-center appear-animation' data-appear-animation='fadeInUpShorter' data-appear-animation-delay='1000'>
            <div class='col-lg-6'>
                <a href='admin/".$a[5]."' class='btn btn-modern btn-primary mt-3' download=''>Download CV</a>

            </div>
            <div class='col-sm-6 text-lg-end my-4 my-lg-0'>
                <strong class='text-uppercase text-1 me-3 text-dark'>follow me</strong>
                <ul class='social-icons float-lg-end'>
                    <li class='social-icons-facebook'><a href='https://github.com/yaseminmerveayar' target='_blank' title='Github'><i class='fa-brands fa-github'></i></a></li>
                    <li class='social-icons-linkedin'><a href='https://www.linkedin.com/in/yasemin-merve-ayar/' target='_blank' title='Linkedin'><i class='fab fa-linkedin-in'></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class='col-md-5 order-md-2 mb-4 mb-lg-0 appear-animation' data-appear-animation='fadeInRightShorter'>
        <img src='admin/".$a[4]."' class='img-fluid mb-2' alt=''>
    </div>";
        
        ?>
    </div>
</div>