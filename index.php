<!DOCTYPE html>
<html>
<style>
    form {
        border: 3px solid #f1f1f1
		size:medium;
    }

    input[type=text], input[type=password] {
        width: %;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #636863;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: %;
    }

        button:hover {
            opacity: 0.8;
        }

    .cancelbtn {
        width: 100px;
        padding: 10px 18px;
        background-color:#330099;
    }
.submitbtn{
width: 100px;
        padding: 10px 18px;
        background-color: #6382ea;
}
    
    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: ;
        }

        .cancelbtn {
            width: %;
        }
    }
span.psw1 {        float: right;
        padding-top: 16px;
}
span.psw1 {            display: block;
            float: ;
}
body
body {
	background-color: #99CCCC;
}
body {
	background-color: #CCCCCC;
}
.style1 {
	font-size: 16px;
	font-weight: bold;
	font-style: italic;
}
#form.style{
font-size:16px}
</style>
<body>
<form method="post" action="login.php">
    
      
<div class="style1"></div>
<div class="container">
            <p>
    
    <center>
   <span style="color:#FF0000;"><?php if(isset($_GET['err'])) { echo $_GET['err']; } ?></span>
   
            <h2 align="center"><b><i>SD Computers</i></b><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/login.png" width="83" height="94" align="absmiddle"></span></h2>
            
<label><b>Username </b></label>    
      <input type="text" placeholder="Enter Username" name="uname" required>
</center></p>
        <p>
              <center>
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
              
           </center> </p>
<p>  
            
            
            <center><button class="submitbtn" type="submit">Login</button>&nbsp;
            <button type="button" class="cancelbtn">Cancel</button></center>
        </div></p>
            
      
    </form>

</body>
</html>
