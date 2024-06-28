<div class="card mt-3">
    <div class="card-header">
        <div class="card-title"><b><?= $newsItem['title'] ?></b></div>
        <div class="float-right"><?= $newsItem['pubDate'] ?></div>
    </div>
    <div class="card-body">
        <!-- <h5 class="card-title"></h5> -->
        <p class="card-text"><?= $newsItem['description'] ?></p>
        <a href="<?= $newsItem['link'] ?>" class="btn btn-primary" target="_blank">Read more</a>
    </div>
</div>