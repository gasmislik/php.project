<!--index_ad.php-->  
<!DOCTYPE html>
<html lang="en" class="!scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style_index.css" />
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="icon" href="..\img\3.png" />
</head>

<body class="body-home text-white">
    <div class="black-fill d-flex align-items-center justify-content-center custom-bg">
        <!-- Sign Up Form -->
        <div class="border rounded-5 bg-transparent shadow box-area" id="signup" style="display:none;">
            <div class="text-center">
                <img src="..\img\3.png" alt="logo">
                <h1 class="form-title">Admin Register</h1>
            </div>
            <form method="post" action="../backend/Register_ad.php">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="fName" id="fName" placeholder=" " required>
                    <label for="fName">First Name</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="lName" id="lName" placeholder=" " required>
                    <label for="lName">Last Name</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder=" " required>
                    <label for="email">Email</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="registerPassword" placeholder=" " required>
                    <label for="registerPassword">Password</label>
                    <img src="https://cdn-icons-png.flaticon.com/128/10812/10812267.png" alt="Toggle Password" id="eyeicon-password" class="toggle-password">
                </div>
                <div class="input-group">
                    <i class="fas fa-key"></i>
                    <input type="password" name="code" id="code" placeholder=" " required>
                    <label for="code">Admin Code</label>
                    <img src="https://cdn-icons-png.flaticon.com/128/10812/10812267.png" alt="Toggle Code" id="eyeicon-code" class="toggle-password">
                </div>
                <input type="submit" class="btn" value="Sign Up" name="signUp">
            </form>
            
            <div class="links text-center">
                <p>Already Have Account?</p>
                <button id="signInButton" class="btn-link">Sign In</button>
            </div>
        </div>

        <!-- Sign In Form -->
        <div class="border rounded-5 bg-transparent shadow box-area" id="signIn">
            <div class="text-center">
                <img src="..\img\3.png" alt="logo">
                <h1 class="form-title">Admin Sign In</h1>
            </div>
            <form method="post" action="../backend/Register_ad.php">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="loginEmail" placeholder=" " required>
                    <label for="loginEmail">Email</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="loginPassword" placeholder=" " required>
                    <label for="loginPassword">Password</label>
                    <img src="https://cdn-icons-png.flaticon.com/128/10812/10812267.png" alt="Toggle Password" id="eyeicon-login" class="toggle-password">
                </div>
                <p class="recover">
                    <a href="#">Recover Password</a>
                </p>
                <input type="submit" class="btn" value="Sign In" name="signIn">
            </form>
            
            <div class="links text-center">
                <p>Don't have an account yet?</p>
                <button id="signUpButton" class="btn-link">Sign Up</button>
            </div>
        </div>
    </div>

    <?php include '../partials_admin/footer.php'; ?>
