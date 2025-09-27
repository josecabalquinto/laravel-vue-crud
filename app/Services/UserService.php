<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function getPaginatedUser(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = User::query();

        // You can use this block for filters function in the future
        // if(isset($filters['name'])) {
        //     $query->where('name', 'like', '%'. $filters['name'] . '%');
        // }

        return $query->paginate($perPage);
    }

    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        try {
            DB::beginTransaction();

            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(array $data, User $user): User
    {
        try {
            DB::beginTransaction();

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);

            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function delete(User $user): Bool
    {
        try {
            DB::beginTransaction();

            $res = $user->delete();

            DB::commit();

            return $res;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
