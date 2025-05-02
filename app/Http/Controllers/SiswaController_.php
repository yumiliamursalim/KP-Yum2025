<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    function index(){

        $data = siswa::orderBy('nomor_induk', 'desc')->paginate(5);
        // $data = siswa::all();
        return view('siswa/index')->with('data', $data);


        return $data;
    }
    function detail($id){
        // return "Saya siswa from Con dengan id $id";
        $data = siswa::where('nomor_induk', $id)->first();
        return view('siswa/show')->with('data', $data);
    }

    function create(){
        
    }

    function delete(){

    }
}

