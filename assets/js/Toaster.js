$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });
    // success , info , warning , error , question


    // $('.online').click(function() {
    //     Toast.fire({
    //         icon: 'success',
    //         title: 'Back to online.'
    //     })
    // }); 


    //!! Online and offline......

    window.addEventListener('online', function() {
        Toast.fire({
            icon: 'success',
            title: 'Your internet connection was restore.'
        });
    })
    window.addEventListener('offline', function() {
        Toast.fire({
            icon: 'error',
            title: 'No internet connection. Please connect your device with internet.'
        })
    });



    //!! Shortcut Key Restriction...

    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
    });
    document.onkeydown = function(e) {
        if (event.keyCode == 123) { // f12
            Toast.fire({
                icon: 'error',
                title: 'Right click and input facilities are disabled for security reason.'
            })
            return false;
        }
        if (e.ctrlKey && e.keyCode == "I".charCodeAt(0)) {
            Toast.fire({
                icon: 'error',
                title: 'Right click and input facilities are disabled for security reason.'
            })
            return false;
        }
        if (e.ctrlKey && e.keyCode == "C".charCodeAt(0)) {
            Toast.fire({
                icon: 'error',
                title: 'Right click and input facilities are disabled for security reason.'
            })
            return false;
        }
        if (e.ctrlKey && e.keyCode == "J".charCodeAt(0)) {
            Toast.fire({
                icon: 'error',
                title: 'Right click and input facilities are disabled for security reason.'
            })
            return false;
        }
        if (e.ctrlKey && e.keyCode == "U".charCodeAt(0)) {
            Toast.fire({
                icon: 'error',
                title: 'Right click and input facilities are disabled for security reason.'
            })
            return false;
        }
        if (e.ctrlKey && e.keyCode == "T".charCodeAt(0)) {
            Toast.fire({
                icon: 'error',
                title: 'Right click and input facilities are disabled for security reason.'
            })
            return false;
        }
        if (e.ctrlKey && e.keyCode == "R".charCodeAt(0)) {
            Toast.fire({
                icon: 'error',
                title: 'Right click and input facilities are disabled for security reason.'
            })
            return false;
        }
    }
});

//!! Right Click .....

function RightClick() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: 'error',
        title: 'Right click and input facilities are disabled for security reason.'
    })
    return false;
}