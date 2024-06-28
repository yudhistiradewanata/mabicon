<?php if (!empty($newsItems)): ?>
    <div class="row mt-3">
        <?php foreach ($newsItems as $item): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['title'] ?></h5>
                        <small class="text-muted"><?= $item['pubDate'] ?></small>
                        <p class="card-text mt-2"><?= $item['description'] ?></p>
                        <a href="<?= site_url('member/news/view?guid=' . $item['guid']) ?>" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info mt-3">
        No news items available.
    </div>
<?php endif; ?>