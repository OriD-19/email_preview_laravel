<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserPatchRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $usernameQuery = $request->query('username');
        $emailQuery = $request->query('email');

        $users = DB::table('users');

        if ($usernameQuery) {
            $users->where('username', 'like', '%'. $usernameQuery. '%');
        }

        if ($emailQuery) {
            $users->where('email', 'like', '%'. $emailQuery. '%');
        }

        return response()->json(UserResource::collection($users->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Str::random(8);

        $user = User::create($data);

        return response()->json(UserResource::make($user), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(UserResource::make($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response("", 204);
    }

    public function patch(UserPatchRequest $request, User $user) {
        $data = $request->validated();
        $user->update($data);

        return $user;
    }
}
