<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = factory(App\Supplier::class, 20)->create();

        $users = factory(App\User::class, 5)->create();

        factory(App\User::class)->create([
            'name' => 'Test',
            'email' => 'test@test.test',
            'password' => bcrypt('Test'), // secret
            'remember_token' => str_random(10),
        ]);

        $users->each(function ($user) {
            $orders = $user
                ->orders()
                ->saveMany(factory(App\Order::class, rand(5, 30))->make());

            $orders->each(function ($order) {
                $order
                    ->orderLines()
                    ->saveMany(factory(App\OrderLine::class, rand(1, 10))->make());
                });
        });
    }
}
