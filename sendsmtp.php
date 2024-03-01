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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
.form-group {
    margin-bottom: 20px;
}

/* Style for labels */
label {
    font-weight: bold;
}

/* Style for error messages */
.text-danger {
    color: #dc3545;
    font-size: 12px;
}

/* Style for buttons */
.btnSendMail {
    background-color: #28a745;
    color: #fff;
}

/* Responsive styles for small devices */
@media (max-width: 768px) {
    .sub-container {
        flex-direction: column;
    }
    .left-div,
    .right-div {
        flex-basis: 100%;
    }
}

</style>

<body>
<div class="container">
 <div class="title-div">Testing Portal</div>
 <div class="sub-container">
   <div class="left-div">
     <div class="left-title">All Server</div>
     <!-- Add content for left-div here -->
   </div>
   <div class="right-div">
     <div class="right-title">Form</div>
     <div class="mb-4">
        <form id="sendMailForm" method="post" action="send.php">
        <div class="row ml-1 mr-1 text-center">
                <div class="form-group">
                <label>Sending Mode</label><br>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sending_type" id="sending_type1" checked="" value="test">
                    <label class="form-check-label" for="inlineRadio1">Test</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sending_type" id="sending_type2" value="bulk">
                    <label class="form-check-label" for="inlineRadio2">Bulk</label>
                    </div>                         
            </div>
        </div>
                                                      
        <div class="row ml-1 mr-1">
            <div class="form-group col-12 ">
            <label>Email From <b class="text-danger">*</b></label>
            <input type="text" class="form-control" id="from_email" name="from_email" value="" placeholder="Enter From Email Address" fdprocessedid="p554ql">
            <span class="text-danger customError error_from_email"></span>
        </div>
        </div>

        <div class="row ml-1 mr-1">
            <div class="form-group col-12 ">
            <label>
            From Name<b class="text-danger">*</b>
            
            </label>
            <input type="text" class="form-control" id="from_name" name="from_name" value="" placeholder="Enter From Name" fdprocessedid="3qsjen">
            &nbsp;<div class="form-check form-check-inline text-xs">
                        <input class="form-check-input" type="radio" name="from_name_encodeing" id="from_name_encodeing1" value="UTF8-B">
                        <label class="form-check-label" for="inlineRadio1">UTF8-B</label>
                        </div>
                        <div class="form-check form-check-inline text-xs">
                        <input class="form-check-input" type="radio" name="from_name_encodeing" id="from_name_encodeing2" value="UTF8-Q">
                        <label class="form-check-label" for="inlineRadio2">UTF8-Q</label>
                        </div>    
                        <div class="form-check form-check-inline text-xs">
                        <input class="form-check-input" type="radio" name="from_name_encodeing" id="from_name_encodeing3" checked="" value="none">
                        <label class="form-check-label" for="inlineRadio2">RESET</label>
                        </div> 
            <span class="text-danger customError error_from_name"></span>
        </div>
        </div>     
        <div class="row ml-1 mr-1">
            
                <div class="form-group   col-12 ">
                <label>
                    Subject <b class="text-danger">*</b>
                
                </label>
                    
                    <input type="text" class="form-control" id="subject" name="subject" value="" placeholder="Enter Subject" fdprocessedid="ma45qbr">
                    &nbsp;
                    <div class="form-check form-check-inline text-xs">
                        <input class="form-check-input" type="radio" name="subject_encodeing" id="subject_encodeing1" value="UTF8-B">
                        <label class="form-check-label text-xs" for="inlineRadio1">UTF8-B</label>
                        </div>
                        <div class="form-check form-check-inline text-xs">
                        <input class="form-check-input " type="radio" name="subject_encodeing" id="subject_encodeing2" value="UTF8-Q">
                        <label class="form-check-label text-xs" for="inlineRadio2">UTF8-Q</label>
                        </div>    
                        <div class="form-check form-check-inline text-xs">
                        <input class="form-check-input" type="radio" name="subject_encodeing" id="subject_encodeing3" checked="" value="none">
                        <label class="form-check-label text-xs" for="inlineRadio2">RESET</label>
                        </div>        
                    
                <span class="text-danger customError error_subject"></span>
        </div> 
        </div>
                    
        <div class="row ml-1 mr-1 ">
        <div class="form-group col-12 ">
        <label>Test Mail</label>
        <input class="form-control" rows="4" id="test_email" name="test_email" placeholder="Put Test Email Id here"></input>
        <span class="text-danger customError error_test_email"></span>
        </div> 
        </div>
                                                                 
        <div class="row ml-1 mr-1">
            <div class="form-group col-4">
                <label>Content Type</label><br>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="content_type" id="content_type1" value="plain">
                    <label class="form-check-label" for="inlineRadio1">Plain</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="content_type" id="content_type2" checked="" value="html">
                    <label class="form-check-label" for="inlineRadio2">HTML</label>
                    </div>    
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="content_type" id="content_type3" value="mime">
                    <label class="form-check-label" for="inlineRadio2">MIME</label>
                    </div>     
                </div>

                <div class="form-group  col-4">
                <label>Content Encodeing</label>
                <select name="content_encoding" class="form-control" id="content_encoding" fdprocessedid="nywqjz">
                
                <option value="quoted-printable">Quoted Printable</option>     
                <option value="base64">Base64 Encoding</option>
                
                <option value="7bit">7Bit Encoding</option>
                <option value="8bit">8Bit Encoding</option>
                
                
                        </select>
                </div>

                <div class="form-group  col-4">
                <label>Character Encodeing</label>
                <select name="character_encoding" class="form-control" id="character_encoding" fdprocessedid="xvrum">
                <option value="quoted-printable">Quoted Printable</option>  
                <option value="base64">Base64 Encoding</option>
                
                <option value="7bit">7Bit Encoding</option>
                <option value="8bit">8Bit Encoding</option>
                <!-- <option value="binary">Binary Encoding</option> -->
                
                        </select>
                </div>

                    
        </div>
        <div class="row ml-1 mr-1">
        <div class="form-group col-sm-6">
            <label>Data File</label>
            <select name="data_file" id="data_file" class="form-control">
                <?php
                // Directory containing the files
                $directory = 'emails-folder';

                // Get all files in the directory
                $files = scandir($directory);

                // Remove '.' and '..' from the list
                $files = array_diff($files, array('.', '..'));

                // Iterate over the files and create options for the dropdown
                foreach ($files as $file) {
                    echo '<option value="' . $file . '">' . $file . '</option>';
                }
                ?>
            </select>
            <span class="text-danger customError error_data_file"></span>
                </div>
                <div class="form-group col-sm-6">
                    <!-- Content for the second half-width form group -->
                    <label>Count</label>
                    <input type="text" class="form-control" id="count" name="count" value="100" placeholder="Enter Mail Limit" fdprocessedid="mx2cdp">
                    <span class="text-danger customError error_limit"></span>
                </div>
            </div>

                      
        <div class="row ml-1 mr-1">
        <div class="form-group col-12 htmlDiv">
        <label>HTML Body <b class="text-danger">*</b>&nbsp;&nbsp;
        <!-- <a href="javascript:void(0);" class="text-info tempPreview">View Template</a>                     -->
            
        </label>
        <textarea class="form-control" rows="5" id="email_body" name="email_body" placeholder="Put HTML here"></textarea>
        
        <span class="text-danger error_email_body"></span>
        </div> 
        </div>
            
        <div class="row ml-1 mr-1">
            <div class="form-group col-12 plainDiv">
            <label>Plain</label>
            <textarea class="form-control" rows="5" id="plain_text" name="plain_text" placeholder="Put Plain text here"></textarea>
            <span class="text-danger customError error_plain_text"></span>
        </div> 
        </div>
        <div class="row ml-1 mr-1">
            <div class="form-group col-12">
                <button type="submit" class="btn btn-block btn-success btnSendMail" fdprocessedid="skv8yh">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                    <span class="ml-2">SEND</span>
                </button>
            </div>
        </div>   
        </form> 
        </div>
   </div>
 </div>
