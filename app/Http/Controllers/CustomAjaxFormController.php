<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomAjaxFormController extends Controller
{
    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
            "address1" => "required",
            "address2" => "required",
            "city" => "required",
            "state" => "required",
            "zip" => "required",
            "check_me_out" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "invalid input",
                "error" => $validator->errors(),
                "status" => false
            ], 422);
        }

        return response()->json([
            "message" => "Data saved",
            "status" => true,
            "data" => $request->all(),
            "redirect" => route('home')
        ]);
    }

    public function list(Request $request)
    {
        $users = User::all();
        return view('index', compact('users'));
    }

    public function modalOpen(Request $request)
    {
        try {
            $id = $request->input('id');
            $user = User::find($id);
            $modal = view('userModal', compact('user'))->render();

            return response()->json([
                "modal" => $modal,
                "status" => true,
                "message" => "modal html"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
                "status" => false,
            ], 500);
        }
    }
    public function deleteUser(Request $request)
    {
        try {
            $id = $request->input('id');
            $user = User::find($id);
            if (empty($user)) {
                return response()->json([
                    "message" => "User not found",
                    "status" => false,
                ], 404);
            }
            $user->delete();
            return response()->json([
                "status" => true,
                "message" => "User deleted successfully.",
                "redirect" => route('list')
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
                "status" => false,
            ], 500);
        }
    }



    public function UserStore(Request $request, $id = null)
    {
        try {

            // return $id;
            $data = $request->all();
            $rules = [
                "name" => "required",
                "email" => "required|email|unique:users,email," . $id,
            ];
            if (empty($id)) {
                $rules["password"] = "required";
                $rules["password_confirmation"] = "required";
            } else {
                $rules["password"] = "confirmed";
            }
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return response()->json([
                    "error" => $validator->errors(),
                    "message" => "Invalid Input",
                    "status" => false,
                ], 422);
            }

            if (!empty($id)) {
                unset($data['password']);
            }
            $user = User::updateOrCreate(["id" => $id], $data);

            return response()->json([
                "message" => "User " . (empty($id) ? "Added" : "Updated"),
                "status" => true,
                "data" => $user,
                "redirect" => route('list')
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
                "status" => false,
            ], 500);
        }
    }
}
