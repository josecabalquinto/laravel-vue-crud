<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getPaginatedUser();

        return Inertia::render('User/Index', ['data' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name'  => 'required|string',
                'role'  => 'required|in:user,admin',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8'
            ]);

            $this->userService->create($data);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create user. Please try again.');
        }
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
    public function edit(User $user)
    {
        return Inertia::render('User/Form', ['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $data = $request->validate([
                'name'  => 'required|string',
                'role'  => 'required|in:user,admin',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8'
            ]);

            if (empty($data['password'])) {
                unset($data['password']);
            }

            $this->userService->update($data, $user);

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update user. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $res = $this->userService->delete($user);

        if ($res) {
            return redirect()->route('users.index')->with('success', 'User has been deleted successfully!');
        }

        return redirect()->back()->with('error', 'Error deleting user!');
    }
}
