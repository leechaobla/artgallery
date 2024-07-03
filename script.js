document.addEventListener("DOMContentLoaded", function() {
    const signupForm = document.querySelector("#signup-form");
    const loginForm = document.querySelector("#login-form");

    if (signupForm) {
        signupForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(signupForm);
            fetch("signup.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === "success") {
                    window.location.href = "login.html";
                }
            });
        });
    }

    if (loginForm) {
        loginForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === "success") {
                    window.location.href = "profile.php";
                }
            });
        });
    }
});
