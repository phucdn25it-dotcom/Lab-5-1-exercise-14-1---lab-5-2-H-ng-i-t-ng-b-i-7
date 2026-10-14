<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
        <?php foreach ($categories as $category) : ?>
            <li>
            <a href="?category_id=<?php echo $category->getID(); ?>">
                <?php echo $category->getName(); ?>
            </a>
            </li>
        <?php endforeach; ?>
        </ul>
        </nav>
    </aside>
    <section>
        <!-- display a table of products -->
        <h2><?php echo $current_category->getName(); ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product->getCode(); ?></td>
                <td><?php echo $product->getName(); ?></td>
                <td class="right"><?php echo $product->getPriceFormatted(); ?>
                </td>
                <td class="product_actions"><a class="button-link" href="?action=show_edit_form&amp;product_id=<?php echo $product->getID(); ?>">Edit</a>
                    <form class="delete_product_form" action="." method="post"
                          id="delete_product_form">
                    <input type="hidden" name="action"
                           value="delete_product">
                    <input type="hidden" name="product_id"
                           value="<?php echo $product->getID(); ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $current_category->getID(); ?>">
                    <input class="button-danger" type="submit" value="Delete" onclick="return confirm('Delete this product?');">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p class="page_actions"><a class="button-link" href="?action=show_add_form">Add Product</a></p>
        <p class="page_links"><a href="../index.php">Back to Main Menu</a>
           <span aria-hidden="true">·</span>
           <a href="../product_catalog/">Open Product Catalog</a></p>
    </section>
</main>
<?php include '../view/footer.php'; ?>
