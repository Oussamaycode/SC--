<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;

class AdminDashboardController extends Controller
{
    public function index(){
        $userCount=User::all()->count();
        $bannedUsersCount=User::where();
        $activeColocations=Colocation::where('is_active',true)->count();
        $
        return view('admin');
    }
}
