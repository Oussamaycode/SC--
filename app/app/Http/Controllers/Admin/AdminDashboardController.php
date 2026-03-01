<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expense;
use App\Models\Colocation;
use App\Models\Membership;

class AdminDashboardController extends Controller
{
    public function index(){
        $memberships=Membership::with(['colcoation','colocation.users','colocation.expenses','colocation.owner']);
        $userCount=User::count();
        $bannedUsersCount=User::where('is_banned',true)->count();
        $expenseSum=Expense::sum('amount');
        $activeColocations=Colocation::where('is_active',true)->count();
        return view('admin',compact('userCount','bannedUsersCount','expenseSum','activeColocations','memberships'));
    }
}
