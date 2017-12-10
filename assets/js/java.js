
	var path = "/";
	var loc = document.location.hostname;
	if (loc.includes("localhost")) {
		path = "/sites/fwtest/";
	} else if (loc.includes("heymichael")) {
		path = "/fwtest/";
	}

	function ShowDiv(where) {
		document.getElementById(where).style.visibility="visible";
	}

	function HideDiv(where) {
		document.getElementById(where).style.visibility="hidden";
		document.getElementById(where).style.height="0px;"
		document.getElementById(where).style.width="0px;"
	}

	function SwapText(where, what) {
		document.getElementById(where).innerHTML=what;
	}

	function SwapStyles(where, what) {
		document.getElementById(where).className=what;
	}

	function GetText(where) {
		var what = document.getElementById(where).innerHTML;
		return what;
	}

	function GetValue(where) {
		var what = document.getElementById(where).value;
		return what;
	}

	function GoTo(where) {
		document.location.href = where;
	}

	function WriteDate(tmp) {
		datearray = tmp.split("/");
		if (datearray[0].length == 1) {
			datearray[0] = "0" + datearray[0];
		}
		if (datearray[1].length == 1) {
			datearray[1] = "0" + datearray[1];
		}
		tmp = datearray[2] + "-" + datearray[0] + "-" + datearray[1];
		return tmp;
	}

	function UnWriteDate(tmp) {
		datearray = tmp.split("-");
		if (datearray[1].substr(0, 1) == "0") {
			datearray[1] = datearray[1].substr(1, 1);
		}
		if (datearray[2].substr(0, 1) == "0") {
			datearray[2] = datearray[2].substr(1, 1);
		}
		tmp = datearray[1] + "/" + datearray[2] + "/" + datearray[0];
		return tmp;
	}

	function PostItem(theScript, frmName, div) {
	frmName = document.forms[frmName];
		var fld;
		var theData = "";
		for (i = 0; i < frmName.elements.length; i++) {
			fld = frmName.elements[i];
			if ((fld.type !== "button") && (fld.type !== "submit")) {
				if ((fld.type == "radio") || (fld.type == "checkbox")) {
					if (fld.checked) {
						if (i > 0) {
							theData += "&" + fld.name + "=" + escape(fld.value);
						} else {
							theData += fld.name + "=" + escape(fld.value);
						}
					}
				} else {
					if (i > 0) {
						theData += "&" + fld.name + "=" + encodeURIComponent(fld.value);
					} else {
						theData += fld.name + "=" + encodeURIComponent(fld.value);
					}
				}
			}
		}
		var xmlHttp;
		if (xmlHttp = startAjax()) {
			xmlHttp.open("POST", theScript, true);
			xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4) {
					var theText = xmlHttp.responseText;
					ShowDiv(div);
					SwapText(div, theText);
				}
			}
			xmlHttp.send(theData);
		}
	}

	function PostMultiForm(formname, posttoscript, outputdiv) {
		var form = document.forms.namedItem(formname);
		oData = new FormData(form);
		var oReq = new XMLHttpRequest();
		oReq.open("POST", posttoscript, true);
		oReq.onload = function(oEvent) {
			document.getElementById(outputdiv).innerHTML = oReq.status;
		};
		oReq.send(oData);
	}

	function GetItem(theScript, div, doThis) {
		var xmlHttp;
		if (xmlHttp = startAjax()) {
			xmlHttp.onreadystatechange = function() {
				if(xmlHttp.readyState == 4) {
					var theText = xmlHttp.responseText;
					ShowDiv(div);
					SwapText(div, theText);
					if ((doThis) && (typeof(doThis) == "function")) {
						doThis();
					}
				}
			}
			xmlHttp.open("GET", theScript, true);
			xmlHttp.send(null);
		}
	}

	function GetItem_OLD(theScript, div) {
		var xmlHttp;
		if (xmlHttp = startAjax()) {
			xmlHttp.onreadystatechange = function() {
				if(xmlHttp.readyState == 4) {
					var theText = xmlHttp.responseText;
					ShowDiv(div);
					SwapText(div, theText);
				}
			}
			xmlHttp.open("GET", theScript, true);
			xmlHttp.send(null);
		}
	}

	function startAjax() {
		var xmlHttp;
		try {
			xmlHttp = new XMLHttpRequest();
		}
		catch (e) {
			try {
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e) {
				try {
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e) {
					alert("Your browser does not support AJAX.");
					return false;
				}
			}
		}
		return xmlHttp;
	}

	function CheckDate(dname,fname,msg) {
		var frmName = dname;
		var fldName = fname;
		var alertText = msg;
		var string1 = document[frmName][fldName].value;
		if (string1.indexOf("/")==-1) {
			alert(alertText);
			document[frmName][fldName].focus();
			return true;
		}
	        var dateArray = string1.split('/');
		if (dateArray.length !== 3) {
			alert(alertText);
			document[frmName][fldName].focus();
			return true;
		}
		if ((isNaN(dateArray[0])) || (isNaN(dateArray[1])) || (isNaN(dateArray[2]))) {
			alert(alertText);
			document[frmName][fldName].focus();
			return true;
		}
		var vMonth = dateArray[0];
		var vDay = dateArray[1];
		var vYear = dateArray[2];
		if ((vMonth > 12) || (vMonth < 1)) {
			alert(alertText);
			document[frmName][fldName].focus();
			return true;
		}
		if ((vDay < 1) || (vDay > 31)) {
			alert(alertText);
			document[frmName][fldName].focus();
			return true;
		}
		if (vMonth == 2) {
			var febMax = 28;
			var startYear = 1004;
			for (count = 0; count < 1000; count++) {
				startYear = startYear + 4;
				if (vYear == startYear) {
					febMax = 29;
					break;
				}
			}
			if (vDay > febMax) {
				alert(alertText);
				document[frmName][fldName].focus();
				return true;
			}
		}
		if ((vMonth == 4) || (vMonth == 6) || (vMonth == 9) || (vMonth == 11)) {
			if (vDay > 30) {
				alert(alertText);
				document[frmName][fldName].focus();
				return true;
			}
		}
		if ((vMonth == 1) || (vMonth == 3) || (vMonth == 5) || (vMonth == 7) || (vMonth == 8) || (vMonth == 10) || (vMonth == 12)) {
			if (vDay > 31) {
				alert(alertText);
				document[frmName][fldName].focus();
				return true;
			}
		}
		if ((vYear < 1000) || (vYear > 9999)) {
			alert(alertText);
			document[frmName][fldName].focus();
			return true;
		}
	}

	function CheckNull(dname, fname, msg) {
		var tmp = document[dname][fname].value;
		tmp = tmp.replace(/ /g, "");
		if (tmp == "") {
			alert(msg);
			document[dname][fname].focus();
			return true;
		}
	}

	function CheckEmail(dname, fname, msg) {
		var frmName = dname;
		var fldName = fname;
		var stuff = document[frmName][fldName].value;
		if ((stuff.indexOf("@") == -1) || (stuff.indexOf(".") == -1)) {
			alert(msg);
			document[frmName][fldName].focus();
			return true;
		}
	}

	function CheckLink(dname, fname, item) {
		var linkUrl = document[dname][fname].value;
		linkUrl = linkUrl.toLowerCase();
		if ((linkUrl.indexOf("http://") != 0) && (linkUrl.indexOf("https://") != 0)) {
			alert("The " + item + " must begin with \"http://\" or \"https://\".");
			document[dname][fname].focus();
			return true;
		}
	}

	function FixNumber(frm, fld) {
		console.log(frm + " " + fld);
		if (!IsNumeric(document[frm][fld].value)) {
			document[frm][fld].value = "0";
		}
	}

	function DoBox(url,w,h,top,left) {
		window.open(url,'popup','height=' + h + ',width=' + w + ',top=' + top + ',left=' + left + ',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no');
	}

	function DoBox2(url,w,h,top,left) {
		window.open(url,'popup','height=' + h + ',width=' + w + ',top=' + top + ',left=' + left + ',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes');
	}

	function GetTimeList(name, aclass, change, chosen) {
		var tstring;
		var tmp = "<select name=\"" + name + "\" class=\"" + aclass + "\"";
		if (change != "") {
			tmp += " onChange=\"" + change + "\"";
		}
		tmp += ">";
		tmp += "<option value=\"\">Select...</option>";
		tmp += "<option value=\"0\"";
		if (chosen == "0") {
			tmp += " selected";
		}
		tmp += ">All Day</option>";
		var num = 0; var daypart = " AM";
		while (num < 24) {
			hour = num.toString() + "00";
			half = num.toString() + "30";
			if (num > 11) {
				daypart = " PM";
			}
			hour = MilitaryTime(hour + daypart);
			half = MilitaryTime(half + daypart);
			tmp += "<option value=\"" + hour + "\" class=\"" + aclass + "\"";
			if (chosen == hour) {
				tmp += " selected";
			}
			tmp += ">" + CivilianTime(hour) + "</option>";

			tmp += "<option value=\"" + half + "\" class=\"" + aclass + "\"";
			if (chosen == half) {
				tmp += " selected";
			}
			tmp += ">" + CivilianTime(half) + "</option>";
			num++;
		}
		return tmp;
	}

	function PadIt(tmp, leftright, char, len) {
		if (tmp.length > Math.round(len * 1)) {
			console.log("Passed string (" + tmp + ") is longer than the specified return length.");
			return false;
		}
		while (tmp.length < Math.round(len * 1)) {
			leftright == "l" ? tmp = char + tmp : tmp = tmp + char;
		}
		return tmp;
	}

	function MilitaryTime(tmp) {
		var theTime = tmp.toUpperCase();
		timePair = theTime.split(" ");
		var timestamp = timePair[0].replace(":", "");
		if ((timePair[1] == "PM") && (Math.round(timestamp) < 1200)) {
			timestamp = (Math.round((timestamp - 0) + 1200));
		}
		timestamp = timestamp.toString();
		if (timestamp.length < 4) {
			timestamp = "0" + timestamp;
		}
		if ((timestamp.substr(0, 2) == "12") && (timePair[1] == "AM")) {
			timestamp = "00" + timestamp.substr(2, 2);
		}
		return timestamp;
	}

	function CivilianTime(tmp) {
		var hr = tmp.substr(0, 2);
		var mn = tmp.substr(2, 2);
		var daypart = " AM";
		var hrNum = Math.round(1 * hr);
		if (hrNum == 12) {
			hr = hrNum.toString();
			daypart = " PM";
		} else if (hrNum > 12) {
			hrNum = (hrNum - 12);
			hr = hrNum.toString();
			daypart = " PM";
		} else if (hrNum == 0) {
			hr = "12";
		}
		if (hr.substr(0, 1) == "0") {
			hr = hr.substr(1, 1);
		}
		tmp = hr + ":" + mn + daypart;
		return tmp;
	}
 
	function GetActiveList(name, aclass, change, chosen) {
		var tmp = "<select name=\"" + name + "\" class=\"" + aclass + "\"";
		if (change != "") {
			tmp += " onChange=\"" + change + "\"";
		}
		tmp += ">";
		tmp += "<option value=\"1\"";
		if (chosen == "1") {
			tmp += " selected";
		}
		tmp += ">Active</option>";
		tmp += "<option value=\"0\"";
		if (chosen == "0") {
			tmp += " selected";
		}
		tmp += ">Inactive</option>";
		return tmp;
	}

	function IsEven(num) {
		end = num.substr(-1);
		if ((end == "2") || (end == "4") || (end == "6") || (end == "8") || (end == "0")) {
			return true;
		}
		return false;
	}

	function explode(str, del) {
		var arr = str.split(del);
		return arr;
	}

	function IsNull(tmp) {
		if (tmp.trim() == "") {
			return true;
		}
	}

	function trimit(tmp) {
		return tmp.trim();
	}

	function MakeString(tmp, no, delimiter) {
		tmp == "" ? tmp = no : tmp += delimiter + no;
		return tmp;
	}

	function MakeNeg(num) {
		return "(" + num + ")";
	}

	function UnNeg(num) {
		num = num.replace("(", "");
		num = num.replace(")", "");
		return num;
	}

	function MakeNum(num) {
		num == "" ? num = 0 : num = (num * 1);
		return num;
	}

	function IsNumeric(num) {
		if (Math.round((num) * 2) > -1) {
			return true;
		}
	}

	function IsRealNumeric(num) {
		if ((Math.round((num) * 2) > -1) && (Math.round(num) > 0)) {
			return true;
		}
	}

	function IsInteger(num) {
		var n = Math.floor(Number(num));
		return String(n) === num && n >= 0;
	}

	function SelectAll(id) {
		document.getElementById(id).focus();
		document.getElementById(id).select();
	}


