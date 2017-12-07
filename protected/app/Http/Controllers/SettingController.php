<?php

namespace App\Http\Controllers;

use App\ConfigIco;
use App\ListWalletEth;
use Illuminate\Http\Request;
use App\IntroText as IntroText;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function agreement(Request $request){
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],$request->path())){
            return view('403');
        }

        $introText = IntroText::getIntroText('Agreement');

        return view('setting.agreement',compact('userProfile','userMenu','introText'));
    }

    public function agreementProcess(Request $request){
        try{
            $text = $request->input('text');
            $modifiedBy = Auth::user()->id;

            DB::beginTransaction();

            IntroText::where('text_name', 'Agreement')->update([
                'text' => $text,
                'modified_by' => $modifiedBy,
            ]);

            $action = 'Change Agreement text';
            if($this->logging('introduction_text',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Agreement Text Changed!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Failed to change Agreement Text!');
        }
    }

    public function listWalletEth(Request $request){
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],$request->path())){
            return view('403');
        }

        $listWallet = ListWalletEth::getWallets();

        return view('setting.walletEth',compact('userProfile','userMenu','listWallet'));
    }

    public function addWalletEth(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'wallet-name' => 'required|string|max:100',
                'display-name' => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('fail','Failed to add wallet!');
            }

            $wallet_name = $request->input('wallet-name');
            $display_name = $request->input('display-name');

            DB::beginTransaction();

            ListWalletEth::create([
                'wallet_name' => $wallet_name,
                'display_name' => $display_name
            ]);

            $action = 'Add list wallet ETH, name: '.$wallet_name;
            if($this->logging('list_wallet_ethereum',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Wallet added!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Failed to add wallet!');
        }
    }

    public function editWalletEth(Request $request){
        try{
            $id = $request->input('id');
            $wallet_name = $request->input('wallet-name');
            $display_name = $request->input('display-name');

            DB::beginTransaction();

            ListWalletEth::where('id',$id)->update([
                'wallet_name' => $wallet_name,
                'display_name' => $display_name
            ]);

            $action = 'Update wallet ETH, id: '.$id;
            if($this->logging('list_wallet_ethereum',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Wallet edited!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Failed to edit wallet!');
        }

    }

    public function deleteWalletEth($id){
        try{
            DB::beginTransaction();

            $name = ListWalletEth::getWallet($id)->wallet_name;

            ListWalletEth::where('id',$id)->delete();

            $action = 'Delete wallet ETH, name: '.$name;
            if($this->logging('list_wallet_ethereum',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Wallet deleted!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Fail to delete wallet!');
        }
    }

    public function listConfigIco(Request $request){
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],$request->path())){
            return view('403');
        }

        $listConfig = ConfigIco::getConfigs();

        return view('setting.config-ico',compact('userProfile','userMenu','listConfig'));
    }

    public function editConfigIco(Request $request){
        try{
            $id = $request->input('id');
            $display_name = $request->input('display-name');
            $startdate = strtotime($request->input('startdate'));
            $enddate = strtotime($request->input('enddate'));
            $totalsell = $request->input('totalsell');
            $price = floor(1 / $request->input('price') * 100000000) / 100000000;

            DB::beginTransaction();

            ConfigIco::where('id',$id)->update([
                'display_name' => $display_name,
                'start_date' => $startdate,
                'end_date' => $enddate,
                'total_token_sell' => $totalsell,
                'price_token' => $price
            ]);

            $action = 'Edit config_ico,id: '.$id.' name: '.$display_name;
            if($this->logging('config_ico',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Config edited!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Failed to edit config!');
        }

    }
}
