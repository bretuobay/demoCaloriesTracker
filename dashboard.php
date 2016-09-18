<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>::Calories Count ::</title>

</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img  alt="Brand" src="assets/images/logo.png">
        </a>

        <div class="navbar-header pull-right">


             <ul class="nav navbar-nav">
                <li><a class="navbar-right" href="#">
                    <?php
                    session_start();
                    echo "Welcome :". $_SESSION['curr_user'];
                    ?>
                    </a></li>
            </ul>";


            <ul class="nav navbar-nav">
                <li><a class="navbar-right" id="logout_link" href="#logout">
                    Logout
                </a></li>
            </ul>

        </div>
    </div>
</nav>


<div class="container">

    <div class="row">

        <div class="col-sm-8">

            <div id="dashboard">

                <h1>Awesome Dashboard</h1>

                <section class="container select-area" >
                    <select id="calorieslist" class="selectpicker">
                        <option value="default">----</option>
                    </select>
                    <input type="submit"  class="btn btn-default pull-right" id="delete-entry" value="Delete" >
                    <input type="submit"  class="btn btn-default pull-right" id="fill-form" value="Edit" >
                </section>

                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="email"  class="form-control" id="id" aria-describedby="idHelp" placeholder="">
                    <small id="idHelp" class="form-text text-muted"></small>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="email"  class="form-control" id="description" aria-describedby="descriptionHelp" placeholder="Enter description">
                    <small id="descriptionHelp" class="form-text text-muted"></small>
                </div>

                <div class="form-group">
                    <label for="num_calories">Number of Calories</label>
                    <input type="text"  class="form-control" id="num_calories" aria-describedby="caloriesHelp" placeholder="Enter calories">
                    <small id="caloriesHelp" class="form-text text-muted"></small>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date"  class="form-control" id="date" aria-describedby="dateHelp" placeholder="Enter date">
                    <small id="dateHelp" class="form-text text-muted"></small>
                </div>

                <div class="form-group">
                    <label for="email">Time</label>
                    <input type="time"  class="form-control" id="time" aria-describedby="timeHelp" placeholder="Enter time">
                    <small id="timeHelp" class="form-text text-muted"></small>
                </div>

                <button type="submit" id="calories-button" class="btn btn-default pull-right">Save</button>


            </div>




        </div>

        <div class="col-sm-4">
            <div id="register">


                <div class="wrapper">

                    <form class="form-register">
                        <h3>Register</h3>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"  class="form-control" id="password" aria-describedby="passwordHelp" placeholder="xxxxxxxxxx">
                            <small id="passwordHelp" class="form-text text-muted">Enter a secure pass word at least 8 characters long.</small>
                        </div>

                        <!-- <div class="form-group">
                             <label for="confirm-password">Confirm Password</label>
                             <input type="password" class="form-control" id="confirm-password" aria-describedby="confirmPasswordHelp" placeholder="xxxxxxxxxx">
                             <small id="confirmPasswordHelp" class="form-text text-muted">Enter password again</small>
                         </div>

                         -->

                        <button type="submit" id="register-button" class="btn btn-default pull-right">Register</button>
                    </form>

                </div>
            </div>




            <div id="login">
                <div class="wrapper">

                    <form class="form-signin" >
                        <h3>Login </h3>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="lemail" name="email" placeholder="Email Address" required="" autofocus="" />
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="lpassword" name="password" placeholder="Password" required=""/>
                        </div>

                        <button type="submit" id="login-button" class="btn btn-default pull-right">Login</button>

                    </form>
                </div>
            </div>




        </div>






    </div>

</div>




<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src = "assets/js/app.js"></script>

</body>
</html>