<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance.list');
    }

    public function users()
    {
        return view('attendance.users');
    }

    public function approvals()
    {
        return view('attendance.approvals');
    }
}
