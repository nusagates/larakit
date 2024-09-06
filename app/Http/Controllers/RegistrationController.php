<?php

namespace App\Http\Controllers;

use App\Events\RegistrationApprovalEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Auth/RegistrationApproval');
    }

   public function approvalRequest(): \Illuminate\Http\RedirectResponse
   {
       $user = User::where('role', 'admin')->first();
       broadcast(new RegistrationApprovalEvent($user,['status'=>'requested', 'message'=>'Please approve this registration']));
       return redirect()->back();
   }
    public function approvalResult(): \Illuminate\Http\RedirectResponse
    {
        $user = User::where('role', 'user')->first();
        broadcast(new RegistrationApprovalEvent($user, ['status'=>'approved', 'message'=>'Your registration has been approved']));
        return redirect()->back();
    }
}
