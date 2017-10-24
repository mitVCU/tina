<?php
/*
$Locked = file_get_contents('/home/Puppy/AppLock');
if (trim($Locked) == 'Locked') {
  $ModTime = date ("l F d, Y  H:i", filemtime('/home/tinstructor/MemberAppLocked'));
  $FormTemplate = file_get_contents('TemplatePuppyForm.html');
  $UI = "<h2>Not Accepting Applications Now</h2>\n\n<p>Applications were locked $ModTime.</p>\n<p>They'll be unlocked when we feel like it.  Try later...</p>";
  $FormTemplate = str_replace('[[[TheForm]]]',$UI , $FormTemplate);
  echo $FormTemplate;
  exit;
}
*/

function MakeTheForm($ValidationErrors) {
  if (isset($_POST['MAFirstName'])) {
    extract($_POST);
  } else {
    //Set defaults
    $MAFirstName = '';
    $MALastName = '';
    $MAAddressLine1 = '';
    $MAAddressLine2 = '';
    $MACity = '';
    $MAState = '';
    $MAZip = '';
    $MAEmail = '';
    $MASMS = '';
    $MAPuppysVisited = '';
    $MAPuppyFavorite = '';
    $MAOpinion = '';
    $MAColor = '';
    $MAPass1 = '';
    $MAPass2 = '';
    $MALeastFavoriteWeather = '';
    //$MAStatesVisited = '';
    $MAOtherPuppyVisited = '';
  }
  $RedSplat = " <span class=\"Flag\">* </span> ";
  $TheForm = "<p>Complete form and
     click Submit Form when you're done! </p>
    <fieldset>
      <legend>Contact Information</legend>\n";
  if (isset($ValidationErrors['MAFirstName'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  //$TheForm .= "\n  <ul>\n";
  $TheForm .= "      <p><label for=\"MAFirstName\">$SplatSlug First Name:</label>
          <input type=\"text\" name=\"MAFirstName\" id=\"MAFirstName\" value=\"$MAFirstName\" placeholder=\"First Name\" autofocus />
            </p><br /> \n";
  if (isset($ValidationErrors['MALastName'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  //$TheForm .= "\n  <ul>\n";
  $TheForm .= "      <p><label for=\"MALastName\">$SplatSlug Last Name:</label>
          <input type=\"text\" name=\"MALastName\" id=\"MALastName\" value=\"$MALastName\" placeholder=\"Last Name\" />
            </p><br /> \n";

  if (isset($ValidationErrors['MAAddressLine1'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  //$TheForm .= "\n  <ul>\n";
  $TheForm .= "      <p><label for=\"MAAddressLine1\">$SplatSlug Address Line 1:</label>
          <input type=\"text\" name=\"MAAddressLine1\" id=\"MAAddressLine1\" value=\"$MAAddressLine1\" placeholder=\"Address Line 1\"  />
            </p><br /> \n";
  if (isset($ValidationErrors['MAAddressLine2'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  //$TheForm .= "\n  <ul>\n";
 $TheForm .= "      <p><label for=\"MAAddressLine2\">$SplatSlug Address Line 2:</label>
          <input type=\"text\" name=\"MAAddressLine2\" id=\"MAAddressLine2\" value=\"$MAAddressLine2\" placeholder=\"Address Line 2\" />
            </p><br /> \n";
  if (isset($ValidationErrors['MACity'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  //$TheForm .= "\n  <ul>\n";
 $TheForm .= "      <p><label for=\"MACity\">$SplatSlug City:</label>
          <input type=\"text\" name=\"MACity\" id=\"MACity\" value=\"$MACity\" placeholder=\"City\"  />
            </p><br /> \n";
 if (isset($ValidationErrors['MAState'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  //$TheForm .= "\n  <ul>\n";
 $TheForm .= "      <p><label for=\"MAState\">$SplatSlug State:</label>
          <input type=\"text\" name=\"MAState\" id=\"MAState\" value=\"$MAState\" placeholder=\"State\"  />
            </p><br /> \n";
if (isset($ValidationErrors['MAZip'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  //$TheForm .= "\n  <ul>\n";
 $TheForm .= "      <p><label for=\"MAZip\">$SplatSlug Zipcode:</label>
          <input type=\"text\" name=\"MAZip\" id=\"MAZip\" value=\"$MAZip\" placeholder=\"Zipcode\" />
            </p><br /> \n";
  if (isset($ValidationErrors['MAEmail'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "       <p><label for=\"MAEmail\">$SplatSlug Email:</label>
          <input type=\"text\" name=\"MAEmail\" id=\"MAEmail\" value=\"$MAEmail\" placeholder=\"Valid E-mail address\" />
            </p><br />  \n";

  if (isset($ValidationErrors['MASMS'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "      <p><label for=\"MASMS\">$SplatSlug Text/SMS#:</label>
          <input type=\"text\" name=\"MASMS\" id=\"MASMS\" value=\"$MASMS\" placeholder=\"10 digits like 123 123 1234\" />
          </p>  <br />   \n";

 if (isset($ValidationErrors['MAPass'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = '';}
   $TheForm .= "
          <p><label for=\"MAPass1\">$SplatSlug Password:</label>
          <input type=\"text\" name=\"MAPass1\" id=\"MAPass1\" value=\"$MAPass1\" placeholder=\"8 character minimum\" />
      </p><br /> \n";;
  $TheForm .= "
          <p><label for=\"MAPass2\">Confirm Password:</label>
          <input type=\"text\" name=\"MAPass2\" id=\"MAPass2\" value=\"$MAPass2\" placeholder=\"Enter it again, please\" />
        </p><br /> \n";

$TheForm .= "
   </fieldset>\n";
  $TheForm .= "   <fieldset><legend>Popular Options</legend>\n";
  //Make check boxes for MAPuppysVisited[] and radio buttons for FavPuppy from file StatesSE
  $StatesSEFile = fopen('/home/tle2/OptionsStatesSE','r');
  $FavStateRB = '';
  while ($AState = fgets($StatesSEFile)) {
    $AState = trim($AState);
    $AStateNoSpaces = str_replace(' ','',$AState);  //Used to make id with no spaces so extract() will work
    if (isset($MAPuppysVisited) and $MAPuppysVisited != '' and in_array($AState, $MAPuppysVisited)) {
      $CheckedSlug = 'checked';
    } else {
      $CheckedSlug = '';
    }
    $TheForm .= "       <label for=\"Visited$AStateNoSpaces\" class=\"WideLabel\">
         <input type=\"checkbox\" name=\"MAPuppysVisited[]\" id=\"Visited$AStateNoSpaces\" value=\"$AState\" $CheckedSlug />$AState
       </label>\n";
    if (isset($MAPuppyFavorite) and $AState == $MAPuppyFavorite) {
      $CheckedSlug = 'checked';
    } else {
      $CheckedSlug = '';
    }
    $FavStateRB .= "       <label for=\"Fav$AStateNoSpaces\" class=\"WideLabel\">
         <input type=\"radio\" name=\"MAPuppyFavorite\" id=\"Fav$AStateNoSpaces\" value=\"$AState\" $CheckedSlug />$AState
       </label>";
  }
  $TheForm .= "    </fieldset>
    <fieldset><legend>Favorite Pups</legend>
$FavStateRB
    </fieldset>";

  $TheForm .= "
    <fieldset>
      <legend>Requests</legend>
      <div class=\"Row\">\n";
  if (isset($ValidationErrors['MAOpinion'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "   <div class=\"Col-12\">
          <label for=\"MAOpinion\" class=\"WideLabel\">$SplatSlug Specific Requests</label>
            <textarea name=\"MAOpinion\" id=\"MAOpinion\" placeholder=\"Dog breed (ex. golden retriever, Corgi, pit bull, mix, random....\">$MAOpinion</textarea>
        </div>
        </div>
      <div class=\"Row\"><br />";
  //Hard coded small select
  if (isset($ValidationErrors['MALeastFavoriteWeather'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "
        <div class=\"Col-4\">
           <label for=\"MALeastFavoriteWeather\" class=\"WideLabel\">$SplatSlug Favorite Season?</label>
           <select name=\"MALeastFavoriteWeather\" id=\"MALeastFavoriteWeather\" size=\"5\">
 ";
  if ($MALeastFavoriteWeather == 'Heat') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "            <option value=\"Heat\" $SelectedSlug>Spring</option>\n";
  if ($MALeastFavoriteWeather == 'Humidity') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "             <option value=\"Humidity\" $SelectedSlug>Summer</option>\n";
  if ($MALeastFavoriteWeather == 'Thunder') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "             <option value=\"Thunder\" $SelectedSlug>Fall</option>\n";
  if ($MALeastFavoriteWeather == 'Rain') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "             <option value=\"Rain\" $SelectedSlug>Winter</option>\n";
  if ($MALeastFavoriteWeather == 'Snow') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "             <option value=\"Snow\" $SelectedSlug>None</option>";
  $TheForm .= "
           </select>
        </div>\n";
  //Another hard coded single select with background-color
  if (isset($ValidationErrors['MAColor'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "
        <div class=\"Col-4\">\n           <label for=\"MAColor\" class=\"WideLabel\">$SplatSlug Current Shirt Color?</label>
             <select name=\"MAColor\" id=\"MAColor\" size=\"7\">\n";
  if (!isset($MAColor)) $MAColor = '';
  if ($MAColor == 'Red') { $SelectedSlug = "selected "; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"Red\" style=\"background-color: red;\" $SelectedSlug>Red</option>\n";
  if ($MAColor == 'Orange') { $SelectedSlug = "selected "; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"Orange\" style=\"background-color: orange;\" $SelectedSlug>Orange</option>\n";
  if ($MAColor == 'Yellow') { $SelectedSlug = "selected "; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"Yellow\" style=\"background-color: yellow;\" $SelectedSlug>Yellow</option>\n";
  if ($MAColor == 'Green') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"Green\" style=\"background-color: green;\"  $SelectedSlug>Green</option>\n";
  if ($MAColor == 'Blue') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"Blue\" style=\"color:white; background-color: blue;\"  $SelectedSlug>Blue</option>\n";
  if ($MAColor == 'Indigo') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"indigo\" style=\"color:white; background-color: indigo;\"  $SelectedSlug>Indigo</option>\n";
  if ($MAColor == 'Violet') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"violet\" style=\"background-color: violet;\"  $SelectedSlug>Violet</option>
            </select>
        </div>\n";

  //Multi-select using contents of text file with Options...
  $TheForm .= "
        <div class=\"Col-4\">
          <label for=\"MAOtherPuppy\" class=\"WideLabel\">How Many?<br />
          <span class=\"FinePrint\">(Ctrl-click for multiple)</span></label>
          <select name=\"MAOtherPuppyVisited[]\" id=\"MAOtherPuppyVisited\" size=\"12\" multiple>\n";
  $StatesNotSEFile = fopen('/home/tle2/OptionsStatesNotSE','r');
  while ($AState = fgets($StatesNotSEFile)) {
    $AState = trim($AState);
    //$AStateNoSpaces = str_replace(' ','',$AState);
    if (isset($MAOtherPuppyVisited) and $MAOtherPuppyVisited != '' and in_array($AState, $MAOtherPuppyVisited)) { $SelectedSlug = 'selected'; } else { $SelectedSlug = ''; }
    $TheForm .= "             <option value=\"$AState\" $SelectedSlug >$AState</option>\n";
  }
  $TheForm .= "          </select>
        </div>\n";

  $TheForm .= "    </div>\n";
  $TheForm .= " </fieldset>\n";
  return $TheForm;
}
//
//Mainline
//Set if initially $PoppedUp or not, then track it, used to control Close Window button
$PoppedUp = isset($_REQUEST['PoppedUp']);
if (!isset($_REQUEST['View'])) {
  $View = 'First';
} else {
  $View = $_REQUEST['View'];
}
if ($View == 'First') {
  //This is their first time at the page, explain stuff and make the form with empty $_POST...
  $UI = "  <h2>Rent-A-Pup Membership Application</h2>
   <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
   <form method=\"POST\" name=\"PuppyForm\" action=\"PuppyForm.php\" onSubmit=\"return ValidateForm();\">";
  if ($PoppedUp) $UI .= "\n<input type=\"hidden\" name=\"PoppedUp\" value=\"Yep\">\n";
  $UI .= MakeTheForm('');
  $UI .= "
     <p>Click <input type=\"submit\" name=\"View\" value=\"Submit Form\"> to submit your completed form to Rent-A-Pup.  </p>
     <p>Uncheck the box to disable JS ValidateForm: <input type=\"checkbox\" name=\"RunJS\" id=\"RunJS\" checked=\"checked\"></p>
     <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
</form>";
} elseif ($View == 'Submit Form') {
  //They've filled in the form and clicked the Submit button, should be error free unless they've disabled JavaScript
  //on their browser or the content is submitted by a bot.
  $ValidationErrors = '';
  extract($_POST);
  //Validate what came back.
  if (!isset($MAName) or $MAName == '') $ValidationErrors['MAName'] = "Name is missing or empty.  Please enter your name before clicking Submit.";
  if (!isset($MAEmail) or $MAEmail == '') {
    $ValidationErrors['MAEmail'] = "The email address is empty.  Please enter your email address before clicking Submit.";
  } elseif (filter_var($MAEmail, FILTER_VALIDATE_EMAIL) === false) {
    $ValidationErrors['MAEmail'] = "The email  is not a valid format.";
  }
  if (!isset($MASMS) or strlen($MASMS) < 10) $ValidationErrors['MASMS'] = "Please enter the 10-digit number where you receive text messages.";
  if (!isset($MAOpinion) or strlen($MAOpinion) < 50) $ValidationErrors['MAOpinion'] = "Please opine for at least 50 characters. Your opinion weighs heavily on our decision to accept you into the society.";
  if (!isset($MALeastFavoriteWeather) or $MALeastFavoriteWeather == '') {
    $_POST['MALeastFavoriteWeather'] = '';
    $ValidationErrors['MALeastFavoriteWeather'] = "Please select your least favorite weather.";
  }
  if (!isset($MAColor) or $MAColor == '') $ValidationErrors['MAColor'] = "Please select your favorite, or least un-favorite, color.";
  if (!isset($MAPuppyFavorite) or $MAPuppyFavorite  == '') $ValidationErrors['MAPuppyFavorite'] = "You must select your favorite Southeastern state to have your application considered.";
  if ((!isset($MAPass1) or $MAPass1  == '') or (!isset($MAPass2) or $MAPass2  == '')) {
    $ValidationErrors['MAPass'] = "Enter your password twice, please.";
  } elseif ($MAPass1 != $MAPass2) {
    $ValidationErrors['MAPass'] = "Passwords do not match.";
  }
  //$CountPuppys
  $UI = '';
  if (is_array($ValidationErrors)) {
    $ErrorCount = count($ValidationErrors);
    if ($ErrorCount == 1) {
      $UI .= "<p>Please correct this error, then click Submit Form:</p>\n";
    } else {
      $UI .= "<p>Please correct $ErrorCount errors, then click Submit Form:</p>\n";
    }
    $UI .= "<ul>\n";
    foreach ($ValidationErrors as $AnErrorMessage) {
      $UI .= "   <li>$AnErrorMessage</li>\n ";
    }
    $UI .= "</ul>\n";
  } else {
    $UI .= "<p>Your form appears correct and would have been applied to the database
    if we felt like it.  You're welcome to make any corrections that might be
    needed click Submit Form...</p>";
  }
  $UI .= "<form method=\"POST\" name=\"PuppyForm\" action=\"PuppyForm.php\" onSubmit=\"return ValidateForm();\">\n";
  $UI .= "<h2> Membership Application</h2>\n";
  $UI .= MakeTheForm($ValidationErrors);
  if ($PoppedUp) $UI .= "\n<input type=\"hidden\" name=\"PoppedUp\" value=\"Yep\" >\n";
  $UI .= " <p>Run JS ValidateForm: <input type=\"checkbox\" name=\"RunJS\" id=\"RunJS\" checked=\"checked\">  Click <input type=\"submit\" name=\"View\" value=\"Submit Form\"> if changes have been made.  </p>
     <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
 </form>";
  if ($PoppedUp) {
    $UI .= "<p>Click <input type=button value='Close Window' onclick='window.close()'> to close this window when you're done making changes...</p>";
  } else {
    $UI .= "<p>Use your browser's 'back button' or Alt + Left Arrow to return to the previous page...</p>";
  }
} else {
  $UI = "<p><font color=red>! </font>Somehow we don't know what your next view should be '$View' is not valid...</p>";
}
$FormTemplate = file_get_contents('TemplatePuppyForm.html');
$FormTemplate = str_replace('[[[TheForm]]]', $UI, $FormTemplate);
echo $FormTemplate;
exit;
?>
