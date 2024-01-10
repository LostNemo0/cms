<?php

namespace App\Http\Controllers;
use App\Models\CrewModel;
use App\Models\DocumentModel;
use App\Models\UserModel;
use App\Models\UtilitiesModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getrequest(Request $request){
        $data =  $request->all();
        $response = array();
        $response['error'] = 0;
        $response['msg'] = "";
        if(static::checkData($data)){
          $response['error'] = 1;
          $response['msg'] = static::errorMsg($data);
        }
        else {
          if($data['type'] == "crew"){
            if($data['option'] == "new") $response['msg'] = CrewModel::addCrew($data);
            else if($data['option'] == "list") $response['msg'] = CrewModel::listCrew($data);
            else if($data['option'] == "view") $response['msg'] = CrewModel::viewCrew($data);
            else if($data['option'] == "update") $response['msg'] = CrewModel::updateCrew($data);
            else if($data['option'] == "delete") $response['msg'] = CrewModel::deleteCrew($data);
          }
          else if($data['type'] == "document"){
            if($data['option'] == "save") $response['msg'] = DocumentModel::addDocument($data);
            else if($data['option'] == "list") $response['msg'] = DocumentModel::listDocument($data);
            else if($data['option'] == "view") $response['msg'] = DocumentModel::viewDocument($data);
            else if($data['option'] == "delete") {
              $response['msg'] = DocumentModel::deleteDocument($data);
            }
            else if($data['option'] == "update") {
              $response['msg'] = DocumentModel::updateDocument($data);
            }
            else if($data['option'] == "upload"){
              $validatedData = $request->validate(['file' => 'required|mimes:pdf|max:2048',]);
              if(isset($request->lastpath)){
                $lastpath = public_path($request->lastpath);
                $response['msg2'] = $lastpath;
                unlink($lastpath);
              }
              $name = $request->file('file')->getClientOriginalName();
              $folder = '/documents/'.$request->crewid;
              $path = public_path($folder);
              if(!file_exists($path)) mkdir($path, 0777, true);
              $request->file->move($path,$name);
              $response['msg'] = $folder.'/'.$name;
            }
          }
          else if($data['type'] == "user"){
            if($data['option'] == "new") $response['msg'] = UserModel::addUser($data);
            else if($data['option'] == "list") $response['msg'] = UserModel::listUser();
            else if($data['option'] == "view") $response['msg'] = UserModel::viewUser($data);
            else if($data['option'] == "update") $response['msg'] = UserModel::updateUser($data);
            else if($data['option'] == "delete") $response['msg'] = UserModel::deleteUser($data);
          }
          else if($data['type'] == "usertype"){
            if($data['option'] == "new") $response['msg'] = UserModel::addUserType($data);
            else if($data['option'] == "list") $response['msg'] = UserModel::listUserType();
            else if($data['option'] == "view") $response['msg'] = UserModel::viewUserType($data);
            else if($data['option'] == "update") $response['msg'] = UserModel::updateUserType($data);
            else if($data['option'] == "delete") $response['msg'] = UserModel::deleteUserType($data);
          }
          else if($data['type'] == "rank"){
            if($data['option'] == "new") $response['msg'] = UtilitiesModel::addRank($data);
            else if($data['option'] == "list") $response['msg'] = UtilitiesModel::listRank();
            else if($data['option'] == "view") $response['msg'] = UtilitiesModel::viewRank($data);
            else if($data['option'] == "update") $response['msg'] = UtilitiesModel::updateRank($data);
            else if($data['option'] == "delete") $response['msg'] = UtilitiesModel::deleteRank($data);
          }
          else if($data['type'] == "doctype"){
            if($data['option'] == "new") $response['msg'] = UtilitiesModel::addDocType($data);
            else if($data['option'] == "list") $response['msg'] = UtilitiesModel::listDocType();
            else if($data['option'] == "view") $response['msg'] = UtilitiesModel::viewDocType($data);
            else if($data['option'] == "update") $response['msg'] = UtilitiesModel::updateDocType($data);
            else if($data['option'] == "delete") $response['msg'] = UtilitiesModel::deleteDocType($data);
          }
          else if($data['type'] == "defaults"){
            if($data['option'] == "all") {
              $response['msg'] = DocumentModel::getDefaults();
            }
            else if($data['option'] == "usertype") {
              $response['msg'] = UserModel::listUserType();
            }
          }
          else if($data['type'] == "login"){
            $loginData = UserModel::login($data);
            if(isset($loginData['fullname'])){
              session(['logindata' => $loginData]);
            }
            else {
              session(['logindata' => null]);
              $response['error'] = 1;
              $response['msg'] = "Unable to Login";
            }
          }
          else if($data['type'] == "logout"){
            session(['logindata' => null]);
          }
        }
        return $response;
      }
  
    private static function checkData($data){
    $error = false;
    foreach($data as $key => $val){
        if($val == null){
        $error = true;
        }
    }
    if($data['type'] == "user"){
        if($data['option'] == "new" || $data['option'] == "update"){
        $usr = $data['username'];
        $pass = $data['password'];
        $matchuser = preg_match('/[^a-zA-Z]/',$usr);
        $matchpass = preg_match('/[^a-zA-Z0-9]/',$pass);
        if($matchuser > 0) $error = true;
        else if(strlen($usr) > 10 ) $error = true;
        if($matchpass > 0) $error = true;
        else if(strlen($pass) > 20 ) $error = true;
        if($data['password'] != $data['cpassword']) $error = true;
        if($data['option'] == "new"){
            if(UserModel::isUserExist($usr)) $error = true;
        }
        }
    }
    return $error;
    }

    private static function errorMsg($param){
    $msg = "";
    if($param['type'] == "crew"){
        if($param['option'] == "new") $msg = "Please complete the form!";
        else if($param['option'] == "list") $msg = "No Crew Found!";
    }
    else if($param['type'] == "document"){
        if($param['option'] == "save") $msg = "Please complete the form!";
        else if($param['option'] == "update") $msg = "Please complete the form!";
    }
    else if($param['type'] == "usertype"){
        if($param['option'] == "new") $msg = "Please complete the form!";
        else if($param['option'] == "update") $msg = "Please complete the form!";
    }
    else if($param['type'] == "user"){
        $usr = $param['username'];
        $pass = $param['password'];
        $matchuser = preg_match('/[^a-zA-Z]/',$usr);
        $matchpass = preg_match('/[^a-zA-Z0-9]/',$pass);
        if($matchuser > 0) $msg = "Username accept only string character";
        else if(strlen($usr) > 10 ) $msg = "Username maximum of 10 character";
        if($matchpass > 0) $msg = "Passwords dont accept special character";
        else if(strlen($pass) > 20 ) $msg = "Passwords maximum of 20 character";
        if($param['password'] != $param['cpassword']) $msg = "Passwords do not match";
        if($param['option'] == "new"){
        if(UserModel::isUserExist($usr)) $msg = "User Already Existed";
        }

    }
    else if($param['type'] == "rank"){
        if($param['option'] == "new") $msg = "Please complete the form!";
        else if($param['option'] == "update") $msg = "Please complete the form!";
    }
    else if($param['type'] == "doctype"){
        if($param['option'] == "new") $msg = "Please complete the form!";
        else if($param['option'] == "update") $msg = "Please complete the form!";
    }
    return $msg;
    }
}
