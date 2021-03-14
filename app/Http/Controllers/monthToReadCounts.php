<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;

class monthToReadCounts extends Controller
{
    //

    public function index($userID){
        //$readBooks = array("test");
        // return a query containing the where clause created_at = 'something' and read = '1'
        $monthToReadCount = Book::where('Read', 1)->where('user_id', $userID)->selectRaw("created_at as Date")->selectRaw("COUNT(created_at) as read_count")->groupBy('created_at')->get();
        //echo "all books". $readBooks;
        return json_encode($monthToReadCount); 
    }
}
