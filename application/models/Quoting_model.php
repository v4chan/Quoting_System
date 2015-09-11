<?php
class Quoting_model extends CI_Model {

        public function __construct()
        {
        	$this->load->database();
        }

		public function get_quotes()
		{

            $query = $this->db->query('SELECT * from input_data ORDER BY id DESC LIMIT 1');
            return $query->result_array();

		}

		// find apparel price
		public function find_apparel_price($type,$color)
		{
		    $query = $this->db->get_where('apparel_data', array('Garment' => $type));
		    $row = $query->row_array();
		    if ($color == "White") {
		    	return $row['Price_white'];
		    }
		    else {
		    	return $row['Price_Color'];
		    }
		}

		// find front and back colors printed price
		public function find_printer_price($colors,$position) {
			$num_colors = $colors;
			$quantity_list = array(12, 24, 36, 48, 72, 144, 288, 500, 1000, 2500, 5000);
			$diff = abs($quantity_list[0]-$colors);
			for ($i = 1; $i < count($quantity_list); $i++)
		   	{
		   		$temp = abs($quantity_list[$i]-$colors);
		   		if ($temp <= $diff) { 
		   			$diff = $temp;
		   			$num_colors = $quantity_list[$i];
		   		}
		   	}
		   	$query = $this->db->get_where('Printer_Pricing', array('Pricing_List' => $num_colors));
		    $row = $query->row_array();
		    return $row[$position];
		}

		// find shipping cost
		public function find_shipping_cost($quantity,$type)
		{
			$query = $this->db->get_where('apparel_data', array('Garment' => $type));
			$row = $query->row_array();
			$shipping = $row['Shipping'];
			if ($shipping == 1)
			{
				if ($quantity < 48) {
					return 1;
				}
				else {
					return 0.75;
				}
			}
			else {
				if ($quantity < 48) {
					return 0.5;
				}
				else {
					return 0.25;
				}
			}
		}

		public function set_quotes()
		{
		    $this->load->helper('url');

		    // find apparel price
		    $apparel_type = $this->input->post('apparel_type');
		    $apparel_color = $this->input->post('apparel_color');
		    $apparel_price = $this->find_apparel_price($apparel_type,$apparel_color);

		    // find front and back color printed price
		    $quantity_ordered = $this->input->post('quantity_ordered');
			$front_colors = $this->input->post('front_colors');
			if ($front_colors == 0) {
				$front_price = 0;
			}
			elseif ($quantity_ordered <= 12)
		   	{
		   		$query = $this->db->get_where('Printer_Pricing', array('Pricing_List' => 12));
			    $row = $query->row_array();
			    $front_price = $row[$front_colors];
		   	}
		   	else {
		   		$front_price = $this->find_printer_price($quantity_ordered,$front_colors);
		   	}
			$back_colors = $this->input->post('back_colors');
			if ($back_colors == 0) {
				$back_price = 0;
			}
			elseif ($quantity_ordered <= 12)
		   	{
		   		$query = $this->db->get_where('Printer_Pricing', array('Pricing_List' => 12));
			    $row = $query->row_array();
			    $back_price = $row[$back_colors];
		   	}
		   	else {
		   		$back_price = $this->find_printer_price($quantity_ordered,$back_colors);
		   	}

		   	// find cost for apparel and printing
		   	$total_apparel_printing_price = number_format($quantity_ordered * ($apparel_price + $front_price + $back_price), 2, '.', '');

		   	// find shipping cost
		   	$shipping_cost = $this->find_shipping_cost($quantity_ordered,$apparel_type);
		   	$total_shipping_price = $shipping_cost * $quantity_ordered;
		   	
		   	// total apparel, printing, and shipping cost
		   	$total_apparel_printing_shipping_price = $total_apparel_printing_price + $total_shipping_price;

		   	// sales compensation
		   	$sales_compensation = number_format($total_apparel_printing_shipping_price * 0.07, 2, '.', '');

		   	// total apparel, printing, shipping, and sales cost
		   	$total_apparel_printing_shipping_sales_price = $total_apparel_printing_shipping_price + $sales_compensation;

		   	// mark up
		   	if ($total_apparel_printing_shipping_sales_price < 800) {
		   		$mark_up = number_format($total_apparel_printing_shipping_sales_price * 0.5, 2, '.', '');
		   	}
		   	else {
		   		$mark_up = number_format($total_apparel_printing_shipping_sales_price * 0.45, 2, '.', '');
		   	}

		   	// grand total
		   	$grand_total = number_format($total_apparel_printing_shipping_sales_price + $mark_up, 2, '.', '');

		   	// quote per price
		   	$quote_per_price = number_format($grand_total/$quantity_ordered, 2, '.', '');

		    $data = array(
		    	'quantity_ordered' => $quantity_ordered,
		        'apparel_type' => $apparel_type,
		        'apparel_color' => $apparel_color,
		        'apparel_price' => $apparel_price,
		        'number_of_front_colors_printed' => $front_colors,
		        'front_colors_price' => $front_price,
		        'number_of_back_colors_printed' => $back_colors,
		        'back_colors_price' => $back_price,
		        'total_apparel_printing_price' => $total_apparel_printing_price,
		        'shipping_price' => $shipping_cost,
		        'total_shipping_price' => $total_shipping_price,
		        'total_apparel_printing_shipping_price' => $total_apparel_printing_shipping_price,
		        'sales_compensation' => $sales_compensation,
		        'total_apparel_printing_shipping_sales_price' => $total_apparel_printing_shipping_sales_price,
		        'mark_up' => $mark_up,
		        'grand_total' => $grand_total,
		        'quote_per_price' => $quote_per_price
		    );

		    return $this->db->insert('input_data', $data);
		
		}

}