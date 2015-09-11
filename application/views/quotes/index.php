<h2><?php echo $title; ?></h2>

<?php foreach ($quotes as $quotes_item): ?>

        <div class="main">
        	<?php echo "Order #{$quotes_item['id']}"; ?><br />
        	<?php echo "Quantity Ordered: {$quotes_item['quantity_ordered']}"; ?><br />
        	<?php echo "Apparel Type: {$quotes_item['apparel_type']}"; ?><br />
        	<?php echo "Apparel Color: {$quotes_item['apparel_color']}"; ?><br />
        	<?php echo "Apparel Price: {$quotes_item['apparel_price']}"; ?><br />
            <?php echo "Number of Front Colors Printed: {$quotes_item['number_of_front_colors_printed']}"; ?><br />
            <?php echo "Front Color Price: {$quotes_item['front_colors_price']}"; ?><br />
            <?php echo "Number of Back Colors Printed: {$quotes_item['number_of_back_colors_printed']}"; ?><br />
            <?php echo "Back Color Price: {$quotes_item['back_colors_price']}"; ?><br />
            <?php echo "Total Apparel and Printing Cost: {$quotes_item['quantity_ordered']} * ({$quotes_item['apparel_price']} + {$quotes_item['front_colors_price']} + {$quotes_item['back_colors_price']}) = {$quotes_item['total_apparel_printing_price']}"; ?><br />
        	<?php echo "Shipping Price: {$quotes_item['shipping_price']}"; ?><br />
        	<?php echo "Total Shipping Price: {$quotes_item['shipping_price']} * {$quotes_item['quantity_ordered']} = {$quotes_item['total_shipping_price']}"; ?><br />
        	<?php echo "Total Apparel, Printing, and Shipping Price: {$quotes_item['total_apparel_printing_price']} + {$quotes_item['total_shipping_price']} = {$quotes_item['total_apparel_printing_shipping_price']}"; ?><br />
        	<?php echo "Sales Compensation: {$quotes_item['sales_compensation']}"; ?><br />
        	<?php echo "Total Apparel, Printing, Shipping, and Sales Price: {$quotes_item['total_apparel_printing_shipping_price']} + {$quotes_item['sales_compensation']} = {$quotes_item['total_apparel_printing_shipping_sales_price']}"; ?><br />
        	<?php echo "Mark Up: {$quotes_item['mark_up']}"; ?><br />
        	<?php echo "Grand Total: {$quotes_item['total_apparel_printing_shipping_sales_price']} + {$quotes_item['mark_up']} = {$quotes_item['grand_total']}"; ?><br />
            <?php echo "Quote Per Price: {$quotes_item['quote_per_price']}"; ?><br />
        </div>
        <br />
        <div><button onclick="location.href='<?php echo base_url();?>index.php/quotes/create'">Create New Order</button></div>

<?php endforeach; ?>