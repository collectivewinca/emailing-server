<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

?>
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
       .container {
           display: flex;
           flex-direction: column;
           padding: 10px 10px;
           color:#2f3947;
           gap: 4px;
       }
       .title-div {
           font-size: 24px;  /* Adjust font size as needed */
           font-weight: bold;
           margin-bottom: 10px;
       }
       .sub-container {
           display: flex;
           flex-direction: row;
           gap: 10px;
       }
       .left-div, .right-div {
           height: 300px; 
           border: 1px solid #2f3947;
           border-top: 4px solid #2f3947;
           border-radius: 6px;
       }
       .left-div {
           width: 22%;
       }
       .right-div {
           width: 80%;
           display: flex;
           height: 100%;
           flex-direction: column;
       }
       .left-title, .right-title{
        width: 100%;
        padding: 3px 8px;
        font-weight: 600;
        border-bottom: 1px solid lightgray 
       }
       .form-container {
           width: 100%;
           margin: 0 auto;
           padding: 20px 30px;
           display: flex;
           flex-wrap: wrap;
           gap: 10px;
       }

       .form-group {
           flex: 1 1 calc(50% - 10px); /* Two inputs per row */
           margin-bottom: 15px;
       }

       @media (max-width: 768px) {
           .form-group {
               flex: 1 1 100%; /* One input per row on smaller screens */
           }
       }

       .form-group label {
           display: block;
           margin-bottom: 5px;
           font-size: 0.9rem;
           color: #2f3947;
       }

       

       input[type="text"],
       select,
       textarea {
           width: 100%;
           padding: 8px;
           border: 1px solid #ccc;
           border-radius: 4px;
           font-size: 0.85rem;
       }

       /* .radio-group input[type="radio"] {
           display: none;
       } */
       .radio-group{
              display: flex;
              align-items: center;
       }

       .radio-group label {
           display: inline-block;
           padding: 3px 10px;
           background-color: #f0f0f0;
           border-radius: 40px;
           cursor: pointer;
           padding-bottom: 5px
       }

       .radio-group input[type="radio"]:checked + label {
           background-color: #0060df;
           color: #fff;
       }
       .form-textarea {
    width: 100%;
    margin-bottom: 15px;
}

.form-textarea label {
    display: block;
    margin-bottom: 5px;
    font-size: 0.9rem;
    color: #2f3947;
}

.form-textarea textarea {
    width: calc(100% - 16px); /* Adjust for the textarea padding */
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 0.85rem;
    
}

.radio-group {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center; /* Align radio buttons and labels horizontally */
}

.radio-group label {
    margin-right: 10px;

}

.form-textarea button.submitBtn {
    padding: 8px 15px;
    background-color: #2f3947;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
    font-size: 0.85rem;
    margin: 0 auto; /* Center the button */
    display: block; /* Ensure it takes up full width */
}


.form-textarea button.submitBtn:hover {
    background-color: #000;
}

   </style>
</head>
<body class="loggedin">
<div class="">
<div class="container">
 <div class="title-div">Testing Portal</div>
 <div class="sub-container">
   <div class="left-div">
     <div class="left-title">All Server</div>
     </div>
   <div class="right-div">
     <div class="right-title">Form</div>
     <div class="form-container">
        <div class="form-group">
            <label for="esubject">Subject</label>
            <input type="text" id="esubject" required placeholder="Enter Subject Of Email" name="esubject">
        </div>
        <div class="form-group">
            <label for="efrom">From Email</label>
            <input type="text" id="efrom" required placeholder="Sender Email" name="efrom">
        </div>
        <div class="form-group">
            <label for="encodingtype">Encoding Type</label>
            <select name="encodingtype" id="encodingtype">
                <option value="base64">Base64</option>
                <option value="quoted">Quoted</option>
                <option value="plain">Plain</option>
                <option value="hex">Hex</option>
            </select>
        </div>
        <div class="form-group">
            <label for="returnpath">Return Path</label>
            <input type="text" id="returnpath" placeholder="Return Path" name="returnpath">
        </div>
        <div class="form-group">
            <label for="etest">Test Emails</label>
            <input type="text" id="etest" required placeholder="Test Emails Separated By Comma" name="etest">
        </div>
        <div class="form-group">
            <label for="xdelay">X-Delay / Mail</label>
            <select id="xdelay" name="xdelay">
                <option value="0">0</option>
                <option value="1000">1000</option>
                <option value="5000">5000</option>
                <option value="10000">10000</option>
                <option value="20000">20000</option>
                <option value="50000">50000</option>
                <option value="100000">100000</option>
                <option value="200000">200000</option>
                <option value="500000">500000</option>
                <option value="1000000">1000000</option>
                <option value="1500000">1500000</option>
                <option value="2000000">2000000</option>
                <option value="2500000">2500000</option>
                <option value="3000000">3000000</option>
                <option value="3500000">3500000</option>
                <option value="4000000">4000000</option>
                <option value="4500000">4500000</option>
                <option value="5000000">5000000</option>
            </select>
        </div>
        <div class="form-textarea">
            <label for="headerstext">Enter Headers Each In New Line</label>
            <textarea required id="headerstext" style="height: 15rem;" placeholder="Enter Headers one in a line" name="headerstext">MIME-Version: 1.0
From: &lt;contact@__host&gt;
To: &lt;__to&gt;
Subject: __subject
Reply-to: &lt;reply@__host&gt;
Precedence: Bulk
Content-Type: text/html</textarea>
        </div>
        <div class="form-textarea">
            <label for="htmlcode">Email Body</label>
            <textarea id="htmlcode" required placeholder="HTML Code" style="height: 25rem;" name="htmlcode"></textarea>
        </div>
        <div class="form-textarea radio-group">
            <input type="radio" id="style" name="hidetype" value="style" style="margin-bottom: 7px; margin-right: 5px;" checked>
            <label for="style">Style</label>
            <input type="radio" id="style" name="hidetype" value="title" style="margin-bottom: 7px; margin-right: 5px;" >
            <label for="style">Title</label>
            <input type="radio" id="style" name="hidetype" value="object" style="margin-bottom: 7px; margin-right: 5px;">
            <label for="style">Object</label>
            <input type="radio" id="style" name="hidetype" value="script" style="margin-bottom: 7px; margin-right: 5px;">
            <label for="style">Script</label>
        </div>
        <div class="form-textarea">
            <textarea id="negativehtml" placeholder="Negative" style="height: 15rem;" name="negativehtml"></textarea>
        </div>
        <div class="form-textarea">
            <button class="submitBtn" id="sendmailsbutton" name="sendemails">Submit</button>
        </div>
     </div>
 </div>
</div>
</div>
</div>
</body>
</html>
