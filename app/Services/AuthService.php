<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Invite;
use App\Models\Role;
use App\Models\User;
use App\UploadImageTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AuthService
{

    use UploadImageTrait;
    public function login($request)
    {
        $user = User::where('email', $request['email'])->first();
        if ($user && Hash::check($request['password'], $user->password)) {
            Auth::login($user);
            session()->put('UserLoggIn', value: 1);
            return redirect()->route(route: 'dashboard')->with('success', 'Logged in successfully.');
        } else {
            return back()->withErrors(['email' => 'Email or Password entered is incorrect.']);
        }
    }

    public function signUp($request)
    {

        $validateToken = Invite::where('token', $request['invitation'])->where('expires_at', '>', Carbon::now())->where('status', false)->first();

        if ($validateToken) {
            if (isset($request['image'])) {
                $imagePath = $this->uploadImage($request['image'], 'customers');
            }

            $clientRole = Role::where('name', 'Client')->first();

            $customer =  User::create([
                'name'  => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'image' => $imagePath ?? null,
                'password' => $request['password'],
            ]);

            $customer->roles()->attach($clientRole->id);

            $validateToken->update([
                'status' => true,
            ]);

            auth()->logout();

            session()->forget('UserLoggIn');

            return redirect()->route(route: 'login')->with('success', 'SignUp Process Completed Successfully.');
        } else {
            return redirect()->route(route: 'login')->with('error', 'Invitation Expired');
        }
    }

    public function customerList($request)
    {
        $customers = User::query()->whereHas('roles', function ($query) {
            $query->where('name', 'Client');
        });

        return DataTables::of($customers)
            ->addColumn('DT_RowIndex', function ($row) {
                static $index = 0;
                $index++;
                return $index;
            })
            ->addColumn('action', function ($row) {
                $url = route('client.detail', ['id' => $row->id]);
                return '<a href="' . $url . '" class="btn btn-sm btn-primary">View</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function customerDetail($id)
    {
        return User::findOrFail($id);
    }
}
