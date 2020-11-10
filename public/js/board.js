function zakaz(a, b, c, d, e) {
    if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
		var params = "title="+arguments[0]+"&descr="+arguments[1]+"&price="+arguments[2]+"&num="+arguments[3];
		if(arguments[4] == 'sindom'){
			xmlhttp.open("GET","sindom.php?"+params,true);
		}else if(arguments[4] == 'leboard'){
			xmlhttp.open("GET","leboard.php?"+params,true);
		}
		xmlhttp.send();

		alert("Объявление размещено на сайте "+arguments[4]);
	}
function showbut(){
	$(".rightbutton").css("opacity", "1");
}

function masszakaz(){
	var maob = '';
	$("input:checked").each(
		function (i, ob){
			maob = maob + $(ob).val();
		});
	eval(maob);
}
function checkall(){
	$(".mass").prop("checked", true);
	showbut();
}