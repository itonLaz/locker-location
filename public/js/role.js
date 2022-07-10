$('.view_permissions').on('click', function(){
    let role_id = $(this).data('role_id');
    
    getRolePermissions(role_id).then(permissions => {
        
        let permission_html = '';

        $('#save_changes_btn').attr('disabled', role_id == 1 ? true : false);

        permissions.all_permissions.forEach(permission => {
            permission_html += `
                <div class="custom-control custom-checkbox mb-3">
                    <input class="custom-control-input" id="${permission.id}" type="checkbox" ${permissions.role_permissions.includes(permission.id) || role_id == 1 ? 'checked' : ''} ${role_id == 1 ? 'disabled' : ''}>
                    <label class="custom-control-label" for="${permission.id}">${permission.name}</label>
                </div>`;
        });
            
        $('#permission_list').html(permission_html);
    });
});


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
    const permissions = await response.json();

    return permissions;
}