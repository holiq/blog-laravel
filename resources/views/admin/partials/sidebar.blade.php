<aside id="sidebar-wrapper">
	<div class="sidebar-brand">
		<a href="index.html">{{ __('Dashboard') }}</a>
	</div>
	<div class="sidebar-brand sidebar-brand-sm">
		<a href="index.html">{{ strtoupper(substr(env('APP_NAME'), 0, 2)) }}</a>
	</div>
	<ul class="sidebar-menu">
		<li class="menu-header">Dashboard</li>
		<li class="nav-item"><a href="{{ route('admin.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
		
		<li class="menu-header">Menu</li>
		
		@role('admin')
		<li class="nav-item dropdown">
			<a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Management Role</span></a>
			<ul class="dropdown-menu">
				<li class="nav-item">
					<a href="{{ route('role.index') }}" class="nav-link">
						<span>Role</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('users.roles_permission') }}" class="nav-link">
						<span>Role Permission</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('users.index') }}" class="nav-link">
						<span>Users</span>
					</a>
				</li>
			</ul>
		</li>
		@endrole
		
		@role('moderator')
		<li class="nav-item">
			<a href="{{ route('users.index') }}" class="nav-link">
				<i class="fas fa-users nav-icon"></i>
				<span>Users</span>
			</a>
		</li>
		@endrole
		
		<li class="nav-item">
			<a href="{{ route('category.index') }}" class="nav-link">
				<i class="fas fa-users nav-icon"></i>
				<span>Categories</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="{{ route('post.index') }}" class="nav-link">
				<i class="fas fa-users nav-icon"></i>
				<span>posts</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="{{ route('comment.index') }}" class="nav-link">
				<i class="fas fa-users nav-icon"></i>
				<span>Comments</span>
			</a>
		</li>
	</ul>
</aside>