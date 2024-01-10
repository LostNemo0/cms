<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tables\users;
use App\Models\Tables\usertype;

class UserModel extends Model
{
    use HasFactory;

    public function isUserExist($username){
        $islog = users::select()->where('username',$username)->count();
        if($islog > 0) {
          return true;
        }
        return false;
      }
  
      public function addUser($data){
        $users = new users;
        $users->firstname = $data['firstname'];
        $users->middlename = $data['middlename'];
        $users->lastname = $data['lastname'];
        $users->username = $data['username'];
        $users->password = $data['password'];
        $users->usertype = $data['usertype'];
        $users->created_at = date('Y-m-d H:i:s');
        $users->updated_at = date('Y-m-d H:i:s');
        $users->save();
        return "User Successfully Added";
      }
  
      public function listUser(){
        $users = users::select()->get()->toArray();
        return $users;
      }
  
      public function viewUser($data){
        $users = users::select()->where('id',$data['id'])->get()->toArray();
        if(isset($users[0])) return $users[0];
        return $users;
      }
  
      public function deleteUser($id){
        $usertype = users::select()->where('id',$id['id'])->get()->toArray();
        if(isset($usertype[0])) {
          users::where('id',$id['id'])->delete();
        }
        return "User Deleted!";
      }
  
      public function updateUser($data){
        users::where('id','=',$data['id'])->update([
          'firstname' => $data['firstname'],
          'lastname' => $data['lastname'],
          'middlename' => $data['middlename'],
          'username' => $data['username'],
          'password' => $data['password'],
          'usertype' => $data['usertype'],
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return "User Updated!";
      }
  
      public function addUserType($data){
        $usertype = new usertype;
        $usertype->usertype = $data['usertype'];
        $usertype->restriction = $data['restriction'];
        $usertype->created_at = date('Y-m-d H:i:s');
        $usertype->updated_at = date('Y-m-d H:i:s');
        $usertype->save();
        return "User Type Successfully Added";
      }
  
      public function listUserType(){
        $usertype = usertype::select()->get()->toArray();
        if(isset($usertype[0])){
          foreach($usertype as $key => $type){
            $str = "";
            $restriction = json_decode($type['restriction'],true);
            foreach($restriction as $k => $v){
              if($k == 0) $str = $v;
              else $str = $str." | ".$v;
            }
            $usertype[$key]['restriction'] = $str;
          }
        }
        return $usertype;
      }
  
      public function viewUserType($data){
  
        $usertype = usertype::select()->where('id',$data['id'])->get()->toArray();
        if(isset($usertype[0])) {
          $usertype = $usertype[0];
          $usertype['restriction'] = json_decode($usertype['restriction']);
          return $usertype;
        }
        return $usertype;
      }
  
      public function updateUserType($data){
        usertype::where('id','=',$data['id'])->update([
          'usertype' => $data['usertype'],
          'restriction' => $data['restriction'],
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return "User Type Updated!";
      }
  
      public function deleteUserType($id){
        $usertype = usertype::select()->where('id',$id['id'])->get()->toArray();
        if(isset($usertype[0])) {
          usertype::where('id',$id['id'])->delete();
        }
        return "User type Deleted!";
      }
  
      public function login($data){
        $islog = users::select()->where('username',$data['username'])->count();
        if($islog > 0) {
          $users = users::select()->where('username',$data['username'])->get()->toArray();
          $user =$users[0];
          if($user['password'] == $data['password']){
            $userdata = array();
            $userdata['username'] = $user['username'];
            $userdata['fullname'] = $user['firstname'].' '.$user['middlename'].' '.$user['lastname'];
            $userdata['usertype'] = $user['usertype'];
            $res = usertype::select()->where('usertype',$user['usertype'])->get()->toArray();
            if(isset($res[0])){
              $res = $res[0];
              $userdata['restriction'] = json_decode($res['restriction'],true);
            }
            else $userdata['restriction'] = "";
            return $userdata;
          }
          return $users;
        }
        return $islog;
      }
}
