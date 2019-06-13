<?php namespace Chanansys\ContactForm\Components;

use Cms\Classes\ComponentBase;
use Input;
use Mail;
use Validator;
use Redirect;

class ContactForm extends ComponentBase{

public function componentDetails(){

    return [
        'name' => 'Contact Form',
        'description' => 'Simple Contact Form'
    ];

}

public function onSend(){

    $validator = Validator::make(
        [
            'name' => Input::get('name'),
            'surname' => Input::get('surname'),
            'phone' => Input::get('phone'),
            'company' => Input::get('company'),
            'email' => Input::get('email'),
            'content' => Input::get('comments'),
        ],
        [
            'name' => 'required|min:3|max:30|string',
            'surname' => 'required|min:3|max:30|string',
            'phone' => 'required|min:10|numeric',
            'company' => 'sometimes|string|max:64',
            'email' => 'required|email',
            'content' => 'required|string|min:20',
        ]
    );


    if ($validator->fails()) {

        return Redirect::back()->withErrors($validator);

    }
    else{

        // These variables are available inside the message as Twig
        $vars = [
            'name' => Input::get('name'),
            'surname' => Input::get('surname'),
            'phone' => Input::get('phone'),
            'company' => Input::get('company'),
            'email' => Input::get('email'),
            'content' => Input::get('comments'),
        ];

        Mail::send('chanansys.contactform::mail.message', $vars, function($message) {

            $message->to('enquiries@mofaasacco.co.ke', 'Online Enquiry / Customer Support');
            $message->subject('Online Enquiry / Customer Support');

        });

        // Handle Erros
        if (count(Mail::failures()) > 0) {

            // Handle Failure
            return ['#result-wrapper' => '<div class="jumbotron contact-sent">
                <h3>Whoops something is wrong... mail not sent. Kindly call us.</h3>
            </div>'];

        } else {
            // Mail sent
            return ['#result-wrapper' => '<div class="jumbotron contact-sent">
                <h4>Mail sent, someone will get back to you soon. Thank you</h4>
                <h4>Mofaa Sacco Management Ltd.</h4>
            </div>'];
        }
    }
}



}