<?php

namespace App\Helpers;

use Config;
use Mail;

class MailHelper {

    public static $mailTemplate = 'email';

    /**
     * Send the Mails to the User with  data
     *
     * @param array $params
     * @param string $blade
     * @param array $attachments
     * @params string $template
     */
    public static function sendMail($params, $blade, $attachmentPath = array(), $template = '') {

        if (empty($template)) {
            $template = self::$mailTemplate;
        }

        //Mail template
        $templateBlade = $template . '.' . $blade;

        //Send mail to
        $recievers = $params['to'];

        //Email subject
        $subject = $params['subject'];

        //Mail related dynamic data
        $mailInfo = $params['data'];

        //Mail sent from 
        $fromEmail = $params['from'] ?? Config::get('mail.from.address');
        $fromName = $params['from_name'] ?? Config::get('mail.from.address');

        try {
            //Send mail
            Mail::send($templateBlade, ['mailInfo' => $mailInfo], function ($message) use ($fromEmail, $fromName, $recievers, $subject, $attachmentPath) {
                $message->from($fromEmail, $fromName);
                $message->to($recievers);
                $message->subject($subject);

                if (!empty($attachmentPath)) {
                    $message->attach($attachmentPath);
                }
            });

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Send Error mail to admin.
     * 
     * @param object $exception
     * @return boolean false
     * @author LY
     */
    public static function errorMail($exception) {

        $params = array();
        
        $params['to'] = 'preeti.gupta@daffodilsw.com';
        $params['subject'] = "Cardesta: Error Detail";
        $params['data'] = array();
        $params['data']['error'] = "[".Date('Y-m-d h:i:s')."] [".$exception->getFile()."] [(".$exception->getMessage().") at line number ". $exception->getLine() ."]";
        
        $request = Request();
        $requestData = $request->all();
        
        $requestString = json_encode($requestData);
        
        //Save Error stack to file
        Storage::put('error.txt', "RequestData:- \n".$requestString."\n\nApp:-\n".env('APP_URL')." \n\nStack Trace:-\n".$exception->getTraceAsString());
        
        $path = storage_path().'/app/error.txt';
        
        //Send error email
        Self::sendMail($params, 'error', $path);
    }

}
