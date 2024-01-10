<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BladeController extends Controller
{
    public function login(){
      return view('login');
    }

    public function crew(){
      $logindata = session('logindata');
      if($logindata) {
        return view('crew',compact('logindata'));
      }
      else{
        return redirect('/login');
      }
      
    }

    public function user(){
      $logindata = session('logindata');
      if($logindata){
        return view('users',compact('logindata'));
      }
      else{
        return redirect('/login');
      }
    }

    public function rank(){
      $logindata = session('logindata');
      if($logindata){
        return view('rank',compact('logindata'));
      } 
      else {
        return redirect('/login');
      }
      
    }

    public function document(){
      $logindata = session('logindata');
      if($logindata) return view('document',compact('logindata'));
      else return redirect('/login');
    }

}
