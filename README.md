# OctoberCMS Simple Contact Form Plugin
This is a simple contact form that allows client or web visitors to send email to the website owner. It is work in progress and is available with no warranty .

## Getting Started


*  To use this plugin just upload to the plugins folder in OctoberCMS.
*  Add the contactform component to the contact form page

```
{% component 'contactform' %}
```
For now to use this plugin you have to do some hacking to send email by editing ContactForm.php

```

 Mail::send('chanansys.contactform::mail.message', $vars, function($message) {

            $message->to('email@example.com', 'Online Enquiry / Customer Support');
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
                <h4>John Doe Ltd.</h4>
            </div>'];
        }
```

### Prerequisites

Working OctoberCMS installation.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
