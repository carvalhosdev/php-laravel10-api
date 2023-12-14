## Blank Project - Laravel with user 

- liberar acesso ao apache, arquivo conf_vhost.txt
- php artisan migrate
- php artisan db:seed --class=UserSeeder (https://laravel.com/docs/10.x/seeding)
- php artisan migrate:fresh --seedDatabaseSeeder 
- php artisan make:provider RepositoryServiceProvider
- php artisan make:resource CategoryResource

## Add new Rule to check if email exists
- php artisan make:rule EmailExists
    public function validate(string $attribute, mixed $value, Closure $fail): void <br>
    {<br>
        //<br>
        if (User::where('email', $value)->exists()) {<br>
            $fail("O $attribute já existe.");<br>
        }<br><br>

        if (User::where('username', $value)->exists()) {<br>
            $fail("O $attribute já existe.");<br>
        }<br>
    }<br>


    ## global functions
    https://www.itsolutionstuff.com/post/laravel-10-create-custom-helper-functions-exampleexample.html