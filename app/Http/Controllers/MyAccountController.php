<?php

namespace App\Http\Controllers;

use Alert;
use Backpack\CRUD\app\Http\Requests\AccountInfoRequest;
use Backpack\CRUD\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Backpack\PageManager\app\Models\Page;

class MyAccountController extends Controller
{
    protected $data = [];
    private $user = null;

    public function __construct()
    {
        $this->user = \Auth::guard('backpack')->user();
    //    $this->middleware(backpack_middleware());
    }

    public function index()
    {
        if (is_null($this->user)) {
            return redirect('/admin/login');
        }

        $pages = Page::all()->where('is_published', true);
        $this->data['pages'] = $pages;
        $this->data['title'] = trans('backpack::base.my_account');
        $this->data['user'] = $this->guard()->user();

        return view('my.account', $this->data);
    }
    /**
     * Show the user a form to change his personal information & password.
     */
    public function getAccountInfoForm()
    {
        $this->data['title'] = trans('backpack::base.my_account');
        $this->data['user'] = $this->guard()->user();

        return view(backpack_view('my_account'), $this->data);
    }

    /**
     * Save the modified personal information for a user.
     */
    public function postAccountInfoForm(AccountInfoRequest $request)
    {
        $result = $this->guard()->user()->update($request->except(['_token']));

        if ($result) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Save the new password for a user.
     */
    public function postChangePasswordForm(ChangePasswordRequest $request)
    {
        $user = $this->guard()->user();
        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Get the guard to be used for account manipulation.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return backpack_auth();
    }
}
