<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\ListWalletEth;
use Illuminate\Http\Request;
use App\User as User;
use App\Member as Member;
use App\MemberProfile as MemberProfile;
use App\Country as Country;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listMembers(Request $request)
    {
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],$request->path())){
            return view('403');
        }

        $tempMembers = Member::getMembers();
        $x = 0;
        foreach ($tempMembers as $tempMember){
            $tempProfile = MemberProfile::getMemberProfile($tempMember->email);
            $UserCountry = Country::getcountry($tempProfile->country_id);
            if($tempProfile->is_verify_phone_number == 1)
                $verified_phone = "VERIFIED";
            else
                $verified_phone = "NOT VERIFIED";

            $members[$x++]=[
                'id' => $tempMember->id,
                'name' => $tempProfile->name,
                'email' => $tempProfile->email,
                'birth' => $tempProfile->date_of_birth,
                'phone' => $tempProfile->phone,
                'country' => $UserCountry->country_name,
                'address' => $tempProfile->address,
                'zipcode' => $tempProfile->zipcode,
                'referral_code' => $tempProfile->my_referral_code,
                'verified_phone' => $verified_phone,
            ];
        }

        return view('listmember',compact('userProfile','userMenu','members'));
    }

    public function listBuyerBtc(Request $request){
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],$request->path())){
            return view('403');
        }

        $listBuyer = Buyer::getBuyer('btc');
        $buyers=[];
        $x = 0;
        foreach ($listBuyer as $buyer){
            $temp = MemberProfile::getMemberProfileFromUserId($buyer->id_user);
            $wallet = ListWalletEth::getWallet($buyer->ethereum_wallet);
            $buyers[$x++] = [
                'id' => $buyer->id,
                'name' => $temp->name,
                'refund' => $buyer->refund_bitcoin_address,
                'wallet' => $wallet->display_name,
                'eth_address' => $buyer->ethereum_wallet_address,
                'payment_address' => $buyer->payment_bitcoin_address
            ];
        }

        return view('buyer.btc',compact('userProfile','userMenu','buyers'));
    }

    public function listBuyerEth(Request $request){
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],$request->path())){
            return view('403');
        }

        $buyers=[];
        $listBuyer = Buyer::getBuyer('eth');
        $x = 0;
        foreach ($listBuyer as $buyer){
            $temp = MemberProfile::getMemberProfileFromUserId($buyer->id_user);
            $wallet = ListWalletEth::getWallet($buyer->ethereum_wallet);
            $buyers[$x++] = [
                'id' => $buyer->id,
                'name' => $temp->name,
                'wallet' => $wallet->display_name,
                'eth_address' => $buyer->ethereum_wallet_address,
                'refund' => $buyer->refund_ethereum_address,
                'payment_address' => $buyer->payment_eth_address
            ];
        }

        return view('buyer.eth',compact('userProfile','userMenu','buyers'));
    }

}