</div>
</body>
<script>
    $(document).ready(function () {
    $('#sendMailForm').submit(function () {
        // Disable the button and show loading spinner
        $('.btnSendMail').prop('disabled', true);
        $('.btnSendMail').find('.spinner-border').show();

        // Submit the form
        return true;
    });
});

</script>
</html>
<!-- 
        <div class="row ml-4  mr-4">
                    
                    <div class="form-group">
                        <label>Message Id</label><br>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="msg_id_option" id="msg_id_option" checked="" value="default">
                            <label class="form-check-label" for="inlineRadio1">Default</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="msg_id_option" id="msg_id_option" value="custom">
                            <label class="form-check-label" for="inlineRadio2">Custom</label>
                            </div>                         
                    </div>
                </div> -->
        

<!--             
            <div class="row ml-4 mr-4">

            <div class="form-group col-8 msg_custom" style="display:none;">
            <div class="form-group ">
                <label>
                Custom Message Id<b class="text-danger">*</b>
                
                </label>
                <input type="text" class="form-control" id="custom_message_id" name="custom_message_id" value="" placeholder="Enter Custom Message Id">
                <small class="test-info">[[num(5)]]-[[smallchar(5)]]-[[bigchar(5)]]-[[mixall(10)]]##time@##domain</small>
            </div>

            </div>

            <div class="form-group col-8  msg_default">
                            <label>Select Message Id <b class="text-danger">*</b></label>
                            <select id="message_id" name="message_id" class="form-control" fdprocessedid="22y6aa">
                            <option value="1">Pattern 1
                                        
                                            </option><option value="2">Pattern 2
                                        
                                            </option><option value="3">Pattern 3
                                        
                                            </option><option value="4">Pattern 4
                                        
                                            </option><option value="5">Pattern 5
                                        
                                            </option><option value="6">Pattern 6
                                        
                                            </option><option value="7">Pattern 7
                                        
                                            </option><option value="8">Pattern 8
                                        
                                            </option><option value="9">Pattern 9
                                        
                                            </option><option value="10">Pattern 10
                                        
                                            </option><option value="11">Pattern 11
                                        
                                            </option><option value="12">Pattern 12
                                        
                                            </option><option value="13">Pattern 13
                                        
                                            </option><option value="14">Pattern 14
                                        
                                            </option><option value="15">Pattern 15
                                        
                                            </option><option value="16">Pattern 16
                                        
                                            </option><option value="17">Pattern 17
                                        
                                            </option><option value="18">Pattern 18
                                        
                                            </option><option value="19">Pattern 19
                                        
                                            </option><option value="20">Pattern 20
                                        
                                            </option><option value="21">Pattern 21
                                        
                                            </option><option value="22">Pattern 22
                                        
                                            </option><option value="23">Pattern 23
                                        
                                            </option><option value="24">Pattern 24
                                        
                                            </option><option value="25">Pattern 25
                                        
                                            </option><option value="26">Pattern 26
                                        
                                            </option><option value="27">Pattern 27
                                        
                                            </option><option value="28">Pattern 28
                                        
                                            </option>                                              </select>
            </div>

                        <div class="form-group col-4 ">
                            <label>Message ID Domain <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="message_id_domain" name="message_id_domain" value="" placeholder="Enter Message Id Domain Name" fdprocessedid="zpbjpi">
                            <span class="text-danger customError error_message_id_domain"></span>
                            </div>
            </div> -->
            
            
            

