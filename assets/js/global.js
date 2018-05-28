
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

	function postItem(formname, posttoscript, outputdiv, outputText) {
		var form = document.forms.namedItem(formname);
		oData = new FormData(form);
		var oReq = new XMLHttpRequest();
		oReq.open("POST", posttoscript, true);
		oReq.onload = function(oEvent) {
			if (outputText) {
				document.getElementById(outputdiv).innerHTML = outputText;
			} else {
				document.getElementById(outputdiv).innerHTML = oReq.status;
			}
		};
		oReq.send(oData);
	}

	function getItem(theScript, div) {
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				document.getElementById(div).innerHTML = xmlHttp.responseText;
			}
		}
		xmlHttp.open("GET", theScript, true);
		xmlHttp.send(null);
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

	function checkNull(formName, formField) {
		var tmp = document[formName][formField].value;
		tmp = tmp.trim();
		if (tmp == "") {
			document[formName][formField].focus();
			return true;
		}
	}

	function checkEmail(formName, formField) {
		var tmp = document[formName][formField].value;
		if ((tmp.search("@") < 0) || (tmp.search(".") < 0)) {
			document[formName][formField].focus();
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

	function isNumeric(num) {
		if (Math.round((num) * 2) > -1) {
			return true;
		}
	}

	function isRealNumeric(num) {
		if ((Math.round((num) * 2) > -1) && (Math.round(num) > 0)) {
			return true;
		}
	}

	function notInteger(num) {
		var n = Math.floor(Number(num));
		return String(n) === num && n >= 0;
	}

	function SelectAll(id) {
		document.getElementById(id).focus();
		document.getElementById(id).select();
	}

	function StartErrors() {
		errors = new Object();

		errors.errorDiv = "errorbox";
		errors.showClass = "errorbox-on";
		errors.hideClass = "vanish";

		errors.useOuter = false;
		errors.outerDiv = "";

		errors.useOuter ? errors.hideDiv = errors.outerDiv : errors.hideDiv = errors.errorDiv;

		errors.start = function () {
			return new Array();
		};
		errors.plus = function (arr, text) {
			return arr.push(text);
		};
		errors.output = function (arr) {
			document.getElementById(errors.errorDiv).innerHTML = "";
			document.getElementById(errors.hideDiv).className = errors.hideClass;
			if (arr.length) {
				var text = "";
				for (var i = 0; i < arr.length; i++) {
					text += "<p>" + arr[i] + "</p>";
				}
				document.getElementById(errors.errorDiv).innerHTML = text;
				document.getElementById(errors.hideDiv).className = errors.showClass;
				return true;
			}
			return false;
		};
		return errors;
	}
	errors = StartErrors();

	function StayAlive () {
		var alive = new Object();
		alive.url = thePath + "index.cfm?action=main.ajaxStayAlive";
		alive.milliseconds = 600000;
		alive.breathe = function () {
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function() {}
			xmlHttp.open("GET", alive.url, true);
			xmlHttp.send(null);
			alive.gasp();
		}
		alive.gasp = function () {
			setTimeout("alive.breathe()", alive.milliseconds);
		}
		return alive;
	}
//	alive = StayAlive();
//	alive.gasp();

	function setDataTable (tableElement) {
		tableElement.DataTable({
			'info': false
			, 'searching': true
			, 'lengthChange': false
			, 'pageLength': 20
			, 'dom': 'ft<"row"<"col-sm-2"><"col-sm-8"p><"col-sm-2">>'
		});
	}

	function StartSelect(useblank, name, aclass, onchange) {
		var tmp = "<select  id=\"" + name + "\" name=\"" + name + "\" class=\"" + aclass + "\"";
		if (onchange != "") {
			tmp += " onChange=\"" + onchange + ";\"";
		}
		tmp += ">";
		if (useblank == 1) {
			tmp += "<option value=\"\">Select...</option>";
		}
		return tmp;
	}

	function MakeOption(key, chosen, value) {
		key == chosen ? word = " selected" : word = "";
		return "<option value=\"" + key + "\"" + word + ">" + value + "</option>";
	}



