<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Quy tắc validation phức tạp hơn
        $validatedData = $request->validate([
            "name" => [
                "required",
                "string",
                "max:255",
                // Custom regex để kiểm tra tên chỉ chứa chữ cái và khoảng trắng
                "regex:/^[a-zA-Z\s]+$/",
            ],
            "email" => [
                "required",
                "email",
                // Kiểm tra email duy nhất trong bảng users, bỏ qua email của user hiện tại
                "unique:users,email," . $request->user()->id,
            ],
            "password" => [
                "required",
                "string",
                "min:8",   // Mật khẩu ít nhất 8 ký tự
                "regex:/[a-z]/", // Phải chứa ít nhất một chữ thường
                "regex:/[A-Z]/", // Phải chứa ít nhất một chữ hoa
                "regex:/[0-9]/", // Phải chứa ít nhất một số
            ],
        ], [
            // Tùy chỉnh thông báo lỗi
            "name.required" => "Tên là bắt buộc.",
            "name.regex" => "Tên chỉ được chứa chữ cái và khoảng trắng.",
            "name.max" => "Tên không được vượt quá 255 ký tự.",
            "email.required" => "Email là bắt buộc.",
            "email.email" => "Email phải là một địa chỉ email hợp lệ.",
            "email.unique" => "Email đã tồn tại trong hệ thống.",
            "password.required" => "Mật khẩu là bắt buộc.",
            "password.min" => "Mật khẩu phải chứa ít nhất 8 ký tự.",
            "password.regex" => "Mật khẩu phải bao gồm ít nhất một chữ thường, một chữ hoa và một số.",
            "phone.digits_between" => "Số điện thoại phải có từ 10 đến 15 chữ số.",
            "phone.regex" => "Số điện thoại không hợp lệ.",
            "age.integer" => "Tuổi phải là một số nguyên.",
            "age.between" => "Tuổi phải nằm trong khoảng 18 đến 99.",
            "address.max" => "Địa chỉ không được vượt quá 255 ký tự.",
        ]);

        // Tạo mới user hoặc cập nhật thông tin user
        $user = User::create([
            "name" => $validatedData['name'],
            "email" => $validatedData['email'],
            "password" => bcrypt($validatedData['password']),
        ]);

        return redirect()->route("user.index")->with("success", "User created successfully!");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user) {
            return view("users.update", compact("user"));
        } else {
            return redirect()->route("user.index")->with("error", "User does not exist.");
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "email",
            "password" => "required",
        ]);
        $user = User::find($id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            return redirect()->route("user.index")->with("success", "User updated successfully!");

        } else {
            return redirect()->route("user.index")->with("error", "User does not exist.");
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route("user.index")->with("success", "User updated successfully!");
        } else {
            return redirect()->route("user.index")->with("error", "User does not exist.");
        }
    }
}
