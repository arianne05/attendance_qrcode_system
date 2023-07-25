//Logout Alert
function logoutAlert() {
    Swal.fire({
      icon: "question",
      title: "Logout",
      text: "Are you sure you want to logout?",
      showCancelButton: true,
    }).then(function (result) {
      if (result.isConfirmed) {
        window.location.href = "../logout.php";
      }
    });
  }