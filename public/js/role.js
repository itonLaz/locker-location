var id_role;

$('.close_modal').on('click', function(){
    $('#PermissionModal').modal('hide');
})

$('.view_permissions').on('click', function(){
    $('#PermissionModal').modal('show');
    let role_id = $(this).data('role_id');
    
    getRolePermissions(role_id);
});

$('#save_changes_btn').on('click', function() {
    let selected = $('.custom-control-input:checked');
    let permissions = [];
    let role_id = id_role;

    selected.each(function(){
        permissions.push($(this).attr('value'));
    });
    
    updateRolePermission(role_id, permissions);
});

async function updateRolePermission(role_id = 0, permissions = {}) {
    let url = `/role-permissions/${role_id}`;
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let data = {
        permissions:permissions
    }

    const response = await fetch(url, {
        headers: {
            "Content-type": "application/json",
            "Accept": "application/json text-plain, */*",
            "X-request-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token,
        },
        method: "post",
        credentials: "same-origin",
        body: JSON.stringify(data)
    });

    if(response.status == 201) {
        $('#PermissionModal').modal('hide');        
        Swal.fire({
            title: 'Success!',
            icon: 'info',
            text: 'Permissions updated successfully',
            confirmButtonText: 'Done'
          })
    } else {
        Swal.fire({
            title: 'Error!',
            icon: 'error',
            text: 'Error on updating Permissions',
            confirmButtonText: 'Exit'
          })
    }
    
}

async function getRolePermissions(role_id = 0) {

    let url = `/role-permissions/${role_id}`;
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch(url, {
        headers: {
            "Content-type": "application/json",
            "Accept": "application/json text-plain, */*",
            "X-request-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token,
        },
        method: "get",
        credentials: "same-origin",
    });
    let permissions = await response.json();

    let permission_html = '';
    $('#save_changes_btn').attr('disabled', role_id == 1 ? true : false);

    permissions.all_permissions.forEach(permission => {
        permission_html += `
            <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input" name="permissions" id="${permission.id}" value="${permission.id}" type="checkbox" ${permissions.role_permissions.includes(permission.id) || role_id == 1 ? 'checked' : ''} ${role_id == 1 ? 'disabled' : ''}>
                <label class="custom-control-label" for="${permission.id}">${permission.name}</label>
            </div>`;
    });
        
    $('#permission_list').html(permission_html);

    id_role = role_id;
    // return permissions;
}