<?php

namespace Tests;
use Faker\Factory;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function loginUser()
    {

        // $faker = Faker::create('id_ID');
        // $data = User::create([
        //     'fullname' => 'amai',
        //     'email' => 'amais@gmail.com',
        //     'password' => Hash::make('password'),
        //     'telphone' => '0862352322323'
        // ]);

        // $user = User::create([
        //     'fullname' => $data['fullname'],
        //     'email' => $data['email'],
        //     'password' => $data['password'],
        //     'telphone' => $data['telphone'],
        // ]);

        $token = auth()->attempt([
            'email' => 'amais@gmail.com',
            'password' => 'password'
        ]);
        return ["token" => $token];
    }
}
