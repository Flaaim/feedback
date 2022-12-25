<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:manager {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда создает менеджера';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
        ]);
        $user->setUserRole('Manager');
        return $this->info('Менеджер '.$this->argument('name').' успешно создан');
    }
}
