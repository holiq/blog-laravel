<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$roles = Role::orderBy('created_at', 'DESC')->paginate(10);
		$permissions = Permission::all();
		return view('admin.role.index', compact('roles', 'permissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validation = $request->validate([
			'name' => 'required|string|min:5|max:50',
			'permission' => 'required',
		]);
		
		$role = Role::firstOrCreate([
			'name' => $request->name,
		]);
		$role->syncPermissions($request->permission);
		
		return redirect()->back()->with('success', 'Role: '.$role->name.' Added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$role = Role::findOrFail($id);
		$permissions = Permission::all()->pluck('name');
		$hasPermission = $role->permissions->pluck('name')->toArray();
		
		return view('admin.role.edit', compact('role', 'permissions', 'hasPermission'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$role = Role::findById($id);
		$role->syncPermissions($request->permission);
		
		return redirect()->route('role.index')->with(['success' => 'Role Updated']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$role = Role::findOrFail($id);
		$role->delete();
		
		return redirect()->back()->with(['success' => 'Role: ' . $role->name . ' Deleted']);
	}
}
