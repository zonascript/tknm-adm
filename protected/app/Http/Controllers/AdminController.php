<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use App\Role as Role;
use App\Menu as Menu;
use App\RoleMenu as RoleMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePwd(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('pwd_fail','Failed to change password!');
            }

            //cek old password
            $temp = User::getUser($request->input('email'));
            if(!Hash::check($request->input('oldpwd'),$temp->password)){
                return redirect()->back()->with('pwd_fail','Failed to change password!, Old password is incorrect.');
            }

            DB::beginTransaction();

            User::where('email',$request->input('email'))->update([
               'password' => bcrypt($request->input('password'))
            ]);

            if($this->logging('admin_user','Change password'))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('pwd_success','Password changed!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('pwd_fail','Failed to change password!');
        }

    }

    public function listAdmin(Request $request)
    {
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],$request->path())){
            return view('403');
        }

        $tempAdmins = User::getUsers();

        $x = 0;
        foreach ($tempAdmins as $tempAdmin){
            $role = Role::getRole($tempAdmin->role);
            $admins[$x++]=[
                'id' => $tempAdmin->id,
                'name' => $tempAdmin->name,
                'email' => $tempAdmin->email,
                'role' => $role->role,
                'role_id' => $tempAdmin->role
            ];
        }

        $roles = Role::getRoles();

        return view('admin.listadmin',compact('userProfile','userMenu','admins','roles'));
    }

    public function editAdmin(Request $request){
        try{
            $id = $request->input('id');
            $role = $request->input('role');

            DB::beginTransaction();

            User::where('id',$id)->update([
                'role' => $role
            ]);

            $action = 'Change admin '.$id.' role to '.Role::getRole($role)->role;
            if($this->logging('admin_user',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Admin edited!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Failed to edit admin!');
        }

    }

    public function addAdmin(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('fail','Failed to add admin!');
            }

            $name = $request->input('name');
            $email = $request->input('email');
            $role = $request->input('role');
            $password = $request->input('password');

            DB::beginTransaction();

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'role' => $role,
            ]);

            $action = 'Create new admin email: '. $email;
            if($this->logging('admin_user',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Admin added!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Failed to add admin!');
        }

    }

    public function deleteAdmin($id){
        try{
            DB::beginTransaction();

            $email = User::getUserByid($id)->email;
            User::where('id',$id)->delete();

            $action = 'Delete admin id: '.$id.', email: '.$email;
            if($this->logging('admin_user',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Admin deleted!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Fail to delete admin!');
        }
    }


    public function listRole(Request $request){
        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],$request->path())){
            return view('403');
        }

        $tempRoles = Role::getRoles();
        $x = 0;
        foreach ($tempRoles as $tempRole){
            $roles[$x++]=[
                'id' => $tempRole->id,
                'role' => $tempRole->role,
            ];
        }

        return view('admin.listrole',compact('userProfile','userMenu','roles'));
    }

    public function addRole(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('fail','Failed to add role!');
            }

            $role = $request->input('name');

            DB::beginTransaction();

            Role::create([
                'role' => $role,
                'modified_by' => Auth::user()->id
            ]);

            $action = 'Create new role name: '.$role;
            if($this->logging('admin_role',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Role added!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Failed to add role!');
        }
    }

    public function editRole(Request $request){
        try{
            $id = $request->input('id');
            $role = $request->input('name');

            DB::beginTransaction();

            Role::where('id',$id)->update([
                'role' => $role,
                'modified_by' => Auth::user()->id
            ]);

            $action = 'Edit role '.$id.' name into: '.$role;
            if($this->logging('admin_role',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Admin edited!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Failed to edit admin!');
        }

    }

    public function deleteRole($id){
        try{
            if($id == 1 || $id == 2){
                throw (new \Exception());
            }else{

                DB::beginTransaction();

                $role = Role::getRole($id)->role;

                Role::where('id',$id)->delete();
                RoleMenu::where('role',$id)->delete();

                $action = 'Delete role '.$id.' name: '.$role;
                if($this->logging('admin_role',$action))
                    DB::commit();
                else
                    throw (new \Exception());

            }

            return back()->with('success','Admin deleted!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Fail to delete admin!');
        }
    }


    public function listPermission(Request $request, $role_id = 2){

        $userProfile = $this->getUser();

        $userMenu = $this->getUserMenu($userProfile['role']);

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],'permission')){
            return view('403');
        }

        $x = 0;
        foreach(Menu::getMenuLevel1() as $tempLevel1){
            $menus[$x] = [
                'id' => $tempLevel1->id,
                'name' => $tempLevel1->name,
                'icon' => $tempLevel1->icon,
                'path' => $tempLevel1->path,
                'permitted' => Menu::checkPermission($role_id, $tempLevel1->id),
            ];

            $y = 0;

            foreach (Menu::getMenuLevel2($tempLevel1->id) as $tempLevel2){
                $menus[$x]['child'][$y++] = [
                    'id' => $tempLevel2->id,
                    'name' => $tempLevel2->name,
                    'icon' => $tempLevel2->icon,
                    'path' => $tempLevel2->path,
                    'permitted' => Menu::checkPermission($role_id, $tempLevel2->id)
                ];
            }

            $x++;
        };

        $roles = Role::getRoles();

        return view('admin.listpermission',compact('userMenu','userProfile', 'menus', 'roles','role_id'));
    }

    public function deletePermission($role_id,$menu_id){
        $userProfile = $this->getUser();

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],'permission')){
            return view('403');
        }

        try{
            DB::beginTransaction();

            DB::delete("delete from role_menu where (role = $role_id AND menu = $menu_id)");

            //delete child if exist
            DB::delete("delete from role_menu where (role = $role_id AND menu = ANY(select id from menu where parent_id = $menu_id))");

            $action = 'Delete permission for role '.Role::getRole($role_id)->role.' on menu '.Menu::getMenu($menu_id)->name;
            if($this->logging('role_menu',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Permission deleted!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Fail to delete permission!');
        }
    }

    public function grantPermission($role_id,$menu_id){
        $userProfile = $this->getUser();

        //cek role permission
        if(!$this->isPermitted($userProfile['role'],'permission')){
            return view('403');
        }

        try{
            DB::beginTransaction();

            RoleMenu::create([
                'role' => $role_id,
                'menu' => $menu_id,
                'modified_by' => Auth::user()->id
            ]);

            $menu = Menu::getMenu($menu_id);
            $parent = Menu::getMenu($menu->parent_id);
            if($parent && !Menu::checkPermission($role_id,$parent->id)){
                RoleMenu::create([
                    'role' => $role_id,
                    'menu' => $parent->id,
                    'modified_by' => Auth::user()->id
                ]);
            }

            $action = 'Grant permission for role '.Role::getRole($role_id)->role.' on menu '.Menu::getMenu($menu_id)->name;
            if($this->logging('admin_role',$action))
                DB::commit();
            else
                throw (new \Exception());

            return back()->with('success','Permission granted!');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('fail','Fail to grant permission!');
        }
    }
}
