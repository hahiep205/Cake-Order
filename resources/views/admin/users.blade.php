<!-- Section: User Management -->
<div class="section_header">
    <h2><i class="ri-user-line"></i> User Management</h2>
    <button class="btn_add" onclick="openAddUserModal()">
        Add User
    </button>
</div>

<div class="section_body">
    
    <div class="products_table_wrapper">
        <table class="products_table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td title="{{ $user->address }}">
                            {{ $user->address ? Str::limit($user->address, 40) : '-' }}
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="role_badge role_admin">Admin</span>
                            @else
                                <span class="role_badge role_user">User</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn_action btn_edit" onclick="editUser({{ $user->id }})">
                                Edit
                            </button>
                            <button class="btn_action btn_delete" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>