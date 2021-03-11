<?php

namespace App\Http\Controllers\RegisteredUsers;

use Illuminate\Auth\AuthManager;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $auth; 

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Display the dashboard for an authenticated user.
     *     
     * @return \Illuminate\Http\Response
     */
    public function showDashboard()
    {
        return View('registered-users.bashboard', array(

        ));
    }


    public function showFavouriteTracks()
    {
        $tracks = $this->auth->User()->FavouriteTracks()->get();
        dd($tracks);        
    }




}