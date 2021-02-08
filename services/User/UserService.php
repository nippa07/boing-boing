<?php

namespace services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use services\Facade\MailFacade;

class UserService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function get($id)
    {
        return $this->user->find($id);
    }

    public function getByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function create($data)
    {
        return $this->user->create($data);
    }

    /**
     * update
     *
     * @param  mixed $user
     * @param  mixed $data
     * @return void
     */
    public function update(User $user, array $data)
    {
        return $user->update($this->edit($user, $data));
    }

    /**
     * edit
     *
     * @param  mixed $user
     * @param  mixed $data
     */
    protected function edit(User $user, $data)
    {
        return array_merge($user->toArray(), $data);
    }

    public function delete($id)
    {
        $user = $this->get($id);
        return $user->delete();
    }

    public function save($data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->user->create($data);
    }

    public function updateUser($user, $data)
    {
        $data['password'] = Hash::make($data['password']);

        $this->update($user, $data);
    }

    public function checkUser($data)
    {
        $user = $this->getByEmail($data['email']);

        if (!$user) {
            $user = $this->createUser($data);
        }
    }

    public function createUser($data)
    {
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];

        $password = $this->generatePassword();
        $data['password'] = Hash::make($password);

        $user = $this->create($data);

        MailFacade::sendUserDetails($user, $password);
        return $user;
    }

    public function generatePassword()
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, 8);
    }
}
