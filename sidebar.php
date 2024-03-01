
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

*{
	list-style: none;
	text-decoration: none;
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Open Sans', sans-serif;
}

body{
    background: white;
}
.top_navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #2f3947;
    height: 50px;
    padding: 0 10px;
    
}

.top_navbar h1 {
    color: #fff;
    margin: 0;
    font-weight: 600;
    font-size: 1.5rem;
}

.links a {
    color: #fff;
    margin-left: 10px;
    text-decoration: none;
}

.links a:hover {
    color: #a2ecff;
}



.wrapper .sidebar{
	background: #2f3947;
	position: fixed;
	top: 0;
	left: 0;
	width: 225px;
	height: 100%;
	padding: 20px 0;
	transition: all 0.5s ease;
}

.wrapper .sidebar .profile{
	margin-bottom: 30px;
	text-align: center;
}

.wrapper .sidebar .profile img{
	display: block;
	width: 100px;
	height: 100px;
    border-radius: 50%;
	margin: 0 auto;
}

.wrapper .sidebar .profile h3{
	color: #ffffff;
	margin: 20px 10px;
    font-size: 1.2rem;
    font-weight: 500;
}

.wrapper .sidebar .profile p{
	color: rgb(206, 240, 253);
	font-size: 14px;
}

.wrapper .sidebar ul li a{
	display: block;
	padding: 13px 30px;
	border-bottom: 1px solid #2f3947;
	color: rgb(241, 237, 237);
	font-size: 16px;
	position: relative;
}

.wrapper .sidebar ul li a .icon{
	color: #dee4ec;
	width: 30px;
	display: inline-block;
}

 

.wrapper .sidebar ul li a:hover,
.wrapper .sidebar ul li a.active{
	color: #0c7db1;

	background:white;
    border-right: 2px solid #2f3947;
}

.wrapper .sidebar ul li a:hover .icon,
.wrapper .sidebar ul li a.active .icon{
	color: #0c7db1;
}

.wrapper .sidebar ul li a:hover:before,
.wrapper .sidebar ul li a.active:before{
	display: block;
}

.wrapper .section{
	width: calc(100% - 225px);
	margin-left: 225px;
	transition: all 0.5s ease;
}

.wrapper .section .top_navbar{
	background: #2f3947;;
	height: 50px;
	display: flex;
	align-items: center;
	padding: 0 30px;
 
}

.wrapper .section .top_navbar .hamburger a{
	font-size: 28px;
	color: #f4fbff;
}
.wrapper .sidebar ul {
    padding: 0;
    margin: 0;
    text-align: left;
}


.wrapper .section .top_navbar .hamburger a:hover{
	color: #a2ecff;
}
.hamburger{
    cursor: pointer;
    color: #fff;
    padding: 2px 5px;
    border: 1px transparent #fff;
    border-radius: 5px;
}
.hamburger:hover{
    
}

 

body.active .wrapper .sidebar{
	left: -225px;
}

body.active .wrapper .section{
	margin-left: 0;
	width: 100%;
}

    </style>
</head>
<body class="active">
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <span>
                        <i class="fas fa-bars"></i>
                    </span>
                </div>
                <h1>Emailing Server</h1> <!-- Title -->
                <div class="links">
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar">
            <div class="profile">
                <h3>Navigation</h3>
            </div>
            <ul>
                <li>
                    <a href="#" >
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">My Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="logs.php">
                        <span class="icon"><i class="fas fa-boxes"></i></span>
                        <span class="item">Logs</span>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <span class="icon"><i class="fas fa-user-circle"></i></span>
                        <span class="item">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-bullhorn"></i></span>
                        <span class="item">Campaign</span>
                    </a>
                </li>
                <li>
                    <a href="testing.php">
                        <span class="icon"><i class="fas fa-vial"></i></span>
                        <span class="item">Testing</span>
                    </a>
                </li>
                <li>
                    <a href="production.php">
                        <span class="icon"><i class="fas fa-chart-line"></i></span>
                        <span class="item">Production</span>
                    </a>
                </li>
                <li>
                    <a href="sendsmtp.php">
                        <span class="icon"><i class="fas fa-user-shield"></i></span>
                        <span class="item">Gmail SMTP</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <script>
    var hamburger = document.querySelector(".hamburger");
    var body = document.querySelector("body");
    hamburger.addEventListener("click", function() {
        body.classList.toggle("active");
    });
</script>

</body>
</html>