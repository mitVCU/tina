function PopupAbout() {
  NewWindow = window.open('PuppyFormAbout.php', 'PoppedUp', "width=680,height=800,scrollbars=yes");
  return false;
}

function ValidateForm() {
  //alert('Boo');
  if (! document.PuppyForm.RunJS.checked) {
    return true;
  }
  //return true;
  var ValidationErrors = '';
  var CrLf = "\r\n\r\n";
  if (document.PuppyForm.MAFirstName.value == '') {
    ValidationErrors += 'Name is a required field.  Please supply your name...' + CrLf; 
  }
  if (document.PuppyForm.MAEmail.value == '') {
    ValidationErrors += 'EmailAddress is a required field.  Please supply your email address...' + CrLf;
  }
  if (document.PuppyForm.MASMS.value == '') {
    ValidationErrors += 'SMS/Text is required so we can attempt to fleece you by text.  Supply your phone # for texts or go away...' + CrLf;
  }
  if (document.PuppyForm.MAOpinion.value == '') {
    ValidationErrors += 'Add details ro request!' + CrLf;
  }
  if (document.PuppyForm.MAColor.value == '') {
    ValidationErrors += 'Choose your favorite shirt color' + CrLf;
  }
  if ((document.PuppyForm.MAPass1.value == '') || (document.PuppyForm.MAPass2.value == '')) {
    ValidationErrors += 'Please enter your password, twice.' + CrLf;
  } else if (document.PuppyForm.MAPass1.value != document.PuppyForm.MAPass2.value) {
    ValidationErrors += 'Passwords entered are not the same.' + CrLf;
  }
  if (ValidationErrors == '') {
    return true;
  } else {
    alert(ValidationErrors);
    return false;
  }
}


