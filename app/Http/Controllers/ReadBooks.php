<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\User;
use Carbon\Carbon;

class ReadBooks extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //
    public function index($userID){
        //$readBooks = array("test");
        $myTime = Carbon::today(); // returns date and time as "date 00:00:00"
        //echo "current time: ".$myTime;
        // return a query containing the where clause created_at = 'something' and read = '1'
        $readBooks = Book::where('Read', 1)->where('user_id', $userID)->get();
        //echo "all books". $readBooks;
        return json_encode($readBooks); 
    }
}
