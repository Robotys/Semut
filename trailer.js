// hijack every click, get the click script, class, id, referer
// var a = document.getElementsByTagName('a');
$(document).ready(function(){
	// create session hash if not there
	if(getCookie('uid') == ""){
		var uniq = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
    return v.toString(16);
});

		setCookie('uid',uniq);
	}

	$('a').on('click', function(event){

		// stop jump
		event.preventDefault();

		// prep data
		var param = {};
		param.uid = getCookie('uid');
		param.text = $(this).html();
		param.from = document.referrer;
		param.url = document.URL;
		param.to = $(this).attr('href');
		param.style = $(this).attr('style');
		param.class = $(this).attr('class');
		param.id = $(this).attr('id');
		param.tag = $(this).attr('data-tag');

		var to_send = JSON.stringify(param);

		// send data
		$.post('trailer.php', {data:to_send}, function(){
			// load to intended page
			document.location.href = param.to;
		});

	});
});

function getCookie(cname)
{
var name = cname + "=";
var ca = document.cookie.split(';');
for(var i=0; i<ca.length; i++) 
  {
  var c = ca[i].trim();
  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
return "";
}

function setCookie(cname,cvalue)
{
var d = new Date();
exdays = 20000; // save for 20000 days
d.setTime(d.getTime()+(exdays*24*60*60*1000));
var expires = "expires="+d.toGMTString();
document.cookie = cname + "=" + cvalue + "; " + expires;
}
