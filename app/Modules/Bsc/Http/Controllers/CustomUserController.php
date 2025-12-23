<?php
namespace App\Modules\Bsc\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bsc\Property;
use App\Models\Bsc\CustomUser;
use Illuminate\Support\Facades\Hash;

class CustomUserController extends Controller
{
    // Método para mostrar todos los usuarios
    public function index()
    {
       
        return view('modules.bsc.user.index');
    }
    
}
