<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use DB;

class monthToReadCounts extends Controller
{
    
    public function index($userID){
        //$readBooks = array("test");
        // return a query containing the where clause created_at = 'something' and read = '1'
        $monthToReadCount = Book::where('Read', 1)->where('user_id', $userID)->selectRaw("ANY_VALUE(created_at) as Date")->selectRaw("COUNT(books.Read) as read_count")->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->get();
        //echo "mapping: ". $monthToReadCount;
        return json_encode($monthToReadCount); 
    }
}
