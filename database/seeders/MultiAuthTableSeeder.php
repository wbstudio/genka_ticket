<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Shop;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class MultiAuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $init_customers = [
        //     [
        //         'name' => 'テスト太郎',
        //         'email' => 'test@test.com',
        //         'password' => 'testpass',
        //         'ticket' => 0,
        //     ],

        //     // ここに追加できます
        // ];

        // foreach($init_customers as $init_customer) {

        //     $customer = new Customer();
        //     $customer->name = $init_customer['name'];
        //     $customer->email = $init_customer['email'];
        //     $customer->password = Hash::make($init_customer['password']);
        //     $customer->ticket = $init_customer['ticket'];
        //     $customer->save();

        // }

        // $init_shops = [
        //     [
        //         'name' => 'テスト店舗',
        //         'email' => 'shop@test.com',
        //         'password' => 'shoppass',
        //         'kind' => 0,
        //     ],

        //     // ここに追加できます
        // ];

        // foreach($init_shops as $init_shop) {

        //     $shop = new Shop();
        //     $shop->name = $init_shop['name'];
        //     $shop->email = $init_shop['email'];
        //     $shop->password = Hash::make($init_shop['password']);
        //     $shop->kind = $init_shop['kind'];
        //     $shop->save();
        // }

        $init_admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => 'adminpass',
            ],

            // ここに追加できます
        ];

        foreach($init_admins as $init_admin) {

            $admin = new Admin();
            $admin->name = $init_admin['name'];
            $admin->email = $init_admin['email'];
            $admin->password = Hash::make($init_admin['password']);
            $admin->save();
        }

    }
}
