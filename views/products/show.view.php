<?php require 'views/partials/header.php' ?>
 <main class="container mt-4">
    <h1>Products</h1>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['title'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Price: <?= $product['price'] ?></h6>
                        <p class="card-text">Description: <?= $product['description'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php require 'views/partials/footer.php' ?>