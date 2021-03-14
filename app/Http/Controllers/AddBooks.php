<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use Carbon\Carbon;

class AddBooks extends Controller
{

    // insert into database
    public function index(Request $bookRequest){

        // change to authenticated user
        $user = User::find($bookRequest->userID);
       
        //echo "Current user: ". $user . "\n";
         //echo "submitted request obj: book name: ". $bookRequest->name . " book author: ". $bookRequest->author. " status: ". $bookRequest->read;
        $status = strtolower($bookRequest->read);
        if(strcmp($status, "pending") == 0 || empty($status)){
            $blnRead = 0;
            $createdDate = Carbon::now();
            //echo " pending ....";
            $bookToSave = new Book(['BookName' => strtoupper($bookRequest->name), 'Author' => $bookRequest->author, 'Read' => $blnRead, 'created_at:' => $createdDate]);
        }
        else{
            $blnRead = 1;
            //echo " completed ... and date read is: ". new Carbon($bookRequest->dateRead);
            $bookToSave = new Book(['BookName' => strtoupper($bookRequest->name), 'Author' => $bookRequest->author, 'Read' => $blnRead, 'created_at' => new Carbon($bookRequest->dateRead)]);
            //print_r($bookToSave);
        }
        $user->books()->save($bookToSave);
        //echo "\n blnRead: ". $blnRead . " created at: ". $createdDate;
    
        return json_encode(array(1));
    }
}
