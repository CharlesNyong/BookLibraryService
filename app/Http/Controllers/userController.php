<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\SurveyMail;
use Illuminate\Support\Facades\Mail;
use App\User;
use Carbon\Carbon;

class userController extends Controller
{
    
    //@return void


    //
    public function getUserByEmail($emailID)
    {
        $currentUser = User::where('email', $emailID)->get();
        return json_encode($currentUser);
    }

    public function getUserByUserName($username)
    {
        $currentUser = User::where('name', $username)->get();
        return json_encode($currentUser);
    }

    public function addNewUser(Request $userRequest)
    {
        //$createdDate = Carbon::now();
        $userToSave = new User(['name' => strtolower($userRequest->name), 'email' => $userRequest->email, 'password' => $userRequest->password]);
        if($userToSave->save())
        {
            return json_encode(array('success' => true));
        }
        else
        {
            return json_encode(array('success' => false));
        }
    }

    public function updateUser(Request $userRequest){
        //echo "user email: ". $userRequest->email;
        $user = json_decode($this->getUserByEmail($userRequest->email));
        $updatedDate = date('Y-m-d H:i:s');
        //echo "id: ". $user[0]->password; 
        if($user != null){
            if($userRequest->email != '' && $userRequest->email != $user[0]->email){
                $user[0]->email = $userRequest->email;
            }

            if($userRequest->password != '' && $userRequest->password != $user[0]->password){
                $user[0]->password = $userRequest->password;
            }

            if($userRequest->name != '' && $userRequest->name != $user[0]->name){
                $user[0]->name = $userRequest->name;
            }

            User::where("id", $user[0]->id)->update(['name' => $user[0]->name, 'email'=> $user[0]->email, 'password'=> $user[0]->password, 'updated_at' => $updatedDate]);
            
            return json_encode(array('success' => true));
        }
        //var_dump($user);
        //check for what changed

    }

    // error: surveyRequest contains no fields
    public function sendSurvey(Request $surveyRequest){

        $details = [
            'title' => $surveyRequest->surveySubject,
            'body' => $surveyRequest->surveyText,
            'senderEmail' => $surveyRequest->senderEmail,
            'senderName' => $surveyRequest->surveyOwner
        ];
        
        //print_r($details);
        Mail::to("cjinfotechservices@gmail.com")->send(new SurveyMail($details));

        return json_encode(array('success' => true));
    }
}
