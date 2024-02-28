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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#sendmailsbutton').click(function() {
            $(document).prop('title', 'Processing...');
            // CustomNotify("INFO",'<i class="fa fa-spin fa-spinner"></i> Processing...');
            var ipsarray = [];
            $.each($("input[name='ipaddress']:checked"), function(){ 
                ipsarray.push($(this).val());                    
            });
            $('.processing').show(0);
            $('.sendbtn').hide(0);
            $('.killbtn').show(0);
            var formData = new FormData($('#sendmails')[0]);
            formData.append('serverips', ipsarray);
            $.ajax({
                url: '/actions/sendtesting.php',
                type: 'POST',
                xhr: function() { 
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
            })
            .done(function(data) {
                $(document).prop('title', 'Testing Portal');
                $('#mailsendcnt').html(data);
            })
            .fail(function() {
                $(document).prop('title', 'Testing Portal');
            });
            return false;
        });
    });
    </script>
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
        <form id="sendmails" method="post" enctype="multipart/form-data">
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
</form>
     </div>
 </div>
</div>
</div>
</div>
</body>
</html>
