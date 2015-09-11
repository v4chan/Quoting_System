<?php
class Quotes extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Quoting_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['quotes'] = $this->Quoting_model->get_quotes();
                $data['title'] = 'Receipt';

                $this->load->view('templates/header', $data);
                $this->load->view('quotes/index', $data);
                $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $data['quotes_item'] = $this->Quoting_model->get_quotes($slug);

                if (empty($data['quotes_item']))
                {
                        show_404();
                }

                $this->load->view('templates/header', $data);
                $this->load->view('quotes/view', $data);
                $this->load->view('templates/footer');
        }

        public function front_color_check($temp)
        {
            if ($temp > 6 || $temp < 0) {
                $this->form_validation->set_message('front_color_check','Cannot have more than 6 or less than 0 front colors!');
                return FALSE;
            }
            else {
                return TRUE;
            }
        }

        public function back_color_check($temp)
        {
            if ($temp > 6 || $temp < 0) {
                $this->form_validation->set_message('back_color_check','Cannot have more than 6 or less than 0 back colors!');
                return FALSE;
            }
            else {
                return TRUE;
            }
        }

        public function quantity_check($temp)
        {
            if ($temp <= 0) {
                $this->form_validation->set_message('quantity_check','Quantity Order needs to be greater than 0!');
                return FALSE;
            }
            else {
                return TRUE;
            }
        }

        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Please enter your order information';

            $this->form_validation->set_rules('apparel_type', 'Apparel Type', 'required');
            $this->form_validation->set_rules('apparel_color', 'Apparel Color', 'required');
            $this->form_validation->set_rules('quantity_ordered', 'Quantity Ordered', 'callback_quantity_check');
            $this->form_validation->set_rules('front_colors', 'Number of Front Colors', 'callback_front_color_check');
            $this->form_validation->set_rules('back_colors', 'Number of Back Colors', 'callback_back_color_check');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('quotes/create');
                $this->load->view('templates/footer');

            }
            else
            {
                $this->Quoting_model->set_quotes();
                $this->load->view('templates/header', $data);
                $this->load->view('quotes/success', $data);
                $this->load->view('templates/footer');
            }
        }

}