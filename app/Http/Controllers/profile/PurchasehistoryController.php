<?php


namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchasehistoryController extends Controller
{
    public function index(){
    return view('profile.purchasehistory');
    }
}
