<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = User::orderBy('id', 'DESC')->paginate(10);
		return view('admin.users.index', compact('users'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$role = Role::orderBy('name', 'ASC')->get();
		return view('admin.users.create', compact('role'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param	\Illuminate\Http\Request	$request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string|max:100',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
			'role' => 'required|string|exists:roles,name'
		]);

		$user = User::firstOrCreate([
			'email' => $request->email
		],
		[
			'name' => $request->name,
			'slug' => SlugService::createSlug(User::class, 'slug', $request->name),
            'bio' => 'I like Seccodeid',
            'photo' => '',
			'password' => Hash::make($request->password),
			'status' => true,
		]);
		
		$user->assignRole($request->role);
		return redirect()->route('users.index')->with(['success' => 'User: ' . $user->name . ' Ditambahkan']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param	int	$id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param	int	$id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);
		return view('admin.users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param	\Illuminate\Http\Request	$request
	 * @param	int	$id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'name' => 'required|string|max:100',
			'email' => 'required|email|exists:users,email',
			'password' => 'nullable|min:6',
		]);
		
		$user = User::findOrFail($id);
		$password = !empty($request->password) ? Hash::make($request->password):$user->password;
		$user->update([
			'name' => $request->name,
			'slug' => SlugService::createSlug(User::class, 'slug', $request->name),
			'password' => $password
		]);
		return redirect(route('users.index'))->with(['success' => 'User: ' . $user->name . ' Diperbaharui']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param	int	$id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()->back()->with(['success' => 'User: ' . $user->name . ' Dihapus']);
	}
	
	
	public function rolePermission(Request $request)
	{
		$role = $request->get('role');
		
		//Default, set dua buah variable dengan nilai null
		$permissions = null;
		$hasPermission = null;
		
		//Mengambil data role
		$roles = Role::all()->pluck('name');
		
		//apabila parameter role terpenuhi
		if(!empty($role)) {
			//select role berdasarkan namenya, ini sejenis dengan method find()
			$getRole = Role::findByName($role);
				
			//Query untuk mengambil permission yang telah dimiliki oleh role terkait
			$hasPermission = DB::table('role_has_permissions')
			->select('permissions.name')
			->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
			->where('role_id', $getRole->id)
			->get()->pluck('name')->all();
			
			//Mengambil data permission
			$permissions = Permission::all()->pluck('name');
		}
		return view('admin.users.role_permission', compact('roles', 'permissions', 'hasPermission'));
	}
	
	
	public function addPermission(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string|unique:permissions'
		]);
		
		$permission = Permission::firstOrCreate([
			'name' => $request->name
		]);
		return redirect()->back();
	}
	
	public function setRolePermission(Request $request, $role)
	{
		//select role berdasarkan namanya
		$role = Role::findByName($role);
		
		//fungsi syncPermission akan menghapus semua permissio yg dimiliki role tersebut
		//kemudian di-assign kembali sehingga tidak terjadi duplicate data
		$role->syncPermissions($request->permission);
		return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
	}
	
	public function roles(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$roles = Role::all()->pluck('name');
		return view('admin.users.roles', compact('user', 'roles'));
	}
	
	public function setRole(Request $request, $id)
	{
		$this->validate($request, [
			'role' => 'required'
		]);
		
		$user = User::findOrFail($id);
		//menggunakan syncRoles agar terlebih dahulu menghapus semua role yang dimiliki
		//kemudian di-set kembali agar tidak terjadi duplicate
		$user->syncRoles($request->role);
		return redirect()->back()->with(['success' => 'Role Sudah Di Set']);
	}
}
