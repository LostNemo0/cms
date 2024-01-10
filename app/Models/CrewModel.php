<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tables\crews;
use App\Models\Tables\ranks;
use App\Models\DocumentModel;

class CrewModel extends Model
{
    use HasFactory;
    public function addCrew($data){
        $crews = new crews;
        $crews->firstname = $data['firstname'];
        $crews->middlename = $data['middlename'];
        $crews->lastname = $data['lastname'];
        $crews->email = $data['email'];
        $crews->birthdate = $data['birthdate'];
        $crews->age = $data['age'];
        $crews->address = $data['address'];
        $crews->rank = $data['rank'];
        $crews->height = $data['height'];
        $crews->weight = $data['weight'];
        $crews->created_at = date('Y-m-d H:i:s');
        $crews->updated_at = date('Y-m-d H:i:s');
        $crews->save();
        return "Crew Successfully Added";
      }
  
      public function listCrew(){
        $crews = crews::select()->get()->toArray();
        if(isset($crews[0])){
          foreach($crews as $key => $crew){
            $rank = $crew['rank'];
            $ranks = ranks::select('name')->where('code',$rank)->get()->toArray();
            if(isset($ranks[0])) $crews[$key]['rank'] = $ranks[0]['name'];
          }
        }
        return $crews;
      }
  
      public function viewCrew($data){
        $crews = crews::select()->where('id',$data['id'])->get()->toArray();
        if(isset($crews[0])) return $crews[0];
        return $crews;
      }
  
      public function deleteCrew($id){
        $crews = crews::select()->where('id',$id['id'])->get()->toArray();
        if(isset($crews[0])) {
          $docs = DocumentModel::listDocument($id);
          foreach($docs as $doc){
            $tmp = array();
            $tmp['id'] = $doc['id'];
            DocumentModel::deleteDocument($tmp);
          }
          crews::where('id',$id['id'])->delete();
        }
        return "Crew Deleted!";
      }
  
      public function updateCrew($data){
        crews::where('id','=',$data['id'])->update([
          'firstname' => $data['firstname'],
          'lastname' => $data['lastname'],
          'middlename' => $data['middlename'],
          'email' => $data['email'],
          'address' => $data['address'],
          'age' => $data['age'],
          'rank' => $data['rank'],
          'weight' => $data['weight'],
          'height' => $data['height'],
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return "Crew Profile Updated!";
      }
}
