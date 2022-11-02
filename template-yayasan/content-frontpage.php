<section id="intro" class="d-flex align-items-center" style="aspect-ratio: 22/9;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 mx-auto my-5">
                <h1 class="mb-4">We aim to deliver sustainable impact,
                    <br />improving quality of life across the nation
                </h1>
                <p class="lead">Yayasan PETRONAS is the Corporate Social Responsibility arm of PETRONAS. We will ensure that programmes which have promising outcomes are rolled out nationwide, to deliver sustainable impact and there is shared success for all involved. It will also direct its attention to areas which are currently underserved to deliver measurable impact and accelerate results with its participation.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="cta-video" class="d-flex align-items-center bg-dark text-light" style="aspect-ratio: 22/7; background: url('<?= UPLOAD_DIR_YAYASAN ?>/frontpage-poster-video.jpg') center no-repeat; background-size: cover">
    <div class="col-md-9 mx-auto">
        <h2 class="display-3 my-4 text-light" style="width: min-content">Where Good Flourishes</h2>
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalYoutube" data-video_id="IT_JSMrifZA">
            Watch Video
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalYoutube" tabindex="-1" aria-labelledby="modalYoutubeLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-header border-0 justify-content-end">
                        <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <iframe id="modalYoutube__iframe" class="w-100" style="aspect-ratio: 16/9" src="https://www.youtube-nocookie.com/embed/IT_JSMrifZA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="focus" class="py-5">
    <section class="py-5">
        <div class="col-md-10 mx-auto">
            <h2 class="display-1" style="width: min-content">
                <span>Our</span>
                <span>Primary</span>
                <span>Focus</span>
            </h2>
        </div>
    </section>
    <style>
        h2 span {
            background: url('<?= UPLOAD_DIR_YAYASAN ?>/bg-yayasan_dots2.png') center no-repeat;
            background-size: 100% 100%;
            padding: 0 1rem;
            line-height: 1.3;
            color: #fff;
        }

        h3 span {
            background: url('<?= UPLOAD_DIR_YAYASAN ?>/bg-yayasan_dots2.png') center no-repeat;
            background-size: 100% 100%;
            padding: 0.5rem 1rem;
            line-height: 1.1;
            display: block;
            color: #fff;
        }
    </style>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <img src="<?= UPLOAD_DIR_YAYASAN ?>/frontpage-focus1.jpg" alt="" style="aspect-ratio: 2/1; object-fit: cover; width: 100%">
                </div>
                <div class="col-md-4 d-flex flex-column align-items-start justify-content-center">
                    <h3 class="h1"><span>Education</span></h3>
                    <p>In order to improve the standard of living for more Malaysians and prepare them to face the challenges of the future, Yayasan PETRONAS delivers several programmes for teachers and students alike.</p>
                    <a href="<?= get_site_url() ?>/focus-area/education/" class="btn px-0 border-0">Find Out More ></a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-lg-2">
                    <img src="<?= UPLOAD_DIR_YAYASAN ?>/frontpage-focus2.jpg" alt="" style="aspect-ratio: 2/1; object-fit: cover; width: 100%">
                </div>
                <div class="col-md-4 d-flex flex-column align-items-start justify-content-center">
                    <h3 class="h1"><span>Community Well-being & Development</span></h3>
                    <p>We believe that social progress is inclusive and everyone can enjoy a better quality of life. Yayasan PETRONAS delivers several programmes to address a variety of immediate and long term community issues.</p>
                    <a href="<?= get_site_url() ?>/focus-area/community/" class="btn px-0 border-0">Find Out More ></a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <img src="<?= UPLOAD_DIR_YAYASAN ?>/frontpage-focus3.jpg" alt="" style="aspect-ratio: 2/1; object-fit: cover; width: 100%">
                </div>
                <div class="col-md-4 d-flex flex-column align-items-start justify-content-center">
                    <h3 class="h1"><span>Environment</span></h3>
                    <p>From marine to mangrove, shores to rivers, we want to work to conserve natural resources for the well-being of current and future generations. In restoring the abundant favours from nature, PETRONAS has invested close to RM100 million to restore the lands, the seas and the coasts.</p>
                    <a href="<?= get_site_url() ?>/focus-area/environment/" class="btn px-0 border-0">Find Out More ></a>
                </div>
            </div>
        </div>
    </section>
</section>