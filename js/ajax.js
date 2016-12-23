function GetSub(cat) {
		if (cat=='') {
			document.getElementById('res').innerHTML='';
			return;
		}
		if (window.XMLHttpRequest) {
			ao=new XMLHttpRequest();
		}
		else{
			ao=new ActiveXObject('Microsoft.XMLHTTP');
		}
		ao.onreadystatechange=function() {
			if (ao.readyState==4 && ao.status == 200) {
				document.getElementById('res').innerHTML=ao.responseText;
			}
		}
		ao.open('get','pages/lists.php?cat='+cat,true);
		ao.send(null);
	}

//////////////////////////////////////////////////////////////////////////////////

	function GetSub2(cat) {
		if (cat=='') {
			document.getElementById('res1').innerHTML='';
			return;
		}
		if (window.XMLHttpRequest) {
			ao=new XMLHttpRequest();
		}
		else{
			ao=new ActiveXObject('Microsoft.XMLHTTP');
		}
		ao.onreadystatechange=function() {
			if (ao.readyState==4 && ao.status == 200) {
				document.getElementById('res1').innerHTML=ao.responseText;
			}
		}
		ao.open('get','pages/lists.php?cat='+cat,true);
		ao.send(null);
	}

//////////////////////////////////////////////////////////////////////////////////

	function GetItem(sub) {
		if (sub=='') {
			document.getElementById('res2').innerHTML='';
			return;
		}
		if (window.XMLHttpRequest) {
			ao=new XMLHttpRequest();
		}
		else{
			ao=new ActiveXObject('Microsoft.XMLHTTP');
		}
		ao.onreadystatechange=function() {
			if (ao.readyState==4 && ao.status == 200) {
				document.getElementById('res2').innerHTML=ao.responseText;
			}
		}
		ao.open('get','pages/lists2.php?sub='+sub,true);
		ao.send(null);
	}