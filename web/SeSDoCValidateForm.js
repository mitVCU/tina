function PopupAbout() {
  NewWindow = window.open('SeSDoCFormAbout.php', 'PoppedUp', "width=680,height=800,scrollbars=yes");
  return false;
}

function ValidateForm() {
  //alert('Boo');
  if (! document.SeSDoCForm.RunJS.checked) {
    return true;
  }
  //return true;
  var ValidationErrors = '';
  var CrLf = "\r\n\r\n";
  if (document.SeSDoCForm.MAFirstName.value == '') {
    ValidationErrors += 'Name is a required field.  Please supply your name...' + CrLf; 
  }
  if (document.SeSDoCForm.MAEmail.value == '') {
    ValidationErrors += 'EmailAddress is a required field.  Please supply your email address...' + CrLf;
  }
  if (document.SeSDoCForm.MASMS.value == '') {
    ValidationErrors += 'SMS/Text is required so we can attempt to fleece you by text.  Supply your phone # for texts or go away...' + CrLf;
  }
  if (document.SeSDoCForm.MAOpinion.value == '') {
    ValidationErrors += 'Add details ro request!' + CrLf;
  }
  if (document.SeSDoCForm.MAColor.value == '') {
    ValidationErrors += 'Choose your favorite shirt color' + CrLf;
  }
  if ((document.SeSDoCForm.MAPass1.value == '') || (document.SeSDoCForm.MAPass2.value == '')) {
    ValidationErrors += 'Please enter your password, twice.' + CrLf;
  } else if (document.SeSDoCForm.MAPass1.value != document.SeSDoCForm.MAPass2.value) {
    ValidationErrors += 'Passwords entered are not the same.' + CrLf;
  }
  if (ValidationErrors == '') {
    return true;
  } else {
    alert(ValidationErrors);
    return false;
  }
}


