<main class="container mt-4">
    <h1>Create a new Product</h1>
    <form action="/products" method="post">
        <input type="hidden" name="_method" value="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>  
            <input type="text" class="form-control" name="price">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>  
            <input type="text" class="form-control" name="description">
        </div>  
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>