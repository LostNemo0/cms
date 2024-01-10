<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tables\crewdocs;
use App\Models\Tables\documents;
use App\Models\Tables\ranks;

class DocumentModel extends Model
{
    use HasFactory;
    public function addDocument($data){
        date_default_timezone_set("Asia/Manila");
        $crews = new crewdocs;
        $crews->crewid = $data['crewid'];
        $crews->code = $data['code'];
        $crews->doctype = $data['doctype'];
        $crews->docname = $data['docname'];
        $crews->docnum = $data['docnum'];
        $crews->dateissued = $data['dateissued'];
        $crews->dateexpire = $data['dateexpire'];
        $crews->uploadedby = $data['uploadedby'];
        $crews->docpath = $data['docpath'];
        $crews->created_at = date('Y-m-d H:i:s');
        $crews->updated_at = date('Y-m-d H:i:s');
        $crews->save();
        return "Document Successfully Added";
      }
  
    public function listDocument($id){
    //return $id;
    $crews = crewdocs::select()->where('crewid',$id['id'])->get()->toArray();
    if(isset($crews[0])){
        foreach($crews as $key => $val){
        $date1=date_create(date('Y-m-d'));
        $date2=date_create($val['dateexpire']);
        $diff=date_diff($date1,$date2);
        if($diff->days <= 7) $crews[$key]['color'] = "red";
        else if($diff->days <= 30 && $diff->days > 7) $crews[$key]['color'] = "yellow";
        else if($diff->days <= 90 && $diff->days > 30) $crews[$key]['color'] = "orange";
        else $crews[$key]['color'] = "transparent";
        }
    }
    return $crews;
    }

    public function viewDocument($id){
    $crews = crewdocs::select()->where('id',$id['id'])->get()->toArray();
    if(isset($crews[0])) {
        $crews = $crews[0];
        $docpath = explode("/",$crews['docpath']);
        $crews['docfile'] = $docpath[sizeof($docpath) - 1];
        $crews['dateupdated'] = date_format(date_create($crews['updated_at']),"F j, Y h:i:s A");
        $crews['dateuploaded'] = date_format(date_create($crews['created_at']),"F j, Y h:i:s A");
        return $crews;
    }
    return $crews;
    }

    public function updateDocument($data){
    date_default_timezone_set("Asia/Manila");
    crewdocs::where('id','=',$data['docid'])->update([
        'crewid' => $data['crewid'],
        'code' => $data['code'],
        'docname' => $data['docname'],
        'doctype' => $data['doctype'],
        'docnum' => $data['docnum'],
        'dateissued' => $data['dateissued'],
        'dateexpire' => $data['dateexpire'],
        'uploadedby' => $data['uploadedby'],
        'docpath' => $data['docpath'],
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
    return "Document Updated!";
    }

    public function deleteDocument($id){
    $crews = crewdocs::select()->where('id',$id['id'])->get()->toArray();
    if(isset($crews[0])) {
        if(file_exists(public_path($crews[0]['docpath']))){
        unlink(public_path($crews[0]['docpath']));
        }
        crewdocs::where('id',$id['id'])->delete();
    }
    return "Document Removed!";
    }

    public function getDefaults(){
    $defaults = array();
    $defaults['documents'] = documents::select()->get()->toArray();
    $defaults['ranks'] = ranks::select()->get()->toArray();
    return $defaults;
    }
}
