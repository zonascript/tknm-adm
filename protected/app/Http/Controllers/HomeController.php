<?php

namespace App\Http\Controllers;

use App\EthAddress;
use App\Member;
use Illuminate\Http\Request;
use App\User as User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);


        return view('home',compact('userProfile','userMenu'));
    }

    public function getMemberCount(){
        $memberCount = Member::getMemberCount();

        return $memberCount;
    }

    public function getAddressCount(){
        $addressCount = EthAddress::getUnusedAddressCount();

        return $addressCount;
    }
}
