<div class="row">
    <?php
        $sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT 4";
        $res = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($res)){
    ?>
    <div class="col-sm-6 col-md-3 col-lg-3">
        <a href="description.php?ID=<?php echo $row['product_id']; ?>">
            <div class="book-block">
                <div class="tag">New</div>
                <div class="tag-side"><img src="img/tag.png"></div>
                <img class="book block-center img-responsive" src="./<?php echo $row['image'];?>">
                <hr>
                <?php echo $row['Title']; ?> <br>
                <?php echo $row['Price']; ?>  &nbsp
                <span style="text-decoration:line-through;color:#828282;"> <?php echo $row['MRP']; ?> </span>
                <span class="label label-warning"><?php echo $row['Discount']; ?>%</span>
            </div>
        </a>
    </div>
    
    <?php
        }
    ?>
</div>