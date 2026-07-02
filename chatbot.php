<?php

/* detect ajax request */

if(isset($_POST['question'])){

$q=$_POST['question'];

$reply="";

if($q=="order"){
$reply="📦 You can track order from My Orders page.";
}

elseif($q=="shipping"){
$reply="🚚 Delivery takes 3-5 days.";
}

elseif($q=="payment"){
$reply="💳 We accept UPI, Debit Card, Credit Card, COD.";
}

elseif($q=="return"){
$reply="🔄 Return available within 7 days.";
}

elseif($q=="contact"){
$reply="📞 Email: support@planetshopify.com";
}

elseif($q=="products"){
$reply="🛍 We sell Watches, Shoes, Shirts and Headphones.";
}

else{
$reply="Please select a question from left panel.";
}

echo $reply;
exit();

}

?>


<!DOCTYPE html>

<html>

<head>

<title>Support Chatbot</title>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>

body{
background:#eef1f5;
font-family:Segoe UI;
}

/* layout */

.chat-wrapper{

width:950px;
margin:40px auto;
display:flex;
border-radius:12px;
overflow:hidden;
box-shadow:0 8px 25px rgba(0,0,0,0.15);

}

/* sidebar */

.sidebar{

width:260px;
background:#0d6efd;
padding:20px;
color:white;

}

.sidebar h5{

margin-bottom:20px;

}

.sidebar button{

width:100%;
margin-bottom:10px;
padding:10px;
border:none;
border-radius:8px;
background:white;
color:#0d6efd;
cursor:pointer;

}

/* chat */

.chat-area{

flex:1;
background:white;
display:flex;
flex-direction:column;

}

.chat-header{

background:#0d6efd;
color:white;
padding:15px;
font-size:18px;

}

.chat-body{

flex:1;
padding:20px;
overflow-y:auto;
background:#f8f9fa;

}

/* bubbles */

.user{

background:#0d6efd;
color:white;
padding:10px;
border-radius:10px;
margin-bottom:10px;
margin-left:auto;
max-width:70%;

}

.bot{

background:white;
padding:10px;
border-radius:10px;
margin-bottom:10px;
max-width:70%;
box-shadow:0 2px 6px rgba(0,0,0,0.1);

}

/* typing dots */

.typing{

padding:10px;
background:white;
border-radius:10px;
display:inline-block;

}

.dot{

height:6px;
width:6px;
background:#888;
border-radius:50%;
display:inline-block;
margin:2px;

animation:bounce 1.2s infinite;

}

.dot:nth-child(2){
animation-delay:0.2s;
}

.dot:nth-child(3){
animation-delay:0.4s;
}

@keyframes bounce{

0%,80%,100%{transform:scale(0);}
40%{transform:scale(1);}

}

.sender{

font-size:12px;
color:gray;

}

</style>

</head>


<body>


<div class="chat-wrapper">


<div class="sidebar">

<h5>Help Topics</h5>

<button onclick="ask('order')">Track Order</button>

<button onclick="ask('shipping')">Shipping</button>

<button onclick="ask('payment')">Payment</button>

<button onclick="ask('return')">Return</button>

<button onclick="ask('contact')">Contact</button>

<button onclick="ask('products')">Products</button>

</div>


<div class="chat-area">


<div class="chat-header">

Customer Support

</div>


<div class="chat-body" id="messages">

<div class="sender">Bot</div>

<div class="bot">

Hello 👋 Select a question from left panel.

</div>

</div>


</div>


</div>



<script>

function ask(q){

$("#messages").append(
"<div class='sender'>You</div><div class='user'>"+q+"</div>"
);

/* typing animation */

var typingHTML=
"<div id='typing'>"+
"<div class='sender'>Bot</div>"+
"<div class='typing'>"+
"<span class='dot'></span>"+
"<span class='dot'></span>"+
"<span class='dot'></span>"+
"</div></div>";

$("#messages").append(typingHTML);

$("#messages").scrollTop($("#messages")[0].scrollHeight);

/* ajax after 2 second delay */

setTimeout(function(){

$.ajax({

url:"",
type:"POST",
data:{question:q},

success:function(response){

$("#typing").remove();

$("#messages").append(
"<div class='sender'>Bot</div><div class='bot'>"+response+"</div>"
);

$("#messages").scrollTop($("#messages")[0].scrollHeight);

}

});

},2000); // 2000ms = 2 seconds

}

</script>

</body>

</html>