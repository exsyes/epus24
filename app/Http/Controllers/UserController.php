<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    private UserServices $userServices;

    /**
     * @param UserServices $userServices
     */
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function login(): Response
    {
        return response()->view("admin.login");
    }
    public function doLogin(Request $request):RedirectResponse
    {
        $username = $request->input("username");
        $password = $request->input("password");

        if (empty($username) || empty($password)){
            return redirect("/login")->with("error", "username atau password tidak boleh kosong");
        }

        if ($this->userServices->doLogin($username, $password)){
            $request->session()->put("username", $username);
            return redirect("/borrowed-books");
        }

        return redirect("/login")->with("error", "username atau password salah");
    }

    public function doLogout(Request $request):RedirectResponse
    {
        $request->session()->forget("username");
        return redirect("/login")->with("success", "Anda telah keluar/log out");
    }
}
