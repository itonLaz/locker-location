$('.view_permissions').on('click', function(){
    let role_id = $(this).data('role_id');
    let roles = getRolePermissions(role_id);
    console.log(roles);
});


async function getRolePermissions(role_id = 0) {

    let url = `/role-permissions/${role_id}`;
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(url, {
        headers: {
            "Content-type": "application/json",
            "Accept": "application/json text-plain, */*",
            "X-request-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token,
        },
        method: "get",
        credentials: "same-origin",
    })
    .then((data) => {
        console.log(data);
    })
    .catch(function(error){
        console.log(error);
        alert('Error on fetching Permissions'); //you can use alert of Argon.
    })

}