<style>
	

$red: #881d12;


@mixin bump {
    0%      {transform: scale(1); }
    50%     {transform: scale(1.5); }
    100%    {transform: scale(1); }
}

@keyframes bump1 { @include bump; }
@keyframes bump2 {@include bump;}

body {padding:50px; background:#ededed;}

.vote-count {
  width:40px;
  height:35px;
  text-align:center;
  color:$red;
  font:20px/1.5 georgia;
  margin-bottom:10px;
  animation: bump .3s; 
  &.bumped {
    animation: bump2 .3s; 
  }
}

.vote-btn {
  appearance:none;
  border-radius:3px;
  border:0;
  background:#fff;
  padding:15px 12px 15px 40px;
  font:bold 9px/1.2 arial;
  text-transform:uppercase;
  letter-spacing:1px;
  color:$red;
  box-shadow:0 1px 1px rgba(0,0,0,.2);
  outline:none;
  position:relative;
  transition: all .3s ease-out; 
  cursor:pointer;
  overflow:hidden;
  
  .icon {
        position:absolute;
    content: "";
    left:10px;
    top:10px;
    width:20px;
    height:20px;
    border-radius:10px;
    display:inline-block;
    background:$red url(https://jamesmuspratt.com/codepen/img/checkmark.svg) no-repeat 2px 1px;
    background-size:16px auto;
  transition: all .3s ease-out; 

  }
  
}
  

.vote-btn.complete {
  padding-left:15px;
  background:#c1c0bb;
  color: #fff;
  .icon {
    opacity:0;
    /* transform: rotateX(90deg); */
      transform: scale(0); 
 }
}

</style>

<style>
	

.container{
	background:rgba(0,0,0,.4) url(http://re3ker.de/raffle/images/metal.jpg) 50% 50% no-repeat;
	background-size:cover;
	-moz-background-size:cover;
	-webkit-background-size:cover;
	height:100%;
}
.topbox{
	background:white;
	padding-bottom:50px;
	background: #0f161d; /* Old browsers */
	background: -moz-linear-gradient(left,  #0f161d 0%, #131b24 51%, #0f161d 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, right top, color-stop(0%,#0f161d), color-stop(51%,#131b24), color-stop(100%,#0f161d)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(left,  #0f161d 0%,#131b24 51%,#0f161d 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(left,  #0f161d 0%,#131b24 51%,#0f161d 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(left,  #0f161d 0%,#131b24 51%,#0f161d 100%); /* IE10+ */
	background: linear-gradient(to right,  #0f161d 0%,#131b24 51%,#0f161d 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0f161d', endColorstr='#0f161d',GradientType=1 ); /* IE6-9 */
	box-shadow:0 0 10px 0 black;
}

.rollbox{
	margin-top:50px;
	height:200px;
	background:#000;
	border:1px solid #616161;
	overflow-x:auto;
	overflow:hidden;
	position:relative;
	padding:0;
}
.rollbox > table{
	width:auto;
	height:200px;
	margin:0;
	padding:0;
	
}
#loadout{
	position:absolute;
	top:10px;
	left:5px;
	z-index:1;
	background:#121619;
}

.roller {
	position:relative;
	display: block;
	height:100%;
	text-align:center;
	color:white;
	line-height:180px;
	font-size:0.8em;
	font-weight:bold;
	font-family:sans-serif;
}
.roller div{
	display:block;
	height:50px;
	line-height:50px;
	position:absolute;
	bottom:0;
	width:100%;
	left:0;
	
}
.inputbox{
	background:#212121;
	box-shadow:inset 0 0 7px 0 black;
	font-size:1.1em;
	font-weight:bold;
	color:white;
}
.badge{
	padding-top:5px;
	text-shadow:1px 1px 1px black;
	margin-bottom:20px;
}
.line{
	width:2px;
	height:198px;
	top:1px;
	left:50%;
	position:absolute;
	background:#FFCE0A;
	opacity:0.6;
	z-index:2;
	
}
#log{
	margin-top:30px;
	text-align:center;
	font-size:1.5em;
	color:white;
	
}
#log span{
	font-size:2em;
	font-weight:bold;
	color:#57B3F9;
}
#roll{
	margin-top:30px;
}
.roller{
	height:180px;
	
	width:180px;
	margin-right:10px;
	box-shadow:0 0 5px 0 black;
	background:url(http://re3ker.de/raffle/images/purple.jpg);
}
tr,table,td{
	margin:0;
	padding:0;
}

td:nth-child(even) .roller{
	background:url(http://re3ker.de/raffle/images/blue.jpg);
}


</style>


<div class="row">
	<div class="col-lg-4">
		<form class="myform">
		  <p class="vote-count">0</p>
		  <button
		          class="vote-btn" 
		          data-default-text="Vote This Dish Up!"
		          data-alt-text="Thanks for Voting">
		    <span class="icon"></span> <span class="text">Vote This Dish Up!</span>
		  </button>
		</form>
	</div>
	<div class="col-lg-8">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="page-header">
						<h1>Chama Position Assignment System <small>by Mervo</small></h1>
					</div>
					
				</div>
			</div>
			
			<div class="row topbox">
				<div class="col-md-6 col-md-offset-3 rollbox">
					<div class="line"></div>
					<table><tr id="loadout">
						
					</tr></table>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<button id="roll" class="btn btn-success form-control">Roll</button>
					<div id="msgbox"class="alert alert-warning" style="margin-top:20px;display:none;">There are 6 positions available! And every number needs to play only once to get assigned a number.</div>
				</div>
			</div>
			
			<div class="row">
				
				<div class="col-md-12" style="text-align:center">
					<div id="log"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<p>Numbers Allocated are immediately removed. </p>
					<textarea class="form-control inputbox" rows="10"></textarea>
				</div>
			</div>
		</div>
	</div>
</div>




<script>
	var VoteWidget= {
  settings: {
    $counter: $('.vote-count'),
    $btn:     $('.myform button'),
  },
init: function() {
  VoteWidget.bind();
},
  bind: function() {
    VoteWidget.settings.$btn.click(function(){
      if (! $(this).hasClass('complete')) {
            VoteWidget.bumpCount();
      }
      $(this).toggleClass('complete');
      VoteWidget.toggleText();  

    return false;
  });
  },
  bumpCount: function() {
    var current_count = $('.vote-count').text();
    count = parseInt(current_count);
    count++;
    VoteWidget.settings.$counter.toggleClass('bumped').text(count);
  },
  toggleText: function(){
    var $text_container = $('.myform button .text');
    var alt_text = VoteWidget.settings.$btn.data('alt-text');
    var default_text = VoteWidget.settings.$btn.data('default-text');
    var current_text = $text_container.text();
    console.log('current is ' + current_text);
    if ( current_text == default_text ) {
      $text_container.text(alt_text)
    } else {
      $text_container.text(default_text)
    }
  }
}


VoteWidget.init();


</script>


<script>
	$(document).ready(function(){
	var users = [],
	shuffled = [],
	loadout = $("#loadout"),
	insert_times = 30,
	duration_time = 10000;
	$("#roll").click(function(){
		users = [];
		var lines = $('textarea').val().split('\n');
		if(lines.length < 1){
			$("#msgbox").slideToggle(100);
			setTimeout(function() {
				  $("#msgbox").slideToggle(100);
			}, 3000);
			return false;
		}
		for(var i = 0;i < lines.length;i++){
			if(lines[i].length > 0){
				users.push(lines[i]);
			}
		}
		$("#roll").attr("disabled",true);
		var scrollsize = 0,
		diff = 0;
		$(loadout).html("");
		$("#log").html("");
		loadout.css("left","100%");
		if(users.length < 10){
			insert_times = 20;
			duration_time = 5000;
		}else{
			insert_times = 10;
			duration_time = 10000;
		}
		for(var times = 0; times < insert_times;times++){
			shuffled = users;
			shuffled.shuffle();
			for(var i = 0;i < users.length;i++){
				loadout.append('<td><div class="roller"><div>'+shuffled[i]+'</div></div></td>');
				scrollsize = scrollsize + 192;
			}
		}
		
		
		diff = Math.round(scrollsize /2);
		diff = randomEx(diff - 300,diff + 300);
		$( "#loadout" ).animate({
			left: "-="+diff
		},  duration_time, function() {
			$("#roll").attr("disabled",false);
			$('#loadout').children('td').each(function () {
				var center = window.innerWidth / 2;
				if($(this).offset().left < center && $(this).offset().left + 185 > center){
					var text = $(this).children().text();
					$("#log").append("THE WINNER IS<br/> <span class=\"badge\">"+text+"</span>");
					
				}
				
			});
		});
	});
	Array.prototype.shuffle = function(){
		var counter = this.length, temp, index;
		while (counter > 0) {
			index = (Math.random() * counter--) | 0;
			temp = this[counter];
			this[counter] = this[index];
			this[index] = temp;
		}
	}
	function randomEx(min,max)
	{
		return Math.floor(Math.random()*(max-min+1)+min);
	}
});

</script>

