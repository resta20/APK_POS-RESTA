<?php

namespace App\Policies;

use App\Models\Jenis;
use App\Models\User;

class JenisPolicy
{
    /**
     * Semua user yang login (admin & kasir) boleh melihat daftar jenis.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Semua user yang login boleh melihat detail jenis.
     */
    public function view(User $user, Jenis $jenis): bool
    {
        return true;
    }

    /**
     * Hanya admin yang boleh membuat jenis baru.
     */
    public function create(User $user): bool
    {
        return $user->role->name === 'admin';
    }

    /**
     * Admin boleh update jenis apa saja.
     * Kasir hanya boleh update jenis yang ia buat sendiri.
     */
    public function update(User $user, Jenis $jenis): bool
    {
        if ($user->role->name === 'admin') {
            return true;
        }

        return $user->id === $jenis->user_id;
    }

    /**
     * Admin boleh hapus jenis apa saja.
     * Kasir hanya boleh hapus jenis yang ia buat sendiri.
     */
    public function delete(User $user, Jenis $jenis): bool
    {
        if ($user->role->name === 'admin') {
            return true;
        }

        return $user->id === $jenis->user_id;
    }
}