<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Home;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allUsers = User::withoutTrashed()->get()->toArray();
        $deletedUsers = User::onlyTrashed()->get()->toArray();
        $allRoles = Role::get()->toArray();

        return view('home', [
            'allUsers' => $allUsers,
            'deletedUsers' => $deletedUsers,
            'allRoles' => $allRoles]);
    }

    //роль метода edit() исполняет index()
    //в личном кабинете администратору предоставляется панель управления пользователями и их возможностями
    public function update(Request $request) 
    {
        $user = User::where('name', $request['name'])->first();
        if ($user == null) 
        {
            Session::flash('alertCode', 'warning');
            Session::flash('message', 'Пользователь не найден!');
            return;
        }

        $role = $request['Role'] == "Администратор" ? Role::where('slug', 'admin')->first() : Role::where('slug', 'operator')->first();
        $permissions = $request['Role'] == "Администратор" ? Permission::where('slug', 'all')->first() : Permission::where('slug', 'monitoring')->first();

        Session::flash('alertCode', 'success');
        Session::flash('message', 'Данные обновлены!');

        //Закрепление фактических роли и прав
        $user->roles()->sync($role);
        $user->permissions()->sync($permissions);
        // //Видимая часть в таблице users
        $user->Role = $request['Role'];
        $user->save();

        return redirect()->action([HomeController::class, 'index']);
    }

    /*
    Роль метода create() исполняет index()
    /в личном кабинете администратору предоставляется панель управления пользователями и их возможностями.

    Универсальный метод для создания или восстановления аккаунта.
    */
    public function store(Request $request) 
    {
        $nameRequest = $request->get('name');
        $emailRequest = $request->get('email');
        $roleRequest = $request->get('Role');
        $passwordRequest = $request->get('password');
        
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'Role' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $this->create($request->toArray(), $request, $validatedData);
        } catch (\Exception $error) {
            Session::flash('alertCode', 'danger');
            Session::flash('message', 'Ошибка валидации! Пользователь не создан.');
            \Log::error("Ошибка валидации" . $error->getMessage());
        }

        return redirect()->action([HomeController::class, 'index']);
    }

    protected function create(array $data, Request $request, array $validatedData)
    {
        $checkUser = User::where('name', $data['name'])->first();
        if ($checkUser != null)
        {
            Session::flash('alertCode', 'danger');
            Sessiom::flash('message', 'Такой пользователь уже существует!');
            return;
        }

        try {
            $createUser = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'Role' => $validatedData['Role'],
            ]);

            $user = User::where('name', $data['name'])->first();

            $role = $data['Role'] == "Администратор" ? Role::where('slug', 'admin')->first() : Role::where('slug', 'operator')->first();
            $permissions = $data['Role'] == "Администратор" ? Permission::where('slug', 'all')->first() : Permission::where('slug', 'monitoring')->first();

            Session::flash('alertCode', 'success');
            Session::flash('message', 'Пользователь успешно добавлен!');

            //Закрепление фактических роли и прав
            $user->roles()->attach($role);
            $user->permissions()->attach($permissions);
            //Видимая часть в таблице users
            $user->Role = $data['Role'];
            $user->save();
        } catch(\Exception $error) {
            \Log::error('Ошибка при создании пользователя' . $error->getMessage());
            return back()->with('error', 'Ошибка при создании пользователя, пожалуйста, попробуйте снова или обратитесь в техподдержку');
        }
    }

    public function destroy($id) 
    {
        $user = User::findOrFail($id);
        if (!$user) abort(404, 'Пользователь не найден.');

        $user->delete();

        Session::flash('alertCode', 'success');
        Session::flash('message', 'Пользователь успешно удалён!');
        
        return redirect()->action([HomeController::class, 'index']);
    }

    public function restore(Request $request) 
    {
        $userID = $request->input('user_id');
        // dd($userID);
        if (!$userID) {
        // Обработка ошибки, если ID не передан
            return back()->with('error', 'Не выбран пользователь для восстановления.');
        }

        $user = User::onlyTrashed()->findOrFail($userID);
        if (!$user) abort(404, 'Пользователь не найден.');

        // dd($user);

        $user->restore();
        
        Session::flash('alertCode', 'success');
        Session::flash('message', 'Пользователь успешно восстановлен!');
        
        return redirect()->action([HomeController::class, 'index']);
    }
}