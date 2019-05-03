<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // test user
        $user1 = new \App\User;
        $user1->name = 'testuser';
        $user1->email = 'test@gmail.com';
        $user1->password = bcrypt('secret_test');
        $user1->firstName = 'Tex';
        $user1->lastName = 'Tester';
        $user1->address = 'Teststreet 7, 71117 Texas';
        $user1->isAdmin = true;
        $user1->save();

        // admin user
        $user2 = new \App\User;
        $user2->name = 'adminuser';
        $user2->email = 'admin@gmail.com';
        $user2->password = bcrypt('secret_admin');
        $user2->firstName = 'Armin';
        $user2->lastName = 'Assinger';
        $user2->address = 'Asselberg 17, 1100 Wien';
        $user2->isAdmin = true;
        $user2->save();

        // regular user
        $user3 = new \App\User;
        $user3->name = 'regularuser';
        $user3->email = 'user@gmail.com';
        $user3->password = bcrypt('secret_user');
        $user3->firstName = 'Reginald';
        $user3->lastName = 'Userius';
        $user3->address = 'Userbach 3, 3111 Usern';
        $user3->isAdmin = false;
        $user3->save();

        $user4 = new \App\User;
        $user4->name = 'geggo';
        $user4->email = 'geggo@gmail.com';
        $user4->password = bcrypt('secret_geggo');
        $user4->firstName = 'Georg';
        $user4->lastName = 'Strasser';
        $user4->address = 'Hochtor 7, 4322 Windhaag';
        $user4->isAdmin = false;
        $user4->save();

        $user5 = new \App\User;
        $user5->name = 'lizzy';
        $user5->email = 'lizzy@gmail.com';
        $user5->password = bcrypt('secret_lizzy');
        $user5->firstName = 'Lizzy';
        $user5->lastName = 'Stardust';
        $user5->address = 'Provenca 120, 08001 Barcelona';
        $user5->isAdmin = false;
        $user5->save();
    }

}
