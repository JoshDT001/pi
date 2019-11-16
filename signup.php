<!DOCTYPE html>
<?php
    session_start();
    require_once 'classes/Membership.php';
    $membership = new Membership();
    
    //Did the user enter a password and click submit?
    if($_POST && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && $_POST['password'] == $_POST['password2']) {
        $response = $membership->signup_user($_POST['username'], $_POST['password']);
    }
    
?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="css/normalize.css">
    <style>
        body {
            background-color: #eeeeee;
            font-family: Verdana, Arial, sans-serif;
            font-size: 90%;
        margin: 4em 0;
        }

        header {
            float: left;
            margin: 0 0 5px 0;
            padding: 0 0 0 0;
            width: 100%;
        }

        article, footer {
            display: block;
            margin: 0 auto;
            width: 90%;
        }

        a {
            color: #004466;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        a:visited {
            color: #666666;
        }

        article {
            background-color: #ffffff;
            border: #cccccc solid 1px;
            -moz-border-radius: 11px;
            -webkit-border-radius: 11px;
            border-radius: 11px;
            padding: 0 1em;
        }

        h1 {
            font-size: 140%;
        }

        ol {
            line-height: 1.4em;
            list-style-type: disc;
        }

        li.directory a:before {
            content: '[ ';
        }

        li.directory a:after {
            content: ' ]';
        }

        footer {
            font-size: 70%;
            text-align: center;
        }

        nav {
            text-align: center;
            padding: 5px 0;
            margin: 10px 0 0;
        }

        nav ul {
            list-style: none;
            margin: 0 10px;
            padding: 0;
        }

        nav li {
            display: inline-block;
        }

        nav a {
            font-weight: 800;
            padding: 15px 10px;
        }

        nav a, nav a:visited {
            color: #000;
        }

        nav a.selected, nav a:hover {
            color: #0F88B3;
        }
    </style>
    <title>Account:</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="browser.php?files=movies">Movies</a></li>
            <li><a href="browser.php?files=tvshows">TV Shows</a></li>
            <li><a href="account.php">My Account</a></li>
        </ul>
    </nav>
    <article>
        <div id="signup">
            <form method="post" action="">
                <h2>Sign up</h2>
                <p>
                    <label for="username">Username: </label>
                    <input type="text" name="username" />
                </p>

                <p>
                    <label for"password">Password: </label>
                    <input type="password" name="password" />
                </p>

                <p>
                    <label for"password2">Repeat Password: </label>
                    <input type="password" name="password2" />
                </p>

                <p>
                    <input type="submit" id="submit" value="Signup" name="submit" />
                </p>
            </form>
            <?php if(isset($response)) echo "<h4 class='alert'>" .$response . "</h4>"; ?>
        </div>

    </article>

    <footer>
        <p><a href="login.php?status=loggedout">Logout</a></p>
    </footer>

</body>
</html>



