<?php 

class ContactController extends Controller{

    function index(){
        $this->renderView('customer/layout', [
            'title' => 'Contact',
            'views' => 'customer/contact/contact-form'
        ]);
    }
}