<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterManagerController extends Controller
{
    protected $mailchimp;
    protected $listId = '753157867b';        // Id of newsletter list

    /**
     * Pull the Mailchimp-instance from the IoC-container.
     */
    public function __construct(\Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Access the mailchimp lists API
     * for more info check "https://apidocs.mailchimp.com/api/2.0/lists/subscribe.php"
     */
    public function addEmailToList(Request $request)
    {
        try {

            $email=$request->input('email');
            $this->mailchimp
                ->lists
                ->subscribe(
                    $this->listId,
                    ['email' =>$email ]
                );

            return back()->with('status','Gracias por suscribirte');
        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            return back()->with('status',$e->getMessage());
        } catch (\Mailchimp_Error $e) {
            return back()->with('status',$e->getMessage());
        }
    }
}
