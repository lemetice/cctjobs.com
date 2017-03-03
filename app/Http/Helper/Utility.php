<?php namespace App\Http\Helper;
//use Eventviva\ImageResize;
use Illuminate\Support\Facades\Mail;

/**
 * Created by PhpStorm.
 * User: Toure Nathan
 * Date: 9/11/2016
 * Time: 1:49 PM
 */
class Utility
{

    public static $ABONNE_ROLE_ID = 1;
    public static $PAID_EMPLOYER_ROLE_ID = 2;
    public static $EMPLOYER_ROLE_ID = 3;
    public static $ADMIN_ROLE_ID = 4;

    /**
     * Get the user generated ID
     */
    public static function generateUserID()
    {
        return round(microtime(true) * 10000);

    }

    /**
     * This sends a simple text mail
     * @param $message_content. The Message content
     * @param $mail_parameters . An array of parameters to send. the array have the structure of ["sender_email" => "an_email", "sender_name" => "a_name", "receiver_email" => 'a_mail', "receiver_name" => 'a_name', "subject" => 'a_subject]
     */
    public static function SendSimpleMail($message_content,  $mail_parameters){

        if($mail_parameters != null) {
            Mail::raw($message_content, function ($message) use ($mail_parameters) {
                $message->from($mail_parameters["sender_email"], $mail_parameters["sender_name"]);
                $message->to($mail_parameters["receiver_email"], $mail_parameters["receiver_name"])->subject($mail_parameters["subject"]);
            });
        }
    }

    /*Create destination folder for Candidate CV(Resume)*/
    public static function handleCv($file, $destinationfolder, $objectId, $extension)
    {
        $fileName = 'cv'.$objectId.'.'.$extension;
        /*File less than 10M*/
        if($file->getClientSize() < 1048576){
            $file->move(base_path().'/public/uploads/'.$destinationfolder, $fileName);
            return 'cvrepository/'.$fileName;
        } else {
            return "failed";
        }
    }


    public static function handleImages($file, $urlRedirection, $objectId, $tableName, $updateMode)
    {
        /*$object =  array(
         "file" => $file,
         "destination" => $urlRedirection,
         "id" => $objectId,
         "table" => $tableName,
         "updateMode" => $updateMode
        );
        dd($object);*/
        if($updateMode == 0){

            $imageName = $urlRedirection.$objectId.'.'.$file->getClientOriginalExtension();
            $file->move(base_path().'/public/uploads/'.$urlRedirection, $imageName);
            //Resize the image
            list($width, $height) = getimagesize('uploads/'.$urlRedirection.'/'.$imageName);
            //creation
            if($width >= 344 && $height >= 344){
                $image = new ImageResize('uploads/'.$urlRedirection.'/'.$imageName);
                $image->resize(344, 344);
                $image->save('uploads/'.$urlRedirection.'/'.$imageName);
                return $imageName;
            } else {

                if (unlink('uploads/'.$urlRedirection.'/'.$imageName)) {
                    return 'failed';
                }
            }
        }else{
            //Update
            $imageName = $urlRedirection.'-'.$objectId.'.'.$file->getClientOriginalExtension();
            $file->move(base_path().'/public/uploads/'.$urlRedirection, $imageName);
            //Resize the image
            list($width, $height) = getimagesize('uploads/'.$urlRedirection.'/'.$imageName);

            if($width >= 344 && $height >= 344){
                $image = new ImageResize('uploads/'.$urlRedirection.'/'.$imageName);
                $image->resize(344, 334);
                $image->save('uploads/'.$urlRedirection.'/'.$imageName);
                return $imageName;
            } else {
                return 'failed';

            }
        }

    }

}