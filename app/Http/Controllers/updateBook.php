<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class updateBook extends Controller
{
    //


    public function index(Request $bookRequest){
        $blnRead = strtolower($bookRequest->read);

        //echo "updating with the following data: ". $status . " date read: ". $bookRequest->dateRead . " Book name: ". $bookRequest->name;
        Book::where("user_id", 1)->where("BookName", $bookRequest->name)->update(['Read' => $blnRead, 'created_at'=> $bookRequest->dateRead]);
        
        
        // update successful
        return json_encode(array(1));
        
    }
}
