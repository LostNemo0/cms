<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tables\ranks;
use App\Models\Tables\documents;

class UtilitiesModel extends Model
{
    use HasFactory;

    public function addRank($data){
        $ranks = array();
        $ranks['code'] = $data['code'];
        $ranks['name'] = $data['longname'];
        $ranks['short_name'] = $data['shortname'];
        $ranks['alias'] = $data['alias'];
        $ranks['ranking'] = $data['ranking'];
        ranks::insert([$ranks]);
        return "Rank Successfully Added";
      }
  
      public function listRank(){
        $users = ranks::select()->get()->toArray();
        return $users;
      }
  
      public function updateRank($data){
        ranks::where('code','=',$data['oldcode'])->delete();
        static::addRank($data);
        return "Rank Updated!";
      }
  
      public function viewRank($data){
        $users = ranks::select()->where('code',$data['code'])->get()->toArray();
        if(isset($users[0])) return $users[0];
        return $users;
      }
  
      public function deleteRank($data){
        ranks::where('code','=',$data['code'])->delete();
        return "Rank Deleted!";
      }
  
      public function addDocType($data){
        $doctype = array();
        $doctype['code'] = $data['code'];
        $doctype['name'] = $data['name'];
        documents::insert([$doctype]);
        return "Document Type Successfully Added";
      }
  
      public function updateDocType($data){
        documents::where('code','=',$data['oldcode'])->delete();
        static::addDocType($data);
        return "Document Type Updated!";
      }
  
      public function listDocType(){
        $users = documents::select()->get()->toArray();
        return $users;
      }
  
      public function viewDocType($data){
        $users = documents::select()->where('code',$data['code'])->get()->toArray();
        if(isset($users[0])) return $users[0];
        return $users;
      }
  
      public function deleteDocType($data){
        documents::where('code','=',$data['code'])->delete();
        return "Document Type Deleted!";
      }
}
