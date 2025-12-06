<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class InfoController extends Controller
{
public function infoMhs ($kd)
{
return view('info', ['progdi'=>$kd]);
}
}