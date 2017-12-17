
	// -- Logins and passwords -- //

	function Login() {
		if (CheckNull("frmLogin", "email", "Please enter your Email address first.")) {
			return false;
		}
		if (CheckNull("frmLogin", "logpw", "Please enter your Password first.")) {
			return false;
		}
		if (CheckEmail("frmLogin", "email", "That Email doesn't look valid.")) {
			return false;
		}
		document.frmLogin.submit();
	}

	function Forgot() {
		if (CheckNull("frmForgot", "email", "Please enter your Email address first.")) {
			return false;
		}
		if (CheckEmail("frmForgot", "email", "That Email doesn't look valid.")) {
			return false;
		}
		document.frmForgot.submit();
	}

	function DoneForgot() {
		document.location.href = "index.php?action=admin";
	}

	function KillUser(id) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = "index.php?action=admin.userlist&del=" + id;
		}
	}

	function WriteUser() {


		document.frmUser.submit();
	}

	function DoReset() {
		if (CheckNull("frmReset", "email", "Please enter your email first.")) {
			return false;
		}
		if (CheckEmail("frmReset", "email", "That email doesn't look valid.")) {
			return false;
		}
		if (CheckNull("frmReset", "log1", "Please enter your new password first.")) {
			return false;
		}
		if (CheckNull("frmReset", "log2", "Please repeat your new password.")) {
			return false;
		}
		if (trimit(document.frmReset.log1.value) != trimit(document.frmReset.log2.value)) {
			alert("The two entries of your password do not match.");
			return false;
		}

		document.frmReset.submit();
	}


	// -- Annual BBQ Date -- //

	function CheckTheDate() {
		if (CheckDate("frmDate", "yeardate", "Please enter a valid date in m/d/yyyy format.")) {
			return false;
		}
		var thedate = WriteDate(document.frmDate.yeardate.value);
		var today = document.frmDate.today.value;
		if (thedate <= today) {
			alert("The date must be a future date.");
			document.frmDate.yeardate.focus();
			return false;
		}
		document.frmDate.submit();
	}


	// -- Related links -- //

	function WriteLink() {
		if (CheckNull("frmLink", "linkname", "Please enter a name for this link.")) {
			return false;
		}
		if (CheckNull("frmLink", "linkurl", "Please enter the URL for this link.")) {
			return false;
		}
		if (CheckLink("frmLink", "linkurl", "URL")) {
			return false;
		}
		document.frmLink.submit();
	}


	// -- Event schedule -- //

	function WriteEvents() {
		var numarray = explode(document.frmEvents.numstring.value, ",");
		for (i = 0; i < numarray.length; i++) {
			if ((IsNull(document.frmEvents["time" + numarray[i]].value)) || (IsNull(document.frmEvents["name" + numarray[i]].value))) {
				alert("Each event must have both a time and a name.");
				document.frmEvents["name" + numarray[i]].focus();
				return false;
			}
		}
		if ((!IsNull(document.frmEvents["time-new"].value)) || (!IsNull(document.frmEvents["name-new"].value))) {
			if ((IsNull(document.frmEvents["time-new"].value)) || (IsNull(document.frmEvents["name-new"].value))) {
				alert("If you're going to add a new event, be sure to include both a time and a name.");
				document.frmEvents["name-new"].focus();
				return false;
			}
		}
		document.frmEvents.submit();
	}


	// -- Sponsors and sponsorships -- //

	function WriteSponsor() {
		if (CheckNull("frmSponsor", "sponsorname", "Please enter the sponsor's name.")) {
			return false;
		}
		if (!IsNull(document.frmSponsor.url.value)) {
			if (CheckLink("frmSponsor", "url", "Website URL")) {
				return false;
			}
		}
		document.frmSponsor.submit();
	}

	function ChangeSponsor(id, active) {
		if (confirm("This will mark the sponsorship as fully paid, and you can't change it again after that!")) {
			GetItem("./model/services/ajax.php?func=active&id=" + id, "toggle" + id);
		}
	}

	function WriteSponsorship() {
		if (document.frmSponsorship.disable == "") {
			if (CheckNull("frmSponsorship", "title", "Please enter a Title for the sponsorship.")) {
				return false;
			}
		}
		if (CheckNull("frmSponsorship", "description", "Please enter a Description for the sponsorship.")) {
			return false;
		}
		if (document.frmSponsorship.disable == "") {
			if (!IsRealNumeric(document.frmSponsorship.price.value)) {
				alert("The Price must be a numeric value greater than zero.");
				document.frmSponsorship.price.focus();
				return false;
			}
		}
		document.frmSponsorship.title.disabled = false;
		document.frmSponsorship.price.disabled = false;
		if (document.frmSponsorship.price.value == "") {
			document.frmSponsorship.price.value = "0";
		}
		document.frmSponsorship.submit();
	}

	function KillSponsor(id) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = "index.php?action=admin.sponsorlist&id=" + id;
		}
	}

	function CheckLogo() {
		theFile = trimit(document.frmUpload.docfile.value);
		if (theFile == "") {
			alert("Please select an image first.");
			return false;
		}
		theFile = theFile.toLowerCase();
		if (theFile !== "") {
			if (theFile.indexOf(".") < 1) {
				alert("The file extension on the logo file is not apparent.");
				return false;
			} else {
				theArray = theFile.split(".");
				var theIDX = (theArray.length - 1);
				var theExt = theArray[theIDX];
				if ((theExt !== "jpg") && (theExt !== "jpeg") && (theExt !== "png")) {
					alert("The logo file must be in JPG, JPEG, or PNG format.");
					return false;
				}
			}
		}
		document.frmUpload.sbutton.disabled = true;
		SwapStyles("waitpic", "waiter-show");
		document.frmUpload.submit();
	}


	// -- Team Registrations -- //

	function ChangeTeam(id, active) {
		if (confirm("This will mark the registration as fully paid, and you can't change it again after that!")) {
			GetItem("./model/services/ajax.php?func=activeteam&id=" + id, "toggle" + id);
		}
	}



	// -- Judges -- //

	function WriteJudge() {
		if (CheckNull("frmJudge", "judgename", "Please enter the judge's Name.")) {
			return false;
		}
		if (CheckNull("frmJudge", "bio", "Please enter something about the judge at \"Bio.\"")) {
			return false;
		}
		document.frmJudge.submit();
	}


	// -- Photo and video galleries -- //

	function CheckPics(where) {
		var picCount = Math.round(document.frmUpload.maxuploads.value);
		var isOk = 0;
		var picFile;
		var picArray = new Array();
		for (i = 1; i <= picCount; i++) {
			picFile = document.frmUpload["docfile-" + i].value;
			picFile = picFile.replace(/ /g, "");
			picArray[i] = picFile;
			if (picFile !== "") {
				isOk++;
			}
		}
		if (isOk == 0) {
			alert("Please select at least one file to upload.");
			return false;
		}
		for (i = 1; i <= picCount; i++) {
			theFile = picArray[i];
			theFile = theFile.toLowerCase();
			if (theFile !== "") {
				if (theFile.indexOf(".") < 1) {
					alert("The file extension on Photo " + i + " is not apparent.");
					return false;
				} else {
					theArray = theFile.split(".");
					var theIDX = (theArray.length - 1);
					var theExt = theArray[theIDX];
					if ((theExt !== "jpg") && (theExt !== "jpeg")) {
						alert("All images must be in JPG or JPEG format.");
						return false;
					}
				}
			}
		}
		if (where == "bank") {
			var next = "../admin/imageuploader.php";
		} else {
			var next = "../admin/gallerypics.php";
		}
		document.frmUpload.action.value = next;
		document.frmUpload.sbutton.disabled = true;
		SwapStyles("waitpic", "waiter-show");
		document.frmUpload.submit();
	}

	function WriteGallery() {
		if (document.frmGallery.id.value != "") {
			if (CheckNull("frmGallery", "gtype", "Please select a gallery Type.")) {
				return false;
			}
			if (CheckNull("frmGallery", "title", "Please enter a Title for the gallery.")) {
				return false;
			}
		}
		FixNumber("frmGallery", "sortno");
		document.frmGallery.gtype.disabled = false;
		document.frmGallery.submit();
	}

	function UpdatePics() {
		var numarray = explode(document.frmUpdate.numstring.value, ",");
		for (i = 0; i < numarray.length; i++) {
			FixNumber("frmUpdate", "sort-" + numarray[i]);
		}
		document.frmUpdate.submit();
	}

	function KillPic(galleryid, picid) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = "index.php?action=admin.gallerypics&id=" + galleryid + "&del=" + picid;
		}
	}

	function CheckVid() {
		if (CheckNull("frmVid", "vidtitle", "Please enter a title for the video.")) {
			return false;
		}
		if (CheckNull("frmVid", "vidcode", "Please paste in the embed code.")) {
			return false;
		}
		var code = document.frmVid.vidcode.value;
		if ((!code.includes("iframe")) || (!code.includes("src"))) {
			alert("That doesn't look like valid code.");
			return false;
		}
		document.frmVid.submit();
	}

	function UpdateVids() {
		var numarray = explode(document.frmUpdate.numstring.value, ",");
		for (i = 0; i < numarray.length; i++) {
			FixNumber("frmUpdate", "sort-" + numarray[i]);
		}
		document.frmUpdate.submit();
	}

	function KillVid(galleryid, vidid) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = "index.php?action=admin.galleryvids&id=" + galleryid + "&del=" + vidid;
		}
	}


	// -- Editor, editor pics, editor docs -- //

	function KillEditorPic(picid) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = "index.php?action=admin.imageuploader&del=" + picid;
		}
	}

	function GetImageBank() {
		var whole = screen.width;
		var left = ((whole - 280) - 100);
		var top = 20;
		var wide = 280;
		var high = 700;
		DoBox2('index.php?action=admin.imagebank', wide, high, top, left);
	}

	function GetDocBank() {
		var whole = screen.width;
		var left = ((whole - 300) - 100);
		var top = 20;
		var wide = 350;
		var high = 700;
		DoBox2('index.php?action=admin.docbank', wide, high, top, left);
	}

	function GetPreview() {
		document.frmHide.submit();
	}

	function CheckDoc() {
		if (CheckNull("frmUpload", "doctitle", "Please enter a title for the document.")) {
			return false;
		}
		if (CheckNull("frmUpload", "docfile", "Please select a document to upload.")) {
			return false;
		}
		SwapStyles("waitpic", "waiter-show");
		document.frmUpload.submit();
	}

	function KillDoc(id) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = "index.php?action=admin.docuploader&del=" + id;
		}
	}

	function GetHelper(which) {
		SwapStyles("helper", "helper-shown");
	}

	function KillHelper(which) {
		SwapStyles("helper", "helper-hidden");
	}

	function CheckEditor(where) {
		var tmp = CKEDITOR.instances[where].getData();
		var para = "<p>&nbsp;</p>";
		tmp = tmp.replace(para, "");
		if (IsNull(tmp)) {
			alert("Your entry is empty. You can do that if you want to. Just letting you know.");
		}
		document.frmEditor.submit();
	}

	function SavePage() {
		document.frmEditor.otherbody.value = CKEDITOR.instances["body"].getData();
		PostItem(path + "model/services/ajax.php", "frmEditor", "saved");
		setTimeout("EraseSaved()", 1500);
	}

	function EraseSaved() {
		document.getElementById("saved").innerHTML = "&nbsp;";
	}


	// -- Contact messages -- //

	function KillContact(id) {
		if (confirm("This is permanent and cannot be reversed!")) {
			document.location.href="indexphp?action=admin.contactlist.php?func=del&id=" + id;
		}
	}


	// -- Modals -- //

	function GetRegisterDetail(id) {
		document.getElementById("mask").className = "mask-on";
		GetItem(path + "view/admin/registerdetail.php?id=" + id, "detail", "");
		document.getElementById("detail-outer").className = "detail-outer-on outer-large";
		document.getElementById("detail").className = "detail-on detail-on-large";
	}

	function GetSponsorDetail(id) {
		document.getElementById("mask").className = "mask-on";
		GetItem(path + "view/admin/sponsordetail.php?id=" + id, "detail", "");
		document.getElementById("detail-outer").className = "detail-outer-on outer-large";
		document.getElementById("detail").className = "detail-on detail-on-large";
	}

	function KillDetail() {
		document.getElementById("detail").innerHTML = "";
		document.getElementById("detail").className = "vanish";
		document.getElementById("detail-outer").className = "vanish";
		document.getElementById("mask").className = "vanish";
	}


	// -- Utilities -- //

	function CheckDateRange() {
		if (CheckDate("frmDates", "fromdate", "Please enter a valid \"from\" date in m/d/yyyy format.")) {
			return false;
		}
		if (CheckDate("frmDates", "todate", "Please enter a valid \"to\" date in m/d/yyyy format.")) {
			return false;
		}
		var fromdate = document.frmDates.fromdate.value;
		var todate = document.frmDates.todate.value;
		fromnum = MakeDateNumeric(fromdate);
		tonum = MakeDateNumeric(todate);
		if (fromnum > tonum) {
			alert("The \"From\" date can't be later than the \"To\" date.");
			return false;
		}
		document.frmDates.submit();
	}

	function MakeDateNumeric(sentdate) {
		dateArray = sentdate.split("/");
		if (dateArray[0].length == 1) {
			dateArray[0] = "0" + dateArray[0];
		}
		if (dateArray[1].length == 1) {
			dateArray[1] = "0" + dateArray[1];
		}
		numdate = dateArray[2] + dateArray[0] + dateArray[1];
		return numdate;
	}

	function GoBack() {
		document.location.href = "index.php?action=admin.menu";
	}

